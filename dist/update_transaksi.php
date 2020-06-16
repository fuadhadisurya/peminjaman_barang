<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');

if(isset($_POST['submit'])) {
    $id=$_POST['id'];
    $tujuan = $_POST['tujuan'];
    $tanggal_kembali=$_POST['tanggal_kembali'];
    $catatan=$_POST['catatan'];
    $status=$_POST['status'];
    $jumlah_pinjam=$_POST['jumlah_pinjam'];
    $kode_barang=$_POST['kode_barang'];

    $query="SELECT stok FROM barang WHERE kode_barang='$kode_barang'";
    $result=mysqli_query($conn,$query);
    $data_barang = mysqli_fetch_array($result);
    $stok=$data_barang['stok'];
    $stok_baru=$stok+$jumlah_pinjam;

    if($status==Dikembalikan){
    $query_barang="UPDATE barang SET stok='$stok_baru' WHERE kode_barang='$kode_barang'";
    $result_barang=mysqli_query($conn, $query_barang) or die (mysqli_error($conn));
    }

    if($tanggal_kembali==""){
        $query="UPDATE transaksi SET tujuan='$tujuan',catatan='$catatan',status='$status' WHERE id='$id'";
    }else{
        $query="UPDATE transaksi SET tujuan='$tujuan',tanggal_kembali='$tanggal_kembali',catatan='$catatan',status='$status' WHERE id='$id'";
    }
    $result=mysqli_query($conn, $query) or die (mysqli_error($conn));
    if( $result || $result_barang ) {
        echo '<script>window.location.assign("data_transaksi.php?update=")</script>';
    } else {
        echo "<script>window.location.assign('update_transaksi.php?id=$id')</script>";
    }
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="data_transaksi.php">Data transaksi</a></li>
                            <li class="breadcrumb-item active">Edit transaksi</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            <?php 
                            $id = $_GET['id'];
                            $result = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '$id'");
                            $data = mysqli_fetch_array($result);
                            ?>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                    <input type="hidden" name="jumlah_pinjam" value="<?php echo $data['jumlah_pinjam'] ?>">
                                    <input type="hidden" name="kode_barang" value="<?php echo $data['id_barang'] ?>">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputno_surat">No surat</label>
                                        <input class="form-control py-4" name="no_surat" id="no_surat" type="text" value="<?php echo $data['no_surat'] ?>" required="required" autofocus="autofocus" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputJumlah_pinjam">Jumlah yang dipinjam</label>
                                        <input class="form-control py-4" name="jumlah_pinjam" id="jumlah_pinjam" type="text" value="<?php echo $data['jumlah_pinjam'] ?>" required="required" autofocus="autofocus" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtujuan">Tujuan</label>
                                        <input class="form-control py-4" name="tujuan" id="tujuan" type="text" value="<?php echo $data['tujuan'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputtanggal_pinjam">Tanggal pinjam</label>
                                                <input class="form-control" name="tanggal_pinjam" id="tanggal_pinjam" type="date" value="<?php echo $data['tanggal_pinjam'] ?>" required="required" autofocus="autofocus" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputtanggal_kembali">Tanggal kembali</label>
                                                <input class="form-control" name="tanggal_kembali" id="tanggal_kembali" type="date" value="<?php echo $data['tanggal_kembali'] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputCatatan">Catatan</label>
                                        <textarea class="form-control" id="catatan" name="catatan" rows="3"><?php echo $data['catatan'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputStatus">Status</label>
                                        <select class="custom-select" name="status">
                                            <option selected>Dipinjamkan</option>
                                            <option >Dikembalikan</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-4 mb-0">
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#konfirmasi">
                                            Submit
                                        </button>
                                        <a href="data_transaksi.php" class="btn btn-secondary btn-block">Kembali</a>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah yakin untuk menyimpan perubahan
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php
include('layout/footer.php');
?>