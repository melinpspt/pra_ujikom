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
    <h2>Data Peminjaman</h2>
    <a href="tambah_transaksi_melinda.php">+ Tambah Transaksi</a>
    <br><br>

    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>aksi</th>
        </tr>

        <?php
        $no_melinda = 1;
        $query_melinda = mysqli_query($koneksi_melinda, "
    SELECT * FROM peminjaman_melinda
    JOIN anggota_melinda ON peminjaman_melinda.id_anggota_melinda = anggota_melinda.id_anggota_melinda
    JOIN buku_melinda ON peminjaman_melinda.id_buku_melinda = buku_melinda.id_buku_melinda
");

        while ($data_melinda = mysqli_fetch_assoc($query_melinda)) {
            ?>
            <tr>
                <td><?= $no_melinda++; ?></td>
                <td><?= $data_melinda['nama_anggota_melinda']; ?></td>
                <td><?= $data_melinda['judul_buku_melinda']; ?></td>
                <td><?= $data_melinda['tanggal_pinjam_melinda']; ?></td>
                <td><?= $data_melinda['tanggal_kembali_melinda']; ?></td>
                <td><?= $data_melinda['status_melinda']; ?></td>
                <td><a href="edit_transaksi_melinda.php?id=<?= $data_melinda['id_peminjaman_melinda'];?>">Edit</a>
                    |<a href="hapus_transaksi_melinda.php?id=<?= $data_melinda['id_peminjaman_melinda']; ?>"
                        onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>