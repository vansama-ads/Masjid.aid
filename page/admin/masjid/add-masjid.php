<?php
session_start();
include "../../login_user/koneksi.php";

$nama = "";
$alamat = "";
$kebutuhan = "";
$id_donasi = "";
$alamat_lengkap = "";
$hp = "";


// Cek apakah sedang edit data
if (isset($_GET['ubah'])) {
    $id_donasi = $_GET['ubah'];
    $query = "SELECT * FROM donasi_tujuan WHERE id_donasi = '$id_donasi'";
    $sql = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
        $nama = $result['nama'];
        $alamat = $result['alamat'];
        $alamat_lengkap = $result['alamat_lengkap'];
        $hp = $result['hp'];
        $kebutuhan = $result['kebutuhan'];
    }

}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donasi</title>
    <link rel="icon" type="image/x-icon" href="../../img/assets/favicon.ico">
    <link rel="stylesheet" href="../../css/admin/style-add.css">

</head>

<body>


    <form method="POST" action="proses-masjid.php" enctype="multipart/form-data">
        <table align="center">
            <tr>
                <td colspan="2" align="center">
                    <?php
                    if (isset($_GET['ubah'])) {
                        ?>
                        Edit Masjid
                        <?php
                    } else {
                        ?>
                        Tambah Masjid
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <input type="hidden" name="id" value="<?php echo isset($_GET['ubah']) ? $_GET['ubah'] : ''; ?>">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
            </tr>
            <tr>

                <td>Foto</td>
                <td><input type="file" name="foto" value="<?php echo $foto; ?>" accept="image/*"></td>
            </tr>
            <tr>
                <td>Alamat Singkat</td>
                <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
            </tr>
            <tr>
                <td>Alamat Lengkap</td>
                <td><input type="text" name="alamat_lengkap" value="<?php echo $alamat_lengkap; ?>"></td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td><input type="text" name="hp" value="<?php echo $hp; ?>"></td>
            </tr>

            <tr>
                <td>kebutuhan</td>
                <td><input type="text" name="kebutuhan" value="<?php echo $kebutuhan; ?>"></td>
            </tr>
            <tr>

                <td>
                    <?php
                    if (isset($_GET['ubah'])) {
                        ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary">

                            Simpan perubahan
                        </button>
                        <?php
                    } else {
                        ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary">

                            Tambahkan
                        </button>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <a href="admin-masjid.php" type="button" class="btn btn-danger">

                        Batal
                    </a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>