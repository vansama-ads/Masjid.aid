<?php
session_start();
include "../login_user/koneksi.php";


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu untuk mengakses halaman ini.');
        window.location.href = '../login_user/login.php';
    </script>";
    exit;
}


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result); // ambil satu baris data user
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style-profile.css">
    
</head>
<body>
<header>
        <div class="fcontainer">
            <nav class="wrapper">
                <div class="brand">
                    <img src="../img/assets/LOGO.png" alt="">
                    <h3>| Profile</h3>
                </div>
                
               
  



            </nav>
        </div>
    </header> 
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            
            <ul>
                <li><a href="#"  > User Info</a></li>
                <li><a href="#riwayat"> Riwayat</a></li>
                <li class="logout"><a href="../login_user/logout.php"> Log out</a></li>
            </ul>
        </aside>

        <!-- Konten -->
        <main id="user-info" class="content">
            <section  class="content-section">
                <div class="profile-header">
                <form action="upload_foto.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

                        <label for="foto_input">
                            <img 
                                src="../img/user/<?= htmlspecialchars( $user['foto'] ) ?>" 
                                alt="Foto Profil"
                                style=" cursor: pointer;"
                            >
                        </label>

                        <input 
                            type="file" 
                            name="foto" 
                            id="foto_input" 
                            accept="image/*" 
                            style="display: none;" 
                            onchange="this.form.submit()"
                        >
                    </form>

                    <div>
                        <h1>  <?= htmlspecialchars($user['nama']) ?> <i class="fas fa-edit"></i></h1>
                        <p><span>
                        <?= htmlspecialchars(implode(', ', array_slice(explode(',', $user['alamat']), 0, 2))) ?>
                        </span>
                        </p>
                    </div>
                </div>

                <div class="profile-details">
                    
                
    <div class="row">
        <div class="info">
            <label>Email</label>
            <div class="input-box">
                <span><?= htmlspecialchars($user['email']) ?>m</span>
            </div>
        </div>
        <div class="info">
            <label>No HP</label>
            <div class="input-box">
                <span><?= htmlspecialchars($user['no_hp']) ?></span>
            </div>
        </div>
    </div>

    <div class="info-full">
        <label>Alamat</label>
        <div class="input-box">
            <span><?= htmlspecialchars($user['alamat']) ?></span>
        </div>
    </div>


            </section>

            <section id="disimpan" class="content-section">
            <div class="profile-header">
                    <img src="avatar.jpg" alt="Profile Picture">
                    <div>
                        <h1>Wanderer <i class="fas fa-edit"></i></h1>
                        <p>Akademiya, Sumeru City</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="info">
                        <label>Email</label>
                        <div class="input-box">
                            <span>wawanhatguys@gmail.com</span>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="info">
                        <label>No HP</label>
                        <div class="input-box">
                            <span>+62 858-7633-5559</span>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="info-full">
                        <label>Alamat</label>
                        <div class="input-box">
                            <span>Akademiya, Sumeru City, Sumeru, Teyvat</span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="riwayat" class="content-section">
            <div class="profile-header">
                    <img src="avatar.jpg" alt="Profile Picture">
                    <div>
                        <h1>Wanderer <i class="fas fa-edit"></i></h1>
                        <p>Akademiya, Sumeru City</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="info">
                        <label>Email</label>
                        <div class="input-box">
                            <span>wawanhatguys@gmail.com</span>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="info">
                        <label>No HP</label>
                        <div class="input-box">
                            <span>+62 858-7633-5559</span>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="info-full">
                        <label>Alamat</label>
                        <div class="input-box">
                            <span>Akademiya, Sumeru City, Sumeru, Teyvat</span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="notifikasi" class="content-section">
            <div class="profile-header">
                    <img src="avatar.jpg" alt="Profile Picture">
                    <div>
                        <h1>Wanderer <i class="fas fa-edit"></i></h1>
                        <p>Akademiya, Sumeru City</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="info">
                        <label>Email</label>
                        <div class="input-box">
                            <span>wawanhatguys@gmail.com</span>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="info">
                        <label>No HP</label>
                        <div class="input-box">
                            <span>+62 858-7633-5559</span>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="info-full">
                        <label>Alamat</label>
                        <div class="input-box">
                            <span>Akademiya, Sumeru City, Sumeru, Teyvat</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
 
    <script src="script.js"></script>

</body>
</html>
