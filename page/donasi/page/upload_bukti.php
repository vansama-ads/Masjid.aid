<?php
session_start();
include '../..//login_user/koneksi.php';

if (!isset($_POST['submit'])) {
    exit("Akses tidak sah.");
}

$id_transaksi = $_POST['id_transaksi'];

// Cek apakah file ada
if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] !== UPLOAD_ERR_OK) {
    exit("File tidak ditemukan atau terjadi kesalahan saat upload.");
}

// Buat nama file unik
$nama_file = time() . '_' . basename($_FILES["bukti"]["name"]);

// Lokasi folder upload
$target_dir = "../../img/bukti_pembayaran/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Membuat folder jika belum ada
}

$target_file = $target_dir . $nama_file;

// Upload file
if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
    // Simpan bukti pembayaran di tabel pembayaran
    $query = "INSERT INTO pembayaran (id_transaksi, bukti_pembayaran, status, waktu_pembayaran) 
              VALUES ('$id_transaksi', '$nama_file', 'pending', NOW())";

    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman pembayaran
        header("Location: menunggu_pembayaran.php?id_transaksi=$id_transaksi");
        exit;
    } else {
        echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal upload file.";
}
?>
