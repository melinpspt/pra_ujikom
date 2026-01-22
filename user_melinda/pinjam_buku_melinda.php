<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'user') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

$username_melinda = $_SESSION['username_melinda'];

/* ambil id user */
$user_melinda = mysqli_fetch_assoc(mysqli_query(
    $koneksi_melinda,
    "SELECT id_user_melinda FROM user_melinda 
     WHERE username_melinda='$username_melinda'"
));

/* ambil data anggota */
$anggota_melinda = mysqli_fetch_assoc(mysqli_query(
    $koneksi_melinda,
    "SELECT * FROM anggota_melinda 
     WHERE id_user_melinda='{$user_melinda['id_user_melinda']}'"
));

if (!$anggota_melinda) {
    die("Data anggota tidak ditemukan");
}

$id_anggota_melinda = $anggota_melinda['id_anggota_melinda'];

if (isset($_POST['pinjam_melinda'])) {

    if (!isset($_POST['id_buku_melinda'])) {
        echo "<script>alert('Pilih minimal 1 buku');</script>";
    } else {

        $buku_dipilih_melinda = $_POST['id_buku_melinda'];

        foreach ($buku_dipilih_melinda as $id_buku_melinda) {

            // tenggat waktu per buku
            $tenggat_waktu_melinda = $_POST['tenggat_waktu_melinda'][$id_buku_melinda];

            mysqli_query($koneksi_melinda, "
                INSERT INTO peminjaman_melinda
                (
                    id_anggota_melinda,
                    id_buku_melinda,
                    tanggal_pinjam_melinda,
                    tenggat_waktu_melinda,
                    status_melinda
                )
                VALUES
                (
                    '$id_anggota_melinda',
                    '$id_buku_melinda',
                    CURDATE(),
                    '$tenggat_waktu_melinda',
                    'dipinjam'
                )
            ");

            mysqli_query($koneksi_melinda, "
                UPDATE buku_melinda 
                SET stok_melinda = stok_melinda - 1
                WHERE id_buku_melinda='$id_buku_melinda'
            ");
        }

        echo "<script>
            alert('Buku berhasil dipinjam');
            window.location='pinjam_buku_melinda.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pinjam Buku</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Pinjam Buku</h2>

<form method="POST">

<table>
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Kategori</th>
        <th>Tenggat Waktu</th>
        <th>Stok</th>
        <th>Pilih</th>
    </tr>

    <?php
    $no_melinda = 1;
    $query_melinda = mysqli_query(
        $koneksi_melinda,
        "SELECT * FROM buku_melinda WHERE stok_melinda > 0"
    );

    while ($data_melinda = mysqli_fetch_assoc($query_melinda)) {
    ?>
    <tr>
        <td><?= $no_melinda++; ?></td>
        <td><?= $data_melinda['judul_buku_melinda']; ?></td>
        <td><?= $data_melinda['kategori_buku_melinda']; ?></td>
        <td>
            <select name="tenggat_waktu_melinda[<?= $data_melinda['id_buku_melinda']; ?>]">
                <option value="">-- Pilih --</option>
                <option value="1 minggu">1 Minggu</option>
                <option value="2 minggu">2 Minggu</option>
                <option value="3 minggu">3 Minggu</option>
            </select>
        </td>
        <td><?= $data_melinda['stok_melinda']; ?></td>
        <td align="center">
            <input type="checkbox"
                   name="id_buku_melinda[]"
                   value="<?= $data_melinda['id_buku_melinda']; ?>">
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<button type="submit" name="pinjam_melinda">Pinjam Buku</button>

</form>

<br>
<a href="dashboard_user_melinda.php">Kembali</a>

</body>
</html>
