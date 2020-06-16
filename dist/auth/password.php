<?php 
include "../include/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if(isset($_POST["submit"])){
    $emailTo = $_POST["email"]; //email kamu atau email penerima link reset
    $code = uniqid(true); //Untuk kode atau parameter acak
    //Ambil data dari database
    $db=mysqli_query($conn,"SELECT * FROM admin WHERE email='$emailTo'");
    $row=mysqli_fetch_assoc($db);
    
    if($emailTo == $row['email']){
    $delete = mysqli_query($conn, "DELETE FROM reset_password WHERE email='$emailTo'");
    $query = mysqli_query($conn, "INSERT INTO reset_password VALUES (null,'$emailTo','$code')");
    if(!$query){
        exit("Error");
    }
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "manggangoding@gmail.com";     // SMTP username
        $mail->Password = 'mangga123';                         // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom("manggangoding@gmail.com", "Sistem administrasi penyimpanan"); //email pengirim
        $mail->addAddress($emailTo); // Email penerima
        $mail->addReplyTo("no-reply@gmail.com");
        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"]). "/reset.php?reset_pass=$code"; //sesuaikan berdasarkan link server dan nama file
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Link reset password";
        $mail->Body    = "<h1>Permintaan reset password</h1><p> Klik <a href='$url'>link ini</a> untuk mereset password</p>" ;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo 'Link reset password berhasil dikirimkan ke email.';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    echo '<script>window.location.assign("password.php?success=")</script>';
    }else{
        echo '<script>window.location.assign("password.php?error=")</script>';
    }
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
        <title>Lupa password - Gudang</title>
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
                                    <?php 
                                    if(isset($_GET["error"])==true){
                                        echo '
                                        <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                                            Email <strong> tidak </strong> ditemukan. Silahkan coba lagi.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                                    } elseif(isset($_GET["success"])==true){
                                        echo '
                                        <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                            Permintaan reset password <strong> berhasil </strong>.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                                    }
                                        ?>
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login.php">Return to login</a>
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
