<?php
include 'config/koneksi.php';

$id = $_GET['id'];

// hapus data berdasarkan id_barang
$sql = "DELETE FROM data_barang WHERE id_barang='$id'";
mysqli_query($conn, $sql);

// kembali ke list
header("Location: index.php?page=user/list");
exit;
?>
