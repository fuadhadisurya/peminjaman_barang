<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');

if(isset($_POST['submit'])) {
    $id_admin=$_SESSION['id'];
    $no_pegawai=$_POST['no_pegawai'];
    $nim=$_POST['nim'];
    $kode_barang=$_POST['kode_barang'];
    $jumlah_pinjam=$_POST['jumlah_pinjam'];
    $no_surat=$_POST['no_surat'];
    $tujuan=$_POST['tujuan'];
    $tanggal_pinjam=$_POST['tanggal_pinjam'];
    $status=$_POST['status'];

    $query="SELECT stok FROM barang WHERE kode_barang='$kode_barang'";
    $result=mysqli_query($conn,$query);
    $data_barang = mysqli_fetch_array($result);
    $stok=$data_barang['stok'];
    $stok_akhir=$stok-$jumlah_pinjam;

    if($stok<=0){
        echo '<script>window.location.assign("form_transaksi.php?stok=")</script>';
        die();
    }

    $query_barang="UPDATE barang SET stok='$stok_akhir' WHERE kode_barang='$kode_barang'";
    $result_barang=mysqli_query($conn, $query_barang) or die (mysqli_error($conn));

    $query_transaksi="INSERT INTO transaksi (id,id_admin,id_pegawai,id_mahasiswa,id_barang,jumlah_pinjam,no_surat,tanggal_pinjam,tujuan,status) 
    VALUES (null,'$id_admin','$no_pegawai','$nim','$kode_barang','$jumlah_pinjam','$no_surat','$tanggal_pinjam','$tujuan','$status')";
    $result_transaksi=mysqli_query($conn, $query_transaksi) or die (mysqli_error($conn));
    if( $result_transaksi) {
        echo '<script> alert ("Berhasil");</script>';
        echo "<script>window.location.assign('data_transaksi.php?sukses=')</script>";
    } else {
        echo '<script>window.location.assign("form_transaksi.php?gagal=")</script>';
    }
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Form transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Form transaksi</li>
                        </ol>
                        <?php 
                        if(isset($_GET["stok"])==true){
                        echo '
                            <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                            Stock <strong> Tidak tersdia </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        } elseif(isset($_GET["gagal"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> GAGAL! </strong> coba lagi
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNo_Pegawai">No Pegawai</label>
                                                <input class="form-control py-4" onkeyup="pegawai()" name="no_pegawai" id="no_pegawai" type="text" placeholder="Masukkan No"/>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNama">Nama</label>
                                                <input class="form-control py-4" name="nama_pegawai" id="nama_pegawai" type="text" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmail">Email</label>
                                                <input class="form-control py-4" name="email_pegawai" id="email_pegawai" type="text" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputnohp">No. HP</label>
                                                <input class="form-control py-4" name="no_hp_pegawai" id="no_hp_pegawai" type="text" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNIM">Nomor Induk mahasiswa</label>
                                                <input class="form-control py-4" onkeyup="mahasiswa()" name="nim" id="nim" type="text" placeholder="Masukkan NIM"/>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNama">Nama</label>
                                                <input class="form-control py-4" name="nama_mahasiswa" id="nama_mahasiswa" type="text" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputemail">Email</label>
                                                <input class="form-control py-4" name="email_mahasiswa" id="email_mahasiswa" type="text" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputnohp">No. HP</label>
                                                <input class="form-control py-4" name="no_hp_mahasiswa" id="no_hp_mahasiswa" type="text" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputID">Kode Barang</label>
                                                <input class="form-control py-4" onkeyup="barang()" name="kode_barang" id="kode_barang" type="text" placeholder="Masukkan kode" required="required" autofocus="autofocus" />
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNama">Nama</label>
                                                <input class="form-control py-4" name="nama_barang" id="nama_barang" type="text" required="required" autofocus="autofocus" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputmerk">Merk</label>
                                                <input class="form-control py-4" name="merk" id="merk" type="text" required="required" autofocus="autofocus" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputmodel">Model</label>
                                                <input class="form-control py-4" name="model" id="model" type="text" required="required" autofocus="autofocus" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputstok">Stok</label>
                                                <input class="form-control py-4" name="stok" id="stok" type="text" required="required" autofocus="autofocus" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputJumlah_pinjam">Jumlah yang dipinjam</label>
                                        <input class="form-control py-4" name="jumlah_pinjam" id="jumlah_pinjam" type="text" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputno_surat">No surat</label>
                                        <input class="form-control py-4" name="no_surat" id="no_surat" type="text" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtujuan">Tujuan</label>
                                        <input class="form-control py-4" name="tujuan" id="tujuan" type="text" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtanggal_pinjam">tanggal pinjam</label>
                                        <input class="form-control" name="tanggal_pinjam" id="tanggal_pinjam" type="date" required="required" autofocus="autofocus" />
                                    </div>
                                    <input type="hidden" value="Dipinjamkan" name="status">
                                    <div class="form-group mt-4 mb-0">
                                        <button class="btn btn-primary btn-block" type="submit" name="submit">Submit</button>
                                        <a href="data_transaksi.php" class="btn btn-secondary btn-block">Lihat data transaksi</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <script>
                $(document).ready(function() {
                    $('#barang').DataTable();
                } );
                </script>
                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Insert data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
    function pegawai(){
        var id = $("#no_pegawai").val();
			$.ajax({
                url: 'ajax_pegawai.php',
                data:'id='+id ,
            }).done(function(data){
                var json = data,
                obj = JSON.parse(json);
                $('#nama_pegawai').val(obj.nama_pegawai);
                $('#email_pegawai').val(obj.email_pegawai);
                $('#no_hp_pegawai').val(obj.no_hp_pegawai);
            });
    }
</script>
<script type="text/javascript">
    function mahasiswa(){
        var id = $("#nim").val();
			$.ajax({
                url: 'ajax_mahasiswa.php',
                data:'id='+id ,
            }).done(function(data){
                var json = data,
                obj = JSON.parse(json);
                $('#nama_mahasiswa').val(obj.nama_mahasiswa);
                $('#email_mahasiswa').val(obj.email_mahasiswa);
                $('#no_hp_mahasiswa').val(obj.no_hp_mahasiswa);
            });
    }
</script>
<script type="text/javascript">
    function barang(){
        var id = $("#kode_barang").val();
			$.ajax({
                url: 'ajax_barang.php',
                data:'id='+id ,
            }).done(function(data){
                var json = data,
                obj = JSON.parse(json);
                $('#nama_barang').val(obj.nama_barang);
                $('#merk').val(obj.merk);
                $('#model').val(obj.model);
                $('#stok').val(obj.stok);
            });
    }
</script>
<?php
include('layout/footer.php');
?>