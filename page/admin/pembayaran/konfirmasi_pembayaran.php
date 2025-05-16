<?php
session_start();
include "../../login_user/koneksi.php";

if (isset($_POST['konfirmasi'])) {
    $id_transaksi = $_POST['id_transaksi'];

    // Update status di tabel pembayaran
    $update_pembayaran = mysqli_query($koneksi, "UPDATE pembayaran SET status = 'sukses' WHERE id_transaksi = '$id_transaksi'");

    // Update status di tabel transaksi
    $update_transaksi = mysqli_query($koneksi, "UPDATE transaksi SET status = 'sukses' WHERE id_transaksi = '$id_transaksi'");

    if ($update_pembayaran && $update_transaksi) {
        header("Location: konfirmasi.php?pesan=berhasil");
        exit;
    } else {
        echo "❌ Gagal mengonfirmasi pembayaran.";
    }
} else {
    echo "⚠️ Akses tidak sah.";
}

?>
