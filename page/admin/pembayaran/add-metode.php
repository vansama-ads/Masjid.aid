<?php
session_start();
include "../../login_user/koneksi.php";

$nama = "";
$kategori = "";
$rekening = "";



// Cek apakah sedang edit data
if (isset($_GET['ubah'])) {
    $id_donasi = $_GET['ubah'];
    $query = "SELECT * FROM metode_pembayaran WHERE id_metode = '$id_donasi'";
    $sql = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
    $nama = $result['nama'];
    $kategori = $result['kategori'];
     $rekening = $result['rekening'];

}

}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Metode</title>
    <link rel="stylesheet" href="../../css/admin/style-add.css">
</head>
<body>


    <form  method="POST" action="proses-metode.php" enctype="multipart/form-data">
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
                
                <td>Kategori</td>
                    <td>
                        <select name="kategori">
                            <option value="QRIS" <?php if($kategori == "qris") echo "selected"; ?>>QRIS</option>
                            <option value="Bank" <?php if($kategori == "bank") echo "selected"; ?>>Bank</option>
                        </select>
                    </td>

            </tr>
            <tr>
                <td>No. Rekening</td>
                <td><input type="text" name="rekening" value="<?php echo $rekening; ?>"></td>
            </tr>


        
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
                    <a href="metode.php" type="button" class="btn btn-danger">
                        
                        Batal
                    </a>
                    </td>
                    </tr>
                    </table>
    </form>
</body>
</html>