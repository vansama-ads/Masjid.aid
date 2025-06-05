<?php
session_start();
include "koneksi.php";





if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $user_id = $_SESSION['user_id'];

    // Cek apakah user sudah punya foto
    $query = "SELECT foto FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);

    // Jika belum ada foto, set foto default
    if (empty($user['foto'])) {
        $default_foto = 'default.jpg'; // Gambar default
        $query_update = "UPDATE user SET foto = '$default_foto' WHERE user_id = '$user_id'";
        mysqli_query($koneksi, $query_update);
    }
    
    header("Location: profile.php"); // Arahkan ke halaman profil
    exit;
}



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
            echo '<script>alert("Kamu adalah Admin!"); location.href="../info.php";</script>';
        } else {
            echo '<script>alert("Selamat datang, '.$data['nama'].'"); location.href="../info.php";</script>';
        }
    } else {
        // Jika login gagal
        echo '<script>alert("Username atau password salah!"); location.href="../homepage.php";</script>';
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
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="sandi" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </div>
</div>

</body>
</html>
