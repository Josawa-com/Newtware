#!/usr/bin/env bash
#
# Preparation step for the netware-lan systemd user service.
# Runs before `php artisan serve` starts.
#
# - free port 8000 if a stale process is still bound to it
# - remove Vite's "hot" file so built assets are used on other devices
# - keep APP_URL in sync with the current LAN address
#
set -euo pipefail

ROOT="/home/syandana/Documents/Rezka/Kokurikuler"
PORT="${PORT:-8000}"
cd "$ROOT"

IFACE="$(ip route 2>/dev/null | awk '$1 == "default" { iface = $5 } END { print iface }')"
if [[ -n "${IFACE:-}" ]]; then
    IP="$(ip -4 addr show "$IFACE" 2>/dev/null | awk '/inet / { if (!ip) { split($2, a, "/"); ip = a[1] } } END { print ip }')"
fi
IP="${IP:-$(hostname -I 2>/dev/null | awk '{print $1}')}"

if [[ -z "${IP:-}" ]]; then
    echo "prepare: cannot determine LAN IP" >&2
    exit 1
fi

# Free the port from anything that is not our own service.
# NOTE: avoid `| grep -q` here — it can SIGPIPE the upstream command, and
# with `set -o pipefail` the whole script would abort.
PORT_IN_USE="$(ss -ltn 2>/dev/null | grep ":${PORT} " || true)"
if [[ -n "$PORT_IN_USE" ]]; then
    # Docker publishes ports through a root-owned proxy, so it cannot be
    # detected via `ss -p`. Ask Docker directly first.
    if command -v docker >/dev/null 2>&1; then
        mapfile -t CONTAINERS < <(
            docker ps --format '{{.Names}}\t{{.Ports}}' 2>/dev/null |
                awk -F'\t' -v p=":${PORT}->" 'index($2, p) {print $1}'
        )
        for name in "${CONTAINERS[@]:-}"; do
            [[ -z "$name" ]] && continue
            echo "prepare: stopping container '${name}' which publishes port ${PORT}" >&2
            docker stop "$name" >/dev/null 2>&1 || true
        done
        [[ ${#CONTAINERS[@]} -gt 0 ]] && sleep 1
    fi

    OWNER_PID="$(ss -ltnp 2>/dev/null | awk -v p=":${PORT} " 'index($0, p) && !found {match($0, /pid=[0-9]+/); if (RSTART) { print substr($0, RSTART + 4, RLENGTH - 4); found = 1 }}')"
    if [[ -n "${OWNER_PID:-}" ]] && [[ -r "/proc/${OWNER_PID}/cmdline" ]]; then
        OWNER_CMD="$(tr '\0' ' ' < "/proc/${OWNER_PID}/cmdline")"
        # Never kill our own server (artisan serve or its php -S child).
        if [[ "$OWNER_CMD" != *"artisan serve"* ]] && [[ "$OWNER_CMD" != *"${ROOT}"* ]]; then
            echo "prepare: stopping stale process ${OWNER_PID} on port ${PORT}" >&2
            kill "$OWNER_PID" 2>/dev/null || true
            sleep 1
        fi
    fi
fi

rm -f public/hot

if [[ ! -f public/build/manifest.json ]]; then
    npm run build >/dev/null 2>&1 || true
fi

if grep -q '^APP_URL=' .env; then
    sed -i "s|^APP_URL=.*|APP_URL=http://${IP}:${PORT}|" .env
else
    printf 'APP_URL=http://%s:%s\n' "$IP" "$PORT" >> .env
fi
php artisan config:clear >/dev/null 2>&1 || true

echo "prepare: serving http://${IP}:${PORT}"
