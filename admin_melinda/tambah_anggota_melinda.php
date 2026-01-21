<?php
include "../config_melinda/koneksi_melinda.php";

if (isset($_POST['simpan_melinda'])) {
    mysqli_query($koneksi_melinda, "INSERT INTO anggota_melinda VALUES (
        '',
        '$_POST[id_anggota_melinda]',
        '$_POST[nis_melinda]',
        '$_POST[nama_anggota_melinda]',
        '$_POST[kelas_melinda]',
        '$_POST[jurusan_melinda]'
    )");
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
    <h2>Tambah anggota</h2>
    <a href="tambah_anggota_melinda.php">+ Tambah Anggota</a>
    <br><br>
    <form action="">
        ID Anggota <br>
        <input type="text" name="id_anggota_melinda" required><br><br>

        NIS <br>
        <input type="text" name="nis_melinda" required><br><br>

        Nama Anggota <br>
        <input type="text" name="nama_anggota_melinda" required><br><br>

        Kelas <br>
        <input type="text" name="kelas_melinda" required><br><br>

        Jurusan <br>
        <input type="text" name="jurusan_melinda" required><br><br>

        <button type="submit" name="simpan_melinda">Simpan</button>
    </form>
</body>
</html>