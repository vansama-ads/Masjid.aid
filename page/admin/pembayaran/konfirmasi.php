<?php
session_start();
include "../../login_user/koneksi.php";

$query = "SELECT 
    p.id_transaksi,
    u.nama AS nama_user,
    d.nama AS nama_donasi,
    p.waktu_pembayaran,
    p.bukti_pembayaran,
    m.nama AS nama_metode,
    p.status
FROM pembayaran p
JOIN transaksi t ON p.id_transaksi = t.id_transaksi
JOIN user u ON t.user_id = u.user_id
JOIN donasi_tujuan d ON t.id_donasi = d.id_donasi
JOIN metode_pembayaran m ON t.id_metode = m.id_metode
ORDER BY waktu_pembayaran DESC;


";
$sql = mysqli_query($koneksi, $query);
$no = 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Donasi</title>
    <link rel="icon" type="image/x-icon" href="../../img/assets/favicon.ico">
    <link rel="stylesheet" href="../../css/admin/style-admin.css"> <!-- Hubungkan dengan file CSS -->
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

            <li><a href="../admin.php"> User Info</a></li>
            <li><a href="../masjid/admin-masjid.php">Donation List</a></li>
            <li><a href="konfirmasi.php">Confirm Payment</a></li>
            <li><a href="metode.php">Payment Method List</a></li>
            <li><a href="../../info.php">Kembali</a></li>
            <li><a href="../../login_user/logout.php"> Log out</a></li>

        </ul>
    </aside>
    <div class="container">
        <!-- Sidebar -->

        <main class="content">
            <h2>Confirm Donasi</h2>

            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama User</th>
                    <th>Nama Donasi</th>
                    <th>Waktu Donasi</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                        <td><?= $result['id_transaksi']; ?></td>
                        <td><?= htmlspecialchars($result['nama_user']); ?></td>
                        <td><?= htmlspecialchars($result['nama_donasi']); ?></td>
                        <td><?= htmlspecialchars($result['waktu_pembayaran']); ?></td>
                        <td><?= htmlspecialchars($result['nama_metode']); ?></td>
                        <td><img src="../../img/bukti_pembayaran/<?php echo $result['bukti_pembayaran']; ?>"
                                style="width: 200px;"></td>
                        <td>
                            <?php
                            $status = $result['status'];
                            if ($status === 'sukses') {
                                echo "<span style='color: green;'>Sukses</span>";
                            } elseif ($status === 'pending') {
                                echo "<span style='color: orange;'>Pending</span>";
                            } else {
                                echo "<span style='color: red;'>Gagal</span>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($status === 'pending'): ?>
                                <form action="konfirmasi_pembayaran.php" method="POST"
                                    onsubmit="return confirm('Yakin ingin konfirmasi pembayaran ini?');">
                                    <input type="hidden" name="id_transaksi" value="<?= $result['id_transaksi']; ?>">
                                    <button type="submit" name="konfirmasi">Konfirmasi</button>
                                </form>
                            <?php else: ?>
                            
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>


        </main>


</body>

</html>