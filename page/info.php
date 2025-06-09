<?php
session_start();
include "login_user/koneksi.php";

// Proses pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $query = "SELECT * FROM donasi_tujuan WHERE nama LIKE '%$search%'";
} else {
    $query = "SELECT * FROM donasi_tujuan";
}

$sql = mysqli_query($koneksi, $query);
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("search")) {
            const masjidSection = document.querySelector(".masjid-list");
            if (masjidSection) {
                masjidSection.scrollIntoView({ behavior: "smooth" });
            }
        }
    });
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info MasjidAid</title>
    <link rel="icon" href="img/assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-info.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="img/assets/LOGO.png" alt="Logo MasjidAid">
                </div>
                <ul class="navigation">
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="info.php">Information</a></li>
                    <li><a href="aboutpage.php">About</a></li>
                    <?php if (isset($_SESSION['logged_in'])): ?>
                        <li><a href="login_user/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login_user/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner Pencarian -->
    <section class="banner">
        <div class="banner-content">
            <h1>Infaq ke Masjid mana?</h1>
            <form method="GET" action="info.php" class="search-form">
                <div class="search-box">
                    <div class="search-icon">
                        <img src="img/assets/search.png" alt="Search">
                    </div>
                    <div class="search-input">
                        <input 
                            type="text" 
                            name="search" 
                            class="input" 
                            placeholder="Cari Masjid..." 
                            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Tombol Akses -->
    <section class="button-section">
        <a href="profile/riwayat.php" class="icon-button">
            <div class="icon-circle">
                <img src="img/assets/icon-history.svg" alt="Riwayat">
            </div>
            <p>Riwayat</p>
        </a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="admin/admin.php" class="icon-button">
                <div class="icon-circle">
                    <img src="img/assets/dashboard-icon.svg" alt="Dashboard">
                </div>
                <p>Dashboard</p>
            </a>
        <?php endif; ?>

        <a href="profile/profile.php" class="icon-button">
            <div class="icon-circle">
                <img src="img/assets/profile-icon.svg" alt="Profile">
            </div>
            <p>Profile</p>
        </a>
    </section>

    <!-- Daftar Masjid -->
    <section class="masjid-list">
        <div class="location-title">
            <h1>Jelajahi</h1>
        </div>
        <div class="masjid-container">
            <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                <div class="masjid-card">
                    <img src="img/<?php echo $result['foto']; ?>" alt="Foto Masjid">
                    <h3><?php echo $result['nama']; ?></h3>
                    <p><?php echo $result['alamat']; ?></p>
                    <a class="donasi-btn" href="donasi/page/form_donasi.php?id_donasi=<?= $result['id_donasi'] ?>">DONASI</a>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Footer -->
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
                        <p>Email:<br>evan_mahardika_ts7_24@student.smtkelkom-sda.sch.id</p>
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
                    <a href="https://wa.me/085876335559?text=Assalamualaikum" target="_blank"><img src="img/assets/whatsapp.png" alt="WhatsApp"></a>
                    <a href="https://www.instagram.com/evannsm._/profilecard/?igsh=MTVvMzN5NWRmams2bA==" target="_blank"><img src="img/assets/instagram.png" alt="Instagram"></a>
                    <a href="https://x.com/satriamhrdk_art?t=sXq56TSAp-1CvQScUs51cA&s=09" target="_blank"><img src="img/assets/twitter.png" alt="Twitter"></a>
                </div>
                <p class="footer-copy">&copy; 2025 MasjidAid. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
