<?php
session_start();
include "login_user/koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About MasjidAid</title>
    <link rel="icon" type="image/x-icon" href="img/assets/favicon.ico">
    <link rel="stylesheet" href="css/style-about.css" />
</head>
<body>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="img/assets/LOGO.png" alt="">
                </div>
                <div class="container">
    <form method="GET" action="info.php">
        <div class="search-box">
            <div class="search-icon">
                <img src="img/assets/search.png" alt="">
            </div>
            <div class="search-input">
                <input type="text" name="search" class="input" placeholder="Cari Masjid..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
        </div>
    </form>
</div>
  
<ul class="navigation">
    <li><a href="homepage.php">Home</a></li>
    <li><a href="info.php">Information</a></li>
    <li><a href="aboutpage.php">About</a></li>

    <?php if (isset($_SESSION['logged_in'])) : ?>
        <li class="dropdown">
            <a href="profile/profile.php">Account ▼</a>
            <ul class="dropdown-menu">
                <li><a href="#">Profile</a></li>
                <li><a href="login_user/logout.php">Logout</a></li>
            </ul>
        </li>
    <?php else : ?>
        <li><a href="login_user/login.php">Login</a></li>
    <?php endif; ?>  
</ul>


            </nav>
        </div>
    </header> 
        <section class="banner">
        
                <h1>About Us</h1>
                <br>
                <h4>Masjid.Aid</h4>
         

        </section>   
        <section class="info-container">
            <div class="info-box"> 
            <p>
            <strong>MasjidAid</strong> adalah platform digital yang berbasis online dan dikelola oleh komunitas untuk mempermudah donasi masjid di seluruh Indonesia.
             </p>
            </div>
           
        </section> 
        <section class="visi-misi">
    <!-- VISI -->
    <div class="visi-container">
        <div class="visi-card">
            <h2>Visi</h2>
            <p>Menjadi platform donasi terpercaya untuk mendukung pembangunan dan kesejahteraan masjid secara transparan.</p>
        </div>
        <img src="img/assets/trophy-icon.svg" alt="Trophy Icon" class="visi-icon"> <!-- Ikon di kanan -->
    </div>

    <!-- MISI -->
    <div class="misi-container">
        <img src="img/assets/document-icon.svg" alt="Document Icon" class="misi-icon"> <!-- Ikon di kiri -->
        <div class="misi-card">
            <h2>Misi</h2>
            <ol>
                <li>Mempermudah donasi masjid secara digital.</li>
                <li>Menjamin transparansi dalam pengelolaan dana.</li>
                <li>Membangun kesadaran dan kepedulian umat terhadap kebutuhan masjid.</li>
            </ol>
        </div>
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