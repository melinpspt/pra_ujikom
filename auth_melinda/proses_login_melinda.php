<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

$username_melinda = $_POST['username_melinda'];
$password_melinda = md5($_POST['password_melinda']);

$query_melinda = mysqli_query(
    $koneksi_melinda,
    "SELECT * FROM user_melinda 
     WHERE username_melinda='$username_melinda' 
     AND password_melinda='$password_melinda'"
);

$data_melinda = mysqli_fetch_assoc($query_melinda);
$cek_melinda = mysqli_num_rows($query_melinda);

if ($cek_melinda > 0) {
    $_SESSION['id_user_melinda'] = $data_melinda['id_user_melinda'];
    $_SESSION['username_melinda'] = $data_melinda['username_melinda'];
    $_SESSION['role_melinda'] = $data_melinda['role_melinda'];

    if ($data_melinda['role_melinda'] == 'admin') {
        header("location:../admin_melinda/dashboard_admin_melinda.php");
    } else {
        header("location:../user_melinda/dashboard_user_melinda.php");
    }

} else {
    echo "<script>
        alert('Username atau Password salah');
        window.location='login_melinda.php';
    </script>";
}
?>