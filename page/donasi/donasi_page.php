<?php
session_start();
include "../login_user/koneksi.php";



$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $query = "SELECT * FROM donasi_tujuan WHERE nama LIKE '%$search%'";
} else {
    $query = "SELECT * FROM donasi_tujuan";
}

$sql = mysqli_query($koneksi, $query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/donasi/style-page.css">
</head>
<body>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../img/assets/LOGO.png" alt="">
                </div>
                
  
                <ul class="navigation">
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="info.php">Information</a></li>
                    <li><a href="aboutpage.php">About</a></li>
                    
                    
                    <?php if (isset($_SESSION['logged_in'])) : ?>
    <li><a href="login_user/logout.php">Logout</a></li>
<?php else : ?>
    <li><a href="login_user/login.php">Login</a></li>
<?php endif; ?>       
                </ul>
            </nav>
        </div>
    </header> 
</body>
</html>