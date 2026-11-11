<?php
$koneksi = mysqli_connect("localhost", "root", "", "kasir_ukk");

if (!$koneksi) {
    echo "Database tidak terhubung";
}
?>