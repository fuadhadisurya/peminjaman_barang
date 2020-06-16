<?php
require 'include/config.php';
$id= $_GET['id'];

//hapus gambar lama
    $result=mysqli_query($conn,"SELECT gambar FROM barang WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
    unlink("image/barang/".$row['gambar']);

mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
echo "
<script>
	document.location.href='data_barang.php?hapus=';
</script>
";

?>