<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## Local Network Preview

For quick testing on other devices on the same Wi‑Fi network you can start the Laravel dev server on all interfaces.

```bash
# Make sure Vite assets are built (if you haven't already)
npm run build

# Run the helper script (creates/updates APP_URL to your local IP and starts the server)
./run-local.sh
```

Then open a browser on your phone and navigate to `http://<your‑IP>:8000`.

(Replace `<your‑IP>` with the IPv4 address shown when the script starts.)

## Local Network Preview (akses dari HP)

Aplikasi ini otomatis disajikan di jaringan Wi‑Fi lokal pada port **8000**
lewat systemd user service `netware-lan`, jadi Anda tidak perlu menjalankan
apa pun secara manual.

**Alamat yang dibuka di HP:**

```
http://192.168.1.8:8000
```

(IP bisa berubah kalau router memberi alamat baru. Lihat IP terbaru dengan
`hostname -I | awk '{print $1}'` atau dari `./run-local.sh`.)

### Cara pakai sehari-hari

```bash
./run-local.sh            # cek alamat + pastikan server hidup
./run-local.sh 8080       # (opsional) pakai port lain
```

Perintah lain untuk mengelola server:

```bash
systemctl --user status  netware-lan    # cek status
systemctl --user restart netware-lan    # restart
systemctl --user stop    netware-lan    # berhenti
```

Service ini otomatis hidup lagi setelah login/reboot, dan otomatis
restart kalau prosesnya mati. Log ada di `/tmp/opencode/netware-lan.log`.

### Hal yang perlu diketahui

- **Jangan** menjalankan `npm run dev` / `composer run dev` saat mengakses
  dari HP. Mode itu membuat `public/hot` berisi `http://127.0.0.1:5173`
  yang tidak bisa dijangkau HP (aset jadi gagal dimuat). `run-local.sh`
  dan service otomatis menghapus file itu dan memakai hasil `npm run build`.
- **Port 8000 dipakai bersama proyek lain.** Proyek `LocalCulture`
  (`/home/syandana/Documents/Rezka/LocalCulture`) memakai port 8000 lewat
  Docker dan sebelumnya membuat HP menampilkan "Culture Raya" bukan
  Netware. Container itu sudah dihentikan dan `restart` diset `no`.
  Kalau ingin menjalankan keduanya bersamaan, ubah port Culture Raya:

  ```bash
  cd /home/syandana/Documents/Rezka/LocalCulture
  APP_PORT=8081 docker compose up -d
  ```

  `scripts/lan-prepare.sh` juga akan menghentikan container yang menyerobot
  port 8000 saat service dinyalakan.
- **Firewall / VPN.** Jika HP tetap tidak bisa membuka alamatnya, izinkan
  port 8000 (`sudo ufw allow 8000`) dan pastikan router tidak mengaktifkan
  *AP/client isolation*. Cloudflare WARP di mesin ini tidak memblokir
  trafik LAN (rute `192.168.1.0/24` tetap lewat Wi‑Fi).

## Full setup & launch

If this repository is fresh on a machine, run the one‑liner below. It will install PHP & JS dependencies, create the SQLite file, run migrations (if any), build assets and finally launch the server on your LAN.

```bash
./setup-and-serve.sh
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
