<?php
   session_start();
   include "../../login_user/koneksi.php";

   $query = "SELECT * FROM donasi_tujuan";
$sql = mysqli_query($koneksi, $query);
$no = 0;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Donasi</title>
    <link rel="stylesheet" href="../../css/style-admin.css"> <!-- Hubungkan dengan file CSS -->
</head>
<body>

    <h2>Daftar Donasi</h2>
    <a href="add-masjid.php" type="button">
        Tambah Data</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Foto</th>
            <th>alamat</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
        <tr>
            <td><?php echo $result ['id_donasi']; ?></td>
            <td><?php echo $result['nama']; ?></td>
            <td><?php echo $result['foto']; ?></td>
            <td><?php echo $result['alamat']; ?></td>
            <td><?php echo $result['deskripsi']; ?></td>
            <td><a href="add-masjid.php?ubah=<?php echo $result['id_donasi']; ?>" type="button">
                     <img src="../../img/assets/edit.png" alt="edit">
              </a>

                 <a href="proses-masjid.php?hapus=<?php echo $result['id_donasi']; ?>"type="button"  onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <img src="../../img/assets/delete.png" alt="hapus"></a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>