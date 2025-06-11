<?php
session_start();
include "../../login_user/koneksi.php";

if (!isset($_GET['id_donasi'])) {
    echo "ID Donasi tidak ditemukan!";
    exit;
}

$id_donasi = $_GET['id_donasi'];

// Ambil nama masjid
$queryMasjid = "SELECT nama FROM donasi_tujuan WHERE id_donasi = $id_donasi";
$resultMasjid = mysqli_query($koneksi, $queryMasjid);
$masjid = mysqli_fetch_assoc($resultMasjid);

// Ambil data pengeluaran
$query = "SELECT * FROM pengeluaran WHERE id_donasi = $id_donasi ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengeluaran Masjid</title>
    <link rel="stylesheet" href="../../css/admin/style-admin.css">
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
           <button onclick="window.history.back()" class="back-btn">
                    > Kembali
                </button>
        </ul>
    </aside>
    <div class="container">
        <main class="content">
            <h2>Pengeluaran - <?php echo $masjid['nama']; ?></h2>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="add-pengeluaran.php?id_donasi=<?php echo $id_donasi; ?>">Tambah Pengeluaran</a>
            <?php endif; ?>

            <table>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keperluan</th>
                    <th>Keterangan</th>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <th>Aksi</th>
                     <?php endif; ?>
                </tr>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td>Rp<?php echo number_format($row['jumlah'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['keperluan']; ?></td>
                        <td><?php echo $row['keterangan']; ?></td>
                        <td>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>

                                <a
                                    href="add-pengeluaran.php?ubah=<?php echo $row['id']; ?>&id_donasi=<?php echo $id_donasi; ?>">Edit</a>
                            <?php endif; ?>


                        </td>
                    </tr>
                <?php } ?>
            </table>
        </main>
    </div>
</body>

</html>