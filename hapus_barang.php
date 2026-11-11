<?/
<?php
include "koneksi.php";

$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$jumlah_barang = mysqli_num_rows($barang);

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$jumlah_transaksi = mysqli_num_rows($transaksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Kasir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>KASIRKU</h2>
    <p class="garis"></p>

    <a href="index.php">Dashboard</a>
    <a href="barang.php">Data Barang</a>
    <a href="transaksi.php">Transaksi</a>
    <a href="laporan.php">Laporan</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">

    <h2>Dashboard</h2>
    <p>Selamat datang di aplikasi kasir.</p>

    <div class="kotak">
        <h3>Jumlah Barang</h3>
        <h1><?php echo $jumlah_barang; ?></h1>
    </div>

    <div class="kotak">
        <h3>Jumlah Transaksi</h3>
        <h1><?php echo $jumlah_transaksi; ?></h1>
    </div>

    <div class="info">
        <h3>Informasi</h3>
        <p>
            Aplikasi Kasirku digunakan untuk mengelola data barang,
            melakukan transaksi penjualan dan melihat laporan.
        </p>
    </div>

</div>

</body>
</html>
<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int) $_GET['id'];

$cek = mysqli_query($koneksi,
    "SELECT * FROM detail_penjualan WHERE id_barang='$id'");

if (mysqli_num_rows($cek) > 0) {
    echo "Barang sudah memiliki riwayat transaksi dan tidak bisa dihapus.";
    echo "<br><a href='barang.php'>Kembali</a>";
    exit;
}

mysqli_query($koneksi,
    "DELETE FROM barang WHERE id_barang='$id'");

header("Location: barang.php");
exit;
?>