<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "campushub";

$koneksi = mysqli_connect($host, $user,$pass,$db);
if (!$koneksi){
    die ("gagal terhubung");
}else{
    echo "koneksi berhasil";
}
