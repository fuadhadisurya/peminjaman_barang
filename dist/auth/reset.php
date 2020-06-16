<?php
  include "../include/config.php";
  if(!isset($_GET["reset_pass"])){
    echo '<script>window.location.assign("login.php?notoken=")</script>';
  }
  $code = $_GET["reset_pass"];
  $query = mysqli_query($conn, "SELECT email FROM `reset_password` WHERE code = '$code' ");
  if(mysqli_num_rows($query)==0){
    echo '<script>window.location.assign("login.php?notoken=")</script>';
  }
  $row = mysqli_fetch_array($query);
  if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $pass = md5($_POST["password"]);
    $query = mysqli_query($conn, "UPDATE user SET password = '$pass' WHERE email = '$email'");
    if($query){
                mysqli_query($conn, "DELETE FROM reset_password WHERE code = '$code'");
    }
    echo '<script>window.location.assign("login.php?password=")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lupa password</title>
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
                                        <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                    </div>
                                    <div class="card-body">
                                    <form method="post"y>
                                        <label class="small mb-1" for="inputpassword">Masukkan password baru</label>
                                        <input class="form-control py-4" name="password" id="password" type="password" placeholder="Password" />
                                        <input type="hidden" value="<?php echo $row["email"]?>" name="email">
                                    <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                        <button type="submit" name="submit" class="btn btn-primary ">Reset password</button>
                                    </div>
                                    </form>
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
                        <div class="text-muted d-flex justify-content-center">Copyright &copy; Indev 2020</div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
