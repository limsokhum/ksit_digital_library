<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Digital library management system for Kampong spue Institute of Technology</title>
    <!-- Icon Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <img class="logo-form" src="assets/images/logo-login.png" alt="">
                    <p class="text-center">បំពេញអ៊ីម៉ែលរបស់អ្នក</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                    <div class="alert alert-danger text-center">
                        <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="បំពេញអ៊ីម៉ែល"
                            autocomplete="off" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="ចូលបន្ដ">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>