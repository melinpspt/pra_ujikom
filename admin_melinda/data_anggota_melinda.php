<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>

<body>
    <h2>Data Anggota</h2>
    <a href="tambah_anggota_melinda.php">+ Tambah Anggota</a>
    <br><br>
    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Username</th>
            <th>Nama Anggota</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no_melinda = 1;
        $query_melinda = mysqli_query($koneksi_melinda, "
    SELECT 
        a.id_anggota_melinda,
        u.id_user_melinda,
        a.nis_melinda,
        u.username_melinda,
        a.nama_anggota_melinda,
        a.kelas_melinda,
        a.jurusan_melinda,
        a.status_verifikasi
    FROM anggota_melinda a
    JOIN user_melinda u 
        ON a.id_user_melinda = u.id_user_melinda
");
        while ($data_melinda = mysqli_fetch_assoc($query_melinda)) {
            ?>
            <tr>
                <td><?= $no_melinda++; ?></td>
                <td><?= $data_melinda['nis_melinda']; ?></td>
                <td><?= $data_melinda['username_melinda']; ?></td>
                <td><?= $data_melinda['nama_anggota_melinda']; ?></td>
                <td><?= $data_melinda['kelas_melinda']; ?></td>
                <td><?= $data_melinda['jurusan_melinda']; ?></td>
                <td>
                    <?php
                    if ($data_melinda['status_verifikasi'] == 'pending') {
                        echo "<span style='color:red;'>Belum Verifikasi</span>";
                    } else {
                        echo "<span style='color:green;'>Aktif</span>";
                    }
                    ?>
                </td>
                <td>
                    <a
                        href="edit_anggota_melinda.php?id_anggota=<?= $data_melinda['id_anggota_melinda']; ?>&id_user=<?= $data_melinda['id_user_melinda']; ?>">Edit</a>
                    |
                    <?php if ($data_melinda['status_verifikasi'] == 'pending') { ?>
                        <a href="verifikasi_anggota_melinda.php?id_anggota=<?= $data_melinda['id_anggota_melinda']; ?>"
                            onclick="return confirm('Verifikasi anggota ini?')">
                            Verifikasi
                        </a> |
                    <?php } ?>

                    <a href="hapus_anggota_melinda.php?id_anggota=<?= $data_melinda['id_anggota_melinda']; ?>&id_user=<?= $data_melinda['id_user_melinda']; ?>"
                        onclick="return confirm('Hapus data?')">Disable</a>
                </td>

            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="dashboard_admin_melinda.php">Kembali</a>
</body>

</html>