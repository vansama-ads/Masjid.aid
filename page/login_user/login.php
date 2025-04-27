<?php
session_start();
include "koneksi.php";

if(isset($_POST['username'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['sandi']; // Ambil input password

    // Query untuk mendapatkan user berdasarkan username
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    $data = mysqli_fetch_assoc($query);

    // Cek apakah user ditemukan dan password cocok
    if ($data && password_verify($password, $data['sandi'])) {
        // Simpan session login
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $data['role'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['user_id'];

        // Redirect berdasarkan role
        if ($data['role'] == 'admin') {
            echo '<script>alert("Kamu adalah Admin!"); location.href="../homepage.php";</script>';
        } else {
            echo '<script>alert("Selamat datang, '.$data['nama'].'"); location.href="../homepage.php";</script>';
        }
    } else {
        // Jika login gagal
        echo '<script>alert("Username atau password salah!"); location.href="index.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-login.css">
    <link rel="icon" type="image/x-icon" href="../img/assets/favicon.ico">
    <title>Login</title>
</head>
<body>



<div class="container">
    <div class="left">
        <div class="overlay">
            <button onclick="window.history.back()" class="back-btn">
                <img src="../img/assets/back-icon.png" alt="Back" width="30">Back
            </button>
            <h1>Selamat Datang<br>Kembali</h1>
        </div>
    </div>
    <div class="right">
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Nama" required>
            <input type="password" name="sandi" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </div>
</div>

</body>
</html>
