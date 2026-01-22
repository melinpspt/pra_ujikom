<?php
session_start();
include "../config_melinda/koneksi_melinda.php";

if ($_SESSION['role_melinda'] != 'admin') {
    header("location:../auth_melinda/login_melinda.php");
    exit;
}

// AMBIL DATA TRANSAKSI
$id = $_GET['id'];

$query = mysqli_query($koneksi_melinda, "
    SELECT * FROM peminjaman_melinda
    WHERE id_peminjaman_melinda='$id'
");

$data = mysqli_fetch_assoc($query);

// SIMPAN PERUBAHAN
if (isset($_POST['update_melinda'])) {
    $id_anggota_melinda      = $_POST['id_anggota_melinda'];
    $id_buku_melinda         = $_POST['id_buku_melinda'];
    $tanggal_pinjam_melinda  = $_POST['tanggal_pinjam_melinda'];
    $tanggal_kembali_melinda = $_POST['tanggal_kembali_melinda'];
    $status_melinda          = $_POST['status_melinda'];

    mysqli_query($koneksi_melinda, "
        UPDATE peminjaman_melinda SET
            id_anggota_melinda='$id_anggota_melinda',
            id_buku_melinda='$id_buku_melinda',
            tanggal_pinjam_melinda='$tanggal_pinjam_melinda',
            tanggal_kembali_melinda='$tanggal_kembali_melinda',
            status_melinda='$status_melinda'
        WHERE id_peminjaman_melinda='$id'
    ");

    echo "<script>
        alert('Data transaksi berhasil diupdate');
        window.location='data_peminjaman_melinda.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
</head>
<body>

<h2>Edit Transaksi Peminjaman</h2>

<form method="post">
    Nama Siswa <br>
    <select name="id_anggota_melinda" required>
        <?php
        $anggota = mysqli_query($koneksi_melinda, "SELECT * FROM anggota_melinda");
        while ($a = mysqli_fetch_assoc($anggota)) {
            $selected = ($a['id_anggota_melinda'] == $data['id_anggota_melinda']) ? 'selected' : '';
            echo "<option value='{$a['id_anggota_melinda']}' $selected>
                    {$a['nama_anggota_melinda']}
                  </option>";
        }
        ?>
    </select><br><br>

    Judul Buku <br>
    <select name="id_buku_melinda" required>
        <?php
        $buku = mysqli_query($koneksi_melinda, "SELECT * FROM buku_melinda");
        while ($b = mysqli_fetch_assoc($buku)) {
            $selected = ($b['id_buku_melinda'] == $data['id_buku_melinda']) ? 'selected' : '';
            echo "<option value='{$b['id_buku_melinda']}' $selected>
                    {$b['judul_buku_melinda']}
                  </option>";
        }
        ?>
    </select><br><br>

    Tanggal Pinjam <br>
    <input type="date" name="tanggal_pinjam_melinda"
           value="<?= $data['tanggal_pinjam_melinda']; ?>" required><br><br>

    Tanggal Kembali <br>
    <input type="date" name="tanggal_kembali_melinda"
           value="<?= $data['tanggal_kembali_melinda']; ?>"><br><br>

    Status <br>
    <select name="status_melinda" required>
        <option value="dipinjam" <?= $data['status_melinda']=='dipinjam'?'selected':''; ?>>Dipinjam</option>
        <option value="dikembalikan" <?= $data['status_melinda']=='dikembalikan'?'selected':''; ?>>Dikembalikan</option>
    </select><br><br>

    <button type="submit" name="update_melinda">Update</button>
</form>

<br>
<a href="data_peminjaman_melinda.php">Kembali</a>

</body>
</html>
