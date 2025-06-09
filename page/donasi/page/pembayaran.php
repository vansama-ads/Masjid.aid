<?php
session_start();
include '../../login_user/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    exit("Silakan login terlebih dahulu.");
}

if (!isset($_GET['id_transaksi'])) {
    exit("Transaksi tidak ditemukan.");
}

$id_transaksi = $_GET['id_transaksi'];
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
$transaksi = mysqli_fetch_assoc($query);



$id_metode = $transaksi['id_metode'];
$query_metode = mysqli_query($koneksi, "SELECT * FROM metode_pembayaran WHERE id_metode = '$id_metode'");
$metode = mysqli_fetch_assoc($query_metode);


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result); // ambil satu baris data user

// Ambil ID donasi dari URL
// Ambil ID donasi dari transaksi
$id_donasi = $transaksi['id_donasi'];

// Ambil data donasi dari database
$query = mysqli_query($koneksi, "SELECT * FROM donasi_tujuan WHERE id_donasi = '$id_donasi'");
$donasi = mysqli_fetch_assoc($query);


?>







<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Donasi</title>
  <link rel="icon" type="image/x-icon" href="../../img/assets/favicon.ico">
  <link rel="stylesheet" href="../../css/donasi/style-pembayaran.css">
</head>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../img/assets/LOGO.png" alt="">
                    <h3>| Pembayaran</h3>
                </div>
                
               
  



            </nav>
        </div>
    </header> 
<body>
  <div class="container">
    <div class="card">
      <img src="../../img/assets/pembayaran/logo.png" alt="Logo" class="logo">
      <p class="thanks">Terimakasih <span class="highlight"><?= htmlspecialchars($user['nama']) ?></span> atas Donasi yang akan anda berikan pada :</p>
      <h2 class="masjid-name"><?= $donasi['nama'] ?></h2>

      <div class="qris-section">
        <div class="left">
          <div class="qris-box"><?= $metode['kategori'] ?></div>
          <div class="amount-box">
            <img src="../../img/assets/pembayaran/donation-icon.png" class="icon">
            <strong><span class="amount">Rp. <span class="pink"> <?= number_format($transaksi['jumlah'], 0, ',', '.') ?></span></span></strong>
          </div>
          <p class="note">Harap transfer sesuai nominal diatas (sampai 3 digit terakhir) agar dapat terkonfirmasi otomatis dan kebaikan ini dapat kami teruskan.</p>
          <div class="deadline-box">
            <img src="../../img/assets/pembayaran/clock-icon.png" class="icon">
            <span>Transfer sebelum: <br><strong>1 Jam Setelah Anda Mengakses Halaman Ini</strong></span>
          </div>
          <form action="upload_bukti.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">

    <label for="file-upload" class="custom-upload">
        <img src="../../img/assets/pembayaran/upload-icon-white.svg" alt="Upload Icon" class="icon-upload">
        UPLOAD BUKTI PEMBAYARAN DISINI
    </label>
    <input type="file" id="file-upload" name="bukti" class="hidden-input" required>

    <button type="submit" name="submit" class="submit-button">KIRIM</button>
</form>


        </div>
        <div class="right">

                    <?php if ($metode['kategori'] === 'bank'): ?>
                <div class="transfer-box">
                    <p>Silakan transfer ke rekening berikut:</p>
                    <ul>
                        <li><strong><?= htmlspecialchars($metode['nama']) ?>:</strong> <?= htmlspecialchars($metode['rekening']) ?></li>
                    </ul>
                </div>
            <?php elseif ($metode['kategori'] === 'qris'): ?>
                
                    <img src="../../img/assets/pembayaran/qr.png" alt="QR Code" class="qr-code">
                              <p class="scan-info">Scan QR-Code berikut untuk mentransfer dengan app kesayangan anda.</p>
                
            <?php endif; ?>


          
        </div>
      </div>

      <div class="apps">
  <img src="../../img/assets/pembayaran/apps-strip.png" alt="Aplikasi Pembayaran">
                </div>
                <div class="how-to">
        <img src="../../img/assets/pembayaran/steps-strip.png" alt="Langkah-langkah pembayaran">
        
      </div>
      <p style="font-size: 0.9em; color: gray;">
  Semua donasi dari platform ini disalurkan melalui rekening resmi Masjid.Aid sebelum diteruskan ke masjid tujuan. Setiap transaksi tercatat dan dilaporkan secara transparan.
</p>

    </div>
  </div>
</body>
</html>
