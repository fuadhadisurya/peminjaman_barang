<?php
include 'include/config.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$id'");
$hasil = mysqli_fetch_array($query);
$data = array(
            'nama_mahasiswa' =>  $hasil['nama'],
            'email_mahasiswa'=>  $hasil['email'],
            'no_hp_mahasiswa'=>  $hasil['no_hp'],
        );
 echo json_encode($data);
?>