<?php 
session_start();
require_once "ControlTeacher.php";
$teacher_email = $_SESSION['teacher_email'];
// if($teacher_emails == false){
//   header('Location: login-teacher.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Digital library management system for Kampong spue Institute of Technology</title>
    <!-- Icon Favicon -->
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 form">
                <form action="teacher_teacher_reset-code.php" method="POST" autocomplete="off">
                    <img class="logo-form" src="img/logo-login.png" alt="">
                    <?php 
                    if(isset($_SESSION['teacher_info'])){
                        ?>
                    <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                        <?php echo $_SESSION['teacher_info']; ?>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if(count($teacher_errors) > 0){
                        ?>
                    <div class="alert alert-danger text-center">
                        <?php
                            foreach($teacher_errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="teacher_otp" placeholder="បំពេញលេខ ៦ ខ្ទង់..."
                            required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit" name="teacher_check-reset-otp"><i
                                class="fa-solid fa-right-to-bracket"></i> បន្តទៀត</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>