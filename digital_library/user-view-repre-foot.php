<?php
require_once('controllerUserData.php');

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE ((select_role='អ្នកប្រើប្រាស់') AND (email = '$email'))";
    $run_Sql = mysqli_query($conn, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status']; 
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: index.php');
        }
    }
}else{
    header('Location: index.php');
}
?>
<?php
 if(isset($_POST['edit_profile'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $teacher_advisor = mysqli_real_escape_string($conn, $_POST['teacher_advisor']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    
    $totalFiles = count($_FILES['fileImg']['name']);
    $filesArray = array();

    for($i = 0; $i < $totalFiles; $i++){
    $imageName = $_FILES["fileImg"]["name"][$i];
    $tmpName = $_FILES["fileImg"]["tmp_name"][$i];

    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));

    $newImageName = uniqid() . '.' . $imageExtension;

    move_uploaded_file($tmpName, '../admin_dashboard_library/uploads/' . $newImageName);
    $filesArray[] = $newImageName;
    }

    $filesArray = json_encode($filesArray);
    
    $code = 0;
    
    $status = "verified";
    
    if($password==NULL && $cpassword==NULL && $filesArray==NULL ){
        $update_pass = "UPDATE member SET name ='$name', email='$email',code='$code',status='$status' WHERE email = '$email'";
    }elseif($password==NULL && $cpassword==NULL && $filesArray==NULL){
        $update_pass = "UPDATE member SET name ='$name', email='$email' ,code='$code',status='$status' WHERE email = '$email'";
    }elseif($password==NULL && $cpassword==NULL && $filesArray!==NULL){
        $update_pass = "UPDATE member SET name ='$name', email='$email',teacher_advisor='$teacher_advisor',image='$filesArray',code='$code',status='$status' WHERE email = '$email'";
    }else{
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE member SET name ='$name', email='$email', teacher_advisor='$teacher_advisor', password = '$encpass',  image='$filesArray',code='$code', status='$status' WHERE email = '$email'";
    }
    $result_editprofile =$conn ->query($update_pass);
    if($result_editprofile==true){
        $_SESSION['status'] = "<Type Your success message here>";
    }
}
?>



<?php
$query_user_prifile="SELECT * FROM member WHERE email = '$email'";
// WHERE email = '$email'
$result_user_profile = $conn->query($query_user_prifile);
if($result_user_profile ->num_rows>0){
    while($row_user_profile = $result_user_profile->fetch_assoc()){
        ?>
<!-- Start Modal Bootstrap 5 -->
<div class="modal fade" id="exampleModal" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"
                        style="font-family:'Koulen', sans-serif; color: #336666;">
                        Chang Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="label-control mb-1" for="" style="font-family:'Koulen', sans-serif;">ឈ្មោះ
                            <spatn class=" text-danger">:*
                            </spatn>
                        </label>
                        <input type="text" name="name" class="form-control" id=""
                            value="<?php echo $row_user_profile['name']?>"
                            style="font-family: 'Noto Serif Khmer', serif;">
                    </div>
                    <div class="form-group my-2">
                        <label class="label-control mb-1" for="" style="font-family:'Koulen', sans-serif;">អ៊ីម៉ែល
                            <spatn class=" text-danger">:*
                            </spatn>
                        </label>
                        <input type="text" name="email" class="form-control" id=""
                            value="<?php echo $row_user_profile['email']?>"
                            style="font-family: 'Noto Serif Khmer', serif;">
                    </div>
                    <div class="form-group my-2">
                        <label class="label-control" for=""
                            style="font-family:'Koulen', sans-serif;">តើអ្នកចង់ប្ដូលេខសម្ងាត់ឬ ?

                        </label>
                        <div class="form-check d-flex">
                            <input onclick="onclickshowTeacherAdvisor()" class="form-check-input" type="radio" value="">
                            <label class="form-check-label mx-1" style="font-family:Khmer OS System;"> ប្ដូលេខសម្ងាត់
                            </label>
                        </div>
                    </div>
                    <div id="passwords" class="hidden-changpassword">
                        <div class="form-group">
                            <label class="label-control my-1" for=""
                                style="font-family:'Koulen', sans-serif;">លេខសម្ងាត់
                                <spatn class=" text-danger">:*
                                </spatn>
                            </label>
                            <input type="password" name="password" class="text-input form-control" id="">

                        </div>
                        <div class="form-group my-2">
                            <label class="label-control" for="" style="font-family:'Koulen', sans-serif;">បញ្ជាក់
                                <spatn class=" text-danger">:*
                                </spatn>
                            </label>
                            <input type="password" name="cpassword" class="form-control form-control">
                        </div>
                    </div>

                    <div class="form-group my-2">
                        <label class="label-control" for=""
                            style="font-family:'Koulen', sans-serif;">តើអ្នកចង់ផ្លាស់ប្ដូគ្រូជំនួយការឬ ?

                        </label>
                        <div class="form-check d-flex">
                            <input onclick="onclickShow()" class="form-check-input" type="radio" name="select_role"
                                value="">

                            <label class="form-check-label mx-1" style="font-family:Khmer OS System;"> ប្ដូគ្រូជំនួយការ
                            </label>
                        </div>
                    </div>
                    <div id="teacher_advisor" class="hidden-teacher-advisor">
                        <select name="teacher_advisor" class="form-select form-control">
                            <option selected>ជ្រើសរើសជំនួយការ *</option>
                            <?php
                            $select_teacher_advisor = "SELECT * FROM member WHERE  select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់'";
                            $re_select_teacher_advisor = $conn->query($select_teacher_advisor);
                            if($re_select_teacher_advisor -> num_rows >0){
                                while($ro_select_teacher_advisor= $re_select_teacher_advisor ->fetch_assoc()){
                                    ?>
                            <option value="<?php echo $ro_select_teacher_advisor['id'];?>">
                                <?php echo $ro_select_teacher_advisor['firstname']; echo  $ro_select_teacher_advisor['id']?>
                                <?php echo $ro_select_teacher_advisor['lastname']; ?>
                            </option>
                            <?php
                                }
                            }
                            ?>


                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="label-control my-1" for="" style="font-family:'Koulen', sans-serif;">រូប
                                profile
                                <spatn class=" text-danger">:*
                                </spatn>
                            </label>
                            <div class="file-input">
                                <input type="file" class="btn btn-secondary text-input" name="fileImg[]"
                                    accept=".jpg, .jpeg, .png" multiple>
                            </div>
                        </div>

                    </div>
                    <div class="view-profile">

                        <?php
                        if($row_user_profile['image']==NULL){
                            ?>
                        <img class="w-100" src="assets/images/user-profile.png" alt="">
                        <?php
                        }else{
                            foreach (json_decode($row_user_profile["image"]) as $image) : ?>
                        <img class="w-100" src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                        <?php endforeach; 
                        }
                         ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="font-family:' Koulen', sans-serif;">Close</button>

                    <button type="submit" name="edit_profile" class="btn text-light"
                        style=" background-color: #336666; font-family:'Koulen', sans-serif;">Save
                        changes</button>
                </div>
        </div>

        </form>
    </div>
</div>
<!-- Ent Modal Bootstrap 5 -->
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Custom CSS3 -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Icon Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Default Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>Digital library management system for Kampong spue Institute of Technology</title>
</head>

<body style="background-color: #dedede;">
    <!-- Scroll to Top -->
    <div onclick="topFunction()" id="myBtn"><i class="fa-solid fa-circle-chevron-up"
            style="color: orange; font-size: 1.4rem;"></i>
    </div>

    <!-- Start Section Top Bar -->
    <?php include('includes/user-topbar.php');?>

    <!-- Ent Section Top Bar -->

    <!-- Start Navigation Bar -->
    <?php include('includes/navbar-user.php');?>

    <!-- Ent Navigation Bar -->

    <!-- Start All Section Start Content -->
    <div class="container">
        <!-- Start Content Computer -->
        <div class="section-computer mt-2">

            <div class="title d-flex">
                <div class="computer">
                    <h5>ប្រធាន</h5>
                </div>
                <div class="rows"></div>
            </div>

            <div class="card" style="width: 100%;">

                <div class="container row my-4">
                    <div class="col-sm-8">
                        <div class="container">
                            <div class="card my-2" style="width: 100%; border-color: orange;">

                                <?php
                                if(isset($_GET['id'])){
                                    $teacher_representative = $_GET['id'];
                                    ?>
                                <div class="container">
                                    <?php
                                    $select_representative ="SELECT * FROM member WHERE 	select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់' && id=$teacher_representative";
                                    $result_representative = $conn->query($select_representative);
                                    if($result_representative->num_rows>0){
                                        while($row_representative = $result_representative->fetch_assoc()){
                                            $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($row_representative['detail']),$trans);
                                                $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                                            ?>
                                    <div class="card-body">
                                        <h5 class="staff-title">នាយក</h5>
                                        <div class="rowses"></div>
                                        <div class="control-profile row my-2">
                                            <div class="col-sm-4 staff-profile">
                                                <div class="bg-profile">
                                                    <?php
                                                        foreach (json_decode($row_representative["image"]) as $image) : ?>
                                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                                    <?php endforeach; ?>
                                                </div>
                                                <!-- <div class="staff-name text-center mt-2">
                                                        <h6 class="staff-name">Name: SOKHUM</h6>
                                                    </div> -->
                                            </div>
                                            <div class="col-sm-8">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">ឈ្មោះ</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span
                                                                    class="detail-staf mx-2"><?php echo $row_representative['firstname']. $row_representative['lastname']?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">ភេទ</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span class="detail-staf mx-2">ប្រុស</span>
                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">អ៊ីម៊ែល</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span
                                                                    class="detail-staf mx-2"><?php echo $row_representative['email']?></span>
                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">ទូរស័ព្ទ</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span
                                                                    class="detail-staf mx-2"><?php echo $row_representative['phone']?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="conten-show-more">
                                            <div class="title-about-staf my-3">
                                                <span class="list-staf fw-bolder">អំពីរប្រធាន៖</span>
                                            </div>

                                            <div class="descript">
                                                <?php echo $desc;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                }
                                ?>




                            </div>
                            <div class="card my-2" style="width: 100%; border-color: orange;">

                                <div class="container">
                                    <div class="card-body">
                                        <h5 class="staff-title">សមាជិក</h5>
                                        <div class="rowses"></div>
                                        <div class="control-profile my-2">
                                            <?php
                                             $select_teacher ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.email,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                             FROM member INNER JOIN major_tb ON member.select_major=major_tb.id  WHERE (major_title = 'បច្ចេកវិទ្យាអាហារ') AND (select_role='គ្រូបង្រៀន')";
                                            // $select_teacher="SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                            // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE (major_title = 'បច្ចេកវិទ្យាអាហារ') AND (select_role='គ្រូបង្រៀន')";
                                            $result_teacher = $conn->query($select_teacher);
                                            if($result_teacher->num_rows>0){
                                                while($row_teacher = $result_teacher->fetch_assoc()){
                                                    ?>
                                            <a href="view-teacher-staff-page.php?id=<?php echo $row_teacher['id']?>"
                                                class="text-dark text-decoration-none">
                                                <div class="staff-profile">
                                                    <div class="bg-profile">
                                                        <?php
                                                        foreach (json_decode($row_teacher["image"]) as $image) : ?>
                                                        <img
                                                            src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="staff-name text-center mt-2">
                                                        <h6 class="staff-name"
                                                            style="font-family: 'Noto Serif Khmer', serif;">
                                                            <?php echo $row_teacher['firstname']. $row_teacher['lastname']?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card-body major-study">
                            <h6 class="major-title">បុគ្គលិកបង្រៀន</h6>
                            <ul>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញវិទ្យាសាស្រ្តដំណាំ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញវិទ្យាសាស្រ្តសត្វ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញវិទ្យាសាស្រ្តជលផល</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញកុំព្យូទ័រធុរកិច្ច</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញបច្ចេកវិទ្យាកុំព្យូទ័រ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញបច្ចេកវិទ្យាមេកានិច</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញបច្ចេកវិទ្យាអាហារ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ផ្នែកអប់រំបច្ចេកទេសវិជ្ជាជីវៈកម្រិត៣
                                        "បសុវប្បកម្ម"</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Ent Content Computer -->

    </div>
    <!-- Ent All Section Start Content -->
    <!-- Start Bottom Footer -->
    <?php include('includes/footer.php');?>

    <!-- Start Bottom Footer -->
    <!-- Start Bottom Footer Copyright -->
    <?php include('includes/bottom.php');?>

    <!-- Ent Bottom Footer Copyright -->
    <script>
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('.nav-link');
    const menuLength = menuItem.length;

    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].classList.add("active");
        }
    }
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    </script>
    <script>
    function onclickShow() {
        document.getElementById('passwords').style.display = "block";
    }

    function onclickRemove() {
        document.getElementById('passwords').style.display = "none";
    }
    </script>

    <!-- Script Js Default Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>