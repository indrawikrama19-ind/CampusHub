<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Query mengambil semua data event dari database
$query_event = mysqli_query($koneksi, "
    SELECT event.*, category.categoryName 
    FROM event 
    LEFT JOIN category ON event.categoryId = category.categoryId 
    ORDER BY event.eventDate ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - Dashboard</title>
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
            <h1>Welcome, <?= htmlspecialchars($user['fullName']) ?>!</h1>
            <p>Discover what's happening on campus.</p>
        </div>

        <h2>Featured Events</h2>

        <!-- BAGIAN DINAMIS DARI DATABASE -->
        <?php if (mysqli_num_rows($query_event) > 0): ?>
            <?php while ($event = mysqli_fetch_assoc($query_event)): ?>
                <div class="event">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    <p><strong>Kategori:</strong> <?= htmlspecialchars($event['categoryName'] ?? 'Umum') ?></p>
                    <p><?= htmlspecialchars($event['eventDate']) ?> | <?= htmlspecialchars($event['startTime']) ?> WIB</p>
                    <p><?= htmlspecialchars($event['location']) ?></p>
                    
                    <a class="btn" href="detail.php?id=<?= $event['eventId'] ?>">View Event</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="card">
                <p>Belum ada event yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>