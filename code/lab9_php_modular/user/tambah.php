<?php
include 'config/koneksi.php';

if (isset($_POST['submit'])) {
    $nama        = $_POST['nama'];
    $kategori    = $_POST['kategori'];
    $harga_jual  = $_POST['harga_jual'];
    $harga_beli  = $_POST['harga_beli'];
    $stok        = $_POST['stok'];

    // upload gambar
    $file = $_FILES['file_gambar'];
    $gambar = "";

    if ($file['error'] == 0) {
        $filename = str_replace(" ", "_", $file['name']);
        $destination = "user/gambar/" . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $gambar = "user/gambar/" . $filename;
        }
    }

    // insert data
    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar)
            VALUES ('$nama', '$kategori', '$harga_jual', '$harga_beli', '$stok', '$gambar')";

    mysqli_query($conn, $sql);

    // kembali ke list
    header("Location: index.php?page=user/list");
    exit;
}
?>

<h2>Tambah Barang</h2>

<form action="index.php?page=user/tambah" method="post" enctype="multipart/form-data">

    <label>Nama Barang</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Kategori</label><br>
    <select name="kategori">
        <option value="Komputer">Komputer</option>
        <option value="Elektronik">Elektronik</option>
        <option value="Hand Phone">Hand Phone</option>
    </select><br><br>

    <label>Harga Jual</label><br>
    <input type="number" name="harga_jual" required><br><br>

    <label>Harga Beli</label><br>
    <input type="number" name="harga_beli" required><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" required><br><br>

    <label>Gambar</label><br>
    <input type="file" name="file_gambar"><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>
