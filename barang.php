<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="content">
    <h2>Data Barang</h2>

    <a class="tambah" href="tambah_barang.php">+ Tambah Barang</a>
    <a href="index.php">Kembali</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($b = mysqli_fetch_assoc($data)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($b['nama_barang']); ?></td>
            <td>Rp <?= number_format($b['harga']); ?></td>
            <td><?= $b['stok']; ?></td>
            <td>
                <a href="edit_barang.php?id=<?= $b['id_barang']; ?>">Edit</a>
                |
                <a href="hapus_barang.php?id=<?= $b['id_barang']; ?>"
                onclick="return confirm('Yakin ingin menghapus barang?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>