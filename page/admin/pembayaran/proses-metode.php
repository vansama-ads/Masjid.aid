<?php
session_start();
include "../../login_user/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $rekening = $_POST['rekening'];
    $aksi = $_POST['aksi'];

    if ($aksi == "add") {
        $query = "INSERT INTO metode_pembayaran (nama, kategori, rekening) VALUES ('$nama', '$kategori', '$rekening')";
        $sql = mysqli_query($koneksi, $query);

        if ($sql) {
            header("Location: metode.php?status=sukses");
        } else {
            header("Location: metode.php?status=gagal");
        }
    } elseif ($aksi == "edit") {
        $query = "UPDATE metode_pembayaran SET nama = '$nama', kategori = '$kategori', rekening='$rekening' WHERE id_metode = '$id'";
        $sql = mysqli_query($koneksi, $query);

        if ($sql) {
            header("Location: metode.php?status=updated");
        } else {
            header("Location: metode.php?status=gagal");
        }
    }
} else {
    header("Location: metode.php");
}

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Query hapus
    $query = "DELETE FROM metode_pembayaran WHERE id_metode = '$id'";
    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        // Jika berhasil hapus, kembali ke halaman metode.php
        header("Location: metode.php");
    } else {
        echo "Gagal menghapus data.";
    }

}



?>
