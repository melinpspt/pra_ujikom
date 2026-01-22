<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

$id = $_GET['id'];
$tanggal_hari_ini = date('Y-m-d');

mysqli_query($koneksi_melinda, "
    UPDATE peminjaman_melinda
    SET 
        status_melinda='dibatalkan',
        tanggal_kembali_melinda='$tanggal_hari_ini'
    WHERE id_peminjaman_melinda='$id'
");

echo "<script>
    alert('Transaksi berhasil dibatalkan');
    window.location='data_peminjaman_melinda.php';
</script>";
?>
