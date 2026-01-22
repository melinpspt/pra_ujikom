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
    <title>Data Anggota</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>
<body>

<h2>Data Anggota</h2>
<a href="tambah_anggota_melinda.php">+ Tambah Anggota</a>
<br><br>

<table>
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
$no = 1;
$query = mysqli_query($koneksi_melinda, "
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

while ($data = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nis_melinda']; ?></td>
        <td><?= $data['username_melinda']; ?></td>
        <td><?= $data['nama_anggota_melinda']; ?></td>
        <td><?= $data['kelas_melinda']; ?></td>
        <td><?= $data['jurusan_melinda']; ?></td>

        <td>
            <?php
            if ($data['status_verifikasi'] == 'pending') {
                echo "<span style='color:orange;'>Belum Verifikasi</span>";
            } elseif ($data['status_verifikasi'] == 'aktif') {
                echo "<span style='color:green;'>Aktif</span>";
            } elseif ($data['status_verifikasi'] == 'nonaktif') {
                echo "<span style='color:red;'>Nonaktif</span>";
            } elseif ($data['status_verifikasi'] == 'expired') {
                echo "<span style='color:gray;'>Expired</span>";
            }
            ?>
        </td>

        <td>
            <a href="edit_anggota_melinda.php?id_anggota=<?= $data['id_anggota_melinda']; ?>&id_user=<?= $data['id_user_melinda']; ?>">
                Edit
            </a>

            <?php if ($data['status_verifikasi'] == 'pending') { ?>
                |
                <a href="verifikasi_anggota_melinda.php?id_anggota=<?= $data['id_anggota_melinda']; ?>"
                   onclick="return confirm('Verifikasi anggota ini?')">
                    Verifikasi
                </a>
            <?php } ?>

            <?php if ($data['status_verifikasi'] == 'aktif') { ?>
                |
                <a href="ubah_status_anggota_melinda.php?id=<?= $data['id_anggota_melinda']; ?>&status=nonaktif"
                   onclick="return confirm('Nonaktifkan akun siswa ini?')">
                    Disable
                </a>
            <?php } elseif ($data['status_verifikasi'] == 'nonaktif') { ?>
                |
                <a href="ubah_status_anggota_melinda.php?id=<?= $data['id_anggota_melinda']; ?>&status=aktif"
                   onclick="return confirm('Aktifkan kembali akun siswa ini?')">
                    Aktifkan
                </a>
            <?php } ?>
        </td>
    </tr>
<?php } ?>
</table>

<br>
<a href="dashboard_admin_melinda.php">Kembali</a>

</body>
</html>
