<?php
session_start();
include "login_user/koneksi.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login_user/login.php");
    exit;
}

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
    <title>About MasjidAid</title>
    <link rel="icon" type="image/x-icon" href="img/assets/favicon.ico">
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="img/assets/LOGO.png" alt="">
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
        <section class="banner">
    <div class="banner-content">
        <h1>Infaq ke Masjid mana?</h1>
        <form method="GET" action="info.php" class="search-form">
            <div class="search-box">
                <div class="search-icon">
                    <img src="img/assets/search.png" alt="">
                </div>
                <div class="search-input">
                    <input type="text" name="search" class="input" placeholder="Cari Masjid..."
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
            </div>
        </form>
    </div>
</section>
  
<section class="button-section">
        <button class="icon-button">
            <div class="icon-circle">
                <img src="img/assets/pin-icon.svg" alt="Disimpan">
            </div>
            <p>Disimpan</p>
        </button>

        <button class="icon-button">
            <div class="icon-circle">
                <img src="img/assets/profile-icon.svg" alt="Profile">
            </div>
            <p>Profile</p>
        </button>
    </section>
    <section class="masjid-list">
    <div class="location-title">
        <img src="img/assets/icon-location.svg" alt="Location Icon">
        <h2>Kec. Sidoarjo</h2>
    </div>

    <div class="masjid-container">
    <?php while ($result = mysqli_fetch_assoc($sql)){?>
        <div class="masjid-card">
            <img src="img/albadar.png" alt="Masjid Al-Badar">
            <h3><?php echo $result ['nama']; ?></h3>
            <p><?php echo $result ['alamat']; ?></p>
            <button class="donasi-btn">DONASI</button>
        </div>
        <?php }?>
       
    </div>
</section>
  

<footer>
    <div class="footer-container">
    
        <div class="footer-top">
        <div class="footer-logo">
                <img src="img/assets/LOGO.png" alt="MasjidAid">
            </div>
            <div class="footer-links">
                <div class="footer-section">
                    <h3>Kontak Kami</h3>
                    <p>WhatsApp: +62 858-7633-5559</p>
                    <p>Email: <br> evan_mahardika_ts7_24@student.smtkelkom-sda.sch.id</p>
                </div>
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p><a href="#">Profile</a></p>
                    <p><a href="#">Visi & Misi</a></p>
                </div>
                <div class="footer-section">
                    <h3>Bantuan</h3>
                    <p><a href="#">FAQ</a></p>
                    
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <p><a href="#">Kebijakan Privasi</a></p>
                    <p><a href="#">Syarat & Ketentuan</a></p>
                    <p><a href="#">Hak Cipta</a></p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-social">
                <a href="https://wa.me/085876335559?text=Assalamualaikum" target="_blank"><img src="img/assets/whatsapp.png" alt="WhastApp"></a>
                <a href="https://www.instagram.com/evannsm._/profilecard/?igsh=MTVvMzN5NWRmams2bA==" target="_blank"><img src="img/assets/instagram.png" alt="YouTube"></a>
                <a href="https://x.com/satriamhrdk_art?t=sXq56TSAp-1CvQScUs51cA&s=09" target="_blank"><img src="img/assets/twitter.png" alt="Instagram"></a>
            </div>
            <p class="footer-copy">&copy; 2025 MasjidAid. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>