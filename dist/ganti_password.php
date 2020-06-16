<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include 'include/config.php';

if(isset($_POST['submit'])){

    $id=$_SESSION['id'];
    $passwordlama=$_POST['passwordlama'];
    $passwordlama=md5($passwordlama);
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];

    //check apakah password lama cocok dengan di db
    $result=mysqli_query($conn,"SELECT * FROM admin WHERE id='$id'");
    
    $row=mysqli_fetch_assoc($result);
    $passdb=$row['password'];
   if($passwordlama!=$passdb){
      echo '<script>
        window.location.href ="ganti_password.php?error=";
      </script>';
      die();
    }

    //check apakah password dan konfirmasi password sama atau tidak ;
    if($password1 !==$password2){
    echo '<script>
            window.location.href ="ganti_password.php?error2=";
            </script>';
     die();
  }

    //enkripsi Password
    $password1=md5($password1);

    //Query update data
    $query = "UPDATE admin SET password='$password1' WHERE id = '$id'";
    $result=mysqli_query($conn,$query);
    if( $result ) {
        echo '<script>window.location.assign("index.php?password=update")</script>';
    } else {
        // kalau gagal tampilkan pesan
        echo '<script>window.location.assign("ganti_password.php?error=gagal")</script>';
    }
}//milik submit
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ganti password</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ganti password</li>
                        </ol>
                        <?php 
                        if(isset($_GET["error"])==true){
                        echo '
                            <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                            Password <strong> lama </strong> salah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        } elseif(isset($_GET["error2"])==true){
                            echo '
                                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                Password baru dan password konfirmasi <strong> tidak sama </strong>.
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
                                    <input type="hidden" value="<?=$_SESSION['id'];?>" name="email">
                                    <label class="small mb-1" for="inputPasswordLama">Password Lama</label>
                                    <input class="form-control py-4" name="passwordlama" id="inputPasswordLama" type="password" placeholder="Masukkan Password lama" required="required" autofocus="autofocus" />
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" name="password1" id="inputPassword" type="password" placeholder="Masukkan password" required="required" autofocus="autofocus" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputConfirmPassword">Password konfirmasi</label>
                                            <input class="form-control py-4" name="password2" id="inputConfirmPassword" type="password" placeholder="Masukkan password konfirmasi" required="required" autofocus="autofocus" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                    Submit
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
                                                Apakah yakin untuk mengubah password?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
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
<?php
    include('layout/footer.php');
?>