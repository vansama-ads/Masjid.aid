<?php
session_start();
include "../../login_user/koneksi.php";

$nama = "";
$alamat = "";
$deskripsi = "";
$id_donasi = "";

// Cek apakah sedang edit data
if (isset($_GET['ubah'])) {
    $id_donasi = $_GET['ubah'];
    $query = "SELECT * FROM donasi_tujuan WHERE id_donasi = '$id_donasi'";
    $sql = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
        $nama = $result['nama'];
        $alamat = $result['alamat'];
        $deskripsi = $result['deskripsi'];
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donasi</title>
</head>
<body>


    <form  method="POST" action="proses-masjid.php" enctype="multipart/form-data">
    <table align="center">
            <tr>  
                <td colspan="2" align="center" >
                <?php
                       if(isset($_GET['ubah'])){
                    ?>
                   Edit
                    <?php
                         } else {
                    ?> 
                        Tambah
                    <?php
                         }
                    ?> 
                </td>
            </tr>
            <input type="hidden" name="id" value="<?php echo isset($_GET['ubah']) ? $_GET['ubah'] : ''; ?>">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
            </tr>
            <tr>
                
                <td>Foto</td>
                <td><input type="file"  name="foto" value="<?php echo $foto; ?>" accept="image/*"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsi"  value="<?php echo $deskripsi; ?>"></td>
            </tr>
           <tr>
        
     <td> 
    <?php
                       if(isset($_GET['ubah'])){
                    ?>
                    <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                        
                        Simpan perubahan
                    </button>
                    <?php
                         } else {
                    ?> 
                         <button   type="submit" name="aksi" value="add" class="btn btn-primary">
                        
                        Tambahkan
                      </button>
                    <?php
                         }
                    ?> 
                    </td> 
                    <td>    
                    <a href="admin-masjid.php" type="button" class="btn btn-danger">
                        
                        Batal
                    </a>
                    </td>
                    </tr>
                    </table>
    </form>
</body>
</html>