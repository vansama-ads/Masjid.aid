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


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result); // ambil satu baris data user

// Ambil ID donasi dari URL
if (!isset($_GET['id_donasi'])) {
  exit("Donasi tujuan tidak ditemukan.");
}
$id_donasi = $_GET['id_donasi'];

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
  
  <link rel="stylesheet" href="styles.css">
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
      <img src="logo.png" alt="Logo" class="logo">
      <p class="thanks">Terimakasih <span class="highlight"><?= htmlspecialchars($user['nama']) ?></span> atas Donasi yang akan anda berikan pada Masjid :</p>
      <h2 class="masjid-name"><?= $donasi['nama'] ?><</h2>

      <div class="qris-section">
        <div class="left">
          <div class="qris-box">QRIS</div>
          <div class="amount-box">
            <img src="donation-icon.png" class="icon">
            <strong><span class="amount">Rp. <span class="pink">Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?></span></span></strong>
          </div>
          <p class="note">Harap transfer sesuai nominal diatas (sampai 3 digit terakhir) agar dapat terkonfirmasi otomatis dan kebaikan ini dapat kami teruskan.</p>
          <div class="deadline-box">
            <img src="clock-icon.png" class="icon">
            <span>Transfer sebelum: <br><strong>5 April 2025 - 16:52 WIB</strong></span>
          </div>
          <label for="file-upload" class="custom-upload">
                <img src="upload-icon-white.svg" alt="Upload Icon" class="icon-upload">
                UPLOAD BUKTI PEMBAYARAN DISINI
                </label>
                <input type="file" id="file-upload" class="hidden-input" />


        </div>
        <div class="right">
          <img src="qr.png" alt="QR Code" class="qr-code">
          <p class="scan-info">Scan QR-Code berikut untuk mentransfer dengan app kesayangan anda.</p>
        </div>
      </div>

      <div class="apps">
  <img src="apps-strip.png" alt="Aplikasi Pembayaran">
                </div>
                <div class="how-to">
  <img src="steps-strip.png" alt="Langkah-langkah pembayaran">
</div>

    </div>
  </div>
</body>
</html>a
