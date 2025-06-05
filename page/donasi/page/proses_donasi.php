<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include '../../login_user/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    die("Silakan login terlebih dahulu.");
}

$user_id = $_SESSION['user_id'];
$id_donasi = $_POST['id_donasi'];
$jumlah = $_POST['jumlah'];
$id_metode = $_POST['id_metode'];
$pesan = $_POST['pesan'];
$status = 'pending';

// Debugging: Cek apakah data POST sudah diterima dengan benar
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Escape input untuk menghindari SQL Injection
$user_id = mysqli_real_escape_string($koneksi, $user_id);
$id_donasi = mysqli_real_escape_string($koneksi, $id_donasi);
$jumlah = mysqli_real_escape_string($koneksi, $jumlah);
$id_metode = mysqli_real_escape_string($koneksi, $id_metode);
$pesan = mysqli_real_escape_string($koneksi, $pesan);
$status = mysqli_real_escape_string($koneksi, $status);

// Siapkan query untuk memasukkan data transaksi
$query = "INSERT INTO transaksi (user_id, id_donasi, jumlah, status, id_metode, pesan) 
          VALUES ('$user_id', '$id_donasi', '$jumlah', '$status', '$id_metode', '$pesan')";

// Eksekusi query dan cek apakah berhasil
if (mysqli_query($koneksi, $query)) {
    // Ambil ID transaksi terakhir
    $id_transaksi = mysqli_insert_id($koneksi);
    header("Location: pembayaran.php?id_transaksi=$id_transaksi");
    exit;
} else {
    // Debugging: Tampilkan error jika query gagal
    die("Gagal menyimpan transaksi: " . mysqli_error($koneksi));
}
?>
