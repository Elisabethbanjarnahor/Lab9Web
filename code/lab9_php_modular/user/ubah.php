<?php
include 'config/koneksi.php';

// Jika tombol submit ditekan
if (isset($_POST['submit'])) {
    $id          = $_POST['id'];
    $nama        = $_POST['nama'];
    $kategori    = $_POST['kategori'];
    $harga_jual  = $_POST['harga_jual'];
    $harga_beli  = $_POST['harga_beli'];
    $stok        = $_POST['stok'];

    // upload gambar jika ada
    $file = $_FILES['file_gambar'];
    $gambar = "";

    if ($file['error'] == 0) {
        $filename = str_replace(" ", "_", $file['name']);
        $destination = "user/gambar/" . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $gambar = "user/gambar/" . $filename;
        }
    }

    // update data
    $sql = "UPDATE data_barang SET 
            nama='$nama',
            kategori='$kategori',
            harga_jual='$harga_jual',
            harga_beli='$harga_beli',
            stok='$stok'";

    // jika upload gambar baru OK → update juga field gambar
    if (!empty($gambar)) {
        $sql .= ", gambar='$gambar'";
    }

    $sql .= " WHERE id_barang='$id'";

    mysqli_query($conn, $sql);

    // kembali ke list
    header("Location: index.php?page=user/list");
    exit;
}


// AMBIL DATA BERDASARKAN ID
$id  = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang='$id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<h3>Error: ID tidak ditemukan!</h3>";
    exit;
}
?>

<h2>Ubah Barang</h2>

<form action="index.php?page=user/ubah" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $data['id_barang']; ?>">

    <label>Nama Barang</label><br>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

    <label>Kategori</label><br>
    <select name="kategori">
        <option value="Komputer"   <?= $data['kategori']=='Komputer'?'selected':''; ?>>Komputer</option>
        <option value="Elektronik" <?= $data['kategori']=='Elektronik'?'selected':''; ?>>Elektronik</option>
        <option value="Hand Phone" <?= $data['kategori']=='Hand Phone'?'selected':''; ?>>Hand Phone</option>
    </select><br><br>

    <label>Harga Jual</label><br>
    <input type="number" name="harga_jual" value="<?= $data['harga_jual']; ?>" required><br><br>

    <label>Harga Beli</label><br>
    <input type="number" name="harga_beli" value="<?= $data['harga_beli']; ?>" required><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="<?= $data['stok']; ?>" required><br><br>

    <label>Gambar Saat Ini</label><br>
    <img src="<?= $data['gambar']; ?>" width="100"><br><br>

    <label>Ganti Gambar (opsional)</label><br>
    <input type="file" name="file_gambar"><br><br>

    <button type="submit" name="submit">Simpan Perubahan</button>
</form>
