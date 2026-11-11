
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: .php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kasirkuu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="menu">
    <h2>KASIRKU</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="barang.php">Data Barang</a>
    <a href="transaksi.php">Transaksi</a>

    <?php if ($_SESSION['role'] == 'administrator') { ?>
        <a href="registrasi.php">Registrasi</a>
        <a href="laporan.php">Laporan</a>
    <?php } ?>

    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h1>Dashboard</h1>
    <h3>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?></h3>
    <p>Selamat menggunakan aplikasi kasir sederhana.</p>
</div>

</body>
</html>
