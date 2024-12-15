# Bank Payment Web
## Deskripsi Proyek

**Sistem Pembayaran Universitas** adalah aplikasi berbasis web yang dirancang untuk mempermudah pengelolaan pembayaran di tingkat universitas melalui mekanisme virtual account (VA). Sistem ini fokus pada pengelolaan oleh **Admin Bank**, dengan fitur-fitur utama yang mendukung kelancaran operasional pembayaran.

---

## Fitur Utama

1. **Manajemen Request Virtual Account (VA)**  
   - Admin bank dapat menangani request VA yang masuk dari sistem universitas.  
   - Nomor VA akan dihasilkan (digenerate) secara otomatis berdasarkan permintaan.

2. **Validasi Transaksi Berhasil**  
   - Sistem mampu memvalidasi transaksi pembayaran yang berhasil.  
   - Status pembayaran akan diperbarui sesuai dengan hasil validasi.

3. **Log Transaksi**  
   - Admin bank dapat melihat log semua transaksi yang telah terjadi.  
   - Log mencakup detail seperti nomor VA, waktu transaksi, status, dan jumlah pembayaran.

4. **Manajemen Master Data**  
   - Admin bank dapat menetapkan harga untuk item atau layanan tertentu.  
   - Master data memungkinkan pengelolaan informasi yang konsisten dan terpusat.

5. **CRUD Instansi**  
   - Admin bank dapat melakukan operasi **Create**, **Read**, **Update**, dan **Delete** terhadap data instansi yang bekerja sama dengan sistem.  
   - Mempermudah pengelolaan mitra universitas dalam sistem pembayaran.

---

## Tujuan Proyek

- Mempermudah admin bank dalam mengelola pembayaran universitas.
- Mengurangi kesalahan manual dalam proses validasi dan pencatatan transaksi.
- Memberikan transparansi kepada pihak bank terkait status transaksi dan permintaan pembayaran.
- Menyediakan data yang terstruktur dan konsisten melalui pengelolaan master data dan log transaksi.

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
cp .env.example .env

Edit file .env menggunakan editor teks dan sesuaikan pengaturan database Anda:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=bank_payment_web
- DB_USERNAME=root
- DB_PASSWORD= (Gantilah DB_USERNAME dan DB_PASSWORD sesuai dengan konfigurasi MySQL Anda. Default biasanya root tanpa password.)

### 4. Generate Application Key
Jalankan perintah berikut untuk menghasilkan kunci enkripsi aplikasi Laravel:
php artisan key:generate

Periksa file .env Anda, dan pastikan baris APP_KEY telah terisi dengan kunci yang valid.

### 5. Jalankan Server Laravel
Jalankan perintah berikut untuk memulai server pengembangan Laravel:
php artisan serve

Setelah server berjalan, buka browser Anda dan akses proyek di:
http://localhost:8000.

### Fitur
- Login dan autentikasi pengguna.
- Pengelolaan virtual account.
- Pembayaran tagihan secara otomatis.

### Teknologi
- Laravel 6
- MySQL
- Bootstrap 4
