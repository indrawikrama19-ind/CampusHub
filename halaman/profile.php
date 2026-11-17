<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */

// Cek status login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Proses Log Out
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - Profile</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <div class="navbar">
        <div class="logo">CampusHub</div>
        <div>
            <a href="dashboard.php">Home</a>
            <a href="explore.php">Explore</a>
            <a href="myevents.php">My Events</a>
            <a href="profile.php">Profile</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h1><?= htmlspecialchars($user['fullName']) ?></h1>
            <h3>NIM / Student ID: <?= htmlspecialchars($user['studentId']) ?></h3>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <hr>
            <p><a href="myevents.php">My Events</a></p>
            <p><a href="profile.php?logout=true" onclick="return confirm('Apakah Anda yakin ingin keluar?');" style="color: red;">Log Out</a></p>
        </div>
    </div>

</body>
</html>