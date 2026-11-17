<?php
$host = "db";
$user = "root";
$pass = "root";
$db   = "campushub";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("gagal terhubung: " . mysqli_connect_error());
}
?>
