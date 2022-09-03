# Liliyani Amalia - Pendaftaran Pasien Berbasis Web

# Persyaratan Projek
### 1. Web Server 
  - XAMPP versi 7.*
    - https://www.apachefriends.org/download.html
### 2. Package Manager
  - Composer versi 2
    - https://getcomposer.org/download/
  - Node JS versi 16.*
    - https://nodejs.org/en/
### 3. Version Control
  - Git
    - https://git-scm.com/download/win
### 4. Code Editor
  - Visual Studio Code
    - https://code.visualstudio.com/download
### 5. Browser (pilih salah satu)
- Google Chrome
    - https://www.google.com/intl/id_id/chrome/
- Mozila Firefox
    - https://www.mozilla.org/id/firefox/new/
### 6. Koneksi Internet

## CATATAN
- Sebelum melakukan instalasi projek, pastikan git terminal telah dikonfigurasi dengan username github
- Caranya :
  - Buat akun github di halaman https://www.github.com ( jika sudah punya lanjut no 2 )
  - Buka terminal Git Bash dan setup email dan username github
    - Setup username
      ```bash
        git config user.name "username github"
      ```
    - Setup username
      ```bash
        git config user.email "emailanda@gmail.com"

# Instalasi
1. Buka terminal dan jalankan perintah dibawah ini untuk clone projek dari github

```bash
git clone https://github.com/jaylatech/pa-pendaftaran-pasien
```

2. Buka terminal dan arahkan lokasi terminal ke lokasi projek yang sudah di clone
```bash
cd pa-pendaftaran-pasien
```

3. Buka Visual Studio Code
```bash
code .
```

4. Ganti nama file .env.example menjadi .env
```bash
.env.example (sebelum)
.env (sesudah)
```

5. Nyalakan XAMPP dan buat database baru (nama database bebas)

6. Sesuaikan nama database yang telah dibuat pada file .env
```bash
DB_CONNECTION=mysql         (default)
DB_HOST=127.0.0.1           (default)
DB_PORT=3306                (default)
DB_DATABASE=nama_database   (rubah sesuai dengan db yang telah dibuat)
DB_USERNAME=root            (default)
DB_PASSWORD=                (default)
```

7. Instal depedency laravel dan lainnya
```bash
composer install
```

8. Buat Key projek baru
```bash
php artisan key:generate
```

9.  Lakukan migrate database beserta data dummynya
```bash
php artisan migrate:fresh --seed
```

10.  Setup Storage Local
```bash
php artisan storage:link
```

11. Instal depedency javascript
```bash
npm install
```

12. Jalankan server laravel
```bash
php artisan serve
```

13. Buka terminal baru, untuk compile asset Frontend
    - browser akan otomatis membuka localhost:3000
```bash
npm run watch
```

14.  Buka browser localhost:3000 dan masuk sebagai petugas medis
```bash
username: liliyani
password: 11111111
```