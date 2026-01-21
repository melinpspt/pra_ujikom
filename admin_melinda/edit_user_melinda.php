<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

$id_anggota = $_GET['id_anggota'];
$id_user = $_GET['id_user'];

// ambil data anggota + user 
$data = mysqli_fetch_assoc(mysqli_query(
    $koneksi_melinda,
    "SELECT 
        a.nis_melinda,
        a.nama_anggota_melinda,
        a.kelas_melinda,
        a.jurusan_melinda,
        u.username_melinda,
        u.role_melinda
     FROM anggota_melinda a
     JOIN user_melinda u
        ON a.id_user_melinda = u.id_user_melinda
     WHERE a.id_anggota_melinda='$id_anggota'
       AND u.id_user_melinda='$id_user'"
));

if (isset($_POST['update_melinda'])) {

    // update anggota
    mysqli_query($koneksi_melinda, "
        UPDATE anggota_melinda SET
            nis_melinda='$_POST[nis_melinda]',
            nama_anggota_melinda='$_POST[nama_anggota_melinda]',
            kelas_melinda='$_POST[kelas_melinda]',
            jurusan_melinda='$_POST[jurusan_melinda]'
        WHERE id_anggota_melinda='$id_anggota'
    ");

    // update user (username & role)
    mysqli_query($koneksi_melinda, "
        UPDATE user_melinda SET
            username_melinda='$_POST[username_melinda]',
            role_melinda='$_POST[role_melinda]'
        WHERE id_user_melinda='$id_user'
    ");

    // reset password 
    if (!empty($_POST['password_baru_melinda'])) {
        $password = md5($_POST['password_baru_melinda']);
        mysqli_query($koneksi_melinda, "
            UPDATE user_melinda
            SET password_melinda='$password'
            WHERE id_user_melinda='$id_user'
        ");
    }

    echo "<script>
        alert('Data berhasil diperbarui');
        window.location='data_anggota_melinda.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Anggota</title>
    <script>
        function togglePassword() {
            document.getElementById("reset_password").style.display = "block";
        }
    </script>
</head>

<body>

    <h2>Edit Anggota</h2>

    <form method="POST">
        NIS <br>
        <input type="text" name="nis_melinda" value="<?= $data['nis_melinda']; ?>" required><br><br>

        Username <br>
        <input type="text" name="username_melinda" value="<?= $data['username_melinda']; ?>" required><br><br>

        Nama Anggota <br>
        <input type="text" name="nama_anggota_melinda" value="<?= $data['nama_anggota_melinda']; ?>" required><br><br>

        Kelas <br>
        <input type="text" name="kelas_melinda" value="<?= $data['kelas_melinda']; ?>" required><br><br>

        Jurusan <br>
        <input type="text" name="jurusan_melinda" value="<?= $data['jurusan_melinda']; ?>" required><br><br>

        Role <br>
        <select name="role_melinda">
            <option value="user" <?= $data['role_melinda'] == 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $data['role_melinda'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select><br><br>

        <button type="button" onclick="togglePassword()">Reset Password</button>

        <div id="reset_password" style="display:none; margin-top:10px;">
            Password Baru <br>
            <input type="password" name="password_baru_melinda">
        </div>

        <br><br>
        <button type="submit" name="update_melinda">Update</button>

    </form>

    <br>
    <a href="data_anggota_melinda.php">Kembali</a>

</body>

</html>