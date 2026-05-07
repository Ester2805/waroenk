# 🛍️ Waroenk — Platform E-Commerce Laravel

Waroenk adalah aplikasi e-commerce berbasis web yang dibangun dengan **Laravel 12**, dilengkapi fitur belanja, keranjang, checkout, manajemen pesanan, dan panel admin lengkap.

---

## 🧰 Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | PHP 8.3, Laravel 12 |
| Frontend | Blade, TailwindCSS 4, Vite 7 |
| Database | MySQL 8.0 (via Docker) |
| Cache & Queue | Redis |
| Mail Testing | Mailpit |
| Browser Testing | Selenium |
| Container | Docker via Laravel Sail |

---

## ✨ Fitur Utama

### 👤 Customer
- Landing page & katalog produk
- Pencarian produk
- Halaman detail produk
- Keranjang belanja (tambah, hapus, ubah jumlah)
- Checkout dengan pilihan pengiriman & metode pembayaran
- Riwayat pesanan & detail pesanan
- Rating produk per item pesanan
- Manajemen profil

### 🔧 Admin Panel (`/admin`)
- Dashboard admin
- Manajemen Produk (CRUD)
- Manajemen Kategori (CRUD)
- Manajemen Pengguna
- Manajemen Opsi Pengiriman (CRUD)
- Laporan Penjualan
- Analitik
- Pembaruan status pesanan

---

## 🗃️ Struktur Database

| Tabel | Deskripsi |
|---|---|
| `users` | Data pengguna (customer & admin) |
| `products` | Data produk beserta stok, harga, gambar |
| `categories` | Kategori produk |
| `orders` | Data pesanan termasuk info pengiriman & pembayaran |
| `order_items` | Item per pesanan, termasuk rating |
| `shipping_options` | Opsi pengiriman yang tersedia |
| `cache` | Cache Laravel |
| `jobs` | Antrian pekerjaan (queue) |

---

## 🚀 Cara Setup (Menggunakan Docker / Laravel Sail)

### Prasyarat
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) terinstal dan berjalan
- Git Bash atau WSL2 (untuk menjalankan perintah Sail di Windows)

### 1. Clone Repositori
```bash
git clone <url-repositori> waroenk
cd waroenk
```

### 2. Copy File Environment
```bash
cp .env.example .env
```

### 3. Install Dependensi PHP
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Build dan Jalankan Container
```bash
bash vendor/bin/sail build --no-cache
bash vendor/bin/sail up -d
```

### 5. Generate Application Key
```bash
bash vendor/bin/sail artisan key:generate
```

### 6. Jalankan Migrasi Database
```bash
bash vendor/bin/sail artisan migrate
```

### 7. (Opsional) Jalankan Seeder
```bash
bash vendor/bin/sail artisan db:seed
```

### 8. Install Dependensi NPM & Build Aset
```bash
bash vendor/bin/sail npm install
bash vendor/bin/sail npm run build
```

---

## 🔧 Cara Setup Lokal (Tanpa Docker)

### Prasyarat
- PHP 8.3
- Composer
- MySQL atau SQLite
- Node.js & NPM

```bash
# Install dependensi
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di .env, lalu:
php artisan migrate

# Build aset
npm run build

# Jalankan server
php artisan serve
```

---

## 🌐 Akses Layanan

| Layanan | URL |
|---|---|
| Aplikasi Web | http://localhost:8080 |
| Mailpit (Email Testing) | http://localhost:8025 |
| MySQL (dari host) | localhost:3307 |

> **Catatan:** Port dapat disesuaikan melalui variabel di file `.env`.

---

## 📁 Struktur Direktori

```
waroenk/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controller utama (Cart, Order, Product, dll)
│   │   │   └── Admin/          # Controller khusus panel admin
│   │   └── Middleware/         # Middleware (auth, admin, customer)
│   ├── Models/                 # Eloquent Models
│   └── Providers/
├── database/
│   ├── migrations/             # Skema database
│   ├── seeders/                # Data awal
│   └── factories/
├── docker/
│   ├── 8.3/                    # Konfigurasi Dockerfile PHP 8.3 (aktif)
│   └── mysql/                  # Skrip inisialisasi database MySQL
├── public/                     # Aset publik (CSS, JS, gambar)
├── resources/
│   ├── css/                    # Stylesheet sumber
│   ├── js/                     # JavaScript sumber
│   └── views/                  # Template Blade
├── routes/
│   └── web.php                 # Definisi semua route
├── .env                        # Konfigurasi environment (tidak di-commit)
├── .env.example                # Template konfigurasi environment
├── compose.yaml                # Konfigurasi Docker Compose (Laravel Sail)
├── composer.json               # Dependensi PHP
└── package.json                # Dependensi JavaScript
```

---

## ⚙️ Variabel Environment Penting

```env
# Aplikasi
APP_NAME=Laravel
APP_PORT=8080            # Port web app di host

# Database
DB_CONNECTION=mysql
DB_HOST=mysql            # Nama service di Docker
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
FORWARD_DB_PORT=3307     # Port MySQL yang diekspos ke host

# Redis
REDIS_HOST=redis

# Mail (Testing)
MAIL_HOST=mailpit
MAIL_PORT=1025
```

---

## 📜 Lisensi

Proyek ini bersifat privat dan dikembangkan untuk keperluan internal.
