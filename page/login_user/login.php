<?php
   session_start();
   include "koneksi.php";
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

<?php
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['sandi']; // Sesuaikan dengan form input

    // Query untuk cek user berdasarkan username dan password
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND sandi = '$password'");

    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query); // Ambil data user

        // Simpan session login
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $data['role']; // Simpan role dari database
        $_SESSION['username'] = $data['username']; // Simpan username ke session

        // Cek apakah user adalah admin atau bukan
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
