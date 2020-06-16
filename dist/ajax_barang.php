<?php
include 'include/config.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM barang WHERE kode_barang='$id'");
$hasil = mysqli_fetch_array($query);
$data = array(
            'nama_barang'   =>  $hasil['nama'],
            'merk'          =>  $hasil['merk'],
            'model'         =>  $hasil['model'],
            'stok'          =>  $hasil['stok'],
);
 echo json_encode($data);
?>