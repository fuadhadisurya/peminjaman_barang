<?php
include 'include/config.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM pegawai WHERE no_pegawai='$id'");
$hasil = mysqli_fetch_array($query);
$data = array(
            'nama_pegawai' =>  $hasil['nama'],
            'email_pegawai'=>  $hasil['email'],
            'no_hp_pegawai'=>  $hasil['no_hp'],
        );
 echo json_encode($data);
?>