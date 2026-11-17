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

// Query mengambil data pendaftaran & event
$query = mysqli_query($koneksi, "
    SELECT registration.*, event.title
    FROM registration
    JOIN event ON registration.eventId = event.eventId
    WHERE registration.registrationId = $reg_id
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - Registration Successful</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <div class="container">
        <div class="card center" style="max-width:500px; margin:100px auto;">
            <h1 class="success">Registration Successful!</h1>
            <p>You're all set for</p>
            <h2><?= htmlspecialchars($data['title']) ?></h2>

            <a class="btn" href="tiket.php?id=<?= $data['registrationId'] ?>">View Ticket</a>
            <br><br>
            <a href="dashboard.php">Back To Home</a>
        </div>
    </div>

</body>
</html>