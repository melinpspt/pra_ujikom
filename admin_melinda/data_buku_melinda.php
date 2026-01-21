<?php
session_start();
include "../config_melinda/koneksi_melinda.php";
if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Data Buku</h2>
    <a href="tambah_buku_melinda.php">+ Tambah Buku</a>
    <br><br>

    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Kategori Buku</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no_melinda = 1;
        $query_melinda = mysqli_query($koneksi_melinda, "SELECT * FROM buku_melinda");
        while ($data_melinda = mysqli_fetch_assoc($query_melinda)) {
            ?>
            <tr>
                <td><?= $no_melinda++; ?></td>
                <td><?= $data_melinda['judul_buku_melinda']; ?></td>
                <td><?= $data_melinda['pengarang_melinda']; ?></td>
                <td><?= $data_melinda['penerbit_melinda']; ?></td>
                <td><?= $data_melinda['tahun_terbit_melinda']; ?></td>
                <td><?= $data_melinda['stok_melinda']; ?></td>
                <td>
                    <a href="edit_buku_melinda.php?id=<?= $data_melinda['id_buku_melinda']; ?>">Edit</a> |
                    <a href="hapus_buku_melinda.php?id=<?= $data_melinda['id_buku_melinda']; ?>"
                        onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href="dashboard_admin_melinda.php">Kembali</a>
</body>

</html>