<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int) $_GET['id'];

$data = mysqli_query($koneksi,
    "SELECT * FROM barang WHERE id_barang='$id'");

$b = mysqli_fetch_assoc($data);

if (!$b) {
    die("Barang tidak ditemukan");
}

if (isset($_POST['update'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];

    mysqli_query($koneksi,
        "UPDATE barang SET
        nama_barang='$nama',
        harga='$harga',
        stok='$stok'
        WHERE id_barang='$id'");

    header("Location: barang.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Edit Barang</h2>

    <form method="POST">
        <input type="text" name="nama"
        value="<?= htmlspecialchars($b['nama_barang']); ?>" required>

        <input type="number" name="harga"
        value="<?= $b['harga']; ?>" min="1" required>

        <input type="number" name="stok"
        value="<?= $b['stok']; ?>" min="0" required>

        <button type="submit" name="update">Update</button>
    </form>

    <a href="barang.php">Kembali</a>
</div>

</body>
</html>