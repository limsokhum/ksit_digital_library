<?php 
session_start();
require_once "ControlTeacher.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Digital library management system for Kampong spue Institute of Technology</title>
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 form">
                <form action="teach_teacher-forgot-password.php" method="POST" autocomplete="">
                    <img class="logo-form" src="img/logo-login.png" alt="">
                    <p class="text-center">បំពេញអ៊ីម៉ែលរបស់អ្នក</p>
                    <?php
                        if(count($teacher_errors) > 0){
                            ?>
                    <div class="alert alert-danger text-center">
                        <?php 
                                    foreach($teacher_errors as $teacher_error){
                                        echo $teacher_error;
                                    }
                                ?>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control form-control-user" type="email" name="teacher_email"
                            placeholder="បំពេញអ៊ីម៉ែល..." required value="<?php echo $teacher_email ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit" name="teacher_check-email"><i
                                class="fa-solid fa-right-to-bracket"></i> បន្តទៀត</button>
                        <!-- <input class="btn button" value="បន្ដទៀត"> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>