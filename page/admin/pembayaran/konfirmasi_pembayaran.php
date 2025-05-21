<?php
session_start();
include "../../login_user/koneksi.php";

if (isset($_POST['konfirmasi'])) {
    $id_transaksi = $_POST['id_transaksi'];

    // Ambil data transaksi dulu (buat ambil jumlah dan id_donasi)
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $jumlah = $data['jumlah'];
        $id_donasi = $data['id_donasi'];

        // Update status di tabel pembayaran
        $update_pembayaran = mysqli_query($koneksi, "UPDATE pembayaran SET status = 'sukses' WHERE id_transaksi = '$id_transaksi'");

        // Update status di tabel transaksi
        $update_transaksi = mysqli_query($koneksi, "UPDATE transaksi SET status = 'sukses' WHERE id_transaksi = '$id_transaksi'");

        // Tambahkan jumlah ke total di tabel donasi
        $update_donasi = mysqli_query($koneksi, "UPDATE donasi_tujuan SET jumlah = jumlah + $jumlah WHERE id_donasi = '$id_donasi'");

        if ($update_pembayaran && $update_transaksi && $update_donasi) {
            header("Location: konfirmasi.php?pesan=berhasil");
            exit;
        } else {
            echo "❌ Gagal mengonfirmasi pembayaran.";
        }
    } else {
        echo "⚠️ Transaksi tidak ditemukan.";
    }
} else {
    echo "⚠️ Akses tidak sah.";
}
?>
