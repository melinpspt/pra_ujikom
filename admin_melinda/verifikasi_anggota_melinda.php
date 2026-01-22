<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

$id_anggota = $_GET['id_anggota'];

mysqli_query($koneksi_melinda, "
    UPDATE anggota_melinda 
    SET status_verifikasi='aktif'
    WHERE id_anggota_melinda='$id_anggota'
");

echo "<script>
    alert('Anggota berhasil diverifikasi');
    window.location='data_anggota_melinda.php';
</script>";
?>
