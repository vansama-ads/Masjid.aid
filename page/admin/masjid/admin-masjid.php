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
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../../img/assets/LOGO.png" alt="">
                </div>
               
  



            </nav>
        </div>
    </header> 

    <aside class="sidebar">
            
            <ul>
                <li><a href="../admin.php"   ><i class="fas fa-user"></i> User Info</a></li>
                <li><a href="masjid/admin-masjid.php"><i class="fas fa-bookmark"></i> Donation List</a></li>
                <li><a href="../pembayaran/konfirmasi.php"><i class="fas fa-history"></i>Confirm Payment</a></li>
                <li><a href="#notifikasi"><i class="fas fa-bell"></i> Notifikasi</a></li>
                <li class="logout"><a href="#"><i class="fas fa-sign-out-alt"></i> Log out</a></li>
            </ul>
        </aside>
 <div class="container">
        <!-- Sidebar -->

        <main class="content">
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
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
        <tr>
            <td><?php echo $result ['id_donasi']; ?></td>
            <td><?php echo $result['nama']; ?></td>
            <td> <img src="../../img/<?php echo $result['foto']; ?>" style="width: 200px;"></td>
            <td><?php echo $result['alamat']; ?></td>
            <td><?php echo $result['deskripsi']; ?></td>
            <td><?php echo $result['jumlah']; ?></td>
            <td><a href="add-masjid.php?ubah=<?php echo $result['id_donasi']; ?>" type="button">
                     <img src="../../img/assets/edit.png" alt="edit">
              </a>

                 <a href="proses-masjid.php?hapus=<?php echo $result['id_donasi']; ?>"type="button"  onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <img src="../../img/assets/delete.png" alt="hapus"></a></td>
        </tr>
        <?php } ?>
    </table>
        </main>
       
    
</body>
</html>