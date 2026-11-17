<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */

// Cek status login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID event dari URL
$event_id = $_GET['id'] ?? 0;
$event_id = (int)$event_id;

// Query mengambil data event detail berdasarkan ID
$query = mysqli_query($koneksi, "
    SELECT event.*, category.categoryName 
    FROM event 
    LEFT JOIN category ON event.categoryId = category.categoryId 
    WHERE event.eventId = $event_id
");

$event = mysqli_fetch_assoc($query);

// Jika event tidak ditemukan, kembalikan ke dashboard
if (!$event) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - <?= htmlspecialchars($event['title']) ?></title>
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
            <h1><?= htmlspecialchars($event['title']) ?></h1>
            <p><strong>Kategori:</strong> <?= htmlspecialchars($event['categoryName'] ?? 'Umum') ?></p>
            <p><strong>Penyelenggara:</strong> <?= htmlspecialchars($event['organizer'] ?? 'Kampus') ?></p>
            <p><strong>Waktu:</strong> <?= htmlspecialchars($event['eventDate']) ?> | <?= htmlspecialchars($event['startTime']) ?> WIB</p>
            <p><strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?></p>
            <p><strong>Kapasitas:</strong> <?= htmlspecialchars($event['capacity'] ?? '-') ?> Peserta</p>
            <hr>
            <h2>About Event</h2>
            <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>

            <a class="btn" href="registration.php?id=<?= $event['eventId'] ?>">Register</a>
            <a class="btn" href="dashboard.php" style="background: #666; margin-left: 10px;">Kembali</a>
        </div>
    </div>

</body>
</html>