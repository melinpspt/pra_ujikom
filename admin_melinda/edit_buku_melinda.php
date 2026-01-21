<?php
include "../config_melinda/koneksi_melinda.php";
$id_melinda = $_GET['id'];

$data_melinda = mysqli_fetch_assoc(
    mysqli_query($koneksi_melinda, "SELECT * FROM buku_melinda WHERE id_buku_melinda='$id_melinda'")
);

if (isset($_POST['update_melinda'])) {
    mysqli_query($koneksi_melinda, "UPDATE buku_melinda SET
        judul_buku_melinda='$_POST[judul_buku_melinda]',
        pengarang_melinda='$_POST[pengarang_melinda]',
        penerbit_melinda='$_POST[penerbit_melinda]',
        tahun_terbit_melinda='$_POST[tahun_terbit_melinda]',
        stok_melinda='$_POST[stok_melinda]'
        WHERE id_buku_melinda='$id_melinda'
    ");
    header("location:data_buku_melinda.php");
}
?>

<h2>Edit Buku</h2>

<form method="POST">
    Judul <br>
    <input type="text" name="judul_buku_melinda" value="<?= $data_melinda['judul_buku_melinda']; ?>"><br><br>

    Pengarang <br>
    <input type="text" name="pengarang_melinda" value="<?= $data_melinda['pengarang_melinda']; ?>"><br><br>

    Penerbit <br>
    <input type="text" name="penerbit_melinda" value="<?= $data_melinda['penerbit_melinda']; ?>"><br><br>

    Tahun <br>
    <input type="number" name="tahun_terbit_melinda" value="<?= $data_melinda['tahun_terbit_melinda']; ?>"><br><br>

    Stok <br>
    <input type="number" name="stok_melinda" value="<?= $data_melinda['stok_melinda']; ?>"><br><br>

    <button type="submit" name="update_melinda">Update</button>
</form>
