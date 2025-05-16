<?php
session_start();
include '../../login_user/koneksi.php';

if (!isset($_GET['id_transaksi'])) {
    exit("Transaksi tidak ditemukan.");
}

$id_transaksi = $_GET['id_transaksi'];

// Ambil data transaksi & status pembayaran
$query = mysqli_query($koneksi, "SELECT p.status, t.id_donasi, u.nama AS nama_user, d.nama AS nama_masjid
    FROM pembayaran p
    JOIN transaksi t ON p.id_transaksi = t.id_transaksi
    JOIN user u ON t.user_id = u.user_id
    JOIN donasi_tujuan d ON t.id_donasi = d.id_donasi
    WHERE p.id_transaksi = '$id_transaksi'");

if (!$query || mysqli_num_rows($query) == 0) {
    exit("Data transaksi tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);
$status = $data['status'];
$nama_user = $data['nama_user'];
$nama_masjid = $data['nama_masjid'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Donasi</title>
 <link rel="stylesheet" href="../../css/donasi/style-menunggu.css"> 
</head>
<body>

  <?php if ($status === 'sukses') : ?>
    <img src="../../img/assets/status/success-icon.png" class="status-icon" alt="Sukses">
    <div class="message">
      Terima kasih <span class="highlight"><?= htmlspecialchars($nama_user) ?></span>,<br>
      Donasi anda ke Masjid <span class="highlight"><?= htmlspecialchars($nama_masjid) ?></span> sudah <b>berhasil</b> kami terima.
    </div>
  <?php elseif ($status === 'pending') : ?>
    <img src="../../img/assets/status/pending-icon.png" class="status-icon" alt="Pending">
    <div class="message">
      Terima kasih <span class="highlight"><?= htmlspecialchars($nama_user) ?></span>,<br>
      Bukti donasi anda ke Masjid <span class="highlight"><?= htmlspecialchars($nama_masjid) ?></span> sedang kami <b>verifikasi</b>.<br>
      Mohon tunggu beberapa saat.
    </div>
  <?php else : ?>
    <div class="message">
      <b>Status tidak dikenali.</b><br>
      Silakan hubungi admin.
    </div>
  <?php endif; ?>

  <div>
    <span style="color:gray;">Ingin donasi ke masjid lainnya?</span><br>
    <a href="../../info.php" class="link">Klik di sini</a>
  </div>

</body>
</html>
