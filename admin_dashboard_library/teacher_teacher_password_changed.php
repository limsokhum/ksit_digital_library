<?php
session_start();

require_once "ControlTeacher.php";
if($_SESSION['teacher_info'] == false){
    header('Location: login-teacher.php');  
}
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
            <div class="col-md-4 offset-md-4 form login-form">
                <img class="logo-form" src="img/logo-login.png" alt="">
                <?php 
            if(isset($_SESSION['teacher_info'])){
                ?>
                <div class="alert alert-success text-center">
                    <?php echo $_SESSION['teacher_info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="login-teacher.php" method="POST">
                    <div class="form-group">
                        <button class="form-control btn btn-info" type="submit" name="teacher_login-now"><i
                                class="fa-solid fa-right-to-bracket"></i> ចូលម្ដងទៀត</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>