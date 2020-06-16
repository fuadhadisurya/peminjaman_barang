<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');

if(isset($_POST['submit'])) {
    $id=$_POST['id'];
    $kode_barang=$_POST['kode_barang'];
    $nama=$_POST['nama'];
    $jenis=$_POST['jenis'];
    $merk = $_POST['merk'];
    $model=$_POST['model'];
    $stok=$_POST['stok'];
    $jumlah=$_POST['jumlah'];
    $baik=$_POST['baik'];
    $rusak=$_POST['rusak'];
    $foto_tipe =strtolower($_FILES['gambar']['type']);
    $foto_name =$_FILES['gambar']['name'];
    $foto_size =$_FILES['gambar']['size'];
    $foto_temp =$_FILES['gambar']['tmp_name'];
    $foto_error =$_FILES['gambar']['error'];
    
    if(!is_numeric($stok)){
    echo "<script>
      window.location.href ='edit_barang.php?id=$id&numeric=1';
    </script>";
    die();
    }
    if(!is_numeric($jumlah)){
        echo "<script>
          window.location.href ='edit_barang.php?id=$id&numeric=1';
        </script>";
        die();
    }

//hapus gambar lama
if($foto_name==true){
    $result=mysqli_query($conn,"SELECT gambar FROM barang WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
    unlink("image/barang/".$row['gambar']);
}

move_uploaded_file($foto_temp,'../image/barang/'.$foto_name);
    if($foto_name==""){
        $query="UPDATE barang SET kode_barang='$kode_barang',nama='$nama',jenis='$jenis',merk='$merk',model='$model',stok='$stok',jumlah='$jumlah',baik='$baik',rusak='$rusak' WHERE id='$id'";
    }else{
        $query="UPDATE barang SET kode_barang='$kode_barang',nama='$nama',jenis='$jenis',merk='$merk',model='$model',stok='$stok',jumlah='$jumlah',baik='$baik',rusak='$rusak',gambar='$foto_name' WHERE id='$id'";
    }
    
    $result=mysqli_query($conn, $query) or die (mysqli_error($conn));
    if( $result ) {
        echo '<script>window.location.assign("data_barang.php?update=")</script>';
    } else {
        echo "<script>window.location.assign('edit_barang.php?id=$id')</script>";
    }
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="data_barang.php">Data barang</a></li>
                            <li class="breadcrumb-item active">Edit barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            <?php 
                            if(isset($_GET["numeric"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Stok harus <strong> berupa angka </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            } elseif(isset($_GET["gagal"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Data gagal <strong> gagal </strong> diperbarui
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            }
                            //untuk menampilkan data sebelum di update/diedit
                                $id = $_GET['id'];
                                $result = mysqli_query($conn, "SELECT * FROM barang WHERE id = '$id'");
                                $data = mysqli_fetch_array($result);
                                ?>
                                <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $data['id']?>">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputkode_barang">Kode barang</label>
                                        <input class="form-control py-4" name="kode_barang" id="inputkode_barang" type="text" placeholder="Masukkan Kode barang" required="required" autofocus="autofocus" value="<?php echo $data['kode_barang']?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputNama">Nama barang</label>
                                        <input class="form-control py-4" name="nama" id="inputNama" type="text" placeholder="Masukkan nama barang" required="required" autofocus="autofocus" value="<?php echo $data['nama']?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputjenis">Jenis</label>
                                        <input class="form-control py-4" name="jenis" id="inputjenis" type="text" placeholder="Masukkan jenis" required="required" autofocus="autofocus" value="<?php echo $data['jenis']?>"/>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputmerk">Merk</label>
                                                <input class="form-control py-4" name="merk" id="inputmerk" type="text" placeholder="Masukkan nama merk" required="required" autofocus="autofocus" value="<?php echo $data['merk']?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputmodel">Model barang</label>
                                                <input class="form-control py-4" name="model" id="inputmodel" type="text" placeholder="Masukkan model barang" required="required" autofocus="autofocus" value="<?php echo $data['model']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputstok">Stok</label>
                                                <input class="form-control py-4" name="stok" id="inputstok" type="text" placeholder="Masukkan jumlah barang yang tersedia" required="required" autofocus="autofocus" value="<?php echo $data['stok']?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputjumlah">Jumlah</label>
                                                <input class="form-control py-4" name="jumlah" id="inputjumlah" type="text" placeholder="Masukkan jumlah barang" required="required" autofocus="autofocus" value="<?php echo $data['jumlah']?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputbaik">Kondisi baik</label>
                                                <input class="form-control py-4" name="baik" id="inputbaik" type="text" placeholder="Jumlah barang yang baik" required="required" autofocus="autofocus" value="<?php echo $data['baik']?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputrusak">Kondisi rusak</label>
                                                <input class="form-control py-4" name="rusak" id="inputrusak" type="text" placeholder="Jumlah barang yang rusak" required="required" autofocus="autofocus" value="<?php echo $data['rusak']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label class="small mb-1" for="inputGambar">Upload gambar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#update" value="<?php echo $row['id'] ?>">
                                        Update
                                    </button>
                                    <a href="data_barang.php" class="btn btn-secondary btn-block">Kembali</a>
                                    <!-- Modal konfirmasi-->
                                    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post">
                                                        Apakah anda yakin untuk menyimpan perubahan?
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" type="submit" name="submit">Ya</button>
                                                </div>
                                            </div>
                                        </div>
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
                <script>
                    $(".custom-file-input").on("change", function() {
                        var fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                </script>
<?php
include('layout/footer.php');
?>