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
                                    $query=mysqli_query($conn,"SELECT * FROM pegawai WHERE id='$id'");
                                    while($row=mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td>No</td>
                                        <td> : </td>
                                        <td><?php echo $row['id'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td> : </td>
                                        <td><?php echo $row['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Pegawai</td>
                                        <td> : </td>
                                        <td><?php echo $row['no_pegawai'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td> : </td>
                                        <td><?php echo $row['no_hp'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td> : </td>
                                        <td><?php echo $row['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td> : </td>
                                        <td><?php echo $row['alamat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Domisili</td>
                                        <td> : </td>
                                        <td><?php echo $row['domisili'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat lahir</td>
                                        <td> : </td>
                                        <td><?php echo $row['tempat_lahir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal lahir</td>
                                        <td> : </td>
                                        <td><?php echo $row['tanggal_lahir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis kelamin</td>
                                        <td> : </td>
                                        <td><?php echo $row['jenis_kelamin'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gambar pegawai</td>
                                        <td> : </td>
                                    </tr>
                                </table>
                                <img src="image/pegawai/<?php echo $row['gambar'] ?>" alt="pegawai" width="960px">
                                <?php } ?>
                            </div>
                            <div class="card-footer">
                                <a href="data_pegawai.php" class="btn btn-primary"><i class="fas fa-angle-double-left"></i> Kembali</a>
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