<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

if (isset($_POST['simpan_melinda'])) {

    $username_melinda = $_POST['username_melinda'];
    $password_melinda = md5($_POST['password_melinda']);
    $role_melinda     = 'user';

    $nis_melinda          = $_POST['nis_melinda'];
    $nama_anggota_melinda = $_POST['nama_anggota_melinda'];
    $kelas_melinda        = $_POST['kelas_melinda'];
    $jurusan_melinda      = $_POST['jurusan_melinda'];
    $status_verifikasi    = $_POST['status_verifikasi']; 
    // cek username
    $cek_melinda = mysqli_query($koneksi_melinda, "
        SELECT * FROM user_melinda 
        WHERE username_melinda='$username_melinda'
    ");

    if (mysqli_num_rows($cek_melinda) > 0) {
        echo "<script>
            alert('Username sudah digunakan');
            window.location='tambah_user_melinda.php';
        </script>";
        exit;
    }

    // simpan ke user
    mysqli_query($koneksi_melinda, "
        INSERT INTO user_melinda
        (username_melinda, password_melinda, role_melinda)
        VALUES
        ('$username_melinda', '$password_melinda', '$role_melinda')
    ");

    $id_user_melinda = mysqli_insert_id($koneksi_melinda);

    // simpan ke anggota (LANGSUNG AKTIF)
    mysqli_query($koneksi_melinda, "
        INSERT INTO anggota_melinda
        (id_user_melinda, nis_melinda, nama_anggota_melinda, kelas_melinda, jurusan_melinda, status_verifikasi)
        VALUES
        (
            '$id_user_melinda',
            '$nis_melinda',
            '$nama_anggota_melinda',
            '$kelas_melinda',
            '$jurusan_melinda',
            '$status_verifikasi'
        )
    ");

    echo "<script>
        alert('Data siswa berhasil ditambahkan');
        window.location='data_anggota_melinda.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>
<body>

<h2>Tambah User (Admin)</h2>

<form method="POST">
    Username <br>
    <input type="text" name="username_melinda" required><br><br>

    Password <br>
    <input type="password" name="password_melinda" required><br><br>

    NIS <br>
    <input type="text" name="nis_melinda" required><br><br>

    Nama Anggota <br>
    <input type="text" name="nama_anggota_melinda" required><br><br>

    Kelas <br>
    <input type="text" name="kelas_melinda" required><br><br>

    Jurusan <br>
    <input type="text" name="jurusan_melinda" required><br><br>

    Status Akun <br>
    <input type="text" name="status_verifikasi" value="aktif" readonly>
    <br><br>

    <button type="submit" name="simpan_melinda">Simpan</button>
</form>

<br>
<a href="data_anggota_melinda.php">Kembali</a>

</body>
</html>
