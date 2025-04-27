<?php
session_start();
include '../login_user/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = '../login_user/login.php';
          </script>";
    exit;
}

$id_transaksi = $_POST['id_transaksi'];
$id_metode = $_POST['id_metode'];

// Cek apakah transaksi ada
$queryTransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
$data = mysqli_fetch_assoc($queryTransaksi);

if ($data) {
    $jumlah_donasi = $data['jumlah'];
    $id_donasi = $data['id_donasi'];

    // Simpan pembayaran ke tabel pembayaran
    $queryPembayaran = "INSERT INTO pembayaran (id_transaksi, id_metode, status, waktu_pembayaran) 
                        VALUES ('$id_transaksi', '$id_metode', 'Pending', NULL)";
    $insertPembayaran = mysqli_query($koneksi, $queryPembayaran);

    if ($insertPembayaran) {
        echo "<script>
                alert('Pembayaran sedang diproses. Silakan tunggu konfirmasi.');
                window.location.href = 'sukses.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Gagal menyimpan pembayaran: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Transaksi tidak ditemukan!');
            window.history.back();
          </script>";
}
?>
