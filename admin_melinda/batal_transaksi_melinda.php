<?php
include "../config_melinda/koneksi_melinda.php";

$id = $_GET['id'];

// update status jadi DIKEMBALIKAN + isi tanggal kembali
mysqli_query($koneksi_melinda, "
    UPDATE peminjaman_melinda SET
        status_melinda = 'dikembalikan',
        tanggal_kembali_melinda = CURDATE()
    WHERE id_peminjaman_melinda = '$id'
");

echo "<script>
    alert('Buku berhasil dikembalikan');
    window.location='data_peminjaman_melinda.php';
</script>";
