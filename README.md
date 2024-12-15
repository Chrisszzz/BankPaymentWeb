# Bank Payment Web

Proyek ini adalah sistem pembayaran menggunakan virtual account berbasis web yang dibuat dengan Laravel.

---

## Cara Menjalankan Proyek

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1. Aktifkan XAMPP dan Konfigurasi Database
1. Buka **XAMPP Control Panel** dan aktifkan modul berikut:
   - Klik tombol **Start** pada **Apache**.
   - Klik tombol **Start** pada **MySQL**.
   
2. Buka **phpMyAdmin** melalui [http://localhost/phpmyadmin](http://localhost/phpmyadmin).

3. Buat database baru:
   - Klik **New** di sisi kiri.
   - Masukkan nama database, misalnya: `bank_payment_web`.
   - Klik **Create**.

---

### 2. Instal Dependensi Laravel
1. Pastikan Anda memiliki **Composer** terinstal di komputer Anda. Jika belum, unduh dari [getcomposer.org](https://getcomposer.org/).
2. Buka terminal atau command prompt di direktori proyek ini.
3. Jalankan perintah berikut untuk menginstal semua dependensi Laravel:

   ```bash
   composer install

### 3. Atur File Konfigurasi .env
Pastikan file .env tersedia di direktori root proyek. Jika tidak ada, salin file .env.example menjadi .env:

jalankan di terminal perintah dibawah ini :

```bash
cp .env.example .env

Edit file .env menggunakan editor teks dan sesuaikan pengaturan database Anda:

plaintext
Salin kode
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bank_payment_web
DB_USERNAME=root
DB_PASSWORD=
(Gantilah DB_USERNAME dan DB_PASSWORD sesuai dengan konfigurasi MySQL Anda. Default biasanya root tanpa password.)

### 4. Generate Application Key
Jalankan perintah berikut untuk menghasilkan kunci enkripsi aplikasi Laravel:
php artisan key:generate

Periksa file .env Anda, dan pastikan baris APP_KEY telah terisi dengan kunci yang valid.

5. Jalankan Server Laravel
Jalankan perintah berikut untuk memulai server pengembangan Laravel:
php artisan serve

Setelah server berjalan, buka browser Anda dan akses proyek di:
http://localhost:8000.

### Fitur
Login dan autentikasi pengguna.
Pengelolaan virtual account.
Pembayaran tagihan secara otomatis.

###Teknologi
Laravel 6
MySQL
Bootstrap 4
