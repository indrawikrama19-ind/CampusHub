
<?php
ob_start();
session_start();
include "../koneksi/koneksi.php";

/** @var \mysqli $koneksi */

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE studentId = '$username' AND password = '$password'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['user'] = $data;

        header("Location: dashboard.php");
        exit;

    } else {
        echo '<script>
            alert("Username atau password salah!");
            window.location.href = "login.php";
        </script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHub_Login</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <div class="container">
        <div class="login">
            <h2 class="wellcome"> Welcome To CampusHub!!! </h2>
            <p class="deskripsi">Discovers what's happening on campus</p>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username / Student ID</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username / NIM" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                </div>

                <button type="submit" name="login" class="btn" style="width: 100%;">Login</button>
            </form>

            <div class="login-footer">
                <p>Don't have account? <a href="#">Register</a></p>
            </div>
        </div>
    </div>

</body>
</html>