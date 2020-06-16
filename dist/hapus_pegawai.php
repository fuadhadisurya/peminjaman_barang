<?php
require 'include/config.php';
$id= $_GET['id'];

//hapus gambar lama
    $result=mysqli_query($conn,"SELECT gambar FROM pegawai WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
    unlink("image/pegawai/".$row['gambar']);

mysqli_query($conn, "DELETE FROM pegawai WHERE id=$id");
echo "
<script>
	document.location.href='data_pegawai.php?hapus=';
</script>
";

?>