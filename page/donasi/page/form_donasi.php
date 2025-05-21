<?php
session_start();
include "../../login_user/koneksi.php";


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu untuk mengakses halaman ini.');
        window.location.href = '../../login_user/login.php';
    </script>";
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




// Ambil ID donasi dari URL
if (!isset($_GET['id_donasi'])) {
    exit("Donasi tujuan tidak ditemukan.");
}
$id_donasi = $_GET['id_donasi'];

// Ambil data donasi dari database
$query = mysqli_query($koneksi, "SELECT * FROM donasi_tujuan WHERE id_donasi = '$id_donasi'");
$donasi = mysqli_fetch_assoc($query);





// Ambil daftar metode pembayaran dari database
$metode_query = mysqli_query($koneksi, "SELECT * FROM metode_pembayaran");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Donasi Masjid</title>
    <link rel="icon" type="image/x-icon" href="../../img/assets/favicon.ico">
    <link rel="stylesheet" href="../../css/donasi/style-page.css">
</head>
<body>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../../img/assets/LOGO.png" alt="">
                </div>
                <div class="search-container">
    <form method="GET" action="info.php">
        <div class="search-box">
            <div class="search-icon">  
                <img src="../../img/assets/search.png" alt="">
            </div>
            <div class="search-input">
                <input type="text" name="search" class="input" placeholder="Cari Masjid..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
        </div>
    </form>
</div>
  
<ul class="navigation">
    <li><a href="../../homepage.php">Home</a></li>
    <li><a href="info.php">Information</a></li>
    <li><a href="aboutpage.php">About</a></li>

    <?php if (isset($_SESSION['logged_in'])) : ?>
        <li class="dropdown">
            <a href="#">Account ▼</a>
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
<div class="container">

    <div class="kiri">
        <img src="../../img/<?= $donasi['foto']?>" class="foto-masjid" alt="Foto Masjid">
        <h2><?= $donasi['nama'] ?></h2>
        <p><?= $donasi['alamat'] ?></p>
        <p><strong>Alamat:</strong> Jl. Pecantingan, Sekardangan Indah, Sidoarjo</p>
        <p><strong>Telp:</strong> +62 812-3456-7890</p>
        <p><strong>Dana Terkumpul:<br>Rp. <?= $donasi['jumlah'] ?></strong>
            
        </p>
    </div>

    <div class="kanan">
        <form method="POST" action="proses_donasi.php">
        <input type="hidden" name="id_donasi" value="<?= $id_donasi ?>">

            <label>Pilih Nominal:</label><br>
            <div class="nominal-preset">
                <button type="button" onclick="isiNominal(25000)">Rp. 25,000</button>
                <button type="button" onclick="isiNominal(50000)">Rp. 50,000</button>
                <button type="button" onclick="isiNominal(100000)">Rp. 100,000</button>
                <button type="button" onclick="isiNominal(250000)">Rp. 250,000</button>
            </div>
            <input type="number" name="jumlah" id="nominal" placeholder="Masukkan Nominal" required>

            <label>Metode Pembayaran:</label><br>
            <?php while ($row = mysqli_fetch_assoc($metode_query)) : ?>
                <label><input type="radio" name="id_metode" value="<?= $row['id_metode'] ?>" required> <?= $row['nama'] ?></label><br>
            <?php endwhile; ?>



            <label>Pesan atau Doa (Opsional):</label><br>
            <textarea name="pesan" placeholder="Tuliskan pesan atau doa..."></textarea><br>

            <button type="submit" name="submit" value="kirim_donasi">Kirim Donasi</button>

        </form>
    </div>

</div>
<footer>
    <div class="footer-container">
    
        <div class="footer-top">
        <div class="footer-logo">
                <img src="../../img/assets/LOGO.png" alt="MasjidAid">
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
                <a href="https://wa.me/085876335559?text=Assalamualaikum" target="_blank"><img src="../../img/assets/whatsapp.png" alt="WhastApp"></a>
                <a href="https://www.instagram.com/evannsm._/profilecard/?igsh=MTVvMzN5NWRmams2bA==" target="_blank"><img src="../../img/assets/instagram.png" alt="YouTube"></a>
                <a href="https://x.com/satriamhrdk_art?t=sXq56TSAp-1CvQScUs51cA&s=09" target="_blank"><img src="../../img/assets/twitter.png" alt="Instagram"></a>
            </div>
            <p class="footer-copy">&copy; 2025 MasjidAid. All rights reserved.</p>
        </div>
    </div>
</footer>
<script>
    function isiNominal(jumlah) {
        document.getElementById("nominal").value = jumlah;
    }
</script>
</body>
</html>
