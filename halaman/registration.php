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

// Ambil ID event dari URL
$event_id = $_GET['id'] ?? 0;
$event_id = (int)$event_id;

// Query detail event
$query_event = mysqli_query($koneksi, "SELECT * FROM event WHERE eventId = $event_id");
$event = mysqli_fetch_assoc($query_event);

if (!$event) {
    header("Location: dashboard.php");
    exit;
}

// Proses submit pendaftaran
if (isset($_POST['register_event'])) {
    $userId = $user['userId'];
    $registrationDate = date('Y-m-d');
    $status = 'Registered';
    $attendanceStatus = 'Pending';
    
    // Generate kode tiket unik (contoh: CH-0001-8392)
    $ticketCode = 'CH-' . sprintf('%04d', $event_id) . '-' . rand(1000, 9999);
    $issuedAt = date('Y-m-d H:i:s');

    // Cek apakah user sudah pernah mendaftar event ini
    $check = mysqli_query($koneksi, "SELECT * FROM registration WHERE userId = $userId AND eventId = $event_id");
    
    if (mysqli_num_rows($check) > 0) {
        $data_reg = mysqli_fetch_assoc($check);
        echo "<script>
            alert('Anda sudah terdaftar di event ini!');
            window.location.href = 'success.php?id=" . $data_reg['registrationId'] . "';
        </script>";
        exit;
    }

    // Insert ke tabel registration
    $query_insert = "INSERT INTO registration (userId, eventId, registrationDate, status, attendanceStatus, ticketCode, issuedAt) 
                     VALUES ('$userId', '$event_id', '$registrationDate', '$status', '$attendanceStatus', '$ticketCode', '$issuedAt')";

    if (mysqli_query($koneksi, $query_insert)) {
        $new_reg_id = mysqli_insert_id($koneksi);
        header("Location: success.php?id=" . $new_reg_id);
        exit;
    } else {
        $error = "Gagal mendaftar event. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub - Registration</title>
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
        <div class="auth-card" style="max-width:500px; margin:50px auto;">
            <h1>Registration</h1>
            <h2><?= htmlspecialchars($event['title']) ?></h2>

            <?php if (isset($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" value="<?= htmlspecialchars($user['fullName']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Student ID (NIM)</label>
                    <input type="text" value="<?= htmlspecialchars($user['studentId']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                </div>

                <button type="submit" name="register_event" class="btn" style="width: 100%;">Confirm Registration</button>
            </form>
        </div>
    </div>

</body>
</html>