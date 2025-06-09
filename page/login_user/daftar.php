<?php
session_start();
include "koneksi.php";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="../css/style-daftar.css">
    <link rel="icon" type="image/x-icon" href="../img/assets/favicon.ico">
</head>

<body>
    <?php
    if (isset($_POST['username'])) {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
        $password = password_hash($_POST['sandi'], PASSWORD_DEFAULT);
        //default role
        $role = 'user';




        //panjang passwd 8 char
        if (strlen($_POST['sandi']) < 8) {
            echo '<script>alert("Password harus minimal 8 karakter!"); location.href="daftar.php";</script>';
            exit;
        }







        $query = mysqli_query($koneksi, "INSERT INTO user(nama,username,sandi,role,email,no_hp) values ('$nama','$username','$password','$role','$email','$no_hp')");

        if ($query) {
            echo '<script>alert("Selamat, anda telah terdaftar. Silahkan login.");
                      location.href="login.php";</script>';
        } else {
            echo '<script>alert("Pendaftaran gagal");
                      location.href="login.php";</script>';

        }





    }
    ?>



    <div class="container">
        <div class="left">


            <div class="overlay">
                <button onclick="window.history.back()" class="back-btn">
                    <img src="../img/assets/back-icon.png" alt="Back" width="30">Back
                </button>
                <h1>Selamat Datang,<br>
                    Semoga Infaq menjadi Berkah.</h1>
            </div>
        </div>
        <div class="right">
            <h2>Daftar</h2>
            <form method="post">
                <input type="text" name="nama" placeholder="Nama" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="no_hp" placeholder="No hp +62" required>
                <input type="password" name="sandi" placeholder="Password" required>
                <button type="submit">Daftar</button>

            </form>

            <p>Sudah punya Akun? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>

</html>