<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');

if(isset($_POST['submit'])) {
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

    //upload foto
//jika tidak ada foto yang diupload
if($foto_error ===4){
    echo '<script>
    window.location.href ="data_pegawai.php?noimage=1";
  </script>';
  die();
}
// check type file yang akan diupload
//JAngan Lupa Check Juga di php.ini mengenai max upload

if(
  $foto_tipe != "image/jpg" AND
  $foto_tipe != "image/jpeg" AND
  $foto_tipe != "image/pjpeg" AND
  $foto_tipe != "image/png" 
){
   echo '<script>
    window.location.href ="data_pegawai.php?imageformat=1";
  </script>';
  die();
}

//check jika ukuran file terlalu besar
  if($foto_size > 1000000){
     echo '<script>
    window.location.href ="data_pegawai.php?imagesize=1";
  </script>';  
  die();
  }

//Cek gambar
$result=mysqli_query($conn,"SELECT gambar FROM pegawai WHERE gambar='$foto_name'");
if(mysqli_fetch_assoc($result)){
  echo '<script>
    window.location.href ="data_pegawai.php?imagename=1";
  </script>';
  die();
}

    //validasi Numeric
    if(!is_numeric($no_pegawai)){
        echo '<script>
          window.location.href ="data_pegawai.php?no_pegawai="1;
        </script>';
        die();
    }
    if(!is_numeric($no_hp)){
    echo '<script>
      window.location.href ="data_pegawai.php?kontak="1;
    </script>';
    die();
    }

  $result=mysqli_query($conn,"SELECT no_pegawai FROM pegawai WHERE no_pegawai='$no_pegawai'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      window.location.href ="data_pegawai.php?pegawai=1";
    </script>';
    die();
  }

  move_uploaded_file($foto_temp,'image/pegawai/'.$foto_name);
    $query="INSERT INTO pegawai (id,nama,no_pegawai,no_hp,email,alamat,domisili,tempat_lahir,tanggal_lahir,jenis_kelamin,gambar) VALUES (null,'$nama','$no_pegawai','$no_hp','$email','$alamat','$domisili','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$foto_name')";
    $result=mysqli_query($conn, $query) or die (mysqli_error($conn));
     if(mysqli_affected_rows($conn) > 0){
      echo '<script>
         window.location.href ="data_pegawai.php?sukses=1";
      </script>';
      }else{
            echo '<script>
                window.location.href ="data_pegawai.php?gagal=1";
            </script>';
    }    
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data pegawai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data pegawai</li>
                        </ol>
                        <?php 
                        if(isset($_GET["noimage"])==true){
                        echo '
                            <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> GAGAL! </strong> Tidak ada Gambar yang diupload
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        } elseif(isset($_GET["imageformat"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> GAGAL! </strong> Tipe file yang diperbolehkan hanya jpg, jpeg, pjpeg, png
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["imagesize"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> GAGAL! </strong> Ukuran terlalu besar
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["imagename"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> Gagal! </strong> Nama File Sudah ada
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["no_pegawai"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                No. Pegawai harus berupa <strong> angka </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["kontak"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                NIM harus berupa <strong> angka </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["pegawai"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                No. Pegawai <strong> Sudah Ada </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["gagal"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> Gagal! </strong> memasukkan data
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["sukses"])==true){
                            echo '
                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                Data <strong> Berhasil </strong> ditambahkan
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["update"])==true){
                            echo '
                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                Data <strong> berhasil </strong> diperbarui.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["hapus"])==true){
                            echo '
                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                Data <strong> berhasil </strong> dihapus.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } 
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i> Insert data
                                </button>
                                <div style="height: 2vh;"></div>
                            <div class="table-responsive">
                                    <table class="table table-bordered" id="pegawai" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>No pegawai</th>
                                                <th>No. HP</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                include('include/config.php');
                                                $query=mysqli_query($conn,"SELECT * FROM pegawai");
                                                while($row=mysqli_fetch_array($query)){
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['nama'] ?></td>
                                                    <td><?php echo $row['no_pegawai'] ?></td>
                                                    <td><?php echo $row['no_hp'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td>
                                                        <a href="detail_pegawai.php?id=<?php echo $row["id"]?>" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                                        <a href="edit_pegawai.php?id=<?php echo $row["id"]?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                        <a href="hapus_pegawai.php?id=<?php echo $row["id"]?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
                    $('#pegawai').DataTable();
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
                            <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputNama">Nama</label>
                                        <input class="form-control py-4" name="nama" id="inputNama" type="text" placeholder="Masukkan nama" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputno_pegawai">No Pegawai</label>
                                        <input class="form-control py-4" name="no_pegawai" id="inputno_pegawai" type="text" placeholder="Masukkan No pegawai" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputno_hp">No. HP</label>
                                        <input class="form-control py-4" name="no_hp" id="inputno_hp" type="text" placeholder="Masukkan No. HP" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputemail">Email</label>
                                        <input class="form-control py-4" name="email" id="inputemail" type="email" placeholder="Masukkan Email" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputalamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="inputalamat" rows="2" placeholder="Masukkan alamat"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputdomisili">Domisili</label>
                                        <textarea class="form-control" name="domisili" id="inputdomisili" rows="2" placeholder="Masukkan domisili (Jika ada)"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtempatlahir">Tempat lahir</label>
                                        <input class="form-control py-4" name="tempat_lahir" id="inputtempatlahir" type="text" placeholder="Masukkan tempat lahir" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputtanggallahir">Tanggal lahir</label>
                                        <input class="form-control" name="tanggal_lahir" id="inputtanggallahir" type="date" placeholder="Masukkan tanggal lahir" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputjenis_kelamin">Jenis kelamin</label>
                                        <select class="form-control custom-select" id="inputjenis_kelamin" name="jenis_kelamin">
                                            <option>Laki-laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label class="small mb-1" for="inputGambar">Upload gambar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar" name="gambar" required="required" autofocus="autofocus">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
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