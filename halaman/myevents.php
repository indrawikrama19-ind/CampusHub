<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */

// Cek status login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$userId = $user['userId'];

// Query mengambil daftar event yang diikuti oleh user
$query = mysqli_query($koneksi, "
    SELECT registration.*, event.title, event.eventDate, event.startTime, event.location, category.categoryName
    FROM registration
    JOIN event ON registration.eventId = event.eventId
    LEFT JOIN category ON event.categoryId = category.categoryId
    WHERE registration.userId = $userId
    ORDER BY registration.registrationId DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - My Events</title>
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
            <h1>My Events</h1>
            <p>Daftar event yang telah kamu daftari.</p>
        </div>

        <?php if (mysqli_num_rows($query) > 0): ?>
            <?php while ($reg = mysqli_fetch_assoc($query)): ?>
                <div class="event">
                    <h3><?= htmlspecialchars($reg['title']) ?></h3>
                    <p><strong>Kategori:</strong> <?= htmlspecialchars($reg['categoryName'] ?? 'Umum') ?></p>
                    <p><?= htmlspecialchars($reg['eventDate']) ?> | <?= htmlspecialchars($reg['startTime']) ?> WIB</p>
                    <p><?= htmlspecialchars($reg['location']) ?></p>
                    <p><strong>Status Tiket:</strong> <?= htmlspecialchars($reg['status']) ?></p>
                    <a class="btn" href="tiket.php?id=<?= $reg['registrationId'] ?>">View Ticket</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="card">
                <p>Kamu belum mendaftar di event manapun.</p>
                <a class="btn" href="explore.php">Cari Event Sekarang</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>