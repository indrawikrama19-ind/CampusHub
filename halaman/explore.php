<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */

// Cek status login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data kategori untuk tombol filter
$query_category = mysqli_query($koneksi, "SELECT * FROM category ORDER BY categoryName ASC");

// Tangkap keyword pencarian dan filter kategori
$search = $_GET['search'] ?? '';
$category_id = $_GET['category'] ?? '';

// Query dasar untuk mengambil event
$sql = "
    SELECT event.*, category.categoryName 
    FROM event 
    LEFT JOIN category ON event.categoryId = category.categoryId 
    WHERE 1=1
";

// Tambahkan kondisi filter pencarian
if (!empty($search)) {
    $search_clean = mysqli_real_escape_string($koneksi, $search);
    $sql .= " AND (event.title LIKE '%$search_clean%' OR event.description LIKE '%$search_clean%' OR event.location LIKE '%$search_clean%')";
}

// Tambahkan kondisi filter kategori
if (!empty($category_id)) {
    $category_clean = (int)$category_id;
    $sql .= " AND event.categoryId = $category_clean";
}

$sql .= " ORDER BY event.eventDate ASC";
$query_event = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - Explore Events</title>
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
            <h1>Explore Events</h1>
            <p>Find Something Interesting...</p>

            <!-- Form Pencarian -->
            <form method="GET" action="explore.php">
                <?php if (!empty($category_id)): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($category_id) ?>">
                <?php endif; ?>
                <input type="text" name="search" placeholder="Search events..." value="<?= htmlspecialchars($search) ?>">
                <br><br>
                <button type="submit">Cari</button>
            </form>
            <br>

            <!-- Filter Kategori -->
            <a href="explore.php<?= !empty($search) ? '?search=' . urlencode($search) : '' ?>"><button type="button">All</button></a>
            <?php if (mysqli_num_rows($query_category) > 0): ?>
                <?php while ($cat = mysqli_fetch_assoc($query_category)): ?>
                    <?php 
                        $link_cat = "explore.php?category=" . $cat['categoryId'];
                        if (!empty($search)) {
                            $link_cat .= "&search=" . urlencode($search);
                        }
                    ?>
                    <a href="<?= $link_cat ?>"><button type="button"><?= htmlspecialchars($cat['categoryName']) ?></button></a>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <!-- Daftar Event -->
        <?php if (mysqli_num_rows($query_event) > 0): ?>
            <?php while ($event = mysqli_fetch_assoc($query_event)): ?>
                <div class="event">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    <p><strong>Kategori:</strong> <?= htmlspecialchars($event['categoryName'] ?? 'Umum') ?></p>
                    <p><?= htmlspecialchars($event['eventDate']) ?> | <?= htmlspecialchars($event['startTime']) ?> WIB</p>
                    <p><?= htmlspecialchars($event['location']) ?></p>
                    <a class="btn" href="detail.php?id=<?= $event['eventId'] ?>">Detail</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="card">
                <p>Event tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>