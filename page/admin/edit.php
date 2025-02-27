<?php
session_start();
include "../login_user/koneksi.php";

if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    $query = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <link rel="stylesheet" href="../css/style-edit.css">
</head>
<body>
    <h2>Edit Role Pengguna</h2>
    <form action="proses.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>user</option>
        </select>
        <button type="submit" name="update_role">Update</button>
    </form>
</body>
</html>