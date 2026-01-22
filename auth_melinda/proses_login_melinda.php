<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

$username_melinda = $_POST['username_melinda'];
$password_melinda = md5($_POST['password_melinda']);

$query_melinda = mysqli_query($koneksi_melinda, "
    SELECT 
        u.id_user_melinda,
        u.username_melinda,
        u.role_melinda,
        a.status_verifikasi
    FROM user_melinda u
    LEFT JOIN anggota_melinda a 
        ON u.id_user_melinda = a.id_user_melinda
    WHERE u.username_melinda='$username_melinda'
      AND u.password_melinda='$password_melinda'
");

if (mysqli_num_rows($query_melinda) > 0) {

    $data_melinda = mysqli_fetch_assoc($query_melinda);

    if ($data_melinda['role_melinda'] == 'user') {

        if ($data_melinda['status_verifikasi'] == 'pending') {
            echo "<script>alert('Akun belum diverifikasi admin');window.location='login_melinda.php';</script>";
            exit;
        }

        if ($data_melinda['status_verifikasi'] == 'nonaktif') {
            echo "<script>alert('Akun anda sedang dinonaktifkan sementara');window.location='login_melinda.php';</script>";
            exit;
        }

        if ($data_melinda['status_verifikasi'] == 'expired') {
            echo "<script>alert('Akun sudah tidak aktif');window.location='login_melinda.php';</script>";
            exit;
        }
    }

    $_SESSION['id_user_melinda'] = $data_melinda['id_user_melinda'];
    $_SESSION['username_melinda'] = $data_melinda['username_melinda'];
    $_SESSION['role_melinda'] = $data_melinda['role_melinda'];

    if ($data_melinda['role_melinda'] == 'admin') {
        header("location:../admin_melinda/dashboard_admin_melinda.php");
    } else {
        header("location:../user_melinda/dashboard_user_melinda.php");
    }

} else {
    echo "<script>alert('Username atau Password salah');window.location='login_melinda.php';</script>";
}
?>
