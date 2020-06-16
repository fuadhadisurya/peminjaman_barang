<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="data_transaksi.php">Data transaksi</a></li>
                            <li class="breadcrumb-item active">Detail transaksi</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-body">
                            <table>
                                    <?php
                                    include('include/config.php');
                                    $id=$_GET['id'];
                                    $query=mysqli_query($conn,"SELECT *, admin.nama AS nama_admin, pegawai.nama AS nama_pegawai, pegawai.no_hp AS no_hp_pegawai, pegawai.email AS email_pegawai, mahasiswa.nama AS nama_mahasiswa, mahasiswa.no_hp AS no_hp_mahasiswa, mahasiswa.email AS email_mahasiswa, barang.nama AS nama_barang
                                    FROM transaksi INNER JOIN admin ON transaksi.id_admin=admin.id LEFT JOIN pegawai ON transaksi.id_pegawai=pegawai.no_pegawai LEFT JOIN mahasiswa ON transaksi.id_mahasiswa=mahasiswa.nim INNER JOIN barang ON transaksi.id_barang=barang.kode_barang WHERE transaksi.id='$id'");
                                    while($row=mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td>No transaksi</td>
                                        <td> : </td>
                                        <td><?php echo $row['id'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Surat</td>
                                        <td> : </td>
                                        <td><?php echo $row['no_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pegawai</td>
                                        <td> : </td>
                                        <td><?php echo $row['nama_pegawai'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Pegawai</td>
                                        <td> : </td>
                                        <td><?php echo $row['no_pegawai'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No HP Pegawai</td>
                                        <td> : </td>
                                        <td><?php echo $row['no_hp_pegawai'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Pegawai</td>
                                        <td> : </td>
                                        <td><?php echo $row['email_pegawai'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Mahasiswa</td>
                                        <td> : </td>
                                        <td><?php echo $row['nama_mahasiswa'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td> : </td>
                                        <td><?php echo $row['nim'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td> : </td>
                                        <td><?php echo $row['kelas'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No HP Mahasiswa</td>
                                        <td> : </td>
                                        <td><?php echo $row['no_hp_mahasiswa'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td> : </td>
                                        <td><?php echo $row['email_mahasiswa'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode barang</td>
                                        <td> : </td>
                                        <td><?php echo $row['id_barang'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama barang</td>
                                        <td> : </td>
                                        <td><?php echo $row['nama_barang'] ?></td>
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
                                        <td>Jumlah pinjam</td>
                                        <td> : </td>
                                        <td><?php echo $row['jumlah_pinjam'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal pinjam</td>
                                        <td> : </td>
                                        <td><?php echo $row['tanggal_pinjam'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal kembali</td>
                                        <td> : </td>
                                        <td><?php echo $row['tanggal_kembali'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tujuan</td>
                                        <td> : </td>
                                        <td><?php echo $row['tujuan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td> : </td>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $row['status'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td> : </td>
                                        <td><?php echo $row['catatan'] ?></td>
                                    </tr>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="card-footer">
                                <a href="data_transaksi.php" class="btn btn-primary"><i class="fas fa-angle-double-left"></i> Kembali</a>
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