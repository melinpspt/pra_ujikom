<?php
session_start();
if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <b><?= $_SESSION['username_melinda']; ?></b></p>

<ul>
    <li><a href="data_buku_melinda.php">Data Buku</a></li>
    <li><a href="data_anggota_melinda.php">Data Anggota</a></li>
    <li><a href="data_peminjaman_melinda.php">Data Peminjaman</a></li>
    <li><a href="../auth_melinda/logout_melinda.php">Logout</a></li>
</ul>

</body>
</html>
