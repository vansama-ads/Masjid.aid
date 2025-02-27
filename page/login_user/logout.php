<?php
session_start();
session_destroy(); // Hapus semua session
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script>
        alert("Selamat, Anda telah logout!");
        window.location.href = "../homepage.php"; 
    </script>
</head>
<body>
</body>
</html>
