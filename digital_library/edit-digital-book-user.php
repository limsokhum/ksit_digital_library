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
if(isset($_GET['id'])){
    $query_edit_digital_book_id = $_GET['id']; // Id Selct edit 
    
    if(isset($_POST['submit'])){
        $title = $_POST['title']; 
        $name_auther = $_POST['name_auther']; 
        $date = $_POST['date'];
        $teacher_mail = $_POST['teacher_mail'];
        
        $digital_book =$_POST['digital_book'];
        $abstract = $_POST['abstract'];
        $comment = $_POST['comment'];
        $keyword = $_POST['keyword'];
    
        $status = 4;
        
        // start upload image one
        $totalFiles_one = count($_FILES['fileImg_one']['name']);
        $filesArray_one = array();
        for($i = 0; $i < $totalFiles_one; $i++){
        $imageName_one = $_FILES["fileImg_one"]["name"][$i];
        $tmpName_one = $_FILES["fileImg_one"]["tmp_name"][$i];
    
        $imageExtension_one = explode('.', $imageName_one);
        $imageExtension_one = strtolower(end($imageExtension_one));
    
        $newImageName_one = uniqid() . '.' . $imageExtension_one;
    
        move_uploaded_file($tmpName_one, '../admin_dashboard_library/uploads/' . $newImageName_one);
        $filesArray_one[] = $newImageName_one;
        }
    
        $filesArray_one = json_encode($filesArray_one);
        // ent upload image one
    
        // start upload image two
        $totalFiles_two = count($_FILES['fileImg_two']['name']);
        $filesArray_two = array();
        for($i = 0; $i < $totalFiles_two; $i++){
        $imageName_two = $_FILES["fileImg_two"]["name"][$i];
        $tmpName_two = $_FILES["fileImg_two"]["tmp_name"][$i];
    
        $imageExtension_two = explode('.', $imageName_two);
        $imageExtension_two = strtolower(end($imageExtension_two));
    
        $newImageName_two = uniqid() . '.' . $imageExtension_two;
    
        move_uploaded_file($tmpName_two, '../admin_dashboard_library/uploads/' . $newImageName_two);
        $filesArray_two[] = $newImageName_two;
        }
    
        $filesArray_two = json_encode($filesArray_two);
        // ent upload image two
        
        // Start set file
        
        $filename = $_FILES['myfile']['name'];
        //--- destination of the file on the server ---//
        $destination = '../admin_dashboard_library/uploads/' . $filename;
        //--- get the file extension ---//
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        //--- the physical file on a temporary uploads directory on the server ---//
        $file = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];

        if($file==NULL && $imageName_one==NULL && $imageName_two==NULL){
            $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',status='$status' WHERE id = $query_edit_digital_book_id";
        }
        elseif($file!=NULL && $imageName_one==NULL && $imageName_two==NULL){
                if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                    echo "You file extension must be .zip, .pdf or .docx";
                } elseif ($_FILES['myfile']['size'] > 1000000000) { 
                //--- file shouldn't be larger than 1Megabyte ---//
                    echo "File too large!";
                } else {
                    
                //-- move the uploaded (temporary) file to the specified destination --//
                    if (move_uploaded_file($file, $destination)) {
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',name='$filename',size='$size',downloads=0,view=0,status='$status' WHERE id = $query_edit_digital_book_id";
                        }
                }
            }elseif($file==NULL && $imageName_one!=NULL && $imageName_two==NULL){
                $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',image_one='$filesArray_one',status='$status' WHERE id = $query_edit_digital_book_id";
            }elseif($file==NULL && $imageName_one==NULL && $imageName_two!=NULL){
                $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',image_two='$filesArray_two',status='$status' WHERE id = $query_edit_digital_book_id";
                
            }elseif($file==NULL && $imageName_one!=NULL && $imageName_two!=NULL){
                $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment'$comment',image_one='$filesArray_one',image_two='$filesArray_two',status='$status' WHERE id = $query_edit_digital_book_id";
                
            }elseif($file!=NULL && $imageName_one!=NULL && $imageName_two==NULL){
                if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                    echo "You file extension must be .zip, .pdf or .docx";
                } elseif ($_FILES['myfile']['size'] > 1000000000) { 
                //--- file shouldn't be larger than 1Megabyte ---//
                    echo "File too large!";
                } else {
                //-- move the uploaded (temporary) file to the specified destination --//
                    
                    if (move_uploaded_file($file, $destination)) {
                        
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',image_one='$filesArray_one',name='$filename',size='$size',downloads=0,view=0,status='$status' WHERE id = $query_edit_digital_book_id";
                        }
                }
            }elseif($file!=NULL && $imageName_one==NULL && $imageName_two!=NULL){
                if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                    echo "You file extension must be .zip, .pdf or .docx";
                } elseif ($_FILES['myfile']['size'] > 1000000000) { 
                //--- file shouldn't be larger than 1Megabyte ---//
                    echo "File too large!";
                } else {
                    
                //-- move the uploaded (temporary) file to the specified destination --//
                    
                    if (move_uploaded_file($file, $destination)) {
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',image_two='$filesArray_two',name='$filename',size='$size',downloads=0,view=0,status='$status' WHERE id = $query_edit_digital_book_id";

                        }
                }
            }else{
                if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                    echo "You file extension must be .zip, .pdf or .docx";
                } elseif ($_FILES['myfile']['size'] > 1000000000) { 
                //--- file shouldn't be larger than 1Megabyte ---//
                    echo "File too large!";
                } else {
                    
                //-- move the uploaded (temporary) file to the specified destination --//
                    
                    if (move_uploaded_file($file, $destination)) {
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',digital_book='$digital_book',keyword='$keyword',abstract='$abstract',comment='$comment',image_one='$filesArray_one',image_two='$filesArray_two',name='$filename',size='$size',downloads=0,view=0,status='$status' WHERE id = $query_edit_digital_book_id";
                        }
                }
            }

            
            $result_edit_digital = $conn->query($sql);
            if ($result_edit_digital==TRUE) {
                $_SESSION['status'] = "<Type Your success message here>";
                        }

    }
    
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
$query_user_prifile="SELECT * FROM member WHERE ((select_role='អ្នកប្រើប្រាស់') AND (email = '$email'))";
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
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Google Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Default Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <!-- Start Suummernote -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- Ent Summernote -->

    <title>Digital library management system for Kampong spue Institute of Technology</title>
    <style>
    .upload-files {
        display: flex;
        justify-content: center;
        border: 2px dashed grey;
        border-radius: 5px;
    }

    .file-areas {
        padding: 20px 0px;
    }

    .file-areas h3 {
        text-align: center;
    }

    .file-areas p {
        text-align: center;
    }
    </style>
