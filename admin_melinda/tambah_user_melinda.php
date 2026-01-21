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
    $role_melinda     = $_POST['role_melinda'];

    // cek username 
    $cek_melinda = mysqli_query(
        $koneksi_melinda,
        "SELECT * FROM user_melinda 
         WHERE username_melinda='$username_melinda'"
    );

    if (mysqli_num_rows($cek_melinda) > 0) {
        echo "<script>
            alert('Username sudah digunakan');
            window.location='tambah_user_melinda.php';
        </script>";
        exit;
    }

    // simpan user
    mysqli_query($koneksi_melinda, "
        INSERT INTO user_melinda
        (username_melinda, password_melinda)
        VALUES
        ('$username_melinda', '$password_melinda')
    ");

    mysqli_query($koneksi_melinda, "
        INSERT INTO anggota_melinda
        (nis_melinda, nama_anggota_melinda, kelas_melinda, jurusan_melinda)
        VALUES
        ('$nis_melinda', '$nama_anggota_melinda', '$kelas_melinda', '$jurusan_melinda')
    ");

    echo "<script>
        alert('User berhasil ditambahkan');
        window.location='data_user_melinda.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>

<h2>Tambah User</h2>

<form method="POST">
    Username <br>
    <input type="text" name="username_melinda" required><br><br>

    Password <br>
    <input type="password" name="password_melinda" required><br><br>

    nis <br>
    <input type="text" name="nis_melinda"><br><br>

    Nama Anggota <br>
    <input type="text" name="nama_anggota_melinda"><br><br>

    Kelas <br>
    <input type="text" name="kelas_melinda"><br><br>

    Jurusan <br>
    <input type="text" name="jurusan_melinda"><br><br>

    <button type="submit" name="simpan_melinda">Simpan</button>
</form>

<br>
<a href="data_anggota_melinda.php">Kembali</a>

</body>
</html>