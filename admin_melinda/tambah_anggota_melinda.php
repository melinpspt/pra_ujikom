<?php
include "../config_melinda/koneksi_melinda.php";

if (isset($_POST['simpan_melinda'])) {

    mysqli_query($koneksi_melinda, "
        INSERT INTO anggota_melinda
        (nis_melinda, nama_anggota_melinda, kelas_melinda, jurusan_melinda, id_user_melinda)
        VALUES
        (
            '$_POST[nis_melinda]',
            '$_POST[nama_anggota_melinda]',
            '$_POST[kelas_melinda]',
            '$_POST[jurusan_melinda]',
            '$_POST[id_user_melinda]'
        )
    ");

    header("location:data_anggota_melinda.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Anggota</h2>
    <form method="POST">
    NIS <br>
    <input type="text" name="nis_melinda" required><br><br>

    Nama Anggota <br>
    <input type="text" name="nama_anggota_melinda" required><br><br>

    Kelas <br>
    <input type="text" name="kelas_melinda" required><br><br>

    Jurusan <br>
    <input type="text" name="jurusan_melinda" required><br><br>

    Username Login <br>
    <select name="id_user_melinda" required>
        <option value="">-- Pilih User --</option>
        <?php
        $user = mysqli_query($koneksi_melinda,
            "SELECT id_user_melinda, username_melinda 
             FROM user_melinda 
             WHERE role_melinda='user'"
        );
        while ($u = mysqli_fetch_assoc($user)) {
            echo "<option value='{$u['id_user_melinda']}'>
                    {$u['username_melinda']}
                  </option>";
        }
        ?>
    </select>
    <br><br>

    <button type="submit" name="simpan_melinda">Simpan</button>
</form>
</body>
</html>