<?php
require 'include/config.php';
$id= $_GET['id'];

//hapus gambar lama
    $result=mysqli_query($conn,"SELECT gambar FROM mahasiswa WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
    unlink("image/mahasiswa/".$row['gambar']);

mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
echo "
<script>
	document.location.href='data_mahasiswa.php?hapus=';
</script>
";

?>