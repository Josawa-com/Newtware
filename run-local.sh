#!/usr/bin/env bash
#
# Serve this Laravel app on the local Wi-Fi network so phones
# (and other devices on the same network) can open it.
#
# Usage: ./run-local.sh [port]
#
set -euo pipefail

PORT="${1:-${PORT:-8000}}"
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"

# ---------------------------------------------------------------
# 1. Work out the LAN address from the interface holding the
#    default route (that is the one the Wi-Fi network uses).
# ---------------------------------------------------------------
IFACE="$(ip route 2>/dev/null | awk '$1 == "default" { iface = $5 } END { print iface }')"
if [[ -n "${IFACE:-}" ]]; then
    IP="$(ip -4 addr show "$IFACE" 2>/dev/null | awk '/inet / { if (!ip) { split($2, a, "/"); ip = a[1] } } END { print ip }')"
fi
IP="${IP:-$(hostname -I 2>/dev/null | awk '{print $1}')}"

if [[ -z "${IP:-}" ]]; then
    echo "✗ Tidak bisa menentukan alamat IP lokal." >&2
    exit 1
fi

# ---------------------------------------------------------------
# 2. If the background service is already serving, just report it.
# ---------------------------------------------------------------
if systemctl --user is-active --quiet netware-lan.service 2>/dev/null; then
    echo
    echo "  ✓ Server sudah berjalan otomatis (netware-lan.service)."
    echo
    echo "    Lokal   : http://localhost:${PORT}"
    echo "    HP/Wi-Fi: http://${IP}:${PORT}"
    echo
    echo "  Buka alamat HP/Wi-Fi di browser ponsel (jaringan Wi-Fi sama)."
    echo "  Kelola dengan: systemctl --user {status,restart,stop} netware-lan"
    echo
    exit 0
fi

# ---------------------------------------------------------------
# 3. Make sure nothing else already owns the port. This is what
#    previously made the phone show a different website: another
#    Docker container was publishing port 8000.
# ---------------------------------------------------------------
if ss -ltn 2>/dev/null | grep -q ":${PORT} "; then
    echo "✗ Port ${PORT} sudah dipakai proses lain:"
    ss -ltnp 2>/dev/null | grep ":${PORT} " || true

    # Try to be helpful when it is a Docker container publishing the port.
    if command -v docker >/dev/null 2>&1; then
        CONTAINERS="$(docker ps --format '{{.Names}} {{.Ports}}' 2>/dev/null | awk -v p=":${PORT}->" 'index($0, p) {print $1}')"
        if [[ -n "$CONTAINERS" ]]; then
            for name in $CONTAINERS; do
                echo "→ Menghentikan container Docker '${name}' yang memakai port ${PORT}..."
                docker stop "$name" >/dev/null
            done
            sleep 1
        fi
    fi

    if ss -ltn 2>/dev/null | grep -q ":${PORT} "; then
        echo "✗ Port ${PORT} masih dipakai. Hentikan manual lalu jalankan lagi." >&2
        exit 1
    fi
fi

# ---------------------------------------------------------------
# 4. Remove Vite's "hot" file. While it exists Laravel points asset
#    URLs at 127.0.0.1:5173, which a phone cannot reach (that is
#    the phone's own localhost), so pages render unstyled/blank.
# ---------------------------------------------------------------
if [[ -f public/hot ]]; then
    echo "→ Menghapus public/hot agar aset memakai hasil build (bukan dev server)."
    rm -f public/hot
fi

if [[ ! -f public/build/manifest.json ]]; then
    echo "→ Aset belum dibangun, menjalankan npm run build..."
    npm run build
fi

# ---------------------------------------------------------------
# 5. Point APP_URL at the LAN address so generated URLs are correct.
# ---------------------------------------------------------------
if grep -q '^APP_URL=' .env; then
    sed -i "s|^APP_URL=.*|APP_URL=http://${IP}:${PORT}|" .env
else
    printf 'APP_URL=http://%s:%s\n' "$IP" "$PORT" >> .env
fi
php artisan config:clear >/dev/null 2>&1 || true

# ---------------------------------------------------------------
# 6. Start the server on every interface.
# ---------------------------------------------------------------
echo
echo "  Lokal   : http://localhost:${PORT}"
echo "  HP/Wi-Fi: http://${IP}:${PORT}"
echo
echo "  Buka alamat HP/Wi-Fi di browser ponsel (jaringan Wi-Fi sama)."
echo "  Tekan Ctrl+C untuk berhenti."
echo

exec php artisan serve --host=0.0.0.0 --port="$PORT"
