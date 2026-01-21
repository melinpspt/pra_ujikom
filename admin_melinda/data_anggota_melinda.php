<?php
include "../config_melinda/koneksi_melinda.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>  
    <h2>Data Anggota</h2>

    <a href="tambah_anggota_melinda.php">+ Tambah Anggota</a>
    <br><br>

    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
        </tr>

        <?php
        $no_melinda = 1;
        $query_melinda = mysqli_query($koneksi_melinda, "SELECT * FROM user_melinda");
        while ($data_melinda = mysqli_fetch_assoc($query_melinda)) {
            ?>
            <tr>
                <td><?= $no_melinda++; ?></td>
                <td><?= $data_melinda['username_melinda']; ?></td>
                <td><?= $data_melinda['password_melinda']; ?></td>
                <td><?= $data_melinda['nama_lengkap_melinda']; ?></td>
                <td><?= $data_melinda['kelas_melinda']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>