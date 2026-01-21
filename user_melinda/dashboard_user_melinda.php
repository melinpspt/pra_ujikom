<?php
session_start();
if ($_SESSION['role_melinda'] != 'user') {
    header("location:../auth_melinda/login_melinda.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
</head>
<body>

<h2>Dashboard Siswa</h2>
<p>Selamat datang, <b><?= $_SESSION['username_melinda']; ?></b></p>

<ul>
    <li><a href="pinjam_buku_melinda.php">Pinjam Buku</a></li>
    <li><a href="pengembalian_buku_melinda.php">Pengembalian Buku</a></li>
    <li><a href="../auth_melinda/logout_melinda.php">Logout</a></li>
</ul>

</body>
</html>
