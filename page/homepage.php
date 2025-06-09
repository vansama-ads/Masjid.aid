<?php
session_start();
include "login_user/koneksi.php";



$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $query = "SELECT * FROM donasi_tujuan WHERE nama LIKE '%$search%'";
} else {
    $query = "SELECT * FROM donasi_tujuan";
}

$sql = mysqli_query($koneksi, $query);




$resultDonatur = mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT user_id) AS jumlah_donatur 
    FROM transaksi 
    WHERE status = 'sukses'
");
$dataDonatur = mysqli_fetch_assoc($resultDonatur);
$jumlahDonatur = $dataDonatur['jumlah_donatur'];


$resultDana = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS total_dana 
    FROM transaksi 
    WHERE status = 'sukses'
");
$dataDana = mysqli_fetch_assoc($resultDana);
$totalDana = $dataDana['total_dana'];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasjidAid</title>
    <link rel="icon" type="image/x-icon" href="img/assets/favicon.ico">
    <link rel="stylesheet" href="css/style-home.css" />
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
            <a href="#">Account ▼</a>
            <ul class="dropdown-menu">
                <li><a href="profile/profile.php">Profile</a></li>
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

    <section class="home">
        <div class="home-content">
            <h1>Masjid.Aid</h1>
            <h3>Amanah Masjid!</h3>
            <p>Donasi masjid lebih mudah, aman, dan terpercaya!</p>
            <a href="info.php" class="btn">DONATE NOW</a>
        </div>
        
    </section> 
    

    <section class="cara-donasi">
        <h2>Cara Donasi</h2>
        <div class="step">
            <span class="number">1.</span>
            <img src="img/assets/check.svg" alt="Check">
            <p>Tentukan masjid</p>
        </div>
        <div class="step">
            <span class="number">2.</span>
            <img src="img/assets/check.svg" alt="Check">
            <p>Tentukan nominal donasi</p>
        </div>
        <div class="step">
            <span class="number">3.</span>
            <img src="img/assets/check.svg" alt="Check">
            <p>Konfirmasi pembayaran</p>
        </div>
        <div class="ajakan">
    <h2>Yuk Donasi Sekarang!</h2>
        <div class="donate-now">
        <a href="info.php" class="btn">DONASI</a>
</div>
        </div>
        
    </section>
    <section class="why-section">
       <div class="why-title">
       <h2 >Kenapa</h2>
       <img src="img/assets/LOGO.png" alt="MasjidAid" class="logo">
       </div> 
       
        <div class="cards-container">
            <div class="card">
                <img src="img/assets/praktis-icon.png" alt="Praktis">
                <h3>Praktis</h3>
                <p>infaq ke Masjid dari mana saja</p>
            </div>
            <div class="card">
                <img src="img/assets/search.png" alt="Transparan">
                <h3>Transparan</h3>
                <p>penyaluran dana dilakukan secara transparan</p>
            </div>
            <div class="card">
                <img src="img/assets/amal-icon.png" alt="Amal Jariyah">
                <h3>Amal Jariyah</h3>
                <p>Donasi yang diberikan menjadi pahala yang terus mengalir, bahkan setelah kita tiada.</p>
            </div>
        </div>
    </section>
    <section class="donation-stats">
    <div class="stats-container">
    <img src="img/assets/donatur-icon.svg" alt="Donors">
    
        <div class="stat">
        <h2><?php echo $jumlahDonatur; ?></h2>
        <p>Telah berdonasi</p>

        </div>
        <img src="img/assets/dana.svg" style="fill: white;" alt="Funds">
        <div class="stat">
            
        <h2>Rp. <?php echo number_format($totalDana, 0, ',', '.'); ?></h2>
        <p>Dana terkumpul</p>

        </div>
    </div>
</section>
<section class="dalil">
        
        <p><em>"Perumpamaan orang yang menginfakkan hartanya di jalan Allah seperti sebutir biji yang menumbuhkan tujuh tangkai, pada setiap tangkai ada seratus biji. Dan Allah melipatgandakan bagi siapa yang Dia kehendaki."</em></p>
        <p><em>(QS. Al-Baqarah: 261)</em></p>
    </section>
    <section class="cta-section">
        <div class="cta-container">
            <p class="cta-text">Tunggu apa lagi?</p>
          <a href="info.php" style="text-decoration:none;" class="cta-button">DONASI</a>
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
                    <p><a href="aboutpage.php">Profile</a></p>
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
                <a href="https://wa.me/6285876335559?text=Assalamualaikum" target="_blank"><img src="img/assets/whatsapp.png" alt="WhastApp"></a>
                <a href="https://www.instagram.com/evannsm._/profilecard/?igsh=MTVvMzN5NWRmams2bA==" target="_blank"><img src="img/assets/instagram.png" alt="YouTube"></a>
                <a href="https://x.com/satriamhrdk_art?t=sXq56TSAp-1CvQScUs51cA&s=09" target="_blank"><img src="img/assets/twitter.png" alt="Instagram"></a>
            </div>
            <p class="footer-copy">&copy; 2025 MasjidAid. All rights reserved.</p>
        </div>
    </div>
</footer>


</body>
</html>