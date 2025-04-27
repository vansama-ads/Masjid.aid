<?php
session_start();
include '../../login_user/koneksi.php';



$id_pembayaran = $_POST['id_pembayaran'];
$id_transaksi = $_POST['id_transaksi'];

// Update status pembayaran jadi "Lunas"
$queryPembayaran = "UPDATE pembayaran SET status = 'sukses', waktu_pembayaran = NOW() 
                    WHERE id_pembayaran = '$id_pembayaran'";
$updatePembayaran = mysqli_query($koneksi, $queryPembayaran);

// Update status transaksi jadi "Lunas"
$queryTransaksi = "UPDATE transaksi SET status = 'sukses' WHERE id_transaksi = '$id_transaksi'";
$updateTransaksi = mysqli_query($koneksi, $queryTransaksi);


// Update total jumlah di tabel donasi_tujuan
$queryUpdateDonasi = "UPDATE donasi_tujuan SET jumlah = jumlah + $jumlah_donasi WHERE id_donasi = '$id_donasi'";
$updateDonasi = mysqli_query($koneksi, $queryUpdateDonasi);

if ($updatePembayaran && $updateTransaksi) {
    echo "<script>alert('Pembayaran telah dikonfirmasi!'); window.location.href='pembayaran_admin.php';</script>";
} else {
    echo "<script>alert('Gagal mengonfirmasi pembayaran!'); window.history.back();</script>";
}
?>
