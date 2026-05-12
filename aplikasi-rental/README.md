# Rental Ananda - Sistem Rental Mobil

Sistem manajemen rental mobil berbasis Laravel dengan 3 role: **Admin**, **Customer**, dan **Owner**.

---

## Fitur Sistem

### 🌐 Landing Page (Publik)
- Beranda dengan hero section dan informasi layanan
- Halaman Tentang Kami
- Halaman Kontak
- Link ke Login / Register

### 👤 Customer
- Registrasi akun baru
- Dashboard personal
- **Pesan Mobil** – pilih mobil tersedia, tentukan tanggal
- **Pembayaran** – konfirmasi transfer manual (BCA/BNI/Mandiri)
- **Histori** – riwayat semua pemesanan
- **Feedback** – beri ulasan dan lihat balasan

### 🔧 Admin
- Dashboard ringkasan data
- **Kelola Mobil** – CRUD + cetak data
- **Kelola User** – tambah/hapus semua user
- **Tanggapi Feedback** – balas feedback customer

### 👑 Owner
- Dashboard statistik bisnis
- **Laporan** – pendapatan, pemesanan per bulan, mobil terpopuler
- **Tanggapi Feedback** – balas feedback customer

---

## Cara Menjalankan

### 1. Install Dependencies
```bash
composer install
```

### 2. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`, pastikan konfigurasi database:
```
DB_CONNECTION=sqlite
DB_DATABASE=/path/absolut/ke/database/database.sqlite
```

### 3. Setup Database
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### 4. Jalankan Server
```bash
php artisan serve
```

Akses: `http://localhost:8000`

---

## Akun Demo

| Role     | Email                | Password     |
|----------|----------------------|--------------|
| Admin    | admin@rental.com     | password123  |
| Owner    | owner@rental.com     | password123  |
| Customer | customer@rental.com  | password123  |

---

## Struktur Database

| Tabel         | Deskripsi                      |
|---------------|-------------------------------|
| t_users       | Data user (admin/customer/owner) |
| t_mobil       | Data armada mobil              |
| t_pemesanan   | Data pemesanan customer        |
| t_pembayaran  | Konfirmasi pembayaran          |
| t_feedback    | Feedback & balasan             |

---

## Tech Stack
- **Backend:** Laravel 11 (PHP)
- **Frontend:** Bootstrap 5.3 + Bootstrap Icons
- **Database:** SQLite (bisa diganti MySQL)
