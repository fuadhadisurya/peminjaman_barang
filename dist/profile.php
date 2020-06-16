<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include 'include/config.php';

if(isset($_POST['submit'])) {
    $nama=$_POST['nama'];
    $kontak=$_POST['kontak'];
    $alamat=$_POST['alamat'];
    $email=$_POST['email'];
    $id = $_SESSION['id'];

    $query="UPDATE admin SET nama='$nama',no_hp='$kontak',alamat='$alamat',email='$email' WHERE id='$id'";
    $result=mysqli_query($conn, $query) or die (mysqli_error($conn));
    if( $result ) {
        echo '<script>window.location.assign("index.php?profile=update")</script>';
    } else {
        // kalau gagal tampilkan pesan
        echo '<script>window.location.assign("profil_admin.php?error=gagal")</script>';
    }
    
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ubah Profil</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ubah Profil</li>
                        </ol>
                        <?php 
                        if(isset($_GET["error"])==true){
                        echo '
                            <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                            Profile <strong> gagal </strong> di perbarui.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                            <?php
                            //untuk menampilkan data sebelum di update/diedit
                            $id = $_SESSION['id'];
                            $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id'");
                            $user = mysqli_fetch_array($result);
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputFullName">Name Lengkap</label>
                                    <input class="form-control py-4" name="nama" id="inputFullName" type="text" placeholder="Masukkan nama lengkap" value="<?php echo $user['nama'] ?>" required="required" autofocus="autofocus" />
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control py-4" name="email" id="inputEmail" type="email" placeholder="Masukkan NIK" value="<?php echo $user['email'] ?>" required="required" autofocus="autofocus" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputnohp">No. HP</label>
                                            <input class="form-control py-4" name="kontak" id="inputnohp" type="text" placeholder="Masukkan No. HP" value="<?php echo $user['no_hp'] ?>" required="required" autofocus="autofocus" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputAlamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="inputAlamat" rows="2" placeholder="Masukkan alamat" required="required" autofocus="autofocus"><?php echo $user['alamat'] ?></textarea>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                    Ubah
                                    </button>
                                    <a href="index.php" class="btn btn-secondary btn-block">Batalkan</a>
                                </div>
                                <!-- Konfirmasi Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah yakin untuk mengubah data?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit" name="submit">Confirm</button>
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