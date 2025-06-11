<?php
session_start();
include "../../login_user/koneksi.php";

if (isset($_POST['aksi'])) {
    $id_donasi = $_POST['id_donasi'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $keperluan = $_POST['keperluan'];
    $keterangan = $_POST['keterangan'];

    if ($_POST['aksi'] == 'tambah') {
        $query = "INSERT INTO pengeluaran (id_donasi, tanggal, jumlah, keperluan, keterangan)
                  VALUES ('$id_donasi', '$tanggal', '$jumlah', '$keperluan', '$keterangan')";
        mysqli_query($koneksi, $query);
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id'];
        $query = "UPDATE pengeluaran SET 
                    tanggal = '$tanggal',
                    jumlah = '$jumlah',
                    keperluan = '$keperluan',
                    keterangan = '$keterangan'
                  WHERE id = '$id'";
        mysqli_query($koneksi, $query);
    }

    header("Location: pengeluaran.php?id_donasi=$id_donasi");
    exit;
}
?>
