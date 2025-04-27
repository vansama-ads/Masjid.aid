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

// Ambil daftar metode pembayaran dari database
$metode_query = mysqli_query($koneksi, "SELECT * FROM metode_pembayaran");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
</head>
<body>
    <h2>Pembayaran Donasi</h2>
    <p>Jumlah Donasi: Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?></p>

    <form action="proses_pembayaran.php" method="POST">
        <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">

        <label>Pilih Metode Pembayaran:</label>
        <select name="id_metode" required>
            <?php while ($row = mysqli_fetch_assoc($metode_query)) : ?>
                <option value="<?= $row['id_metode'] ?>"><?= $row['nama'] ?> (<?= $row['kategori'] ?>)</option>
            <?php endwhile; ?>
        </select>
        <br>

        <button type="submit">Bayar Sekarang</button>
    </form>
</body>
</html>
