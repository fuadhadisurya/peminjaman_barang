<?php
if(isset($_POST["submit"])){
//masukan ke variable inputan dari user
    $user=$_POST['email'];
    $pass=md5($_POST['password']);

    include '../include/config.php';
    //Ambil data dari database
    $result=mysqli_query($conn,"SELECT * FROM admin WHERE email='$user'");
    $row=mysqli_fetch_assoc($result);
    $id=$row['id'];
    $namadb=$row['nama'];
    $userdb=$row['email'];
    $passdb=$row['password'];
    if($user == $userdb && $pass ==$passdb){
        session_start();
        $_SESSION['email'] = $userdb;
        $_SESSION['id'] = $id;
        $_SESSION['nama'] = $namadb;
        echo '<script>window.location.assign("../index.php")</script>';
    }
    else{
    header('location:login.php?error=1');
    }
    $error = true;
};
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Gudang</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                        if(isset($_GET["error"])==true){
                                        echo '
                                            <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Username/Password</strong> salah.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                        } elseif(isset($_GET["notoken"])==true){
                                        echo '
                                            <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Gagal!</strong> silahkan request lupa password
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                 </button>
                                            </div>';
                                        } elseif(isset($_GET["password"])==true){
                                            echo '
                                            <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                                Password <strong> berhasil </strong> diperbarui
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                        }
                                        ?>
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" required/>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <button type="submit" name="submit" class="btn btn-primary ">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center text-muted">
                                        <div class="small">Silahkan hubungi bagian IT untuk pembuatan akun</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Indev 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
