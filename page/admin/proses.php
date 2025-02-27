<?php
include "../login_user/koneksi.php";
if (isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    // Debugging: Cek apakah data terkirim
    if (empty($user_id) || empty($role)) {
        die("User ID atau Role tidak boleh kosong!");
    }

    // Query update role
    $query = "UPDATE user SET role = '$role' WHERE user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);

    // Debugging: Cek apakah query berhasil
    if ($result) {
        echo "<script>alert('Role berhasil diperbarui!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui role!'); window.history.back();</script>";
    }
}


if(isset($_GET['hapus'])){
    $user_id= $_GET['hapus'];
    $query = "DELETE FROM user WHERE user_id = '$user_id'";
    $sql = mysqli_query($koneksi, $query);

    if($sql){
      header("location: admin.php");
     // echo "berhasil ditambahkan <a href='index.php'>[Home]</a> ";
    } else {
      echo "query";
    }
    //echo "Hapus Data <a href='index.php'>[Home]</a> ";
  } 



?>