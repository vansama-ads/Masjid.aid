<?php
session_start();
include '../../login_user/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    exit("Silakan login terlebih dahulu.");
}

$user_id = $_SESSION['user_id'];
$id_donasi = $_POST['id_donasi'];
$jumlah = $_POST['jumlah'];

// Simpan transaksi ke database
$query = "INSERT INTO transaksi (user_id, id_donasi, jumlah, status) 
          VALUES ('$user_id', '$id_donasi', '$jumlah', 'pending')";
mysqli_query($koneksi, $query) or die("Gagal berdonasi: " . mysqli_error($koneksi));

// Ambil ID transaksi terakhir
$id_transaksi = mysqli_insert_id($koneksi);

// Redirect ke halaman pembayaran
header("Location: pembayaran.php?id_transaksi=$id_transaksi");
exit;
?>
