<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');

if(isset($_POST['submit'])) {
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

    //upload foto
//jika tidak ada foto yang diupload
if($foto_error ===4){
    echo '<script>
    window.location.href ="data_barang.php?noimage=1";
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
    window.location.href ="data_barang.php?imageformat=1";
  </script>';
  die();
}

//check jika ukuran file terlalu besar
  if($foto_size > 1000000){
     echo '<script>
    window.location.href ="data_barang.php?imagesize=1";
  </script>';  
  die();
  }

//Cek gambar
$result=mysqli_query($conn,"SELECT gambar FROM barang WHERE gambar='$foto_name'");
if(mysqli_fetch_assoc($result)){
  echo '<script>
    window.location.href ="data_barang.php?imagename=1";
  </script>';
  die();
}

if(!is_numeric($stok)){
    echo '<script>
      window.location.href ="data_barang.php?numeric="1;
    </script>';
    die();
  }
    if(!is_numeric($jumlah)){
        echo '<script>
          window.location.href ="data_barang.php?numeric="1;
        </script>';
        die();
      }
  $result=mysqli_query($conn,"SELECT nama FROM barang WHERE nama='$nama'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      window.location.href ="data_barang.php?name=1";
    </script>';
    die();
  }
  $result=mysqli_query($conn,"SELECT model FROM barang WHERE model='$model'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      window.location.href ="data_barang.php?model=1";
    </script>';
    die();
  }
  $result=mysqli_query($conn,"SELECT kode_barang FROM barang WHERE kode_barang='$kode_barang'");
  if(mysqli_fetch_assoc($result)){
    echo '<script>
      window.location.href ="data_barang.php?kode=1";
    </script>';
    die();
  }

  move_uploaded_file($foto_temp,'image/barang/'.$foto_name);
    $query="INSERT INTO barang (id,kode_barang,nama,jenis,merk,model,stok,jumlah,baik,rusak,gambar) VALUES (null,'$kode_barang','$nama','$jenis','$merk','$model','$stok','$jumlah','$baik','$rusak','$foto_name')";
    $result=mysqli_query($conn, $query) or die (mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
      echo '<script>
         window.location.href ="data_barang.php?sukses=1";
      </script>';
      }else{
            echo '<script>
                window.location.href ="data_barang.php?gagal=1";
            </script>';
    }    
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data barang</li>
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
                        } elseif(isset($_GET["numeric"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Stok/Jumlah harus berupa <strong> angka </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["name"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Nama barang <strong> Sudah Ada </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["model"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Model <strong> Sudah Ada </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["kode"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Kode barang <strong> Sudah Ada </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } elseif(isset($_GET["gagal"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Data <strong> Gagal </strong> ditambahkan
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
                                    <table class="table table-bordered" id="barang" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Kode barang</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Merk</th>
                                                <th>Model</th>
                                                <th>Stok</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include('include/config.php');
                                                $query=mysqli_query($conn,"SELECT * FROM barang");
                                                while($row=mysqli_fetch_array($query)){
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['kode_barang'] ?></td>
                                                    <td><?php echo $row['nama'] ?></td>
                                                    <td><?php echo $row['jenis'] ?></td>
                                                    <td><?php echo $row['merk'] ?></td>
                                                    <td><?php echo $row['model'] ?></td>
                                                    <td><?php echo $row['stok'] ?></td>
                                                    <td><?php echo $row['jumlah'] ?></td>
                                                    <td>
                                                        <?php echo $row['baik'] ?> Baik
                                                        <br>
                                                        <?php echo $row['rusak'] ?> Rusak
                                                    </td>
                                                    <td>
                                                        <a href="detail_barang.php?id=<?php echo $row["id"]?>" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                                        <a href="edit_barang.php?id=<?php echo $row["id"]?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                        <a href="hapus_barang.php?id=<?php echo $row["id"]?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
                                        <label class="small mb-1" for="inputkode_barang">Kode barang</label>
                                        <input class="form-control py-4" name="kode_barang" id="inputkode_barang" type="text" placeholder="Masukkan Kode barang" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputNama">Nama barang</label>
                                        <input class="form-control py-4" name="nama" id="inputNama" type="text" placeholder="Masukkan nama barang" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputjenis">Jenis</label>
                                        <input class="form-control py-4" name="jenis" id="inputjenis" type="text" placeholder="Masukkan jenis" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputmerk">Merk</label>
                                        <input class="form-control py-4" name="merk" id="inputmerk" type="text" placeholder="Masukkan nama merk" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputmodel">Model barang</label>
                                        <input class="form-control py-4" name="model" id="inputmodel" type="text" placeholder="Masukkan model barang" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputstok">Stok</label>
                                        <input class="form-control py-4" name="stok" id="inputstok" type="text" placeholder="Masukkan barang yang tersedia" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputjumlah">Jumlah</label>
                                        <input class="form-control py-4" name="jumlah" id="inputjumlah" type="text" placeholder="Masukkan jumlah barang" required="required" autofocus="autofocus" />
                                    </div>
                                    <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputbaik">Kondisi baik</label>
                                            <input class="form-control py-4" name="baik" id="inputbaik" type="text" placeholder="Jumlah barang yang baik" required="required" autofocus="autofocus" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputrusak">Kondisi rusak</label>
                                            <input class="form-control py-4" name="rusak" id="inputrusak" type="text" placeholder="Jumlah barang yang rusak" required="required" autofocus="autofocus" />
                                        </div>
                                    </div>
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