<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */

// Cek status login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil registrationId dari URL
$reg_id = $_GET['id'] ?? 0;
$reg_id = (int)$reg_id;

// Query mengambil data tiket dari relasi registration, event, dan user
$query = mysqli_query($koneksi, "
    SELECT registration.*, event.title, event.eventDate, event.startTime, event.location, user.fullName, user.studentId
    FROM registration
    JOIN event ON registration.eventId = event.eventId
    JOIN user ON registration.userId = user.userId
    WHERE registration.registrationId = $reg_id
");

$ticket = mysqli_fetch_assoc($query);

// Jika tiket tidak ditemukan, kembalikan ke myevents
if (!$ticket) {
    header("Location: myevents.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - Digital Ticket</title>
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
        <div class="card" style="max-width:500px; margin:50px auto;">
            <h1>Digital Ticket</h1>
            <h2><?= htmlspecialchars($ticket['title']) ?></h2>
            <hr>
            <p><strong>Nama:</strong> <?= htmlspecialchars($ticket['fullName']) ?> | <?= htmlspecialchars($ticket['studentId']) ?></p>
            <p><strong>Waktu:</strong> <?= htmlspecialchars($ticket['eventDate']) ?> | <?= htmlspecialchars($ticket['startTime']) ?> WIB</p>
            <p><strong>Lokasi:</strong> <?= htmlspecialchars($ticket['location']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($ticket['status']) ?></p>

            <h3>Ticket Code:</h3>
            <p style="font-size: 20px; font-weight: bold; letter-spacing: 2px; color: #222; background: #eee; padding: 10px; border-radius: 6px; text-align: center;">
                <?= htmlspecialchars($ticket['ticketCode']) ?>
            </p>

            <p style="font-size: 12px; color: #666;">Diterbitkan pada: <?= htmlspecialchars($ticket['issuedAt']) ?></p>

            <br>
            <a class="btn" href="dashboard.php">Back To Home</a>
            <a class="btn" href="myevents.php" style="background: #666; margin-left: 10px;">My Events</a>
        </div>
    </div>

</body>
</html>