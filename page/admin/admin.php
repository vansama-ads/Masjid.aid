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
    <link rel="stylesheet" href="../css/style-admin.css"> <!-- Hubungkan dengan file CSS -->
</head>
<body>

    <h2>Daftar Pengguna</h2>

    <table>
        <tr>
            <th>User ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
        <tr>
            <td><?php echo $result ['user_id']; ?></td>
            <td><?php echo $result['nama']; ?></td>
            <td><?php echo $result['username']; ?></td>
            <td><?php echo $result['email']; ?></td>
            <td><?php echo $result['no_hp']; ?></td>
            <td><?php echo $result['role']; ?></td>
            <td><a href="edit.php?edit=<?php echo $result['user_id']; ?>"type="button"> <img src="../img/assets/edit.png" alt="edit"></a>
                 <a href="proses.php?hapus=<?php echo $result['user_id']; ?>"type="button"  onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <img src="../img/assets/delete.png" alt="hapus"></a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
