<?php

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$jumlah_barang = mysqli_num_rows($barang);

$penjualan = mysqli_query($koneksi,
    "SELECT SUM(total_harga) AS total FROM penjualan");

$data = mysqli_fetch_assoc($penjualan);
$total = $data['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kasirku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>KASIRKU</h2>

    <a href="index.php">Dashboard</a>

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <a href="barang.php">Data Barang</a>
        <a href="register.php">Registrasi</a>
        <a href="laporan.php">Laporan</a>
    <?php } ?>

    <a href="transaksi.php">Transaksi</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Dashboard</h2>

    <p>Selamat datang,
        <?= htmlspecialchars($_SESSION['nama']); ?>
    </p>

    <div class="card">
        <h3>Jumlah Barang</h3>
        <h2><?= $jumlah_barang; ?></h2>
    </div>

    <div class="card">
        <h3>Total Penjualan</h3>
        <h2>Rp <?= number_format($total, 0, ',', '.'); ?></h2>
    </div>

</div>

</body>
</html>