</head>

<?php 

if(isset($_GET['id'])){
    
    $edit_teacher_digital_ebook = $_GET['id'];
    
    $query_teacher_digital_ebook = "SELECT * FROM digitalbook_tb WHERE (teacher_mail = '$email') AND (id='$edit_teacher_digital_ebook')";
    
    $result_teacher_digital_ebook = $conn->query($query_teacher_digital_ebook);
    
    if($result_teacher_digital_ebook->num_rows>0){
        while($row_teacher_digital_ebook = $result_teacher_digital_ebook->fetch_assoc()){
            $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $details = strtr(html_entity_decode($row_teacher_digital_ebook['abstract']),$trans);
            $details=str_replace(array("<li>","</li>"), array("",", "), $details);
                                    
            $image_one = $row_teacher_digital_ebook['image_one'];
            $image_two = $row_teacher_digital_ebook['image_two'];
            ?>

<body style="background-color: #dedede;">
    <!-- Scroll to Top -->
    <div onclick="topFunction()" id="myBtn"><i class="fa-solid fa-circle-chevron-up"
            style="color: orange; font-size: 1.4rem;"></i></div>
    <!-- Start Section Top Bar -->
    <?php include('includes/user-topbar.php');?>
    <!-- Ent Section Top Bar -->

    <!-- Start Navigation Bar -->
    <?php include('includes/navbar-user.php');?>
    <!-- Ent Navigation Bar -->

    <!-- Start All Section Start Content -->
    <div class="container">

        <!-- Start Type Research -->
        <div class="card my-2" style="width: 100%;">
            <div class="card-body">
                <h4 class="type-research-title py-4">អ្នកអាចបញ្ចូលឯកសារឌីជីថលដូចជា៖ E-Book,
                    E-Project,
                    E-Journal
                </h4>
                <!-- <div class="header-list-digital-user">
                    <div class="myarticle">
                        <a class="btn btn-danger" href="">Back</a>
                    </div>
                    <div class="button-submit-article">
                        <a class="btn btn-primary" href="">Submit New Manuscript</a>
                    </div>
                </div> -->
                <div class="card-type-list-digital-user mt-3">
                    <?php
                                     if(isset($_SESSION['status']))
                                     {
                                         ?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>You Add Department Success!</strong> .You Can Fine on List Digital Book
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                                         unset($_SESSION['status']);
                                     }
                                    ?>
                    <?php
                    $select_user_add_digital ="SELECT * FROM member WHERE email = '$email'";
                    $result_user_add_digital = $conn->query($select_user_add_digital);
                    if($result_user_add_digital->num_rows>0){
                        while($row_user_add_digital = $result_user_add_digital->fetch_assoc()){
                            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mt-2">
                            <label class="label-control mb-1" for="" style="font-family:'Koulen', sans-serif;">ប្រធានបទ
                                Digital Book
                                <spatn class=" text-danger">:*
                                </spatn>
                            </label>
                            <input type="text" name="title" class="form-control" id=""
                                value="<?php echo $row_teacher_digital_ebook['title']?>"
                                style="font-family: 'Noto Serif Khmer', serif;">
                        </div>
                        <div class="form-group  mt-2">
                            <div class="row mb-3">
                                <div class="col-sm-5">
                                    <label class="label-control my-1" for=""
                                        style="font-family:'Koulen', sans-serif;">ឈ្មោះអ្នកនិពន្ធ
                                        <spatn class=" text-danger">:*
                                        </spatn>
                                    </label>
                                    <input type="text" name="name_auther" class="text-input form-control" id=""
                                        value="<?php echo $row_teacher_digital_ebook['name_auther']?>"
                                        style="font-family: 'Noto Serif Khmer', serif;">
                                </div>
                                <div class="col-sm-3">
                                    <label class="label-control my-1" for=""
                                        style="font-family:'Koulen', sans-serif;">កាលបរិច្ឆេត
                                        <spatn class=" text-danger">:*
                                        </spatn>
                                    </label>
                                    <input type="date" name="date" class="text-input form-control" id=""
                                        aria-describedby="" value="<?php echo $row_teacher_digital_ebook['date']?>">

                                    <input type="hidden" name="teacher_mail" class="form-control form-control" id=""
                                        value="<?php echo $row_user_add_digital['email']?>">
                                </div>
                                <div class="col-sm-4">
                                    <label class="label-control my-1" for=""
                                        style="font-family:'Koulen', sans-serif;">ប្រភេទអត្ថបទ
                                        <spatn class=" text-danger">:*
                                        </spatn>
                                    </label>
                                    <div class="radio-control">
                                        <input type="radio" name="digital_book" class="" id="" value="e-book" checked>
                                        <label for="">E-Book, </label>

                                        <input type="radio" name="digital_book" class="" id="" aria-describedby=""
                                            value="e-project">
                                        <label for="">E-Project, </label>
                                        <input type="radio" name="digital_book" class="" id="" aria-describedby=""
                                            value="e-journal">
                                        <label for="">E-Journal</label>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <label class="label-control mb-1" for=""
                                    style="font-family:'Koulen', sans-serif;">មូលន័យសង្ខេប
                                    <spatn class=" text-danger">:*
                                    </spatn>
                                </label>
                                <textarea name="abstract" id="" cols="30" rows="10"
                                    class="summernote text-input form-control">
                                    <?php echo $details;?>
                                        </textarea>
                            </div>
                            <div class="form-group my-2">
                                <label class="label-control" for=""
                                    style="font-family:'Koulen', sans-serif;">ពាក្យគន្លឺះ
                                    <spatn class=" text-danger">:*
                                    </spatn>
                                </label>
                                <input type="text" name="keyword" class="form-control form-control"
                                    value="<?php echo $row_teacher_digital_ebook['keyword']?>"
                                    style="font-family: 'Noto Serif Khmer', serif;">
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="label-control my-1" for=""
                                        style="font-family:'Koulen', sans-serif;">រូប
                                        Cover សៀវភៅ
                                        <spatn class=" text-danger">:*
                                        </spatn>
                                    </label>
                                    <div class="file-input">
                                        <input type="file" class="btn btn-secondary text-input" name="fileImg_one[]"
                                            accept=".jpg, .jpeg, .png" multiple>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="label-control my-1" for=""
                                        style="font-family:'Koulen', sans-serif;">កម្រងរូបភាព
                                        <spatn class=" text-danger">:*
                                        </spatn>
                                    </label>
                                    <div class="file-input">
                                        <input type="file" class="btn btn-secondary text-input" name="fileImg_two[]"
                                            accept=".jpg, .jpeg, .png" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="wrapper">
                                    <div class="upload-files">
                                        <div class="select-file">
                                            <div class="file-areas" data-img="">
                                                <h3>File Upload</h3>
                                                <p>Digital book must be less than <span>1G</span>
                                                </p>
                                                <input class="btn btn-secondary" type="file" name="myfile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group visually-hidden">
                                <label class="label-control my-1" for=""
                                    style="font-family:'Koulen', sans-serif;">comment
                                    <spatn class=" text-danger">:*
                                    </spatn>
                                </label>

                                <input type="hidden" name="comment" class="form-control">
                                <!-- <textarea class="form-control" id="" cols="30" rows="10"></textarea> -->
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-2"
                            style="font-family: 'Noto Serif Khmer', serif;"><i class="fa-solid fa-circle-check"></i>
                            កែសម្រួល
                        </button>
                        <a href="list-digital-book-user.php" name="back" class="btn btn-danger mt-2"
                            style="font-family: 'Noto Serif Khmer', serif;"><i class="fa-solid fa-backward"></i>
                            ថយ
                        </a>
                    </form>
                    <?php
                    }
                }
                    ?>



                </div>
            </div>
        </div>
        <!-- End Type Research -->

    </div>
    <!-- Ent All Section Start Content -->








    <!-- Start Bottom Footer -->
    <?php include('includes/footer.php');?>
    <!-- Start Bottom Footer -->
    <!-- Start Bottom Footer Copyright -->
    <?php include('includes/bottom.php');?>
    <!-- Ent Bottom Footer Copyright -->

    <script>
    $('.summernote').summernote({

        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript',
                'clear'
            ]],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ol', 'ul', 'paragraph', 'height']],
            ['table', ['table']],
            ['remove', ['removeMedia']],
            ['insert', ['link', 'unlink', 'hr']],
            ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']],

        ],

        fontNames: [
            'Khmer OS System', 'Sans', 'Khmer OS Siemreap', 'Khmer OS Muol Light', 'Courier',
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande',
            'Sacramento',
        ],
    })
    </script>
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

    <!-- Script Js Default Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js">
    </script>
</body>
<?php
        }
    }
}

?>

</html>