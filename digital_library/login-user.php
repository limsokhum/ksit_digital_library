<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Digital library management system for Kampong spue Institute of Technology</title>
    <!-- Icon Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <img class="logo-form" src="assets/images/logo-login.png" alt="">
                    <marquee direction="left ">
                        <h5 class="text-center marquee">សូមស្វាគមន៍មកកាន់
                            ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យឌីជីថលវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</h5>
                    </marquee>
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
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="អ៊ីម៊ែល *..." required
                            value="<?php echo $email ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="លេខសម្ងាត់ *..."
                            autocomplete="off" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">តើអ្នកភ្លេចលេខសម្ងាត់?</a>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="ចូល">
                    </div>
                    <div class="link login-link text-center">តើមិនទាន់ចុះឈ្មោះឬ? <a
                            href="signup-user.php">ចុះឈ្មោះឥឡូវ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>