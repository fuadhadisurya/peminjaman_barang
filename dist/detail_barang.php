<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail pegawai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="data_pegawai.php">Data pegawai</a></li>
                            <li class="breadcrumb-item active">Detail pegawai</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-body">
                            <table>
                                    <?php
                                    include('include/config.php');
                                    $id=$_GET['id'];
                                    $query=mysqli_query($conn,"SELECT * FROM barang WHERE id='$id'");
                                    while($row=mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td>No</td>
                                        <td> : </td>
                                        <td><?php echo $row['id'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode barang</td>
                                        <td> : </td>
                                        <td><?php echo $row['kode_barang'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td> : </td>
                                        <td><?php echo $row['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis</td>
                                        <td> : </td>
                                        <td><?php echo $row['jenis'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Merk</td>
                                        <td> : </td>
                                        <td><?php echo $row['merk'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td> : </td>
                                        <td><?php echo $row['model'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td> : </td>
                                        <td><?php echo $row['stok'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td> : </td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kondisi Baik</td>
                                        <td> : </td>
                                        <td><?php echo $row['baik'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kondisi rusak</td>
                                        <td> : </td>
                                        <td><?php echo $row['rusak'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gambar barang</td>
                                        <td> : </td>
                                    </tr>
                                </table>
                                <img src="image/barang/<?php echo $row['gambar'] ?>" alt="Barang" width="960px">
                                <?php } ?>
                            </div>
                            <div class="card-footer">
                                <a href="data_barang.php" class="btn btn-primary"><i class="fas fa-angle-double-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </main>
                <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<?php
    include('layout/footer.php');
?>