<?php
session_start();
include "../login_user/koneksi.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu.');
        window.location.href = '../login_user/login.php';
    </script>";
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($koneksi, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "User tidak ditemukan.";
    exit;
}
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    if (empty($nama) || empty($email)) {
        $error = "Nama dan Email wajib diisi.";
    } else {
        $update_query = "UPDATE user SET 
            nama = '$nama', 
            email = '$email', 
            no_hp = '$no_hp', 
            alamat = '$alamat' 
            WHERE user_id = '$user_id'";

        if (mysqli_query($koneksi, $update_query)) {
            header("Location: profile.php");
            exit;
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Edit Profile</title>
    <link rel="icon" type="image/x-icon" href="../img/assets/favicon.ico">
    <link rel="stylesheet" href="../css/admin/style-add.css">
</head>

<body>


    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <h2>Edit Profile</h2>
        <label for="nama">Nama:</label><br />
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required><br /><br />

        <label for="email">Email:</label><br />
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
            required><br /><br />

        <label for="no_hp">No HP:</label><br />
        <input type="text" id="no_hp" name="no_hp" value="<?= htmlspecialchars($user['no_hp']) ?>"><br /><br />

        <label for="alamat">Alamat:</label><br />
        <textarea id="alamat" name="alamat" rows="3"><?= htmlspecialchars($user['alamat']) ?></textarea><br /><br />

        <button type="submit">Simpan Perubahan</button>
        <a href="profile.php" class="btn btn-danger">Batal</a>
    </form>
</body>

</html>