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
    UPDATE anggota_melinda
    SET status_verifikasi='$status'
    WHERE id_anggota_melinda='$id'
") or die(mysqli_error($koneksi_melinda));

echo "<script>
    alert('Status anggota berhasil diubah');
    window.location='data_anggota_melinda.php';
</script>";
?>
