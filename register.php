<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['daftar'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $cek = mysqli_query($koneksi,
        "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Username sudah digunakan!";
    } else {
        mysqli_query($koneksi,
            "INSERT INTO users (nama, username, password, role)
            VALUES ('$nama', '$username', '$password', '$role')");

        $pesan = "Akun berhasil dibuat!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Registrasi Akun</h2>

    <?php if (isset($pesan)) echo "<p>$pesan</p>"; ?>

    <form method="POST">
        <input type="text" name="nama" placeholder="Nama lengkap" required>

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="petugas">Petugas</option>
            <option value="admin">Administrator</option>
        </select>

        <button type="submit" name="daftar">Daftar</button>
    </form>

    <a href="index.php">Kembali</a>
</div>

</body>
</html>