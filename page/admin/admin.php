<?php
session_start();
include "../login_user/koneksi.php";

$query = "SELECT * FROM user";
$sql = mysqli_query($koneksi, $query);
$no = 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link rel="icon" type="image/x-icon" href="../img/assets/favicon.ico">
    <link rel="stylesheet" href="../css/admin/style-admin.css"> <!-- Hubungkan dengan file CSS -->
</head>

<body>
    <header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../img/assets/LOGO.png" alt="">
                </div>





            </nav>
        </div>
    </header>


    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">

            <ul>
                <li><a href="admin.php"> User Info</a></li>
                <li><a href="masjid/admin-masjid.php">Donation List</a></li>
                <li><a href="pembayaran/konfirmasi.php">Confirm Payment</a></li>
                <li><a href="pembayaran/metode.php">Payment Method List</a></li>
                <li><a href="../info.php">Kembali</a></li>
                <li><a href="../login_user/logout.php"> Log out</a></li>
            </ul>
        </aside>


        <main class="content">
            <table>
                <h2>Daftar Pengguna</h2>
                <tr>
                    <th>User ID</th>
                    <th>Foto Profile</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Role</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                        <td><?php echo $result['user_id']; ?></td>
                        <td><img src="../img/user/<?php echo $result['foto']; ?>" style="width: 100px;"></td>
                        <td><?php echo $result['nama']; ?></td>
                        <td><?php echo $result['username']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $result['no_hp']; ?></td>

                        <td><?php echo $result['role']; ?></td>
                        <td><?php echo $result['alamat']; ?></td>
                        <td><a href="edit.php?edit=<?php echo $result['user_id']; ?>" type="button"> <img
                                    src="../img/assets/edit.png" alt="edit"></a>
                            <a href="proses.php?hapus=<?php echo $result['user_id']; ?>" type="button"
                                onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <img src="../img/assets/delete.png" alt="hapus"></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </main>

</body>

</html>