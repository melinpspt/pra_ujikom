<?php
include "../config_melinda/koneksi_melinda.php";

if (isset($_POST['simpan_melinda'])) {
    mysqli_query($koneksi_melinda, "INSERT INTO buku_melinda VALUES (
        '',
        '$_POST[judul_buku_melinda]',
        '$_POST[pengarang_melinda]',
        '$_POST[penerbit_melinda]',
        '$_POST[tahun_terbit_melinda]',
        '$_POST[kategori_buku_melinda]',
        '$_POST[stok_melinda]'
    )");
    header("location:data_buku_melinda.php");
}
?>

<h2>Tambah Buku</h2>

<form method="POST">
    Judul Buku <br>
    <input type="text" name="judul_buku_melinda" required><br><br>

    Pengarang <br>
    <input type="text" name="pengarang_melinda" required><br><br>

    Penerbit <br>
    <input type="text" name="penerbit_melinda" required><br><br>

    Tahun Terbit <br>
    <input type="number" name="tahun_terbit_melinda" required><br><br>

    Kategori Buku <br>
<select name="kategori_buku_melinda" required>
    <option value="">-- Pilih Kategori --</option>
    <option value="Novel">Novel</option>
    <option value="Komik">Komik</option>
    <option value="Dongeng">Dongeng</option>
    <option value="Buku Paket">Buku Paket</option>
    <option value="Biografi">Biografi</option>
    <option value="Majalah">Majalah</option>
    <option value="Karya Ilmiah">Karya Ilmiah</option>
    <option value="Buku Digital">Buku Digital</option>
    <option value="Fotografi">Fotografi</option>
    <option value="Cergam">Cergam</option>
</select>
<br><br>


    Stok <br>
    <input type="number" name="stok_melinda" required><br><br>

    <button type="submit" name="simpan_melinda">Simpan</button>
</form>
