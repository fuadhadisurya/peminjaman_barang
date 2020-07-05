<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');

if(isset($_POST['submit'])) {
    $id=$_POST['id'];
    $nama=$_POST['nama'];
    $no_pegawai=$_POST['no_pegawai'];
    $no_hp=$_POST['no_hp'];
    $email=$_POST['email'];
    $alamat=$_POST['alamat'];
    $domisili=$_POST['domisili'];
    $tempat_lahir=$_POST['tempat_lahir'];
    $tanggal_lahir=$_POST['tanggal_lahir'];
    $jenis_kelamin=$_POST['jenis_kelamin'];
    $foto_tipe =strtolower($_FILES['gambar']['type']);
    $foto_name =$_FILES['gambar']['name'];
    $foto_size =$_FILES['gambar']['size'];
    $foto_temp =$_FILES['gambar']['tmp_name'];
    $foto_error =$_FILES['gambar']['error'];

    //validasi Numeric
    if(!is_numeric($no_pegawai)){
        echo "<script>
            window.location.href ='edit_pegawai.php?id=$id&nimnumeric=1';
        </script>";
        die();
    }
    if(!is_numeric($no_hp)){
        echo "<script>
            window.location.href ='edit_pegawai.php?id=$id&kontak=1';
        </script>";
    die();
    }

//hapus gambar lama
if($foto_name==true){
    $result=mysqli_query($conn,"SELECT gambar FROM pegawai WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
    unlink("image/pegawai/".$row['gambar']);
}

move_uploaded_file($foto_temp,'../image/pegawai/'.$foto_name);
    if($foto_name==""){
        $query="UPDATE pegawai SET nama='$nama',no_pegawai='$no_pegawai',no_hp='$no_hp',email='$email',alamat='$alamat',domisili='$domisili',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',jenis_kelamin='$jenis_kelamin' WHERE id='$id'";
    }else{
        $query="UPDATE pegawai SET nama='$nama',no_pegawai='$no_pegawai',no_hp='$no_hp',email='$email',alamat='$alamat',domisili='$domisili',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',jenis_kelamin='$jenis_kelamin',gambar='$foto_name' WHERE id='$id'";
    }
    
    $result=mysqli_query($conn, $query) or die (mysqli_error($conn));
    if( $result ) {
        echo '<script>window.location.assign("data_pegawai.php?update=")</script>';
    } else {
        echo "<script>window.location.assign('edit_pegawai.php?id=$id')</script>";
    }
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Pegawai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="data_pegawai.php">Data Pegawai</a></li>
                            <li class="breadcrumb-item active">Edit Pegawai</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            <?php 
                            if(isset($_GET["nimnumeric"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Stok harus <strong> berupa angka </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            } elseif(isset($_GET["kontak"])==true){
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
                                $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE id = '$id'");
                                $data = mysqli_fetch_array($result);
                                ?>
                                <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $data['id']?>">
                                <div class="form-group">
                                        <label class="small mb-1" for="inputNama">Nama</label>
                                        <input class="form-control py-4" name="nama" id="inputNama" type="text" placeholder="Masukkan nama" value="<?php echo $data['nama'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputno_pegawai">No Pegawai</label>
                                        <input class="form-control py-4" name="no_pegawai" id="inputno_pegawai" type="text" placeholder="Masukkan No pegawai" value="<?php echo $data['no_pegawai'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputno_hp">No. HP</label>
                                        <input class="form-control py-4" name="no_hp" id="inputno_hp" type="text" placeholder="Masukkan No. HP" value="<?php echo $data['no_hp'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputemail">Email</label>
                                        <input class="form-control py-4" name="email" id="inputemail" type="email" placeholder="Masukkan Email" value="<?php echo $data['email'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputalamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="inputalamat" rows="2" placeholder="Masukkan alamat"><?php echo $data['alamat'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputdomisili">Domisili</label>
                                        <textarea class="form-control" name="domisili" id="inputdomisili" rows="2" placeholder="Masukkan domisili (Jika ada)"><?php echo $data['domisili'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtempatlahir">Tempat lahir</label>
                                        <input class="form-control py-4" name="tempat_lahir" id="inputtempatlahir" type="text" placeholder="Masukkan tempat lahir" value="<?php echo $data['tempat_lahir'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtanggallahir">Tanggal lahir</label>
                                        <input class="form-control" name="tanggal_lahir" id="inputtanggallahir" type="date" placeholder="Masukkan tanggal lahir" value="<?php echo $data['tanggal_lahir'] ?>" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputjenis_kelamin">Jenis kelamin</label>
                                        <?php $gender = $data['jenis_kelamin']; ?>
                                        <select class="form-control custom-select" id="inputjenis_kelamin" name="jenis_kelamin">
                                            <option <?php echo ($gender == 'Laki-laki') ? "selected": "" ?>>Laki-laki</option>
                                            <option <?php echo ($gender == 'Perempuan') ? "selected": "" ?>>Perempuan</option>
                                        </select>
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
                                    <a href="data_pegawai.php" class="btn btn-secondary btn-block">Kembali</a>
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
                                                    <button class="btn btn-primary" type="submit" name="submit">ya</button>
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