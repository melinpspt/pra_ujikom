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

if (isset($_GET['kembali'])) {
    $id_peminjaman_melinda = $_GET['kembali'];

    $data_pinjam = mysqli_fetch_assoc(mysqli_query(
        $koneksi_melinda,
        "SELECT * FROM peminjaman_melinda 
         WHERE id_peminjaman_melinda='$id_peminjaman_melinda'"
    ));

    mysqli_query($koneksi_melinda, "
        UPDATE peminjaman_melinda SET
            status_melinda='dikembalikan',
            tanggal_kembali_melinda=CURDATE()
        WHERE id_peminjaman_melinda='$id_peminjaman_melinda'
    ");

    mysqli_query($koneksi_melinda, "
        UPDATE buku_melinda SET
            stok_melinda = stok_melinda + 1
        WHERE id_buku_melinda='{$data_pinjam['id_buku_melinda']}'
    ");

    echo "<script>
        alert('Buku berhasil dikembalikan');
        window.location='pengembalian_buku_melinda.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian Buku</title>
</head>
<body>

<h2>Pengembalian Buku</h2>

<table border="1" cellpadding="5">
<tr>
    <th>No</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Tenggat Waktu</th>
    <th>Tanggal Dikembalikan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php
$no_melinda = 1;
$query_melinda = mysqli_query($koneksi_melinda, "
    SELECT * FROM peminjaman_melinda
    JOIN buku_melinda 
        ON peminjaman_melinda.id_buku_melinda = buku_melinda.id_buku_melinda
    WHERE id_anggota_melinda='$id_anggota_melinda'
");

while ($data_melinda = mysqli_fetch_assoc($query_melinda)) {
?>
<tr>
    <td><?= $no_melinda++; ?></td>
    <td><?= $data_melinda['judul_buku_melinda']; ?></td>
    <td><?= $data_melinda['tanggal_pinjam_melinda']; ?></td>
    <td><?= $data_melinda['tenggat_waktu_melinda']; ?></td>
    <td>
        <?= $data_melinda['tanggal_kembali_melinda']
            ? $data_melinda['tanggal_kembali_melinda']
            : '-' ?>
    </td>
    <td>
        <?php
        if ($data_melinda['status_melinda'] == 'dipinjam') {
            echo "<span style='color:orange;'>Dipinjam</span>";
        } else {
            echo "<span style='color:green;'>Dikembalikan</span>";
        }
        ?>
    </td>
    <td>
        <?php if ($data_melinda['status_melinda'] == 'dipinjam') { ?>
            <a href="?kembali=<?= $data_melinda['id_peminjaman_melinda']; ?>"
               onclick="return confirm('Kembalikan buku ini?')">
               Kembalikan
            </a>
        <?php } else { ?>
            -
        <?php } ?>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard_user_melinda.php">Kembali</a>

</body>
</html>
