<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

$id_anggota_melinda = $_GET['id_anggota'];
$id_user_melinda    = $_GET['id_user'];

// Hapus data peminjaman terkait anggota
mysqli_query($koneksi_melinda, "
    DELETE FROM peminjaman_melinda
    WHERE id_anggota_melinda='$id_anggota_melinda'
");

// Hapus anggota
mysqli_query($koneksi_melinda, "
    DELETE FROM anggota_melinda
    WHERE id_anggota_melinda='$id_anggota_melinda'
");

// Hapus user
mysqli_query($koneksi_melinda, "
    DELETE FROM user_melinda
    WHERE id_user_melinda='$id_user_melinda'
");

echo "<script>
    alert('Data anggota dan user berhasil dihapus');
    window.location='data_anggota_melinda.php';
</script>";
?>
