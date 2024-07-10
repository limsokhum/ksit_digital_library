<?php 
require_once "ControlAdmin.php";
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Digital library management system for Kampong spue Institute of Technology</title>
    <!-- Link Favicon -->
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon">
    <!-- Link Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="" style="background-color: #336666;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center vh-100 align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"
                                style="background-image: url('img/banner-journal.png');"></div>
                            <div class="col-lg-6">
                                <div class="p-4">

                                    <img src="img/logo-login.png" alt="state" style="width: 24rem">

                                    <div class="text-center">
                                        <?php 
                                        if(isset($_SESSION['info'])){
                                            ?>
                                        <div class="alert alert-success text-center">
                                            <?php echo $_SESSION['info']; ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if(count($errors) > 0){
                                        ?>
                                        <div class="alert alert-danger text-center">
                                            <?php
                                        foreach($errors as $showerror){
                                            echo $showerror;
                                        }
                                        ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <form action="reset-code.php" method="POST" autocomplete="off">
                                        <div class="form-group">
                                            <input class="form-control" type="number" name="otp"
                                                placeholder="Enter verification code" required>
                                        </div>
                                        <button class="btn" style="background-color: #336666; color: white;"
                                            type="submit" name="check-reset-otp"><i
                                                class="fa-solid fa-right-to-bracket"></i> ចូលបន្ដទៀត</button>
                                        <!-- <input class="form-control btn" style="background-color: #336666; color: white;"
                                            type="submit" name="check-reset-otp" value="Submit"> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        ប្រសិនបើអ្នកមានគណនេយ្យ<a class="small text-danger" style="font-weight: bold;"
                                            href="login.php">
                                            ចុកចូលនៅទីនេះ!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>