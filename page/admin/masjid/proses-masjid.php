<?php
include "../../login_user/koneksi.php";

// Hapus Data
if (isset($_GET['hapus'])) {
    $id_donasi = $_GET['hapus'];
    
    // Hapus data dari database
    $query = "DELETE FROM donasi_tujuan WHERE id_donasi = '$id_donasi'";
    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        header("Location: admin-masjid.php");
        exit();
    } else {
        echo '<script>alert("Gagal menghapus data!"); location.href="admin-masjid.php";</script>';
    }
}

// Tambah & Edit Data
if (isset($_POST['aksi'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $id_donasi = isset($_POST['id']) ? $_POST['id'] : null;

    if ($_POST['aksi'] == "add") {
        // Insert Data (TIDAK ADA FOTO)
        $query = "INSERT INTO donasi_tujuan (nama, alamat, deskripsi) VALUES ('$nama', '$alamat', '$deskripsi')";
    } elseif ($_POST['aksi'] == "edit") {
        // Pastikan `id_donasi` ada sebelum update
        $query_check = "SELECT * FROM donasi_tujuan WHERE id_donasi = '$id_donasi'";
        $result_check = mysqli_query($koneksi, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Update Data (FOTO TIDAK BERUBAH)
            $query = "UPDATE donasi_tujuan SET nama='$nama', alamat='$alamat', deskripsi='$deskripsi' WHERE id_donasi='$id_donasi'";
        } else {
            echo '<script>alert("Data tidak ditemukan!"); location.href="admin-masjid.php";</script>';
            exit();
        }
    }

    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        echo '<script>alert("Data berhasil disimpan!"); location.href="admin-masjid.php";</script>';
    } else {
        echo '<script>alert("Gagal menyimpan data!"); location.href="add-masjid.php";</script>';
    }
}
?>
