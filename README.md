# Lab9Web
# Nama : Elisabeth Erni Banajarnahor

## 1. index.php
```php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
```

jika URL berisi `?page=about` → `$page` = "`about`"

Jika URL kosong → otomatis buka "`home`"

```php
$parts = explode('/', $page);

$folder = $parts[0];       
$file   = isset($parts[1]) ? $parts[1] : 'list';
```

Kalau URL:
 `page=user/add`
 `$folder = "user"`
 `$file = "add"`

Kalau URL:
 `page=about`
 `$folder = "about"`
 `$file = "list"` (default karena tidak ada bagian kedua)

```php
if (!file_exists($path)) {
    echo "<h2>404 - Halaman tidak ditemukan!</h2>";
    exit;
}
```
kalau file tidak di temukan akan 404

```php
require "header.php";
require $path;   // halaman utama
require "footer.php";
```
header.php selalu muncul di atas
$path (halaman yang ingin dibuka) di tengah
footer.php selalu muncul di bawah

## 2. header.php
```php
<div class="container">
```
Ini adalah pembungkus utama seluruh isi website.
Biasanya dipakai supaya konten rapi berada di tengah halaman.  

```php
<header>
    <h1>Modularisasi Menggunakan PHP</h1>
</header>
```
Bagian ini adalah judul utama dari website kamu.
Biasanya muncul di bagian paling atas halaman.

```php
<nav>
    <a href="index.php?page=home">Home</a>
    <a href="index.php?page=about">About</a>
    <a href="index.php?page=kontak">Kontak</a>
    <a href="index.php?page=user/list">Data Barang</a>
</nav>
```
Bagian `<nav>` adalah menu navigasi untuk berpindah halaman.
Setiap link menuju router di `index.php`:

`index.php?page=home`  membuka `pages/home.php`

`index.php?page=about`  membuka `pages/about.php`

`index.php?page=kontak`  membuka `pages/kontak.php`

`index.php?page=user/list`  membuka `user/list.php`

```php
<div class="content">
```
router di `index.php` akan menentukan file mana yang dimasukkan.

File tersebut akan muncul di dalam `<div class="content"> ... </div>`

## 3. footer.php

```php
    </div>
```
Ini menutup `<div class="content">` yang dibuka sebelumnya.

```php
<footer>
    <p>&copy; 2024 - Praktikum Pemrograman Web | Universitas Pelita Bangsa</p>
</footer>
```
Bagian ini adalah footer atau bagian bawah halaman.
Fungsinya:

  Menampilkan informasi hak cipta (copyright).
  Menampilkan identitas kampus atau deskripsi proyek.
  Muncul di semua halaman, karena ini dipanggil dari template utama.
        `&copy;`= simbol ©

```php
</div>
```

## 4. ubah.php
```php
include 'config/koneksi.php';
```
Supaya file ini bisa melakukan query ke MySQL.

```php
if (isset($_POST['submit'])) {
```
Bagian ini hanya dijalankan ketika tombol Simpan Perubahan ditekan.

```php
$id          = $_POST['id'];
$nama        = $_POST['nama'];
$kategori    = $_POST['kategori'];
$harga_jual  = $_POST['harga_jual'];
$harga_beli  = $_POST['harga_beli'];
$stok        = $_POST['stok'];
```
Data dari form disimpan ke variabel untuk diproses.

```php
$file = $_FILES['file_gambar'];
$gambar = "";
```
proses upload gambar

```php
if ($file['error'] == 0) {
    $filename = str_replace(" ", "_", $file['name']);
    $destination = "user/gambar/" . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        $gambar = "user/gambar/" . $filename;
    }
}
```
jika ada file yang di upload

## 5.tambah.php

```php
if (isset($_POST['submit'])) {
```
Bagian ini hanya dijalankan setelah tombol “Simpan” ditekan.

```php
$nama        = $_POST['nama'];
$kategori    = $_POST['kategori'];
$harga_jual  = $_POST['harga_jual'];
$harga_beli  = $_POST['harga_beli'];
$stok        = $_POST['stok'];
```
Semua input dari user disimpan dalam variabel untuk dimasukkan ke database.

```php
$file = $_FILES['file_gambar'];
$gambar = "";
```
proses upload gambar

 ```php
if ($file['error'] == 0) {
    $filename = str_replace(" ", "_", $file['name']);
    $destination = "user/gambar/" . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        $gambar = "user/gambar/" . $filename;
    }
}
```
jika user memlih gambar

