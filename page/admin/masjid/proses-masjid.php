<?php
include "../../login_user/koneksi.php";

// Hapus Data
if (isset($_GET['hapus'])) {
    $id_donasi = $_GET['hapus'];

    $queryShow = "SELECT * FROM donasi_tujuan WHERE id_donasi = '$id_donasi'";
    $sqlShow = mysqli_query($koneksi, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if ($result) {
        unlink("../../img/" . $result['foto']);
    }

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
    $kebutuhan = mysqli_real_escape_string($koneksi, $_POST['kebutuhan']);
    $alamat_lengkap = mysqli_real_escape_string($koneksi, $_POST['alamat_lengkap']);
    $hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $foto = $_FILES['foto']['name'];
    $id_donasi = isset($_POST['id']) ? $_POST['id'] : null;

    $dir = "../../img/";
    $tmpFile = $_FILES['foto']['tmp_name'];

    if (!empty($foto)) {
        move_uploaded_file($tmpFile, $dir . $foto);
    }

    if ($_POST['aksi'] == "add") {
        // Insert Data
        $query = "INSERT INTO donasi_tujuan (foto, nama, alamat, kebutuhan, alamat_lengkap, hp) VALUES ('$foto', '$nama', '$alamat', '$kebutuhan', '$alamat_lengkap', '$hp')";
    } elseif ($_POST['aksi'] == "edit") {
        // Pastikan `id_donasi` ada sebelum update
        $query_check = "SELECT foto FROM donasi_tujuan WHERE id_donasi = '$id_donasi'";
        $result_check = mysqli_query($koneksi, $query_check);
        $data = mysqli_fetch_assoc($result_check);

        if (!$data) {
            echo '<script>alert("Data tidak ditemukan!"); location.href="admin-masjid.php";</script>';
            exit();
        }

        $query = "UPDATE donasi_tujuan SET nama='$nama', alamat='$alamat', kebutuhan='$kebutuhan', alamat_lengkap='$alamat_lengkap', hp='$hp'";

        // Jika ada file foto baru yang diunggah
        if (!empty($foto)) {
            $foto_baru = $foto;
            $uploadPath = "../../img/" . $foto_baru;

            // Hapus foto lama jika ada
            if (!empty($data['foto']) && file_exists("../../img/" . $data['foto'])) {
                unlink("../../img/" . $data['foto']);
            }

            // Upload foto baru
            move_uploaded_file($tmpFile, $uploadPath);

            // Tambahkan ke query untuk update foto
            $query .= ", foto='$foto_baru'";
        }

        $query .= " WHERE id_donasi='$id_donasi'";
    }

    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        echo '<script>alert("Data berhasil diperbarui!"); location.href="admin-masjid.php";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui data!"); location.href="admin-masjid.php";</script>';
    }
}
?>
