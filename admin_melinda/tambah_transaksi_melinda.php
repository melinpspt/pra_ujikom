<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

if (isset($_POST["simpan_melinda"])) {
    $id_anggota_melinda = $_POST['id_anggota_melinda'];
    $id_buku_melinda    = $_POST['id_buku_melinda'];
    $tanggal_pinjam_melinda = $_POST['tanggal_pinjam_melinda'];
    $tanggal_kembali_melinda = $_POST['tanggal_kembali_melinda'];
    $status_melinda = 'pinjam';

    mysqli_query($koneksi_melinda, "
        INSERT INTO peminjaman_melinda
        (id_anggota_melinda, id_buku_melinda, tanggal_pinjam_melinda, tanggal_kembali_melinda, status_melinda)
        VALUES
        (
            '$id_anggota_melinda',
            '$id_buku_melinda',
            '$tanggal_pinjam_melinda',
            '$tanggal_kembali_melinda',
            '$status_melinda'
        )
    ");

    echo "<script>
        alert('Data transaksi berhasil ditambahkan');
        window.location='data_peminjaman_melinda.php';
    </script>"; 
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
    <form method="post">
        <h2>Tambah Transaksi Peminjaman</h2>

        Nama Siswa <br>
        <select name="id_anggota_melinda" required>
            <option value="">-- Pilih Siswa --</option>
            <?php
            $query_anggota = mysqli_query($koneksi_melinda, "SELECT * FROM anggota_melinda");
            while ($anggota = mysqli_fetch_assoc($query_anggota)) {
                echo "<option value='{$anggota['id_anggota_melinda']}'>{$anggota['nama_anggota_melinda']}</option>";
            }
            ?>
        </select>
        <br><br>

        Judul Buku <br>
        <select name="id_buku_melinda" required>
            <option value="">-- Pilih Buku --</option>
            <?php
            $query_buku = mysqli_query($koneksi_melinda, "SELECT * FROM buku_melinda");
            while ($buku = mysqli_fetch_assoc($query_buku)) {
                echo "<option value='{$buku['id_buku_melinda']}'>{$buku['judul_buku_melinda']}</option>";
            }
            ?>
        </select>
        <br><br>

        Tanggal Pinjam <br>
        <input type="date" name="tanggal_pinjam_melinda" required><br><br>

        Tanggal Kembali <br>
        <input type="date" name="tanggal_kembali_melinda"><br><br>

        Status <br>
        <input type="text" name="status_melinda" value="dipinjam" readonly><br><br>

        <button type="submit" name="simpan_melinda">Simpan</button>
    </form>
</body>
</html>