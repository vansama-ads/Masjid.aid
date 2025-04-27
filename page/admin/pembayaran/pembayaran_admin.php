<?php
session_start();
include '../../login_user/koneksi.php';

// Ambil daftar semua pembayaran
$query = "SELECT p.id_pembayaran, p.id_transaksi, u.nama AS nama_user, d.nama, p.status, m.nama, p.waktu_pembayaran
          FROM pembayaran p
          JOIN transaksi t ON p.id_transaksi = t.id_transaksi
          JOIN user u ON t.user_id = u.user_id
          JOIN donasi_tujuan d ON t.id_donasi = d.id_donasi
          JOIN metode_pembayaran m ON p.id_metode = m.id_metode";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Konfirmasi Pembayaran</title>
</head>
<body>
    <h2>Daftar Pembayaran</h2>
    <table border="1">
        <tr>
            <th>ID Pembayaran</th>
            <th>Nama User</th>
            <th>Donasi</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
            <th>Waktu Pembayaran</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id_pembayaran'] ?></td>
                <td><?= $row['nama_user'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['waktu_pembayaran'] ?: '-' ?></td>
                <td>
                    <?php if ($row['status'] == 'pending') { ?>
                        <form action="konfirmasi_pembayaran.php" method="POST">
                            <input type="hidden" name="id_pembayaran" value="<?= $row['id_pembayaran'] ?>">
                            <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">
                            <button type="submit">Konfirmasi</button>
                        </form>
                    <?php } else { ?>
                        <span>-</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
