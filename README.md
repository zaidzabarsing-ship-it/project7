# Project 7 - MVC dengan Login

Project ini adalah pengembangan Project 6 dengan login dan CRUD User.

## Struktur

- `app/controllers`: menerima request dan mengatur proses.
- `app/models`: berkomunikasi dengan database.
- `app/views`: menampilkan halaman.
- `app/core`: router, controller dasar, dan model dasar.
- `layouts`: layout guest, dashboard, dan aset tampilan.

## Route utama

- `/` - halaman guest.
- `/auth/login` - halaman login.
- `/auth/logout` - keluar dari dashboard.
- `/dashboard` - dashboard akademik.
- `/mahasiswa` - CRUD mahasiswa.
- `/dosen` - halaman placeholder dosen.
- `/matakuliah` - halaman placeholder matakuliah.
- `/user` - CRUD user.

## Menjalankan project

1. Buat database `dbakademik`.
2. Buat database `db_project7`, lalu import `database.sql`.
3. Jalankan `composer install` jika folder `vendor` belum tersedia.
4. Buka `http://localhost/project7 v2` sesuai nama folder XAMPP.
5. Login dengan email `admin@mail.com` dan password `admin`.

Paket `filp/whoops` digunakan untuk menampilkan error PHP dan exception database
secara lebih mudah dibaca selama proses pembelajaran.