## 6. list.php

```php
$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
```
Ambil semua kolom dari tabel `data_barang`
Simpan hasilnya di $`result`

```php
<a href="index.php?page=user/tambah" class="btn-tambah">+ Tambah Data</a>
```
Ketika diklik  membuka halaman tambah barang.

## 7. hapus.php

```php
include 'config/koneksi.php';
```
Supaya bisa menjalankan query DELETE.

```php
$id = $_GET['id'];
```
```url
index.php?page=user/hapus&id=5
```
  Maka `$id = 5`.
  
  ID ini digunakan untuk menentukan data mana yang akan dihapus.

```php
$sql = "DELETE FROM data_barang WHERE id_barang='$id'";
mysqli_query($conn, $sql);
```
  Cari data di tabel `data_barang`
  
  Dengan kolom `id_barang` sesuai ID
  
  Lalu hapus baris tersebut
  
  Jika ID = 7  baris dengan `id_barang `= 7 akan hilang.

## 8. koneksi.php
```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";
```
host : `localhost` server database ada di komputer sendiri

user : `root` user default MySQL

pass : `""`  password MySQL (kosong kalau di XAMPP)

`db : latihan1` nama database yang ingin digunakan

## 9.sytles.css

```css
body {
    font-family: 'Poppins', Arial, sans-serif;
    background: #ffe6f2; 
    margin: 0;
    padding: 0;
}
```
Mengatur font agar lebih modern (`Poppins`)

Background warna pink pastel

Menghilangkan margin & padding bawaan browser

```css
.container {
    width: 90%;
    max-width: 900px;
    background: #fff;
    margin: 30px auto;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(255, 105, 180, 0.2);
}
```
  Luas halaman maksimal 900px
  
  Diletakkan di tengah (`margin: auto`)
  
  Sudut membulat, warna putih
  
  Ada bayangan pink supaya tampil elegan

```css
header h1 {
    text-align: center;
    color: #d63384;
    font-weight: 600;
}
```
Judul di tengah

Warna pink bold

Tulisan lebih tebal & rapi

```css
nav {
    background: #ff7eb9;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
}
```

  Kotak menu dengan warna pink terang
  
  Sudut melengkung, rapi
  
  Ada jarak ke bawah

```css
nav a {
    color: white;
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-weight: 500;
}
  ```
  Warna putih, tidak ada garis bawah
  
  Ada padding agar tombol terasa nyaman

```css
nav a:hover {
    background: rgba(255,255,255,0.35);
}
```
  Saat diarahkan kursor  muncul efek putih transparan
  
  Membuat tombol terasa hidup

```css
.content h2 {
    color: #d63384;
}
```
Judul bagian konten diberi warna pink bold

```css
footer {
    margin-top: 25px;
    text-align: center;
    color: #a8688b;
}
```

  Tulisan abu-pink, lembut
  
  Posisi di tengah

```css
table {
    width: 100%;
    border-collapse: collapse;
}
```
  
  Tabel memenuhi layar
  
  Garis tidak rangkap (collapse)

```css
table th {
    background: #ff7eb9;
    color: white;
}
  ```
  Border pink muda
  
  Background pink sangat lembut
  
  Warna teks pink gelap

```css
table img {
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(255,105,180,0.25);
}
```
  
  Gambar sudut membulat
  
  Ada bayangan pink halus

```css
.btn-tambah {
    background: #ff85c1;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
}
```
  
  Tombol warna pink cerah
  
  Sudut membulat
  
  Warna putih

```css
.btn-tambah:hover {
    background: #ff5ba8;
}
```
Saat diarahkan  lebih gelap

```css
form input,
form select {
    padding: 10px;
    width: 320px;
    border: 1px solid #f7c2d4;
    background: #fff0f7;
}
```
  
  Input pink lembut
  
  Border pink muda
  
  Lebar maksimal 320px

```css
form input:focus,
form select:focus {
    border-color: #ff66b3;
    box-shadow: 0 0 6px rgba(255,105,180,0.4);
}
```
  
  Border berubah pink lebih kuat
  
  Ada glowing efek pink

```css
button {
    background: #ff66b3;
    color: white;
}
button:hover {
    background: #ff408f;
}
```

  Tombol warna pink sedang
  
  Saat hover  lebih gelap
