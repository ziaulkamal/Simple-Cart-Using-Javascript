# Simple Cart JS Laravel

Ini adalah proyek Laravel 10 yang mengimplementasikan fitur Simple Cart menggunakan JavaScript.

## Persyaratan

- PHP >= 8.1
- Composer
- MySQL atau database lain yang didukung Laravel

## Langkah-langkah Instalasi

1. **Clone repositori ini:**

    ```bash
    git clone https://github.com/ziaulkamal/Simple-Cart-Using-Javascript.git
    cd Simple-Cart-Using-Javascript
    ```

2. **Install dependencies menggunakan Composer:**

    ```bash
    composer install
    ```

3. **Buat file `.env` dari `.env.example`:**

    ```bash
    cp .env.example .env
    ```

4. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

5. **Konfigurasi file `.env`:**

    Edit file `.env` dan atur parameter database Anda. Contoh:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_anda
    DB_PASSWORD=password_anda
    ```

6. **Jalankan migrasi dan seed database:**

    ```bash
    php artisan migrate:fresh --seed
    ```

    Perintah ini akan menghapus semua tabel di database Anda dan membuatnya kembali dari awal, lalu menjalankan semua seeder termasuk seeder untuk mengimpor data dari file SQL.

## Menjalankan Server

Setelah semua langkah di atas selesai, Anda bisa menjalankan server pengembangan Laravel menggunakan perintah:

```bash
php artisan serve
