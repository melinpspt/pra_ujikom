<?php
include "../config_melinda/koneksi_melinda.php";

$username_melinda = $_POST['username_melinda'];
$password_melinda = md5($_POST['password_melinda']);
$nis_melinda      = $_POST['nis_melinda'];
$nama_melinda     = $_POST['nama_lengkap_melinda'];
$kelas_melinda    = $_POST['kelas_melinda'];
$jurusan_melinda  = $_POST['jurusan_melinda'];
$role_melinda     = "user";

// cek username
$cek_melinda = mysqli_query($koneksi_melinda,
    "SELECT * FROM user_melinda WHERE username_melinda='$username_melinda'"
);

if (mysqli_num_rows($cek_melinda) > 0) {
    echo "<script>alert('Username sudah digunakan');window.location='register_melinda.php';</script>";
    exit;
}

mysqli_query($koneksi_melinda,
    "INSERT INTO user_melinda
    (username_melinda,password_melinda,role_melinda)
    VALUES
    ('$username_melinda','$password_melinda','$role_melinda')"
);


$id_user_melinda = mysqli_insert_id($koneksi_melinda);


mysqli_query($koneksi_melinda,
    "INSERT INTO anggota_melinda
    (nis_melinda,nama_anggota_melinda,kelas_melinda,jurusan_melinda,id_user_melinda,status_verifikasi)
    VALUES
    ('$nis_melinda','$nama_melinda','$kelas_melinda','$jurusan_melinda','$id_user_melinda','pending')"
);


echo "<script>
    alert('Registrasi berhasil, silakan login');
    window.location='login_melinda.php';
</script>";
?>
