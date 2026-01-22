<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

$id     = $_GET['id'];
$status = $_GET['status'];

mysqli_query($koneksi_melinda, "
    UPDATE buku_melinda 
    SET status_buku_melinda='$status'
    WHERE id_buku_melinda='$id'
");

echo "<script>
    alert('Status buku berhasil diubah');
    window.location='data_buku_melinda.php';
</script>";
?>
