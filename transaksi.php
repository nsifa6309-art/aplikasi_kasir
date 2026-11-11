
<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {

    $id = $_POST['barang'];
    $jumlah = $_POST['jumlah'];

    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    if ($data && $jumlah > 0 && $data['stok'] >= $jumlah) {

        $harga = $data['harga'];
        $total = $harga * $jumlah;
        $nama = $data['nama_barang'];
        $tanggal = date('Y-m-d');
        $petugas = $_SESSION['nama'];

        mysqli_query($koneksi, "INSERT INTO penjualan
        (nama_barang, jumlah, total, tanggal, petugas)
        VALUES ('$nama', '$jumlah', '$total', '$tanggal', '$petugas')");

        mysqli_query($koneksi, "UPDATE barang
        SET stok = stok - $jumlah WHERE id='$id'");

        $pesan = "Transaksi berhasil disimpan!";

    } else {
        $pesan = "Stok barang tidak mencukupi!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Kasirku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="menu">
    <h2>KASIRKU</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="barang.php">Data Barang</a>
    <a href="transaksi.php">Transaksi</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">

    <h2>Transaksi Pembelian</h2>
    <p>Silakan masukkan data pembelian barang.</p>

    <?php
    if (isset($pesan)) {
        echo "<p>$pesan</p>";
    }
    ?>

    <form method="POST">

        <label>Nama Barang</label>
        <select name="barang" required>
            <option value="">-- Pilih Barang --</option>

            <?php
            $barang = mysqli_query($koneksi, "SELECT * FROM barang");

            while ($b = mysqli_fetch_assoc($barang)) {
            ?>
                <option value="<?php echo $b['id']; ?>">
                    <?php echo $b['nama_barang']; ?>
                    - Rp <?php echo number_format($b['harga']); ?>
                </option>
            <?php } ?>

        </select>

        <br><br>

        <label>Jumlah Pembelian</label>
        <input type="number" name="jumlah" min="1" required>

        <br><br>

        <button type="submit" name="simpan">
            Simpan Transaksi
        </button>

    </form>

</div>

</body>
</html>
