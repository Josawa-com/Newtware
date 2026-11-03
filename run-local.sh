#!/usr/bin/env bash
# Determine local IP address (first non-loopback IPv4)
IP=$(hostname -I | awk '{print $1}')
if [[ -z "$IP" ]]; then
  echo "Could not determine local IP address."
  exit 1
fi

# Update .env APP_URL if it differs
sed -i "s|^APP_URL=.*|APP_URL=http://$IP:8000|g" .env

echo "Starting Laravel server on http://$IP:8000 (listening on all interfaces)..."
php artisan serve --host=0.0.0.0 --port=8000
