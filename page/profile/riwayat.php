<?php
session_start();
include "../login_user/koneksi.php";


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu untuk mengakses halaman ini.');
        window.location.href = '../login_user/login.php';
    </script>";
    exit;
}


$user_id = $_SESSION['user_id'];
$query = "SELECT 
            t.waktu,
            t.jumlah,
            t.status,
            d.nama
        FROM 
            transaksi AS t
        JOIN 
            donasi_tujuan AS d ON t.id_donasi = d.id_donasi
        WHERE 
            t.user_id = '$user_id';
        ";
$sql = mysqli_query($koneksi, $query);

?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style-profile.css">
    
</head>
<body>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../img/assets/LOGO.png" alt="">
                    <h3 style="color:white;">| Riwayat</h3>
                </div>
                
               
  



            </nav>
        </div>
    </header> 
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            
            <ul>
                <li><a href="profile.php"  > User Info</a></li>
                <li><a href="#riwayat"> Riwayat</a></li>
                <li><a href="../info.php">< Kembali</a></li>
                <li class="logout"><a href="../login_user/logout.php"> Log out</a></li>
            </ul>
        </aside>

        <!-- Konten -->
        <main id="user-info" class="content">
            <section  class="content-section">
               <table>
    <h2>Riwayat</h2>
        <tr>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Waktu</th>
            <th>Status</th>
           
        </tr>
        <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
        <tr>
            <td><?php echo $result ['nama']; ?></td>
            <td><?php echo $result['jumlah']; ?></td>
            <td><?php echo $result['waktu']; ?></td>
            <td><?php echo $result['status']; ?></td>

            
           
        </tr>
        <?php } ?>
    </table>

            </section>

           
            

            
        </main>
    </div>
 
    

</body>
</html>
