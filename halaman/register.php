<?php
session_start();
include "../koneksi/koneksi.php";
/** @var \mysqli $koneksi */
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);

    $query = mysqli_query($koneksi, "INSERT INTO user(fullName, email, studentId, password) 
    VALUES('$fullname','$email','$nim','$password')");

    if ($query) {
        echo '<script>alert("Selamat, pendaftaran anda berhasil. Silahkan login.");</script>';
    } else {
        echo '<script>alert("Pendaftaran gagal.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campushub_Register</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <div class="container">
        <div class="auth-card">
            <h2 class="auth-title">Create Account</h2>
            <p class="auth-subtitle">Let's get your started with CampusHub</p>

            <form action="#" method="POST">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter Your Name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                </div>

                <div class="form-group">
                    <label for="nim">Student ID (NIM)</label>
                    <input type="text" id="nim" name="nim" placeholder="Enter Your Student ID" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <button type="submit" name="register" class="btn">Create Account</button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="#">Login</a></p>
            </div>
        </div>
    </div>

</body>
</html>