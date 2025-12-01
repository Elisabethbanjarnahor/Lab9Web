<?php
include 'config/koneksi.php';

// query ambil data
$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
?>

<h2>Data Barang</h2>

<a href="index.php?page=user/tambah" class="btn-tambah">+ Tambah Data</a>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><img src="<?= $row['gambar']; ?>" width="80"></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td><?= $row['harga_beli']; ?></td>
                <td><?= $row['harga_jual']; ?></td>
                <td><?= $row['stok']; ?></td>
                <td>
                    <a href="index.php?page=user/ubah&id=<?= $row['id_barang']; ?>">Ubah</a> |
                    <a href="index.php?page=user/hapus&id=<?= $row['id_barang']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus?');">
                       Hapus
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="7">Belum ada data</td></tr>
    <?php endif; ?>
</table>
