<?php
include "../config_melinda/koneksi_melinda.php";
$id_melinda = $_GET['id'];

mysqli_query($koneksi_melinda,
    "DELETE FROM buku_melinda WHERE id_buku_melinda='$id_melinda'"
);

header("location:data_buku_melinda.php");
