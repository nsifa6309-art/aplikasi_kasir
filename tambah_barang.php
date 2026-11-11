<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];

    mysqli_query($koneksi,
        "INSERT INTO barang (nama_barang, harga, stok)
        VALUES ('$nama', '$harga', '$stok')");

    header("Location: barang.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Tambah Barang</h2>

    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Barang" required>

        <input type="number" name="harga" placeholder="Harga Barang" min="1" required>

        <input type="number" name="stok" placeholder="Jumlah Stok" min="0" required>

        <button type="submit" name="simpan">Simpan</button>
    </form>

    <a href="barang.php">Kembali</a>
</div>

</body>
</html>