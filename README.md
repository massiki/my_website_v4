# My Website v4

Website portfolio / company profile berbasis **Laravel + Livewire** dengan **panel admin** untuk mengelola konten (home, services, projects, about, contact info) serta membaca pesan dari halaman contact.

## Fitur

### Frontend (publik)

- **Home**: hero section (nama, title, bio, CTA, gambar) + highlight services + featured projects + daftar technologies.
- **Services**: daftar layanan (diurutkan).
- **Projects**: listing project dengan **search** + filter **category** + pagination.
- **Project detail**: berdasarkan `slug`.
- **About**: bio + experiences + educations + skills (group by kategori).
- **Contact**: form kirim pesan (tersimpan ke database) + tampilkan informasi kontak (email, WA, social, resume).

### Admin (butuh login)

Semua route admin berada di prefix `/admin` dan dilindungi middleware `auth` + `admin`.

- **Dashboard**
- **Manage Home Content**
- **Manage Services**
- **Manage Projects** (kategori + many-to-many technologies, upload thumbnail, featured toggle)
- **Manage Technologies**
- **Manage Categories**
- **Manage About** (data yang dipakai halaman About)
- **Manage Contact Info** (key-value kontak & social link)
- **Manage Messages** (pesan dari halaman Contact)

## Alur sistem (high level)

### 1) Pengunjung membuka halaman

Route publik ada di `routes/web.php` dan diarahkan ke komponen Livewire:

- `/` → `App\Livewire\Frontend\HomePage`
- `/services` → `...ServicesPage`
- `/projects` → `...ProjectsPage`
- `/projects/{slug}` → `...ProjectDetailPage`
- `/about` → `...AboutPage`
- `/contact` → `...ContactPage`

Komponen-komponen ini mengambil data dari model Eloquent (mis. `Service`, `Project`, `Technology`, `Category`, `HomeContent`, dll) dan merender Blade di `resources/views/livewire/...`.

### 2) Pengunjung mengirim pesan

Di halaman Contact, saat submit akan:

- validasi input
- menyimpan record ke tabel `messages` lewat model `App\Models\Message`

### 3) Admin login

Login admin menggunakan Livewire `App\Livewire\Auth\Login` di route `/login`.

Catatan penting: proses login memverifikasi **akun harus `is_admin = true`**.

### 4) Admin mengelola konten

Semua halaman admin berupa komponen Livewire yang melakukan CRUD ke tabel terkait.

Contoh alur kelola project:

- admin membuat/ubah project → otomatis membuat `slug` dari judul
- upload gambar → disimpan ke disk `public`
- relasi technologies → disimpan lewat tabel pivot (many-to-many)

## Struktur data (ringkas)

- **KV content**: `home_contents` (`key`, `value`, `image`) untuk hero & about bio + asset (hero/logo).
- **Projects**: `projects` + relasi `category_id` dan pivot `project_technology`.
- **Contact info**: `contact_infos` (`key`, `value`) untuk email/WA/social/resume.
- **Messages**: `messages` untuk pesan dari contact form.
- **About data**: `experiences`, `educations`, `skills`.
- **Admin flag**: kolom `users.is_admin`.

## Teknologi yang digunakan

- **Backend**: PHP ^8.2, Laravel ^12
- **UI / interaktif**: Livewire ^4.2 (komponen untuk frontend & admin)
- **Frontend tooling**: Vite, `laravel-vite-plugin`
- **Styling**: Tailwind CSS (via `@tailwindcss/vite`)
- **HTTP client (JS)**: Axios
- **Queue / Session / Cache**: memakai driver **database** (lihat `.env.example`)
- **File upload**: Laravel filesystem disk `public` (thumbnail project, hero/logo image)

## Menjalankan project (lokal)

### Prasyarat

- PHP 8.2+
- Composer
- Node.js + npm
- Database:
  - default contoh `.env.example` menggunakan **SQLite**, atau
  - bisa ganti ke MySQL/MariaDB (umum di Laragon)

### Setup cepat

Jalankan perintah berikut dari root project:

```bash
composer run setup
```

Script ini akan:

- install dependency PHP
- membuat `.env` dari `.env.example` (jika belum ada)
- generate `APP_KEY`
- migrate database
- install dependency Node
- build asset Vite

### Mode development (server + queue + logs + Vite)

```bash
composer run dev
```

Ini menjalankan beberapa proses sekaligus:

- `php artisan serve`
- `php artisan queue:listen ...`
- `php artisan pail ...`
- `npm run dev`

### Storage untuk file upload

Jika gambar tidak muncul di frontend/admin setelah upload, pastikan symbolic link storage sudah dibuat:

```bash
php artisan storage:link
```

## Kelebihan

- **Full SPA-like experience** dengan Livewire tanpa harus bikin API terpisah.
- **Admin panel ringan** untuk kelola konten (struktur cukup rapi: frontend vs admin).
- **Konten fleksibel** via model key-value (`HomeContent`, `ContactInfo`) sehingga perubahan teks/link tidak perlu edit kode.
- **Fitur portfolio lengkap**: project listing + filtering + featured, services, about (experience/education/skills), contact message.

## Kekurangan / catatan teknis

- **KV table** (`home_contents`, `contact_infos`) mudah dipakai tapi bisa sulit di-maintain jika key makin banyak (raw string key).
- **Login admin dibatasi `is_admin`**; perlu proses provisioning user admin (set `is_admin` di DB/seed) agar bisa masuk.
- **Queue/session/cache memakai database**: praktis untuk lokal, tapi untuk trafik tinggi biasanya lebih baik pakai Redis.
- **Slug project** dibuat dari judul; jika judul sama, berpotensi bentrok karena `slug` unique (perlu strategi disambiguasi jika sering terjadi).

## Referensi lokasi kode penting

- **Routing**: `routes/web.php`
- **Frontend Livewire**: `app/Livewire/Frontend/`
- **Admin Livewire**: `app/Livewire/Admin/`
- **Auth (login)**: `app/Livewire/Auth/Login.php`
- **Layouts**: `resources/views/layouts/`
- **Migrations**: `database/migrations/`

