<?php
// konfigurasi database
$host_melinda     = "localhost";
$user_melinda     = "root";
$pass_melinda     = "";
$db_melinda       = "perpustakaan_melinda";

// membuat koneksi
$koneksi_melinda = mysqli_connect(
    $host_melinda,
    $user_melinda,
    $pass_melinda,
    $db_melinda
);

// cek koneksi
if (!$koneksi_melinda) {
    die("Koneksi database gagal : " . mysqli_connect_error());
}
?>
