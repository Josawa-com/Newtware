#!/usr/bin/env bash
#
# One-shot setup for a fresh checkout, then hand over to run-local.sh
# which serves the app on the local Wi-Fi network.
#
# Usage: ./setup-and-serve.sh [port]
#
set -euo pipefail

cd "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

if [[ ! -d vendor ]]; then
    echo "→ Installing PHP dependencies..."
    composer install --no-interaction --prefer-dist
fi

if [[ ! -f .env ]]; then
    echo "→ Creating .env from .env.example..."
    cp .env.example .env
    php artisan key:generate --no-interaction
fi

if [[ ! -d node_modules ]]; then
    echo "→ Installing Node dependencies..."
    if [[ -f package-lock.json ]]; then
        npm ci
    else
        npm install
    fi
fi

if [[ ! -f database/database.sqlite ]]; then
    echo "→ Creating SQLite database file..."
    mkdir -p database
    touch database/database.sqlite
fi

echo "→ Running migrations..."
php artisan migrate --no-interaction --force

echo "→ Building front-end assets..."
npm run build

exec ./run-local.sh "${1:-8000}"
