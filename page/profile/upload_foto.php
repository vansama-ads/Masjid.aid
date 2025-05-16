<?php
session_start();
include "../login_user/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $nama_file = $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        $ukuran = $_FILES['foto']['size'];
        $tipe = mime_content_type($tmp_file);

        // Validasi tipe dan ukuran
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($tipe, $allowed_types)) {
            echo "<script>alert('Format gambar harus JPG atau PNG'); window.history.back();</script>";
            exit;
        }

        if ($ukuran > 2 * 1024 * 1024) { // 2MB
            echo "<script>alert('Ukuran gambar maksimal 2MB'); window.history.back();</script>";
            exit;
        }

        $nama_baru = uniqid() . "_" . $nama_file;
        $path_simpan = "../img/user/" . $nama_baru;

        if (move_uploaded_file($tmp_file, $path_simpan)) {
            // Update database dengan foto baru
            $user_id = $_SESSION['user_id'];
            mysqli_query($koneksi, "UPDATE user SET foto = '$nama_baru' WHERE user_id = '$user_id'");

            header("Location: profile.php"); // Arahkan ke halaman profil
            exit;
        } else {
            echo "<script>alert('Upload gagal. Coba lagi.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Tidak ada file yang dipilih atau upload gagal.'); window.history.back();</script>";
        exit;
    }
}
?>
