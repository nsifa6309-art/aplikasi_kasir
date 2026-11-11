
<?php
include "koneksi.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    $user = mysqli_fetch_assoc($query);

    if ($user) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: dashboard.php");
            exit;

        } else {
            $pesan = "Password salah!";
        }

    } else {
        $pesan = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Kasirku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">

    <h2>KASIRKU</h2>
    <p>Silahkan login terlebih dahulu</p>

    <?php
    if (isset($pesan)) {
        echo "<p style='color:red;'>$pesan</p>";
    }
    ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Masuk</button>

    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>

</div>

</body>
</html>
