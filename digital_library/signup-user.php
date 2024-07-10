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
                <form action="signup-user.php" method="POST" autocomplete="">
                    <img class="logo-form" src="assets/images/logo-login.png" alt="">
                    <marquee direction="left ">
                        <h5 class="text-center marquee">សូមស្វាគមន៍មកកាន់
                            ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យឌីជីថលវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</h5>
                    </marquee>
                    <?php
                    if(count($errors) == 1){
                        ?>
                    <div class="alert alert-danger text-center">
                        <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                    </div>
                    <?php
                    }elseif(count($errors) > 1){
                        ?>
                    <div class="alert alert-danger">
                        <?php
                            foreach($errors as $showerror){
                                ?>
                        <li><?php echo $showerror; ?></li>
                        <?php
                            }
                            ?>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="ឈ្មោះ *..." required
                            value="<?php echo $name ?>">

                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="អ៊ីម៊ែល *..." required
                            value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <select name="teacher_advisor" class="form-select form-control">
                            <option class="py-2" selected>ជ្រើសរើសជំនួយការ *</option>
                            <?php
                            $select_teacher_advisor = "SELECT * FROM member WHERE  select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់'";
                            $re_select_teacher_advisor = $conn->query($select_teacher_advisor);
                            if($re_select_teacher_advisor -> num_rows >0){
                                while($ro_select_teacher_advisor= $re_select_teacher_advisor ->fetch_assoc()){
                                    ?>
                            <option
                                value="<?php echo $ro_select_teacher_advisor['firstname'].$ro_select_teacher_advisor['lastname'];?>">
                                <?php echo $ro_select_teacher_advisor['firstname'];?>
                                <?php echo $ro_select_teacher_advisor['lastname']; ?>
                            </option>
                            <?php
                                }
                            }
                            ?>


                        </select>
                        <!-- <input class="form-control" type="email" name="email" placeholder="អ៊ីម៊ែល" required
                            value="<?php echo $email ?>"> -->
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="លេខសម្ងាត់ *..."
                            required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword"
                            placeholder="បញ្ជាក់លេខសម្ងាត់ *..." required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="ចុះឈ្មោះ ">
                    </div>
                    <div class="link login-link text-center">ប្រសិនបើអ្នកបានចុះឈ្មោះរួច? <a
                            href="login-user.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>