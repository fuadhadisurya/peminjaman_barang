<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data transaksi</li>
                        </ol>
                        <?php 
                        if(isset($_GET["update"])==true){
                        echo '
                            <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                            <strong> Sukses! </strong> Data berhasil diperbarui
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        } elseif(isset($_GET["sukses"])==true){
                            echo '
                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Sukses </strong> data berhasil disimpan
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered" id="transaksi" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>No surat</th>
                                                <th>Tanggal pinjam</th>
                                                <th>Kode barang</th>
                                                <th>Tujuan</th>
                                                <th>Jumlah pinjam</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include('include/config.php');
                                                $query=mysqli_query($conn,"SELECT * FROM transaksi WHERE status='Dipinjamkan'");
                                                while($row=mysqli_fetch_array($query)){
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['no_surat'] ?></td>
                                                    <td><?php echo $row['tanggal_pinjam'] ?></td>
                                                    <td><?php echo $row['id_barang'] ?></td>
                                                    <td><?php echo $row['tujuan'] ?></td>
                                                    <td><?php echo $row['jumlah_pinjam'] ?></td>
                                                    <td><span class="badge badge-pill badge-primary"><?php echo $row['status'] ?></span></td>
                                                    <td>
                                                        <a href="detail_transaksi.php?id=<?php echo $row["id"]?>" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                                        <a href="update_transaksi.php?id=<?php echo $row["id"]?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                        <a href="cetak_transaksi.php?id=<?php echo $row["id"]?>" target="_BLANK" class="btn btn-success"><i class="fas fa-print"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <script>
                $(document).ready(function() {
                    $('#transaksi').DataTable();
                } );
                </script>
<?php
include('layout/footer.php');
?>