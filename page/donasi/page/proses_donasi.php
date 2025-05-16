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

// Debugging: Cek apakah data POST sudah diterima dengan benar
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Siapkan query untuk memasukkan data transaksi
$query = "INSERT INTO transaksi (user_id, id_donasi, jumlah, status, id_metode, pesan) 
          VALUES (?, ?, ?, ?, ?, ?)";

// Eksekusi query dan cek apakah berhasil
if ($query = $koneksi->prepare($query)) {
    $pending = 'pending';
    $query->bind_param('iiisis', $user_id, $id_donasi, $jumlah, $pending, $id_metode, $pesan);
    // Ambil ID transaksi terakhir
   if ($query->execute()) {
    // Pastikan data berhasil dimasukkan sebelum redirect
    // Redirect ke halaman pembayaran
    $query_view = "SELECT * FROM transaksi ORDER BY id_transaksi DESC";
    $result = $koneksi->query($query_view);
    $row_transaksi= $result->fetch_assoc();
    // print_r($row_transaksi);   
    $id_transaksi = $row_transaksi['id_transaksi'];
    header("Location: pembayaran.php?id_transaksi=$id_transaksi");
    exit;  // Pastikan tidak ada eksekusi lebih lanjut setelah header
   }
} else {
    // Debugging: Tampilkan error jika query gagal
    die("Gagal menyimpan transaksi: " . mysqli_error($koneksi));
}

?>