<?php
session_start();
include "../../login_user/koneksi.php";

// Variabel default
$tanggal = "";
$jumlah = "";
$keperluan = "";
$keterangan = "";
$id_pengeluaran = "";
$id_donasi = isset($_GET['id_donasi']) ? $_GET['id_donasi'] : "";

// Mode edit
if (isset($_GET['ubah'])) {
    $id_pengeluaran = $_GET['ubah'];
    $query = "SELECT * FROM pengeluaran WHERE id = '$id_pengeluaran'";
    $sql = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
        $tanggal = $result['tanggal'];
        $jumlah = $result['jumlah'];
        $keperluan = $result['keperluan'];
        $keterangan = $result['keterangan'];
        $id_donasi = $result['id_donasi'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($_GET['ubah']) ? "Edit" : "Tambah"; ?> Pengeluaran</title>
    <link rel="stylesheet" href="../../css/admin/style-add.css">
</head>
<body>

    <form method="POST" action="proses_pengeluaran.php">
        <table align="center">
            <tr>
                <td colspan="2" align="center">
                    <h2><?php echo isset($_GET['ubah']) ? "Edit" : "Tambah"; ?> Pengeluaran</h2>
                </td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $id_pengeluaran; ?>">
            <input type="hidden" name="id_donasi" value="<?php echo $id_donasi; ?>">

            <tr>
                <td>Tanggal</td>
                <td><input type="date" name="tanggal" value="<?php echo $tanggal; ?>" required></td>
            </tr>
            <tr>
                <td>Jumlah (Rp)</td>
                <td><input type="number" name="jumlah" value="<?php echo $jumlah; ?>" required></td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td><input type="text" name="keperluan" value="<?php echo $keperluan; ?>" required></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td><input type="text" name="keterangan" value="<?php echo $keterangan; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <?php if (isset($_GET['ubah'])) { ?>
                        <button type="submit" name="aksi" value="edit">Simpan Perubahan</button>
                    <?php } else { ?>
                        <button type="submit" name="aksi" value="tambah">Tambahkan</button>
                    <?php } ?>
                    <a href="pengeluaran.php?id_donasi=<?php echo $id_donasi; ?>" class="btn btn-danger">Batal</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>
