<?php
require_once "ControlAdmin.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE email = '$email'";
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
            header('Location: admin-otp.php');
        }
    }
}else{
    header('Location: login.php');
}

if(isset($_GET['id'])){
    $setion_edit_teacher = $_GET['id'];
    if(isset($_POST['submit'])){
        $teacher_id = $_POST['teacher_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $teacher_email = $_POST['teacher_email'];
        $phone = $_POST['phone'];
        $select_major = $_POST['select_major'];
        $specialty = $_POST['specialty'];
        $select_role = $_POST['select_role'];
        $teacher_password = $_POST['teacher_password'];
        $teacher_encpass = password_hash($teacher_password, PASSWORD_BCRYPT);
        
        $totalFiles = count($_FILES['fileImg']['name']);
        $filesArray = array();
        
        for($i = 0; $i < $totalFiles; $i++){
          $imageName = $_FILES["fileImg"]["name"][$i];
          $tmpName = $_FILES["fileImg"]["tmp_name"][$i];
      
          $imageExtension = explode('.', $imageName);
          $imageExtension = strtolower(end($imageExtension));
      
          $newImageName = uniqid() . '.' . $imageExtension;
                                                    
          move_uploaded_file($tmpName, 'uploads/' . $newImageName);
          $filesArray[] = $newImageName;
        }
      
        $filesArray = json_encode($filesArray);
        
        $teacher_code = 0;
        $teacher_status = "verified";
        $teacher_detials = $_POST['teacher_detials'];
        
        $query_update_teacher = "UPDATE member SET member_id='$teacher_id', firstname='$firstname', lastname='$lastname', email='$teacher_email', phone='$phone', select_major='$select_major', specialty='$specialty', select_role='$select_role', password='$teacher_encpass', image='$filesArray', detail='$teacher_detials', code='$teacher_code', status='$teacher_status' WHERE id=$setion_edit_teacher";
        
         mysqli_query($conn, $query_update_teacher); 
         $result_update_teacher = $conn->query($query_update_teacher);
         
         if($result_update_teacher==TRUE){
            $_SESSION['status'] = "<Type Your success message here>";
         }
         
        //  echo "
        //  <script>
        //    alert('Successfully Added');
        //    document.location.href = 'index.php';
        //  </script>
        //  " ;
    }
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

    <!-- Google Font Koulen -->
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon">

    <!-- Link CND font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom Text Editor -->
    <link rel="stylesheet" href="vendor/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="css/sb-admin.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('sidebar.php')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include ('topbar.php')?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Add Teacher</h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3">
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">

                                <?php
                                     if(isset($_SESSION['status']))
                                     {
                                         ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>អ្នកបានធ្វើការកែសម្រួលទិន្នន័យរួចជាស្រេច!</strong> .អ្នកអាចស្វែងរកនៅក្នុង
                                    បញ្ជីបាន
                                </div>
                                <?php 
                                         unset($_SESSION['status']);
                                     }
                                    ?>

                                <form action="" method="post" enctype="multipart/form-data">

                                    <?php
                                    $setion_edit_teacher = $_GET['id'];
                                    // $select_edit_teacher = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                    // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                    // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                    // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_tb.id = '$setion_edit_teacher'";
                                    $select_edit_teacher="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title
                                                                FROM member INNER JOIN major_tb ON member.select_major=major_tb.id WHERE member.id = '$setion_edit_teacher'";
                                    $result_select_edit_teacher = $conn -> query($select_edit_teacher);
                                    if($result_select_edit_teacher -> num_rows > 0){
                                        while($row_select_edit_teahcer = $result_select_edit_teacher-> fetch_assoc()){
                                            $select_major_edit_teacher = $row_select_edit_teahcer['select_major'];
                                            $select_teacher_role_main = $row_select_edit_teahcer['select_role'];
                                            
                                           ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">អត្ដលេខ

                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type=" number" name="teacher_id"
                                                    class=" form-control form-control"
                                                    value="<?php echo $row_select_edit_teahcer['member_id']?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">នាមត្រកូល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="firstname" class="form-control form-control"
                                                    value="<?php echo $row_select_edit_teahcer['firstname']?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">នាមខ្លួន
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="lastname" class="form-control form-control"
                                                    value="<?php echo $row_select_edit_teahcer['lastname']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">អ៊ីម៉ែល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="email" name="teacher_email"
                                                    class=" form-control form-control"
                                                    value="<?php echo $row_select_edit_teahcer['email']?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">លេខទូរស័ព្ទ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="phone" class="form-control form-control"
                                                    value="<?php echo $row_select_edit_teahcer['phone']?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជំនាញ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <select name="select_major" class="form-control"
                                                    aria-label="Default select">
                                                    <option>ជ្រើសរើសជំនាញ</option>
                                                    <?php
                                                $department_tb = "SELECT * FROM major_tb";
                                                $department_tb_result = $conn -> query($department_tb);
                                                if($department_tb_result->num_rows > 0){
                                                    while($row = $department_tb_result -> fetch_assoc()){
                                                        ?>
                                                    <?php
                                                    if($select_major_edit_teacher==$row['id']){
                                                        ?>
                                                    <option value="<?php echo $row['id']?>" selected>
                                                        <?php echo $row['major_title']?>
                                                    </option>
                                                    <?php
                                                    }elseif($select_major_edit_teacher != $row['id']){
                                                        ?>
                                                    <option value="<?php echo $row['id']?>">
                                                        <?php echo $row['major_title']?>
                                                    </option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                }
                                                ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ឯកទេស
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="specialty" class="form-control form-control"
                                                    value="<?php echo $row_select_edit_teahcer['specialty']?>">
                                            </div>
                                            <div class=" col-sm-8">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជ្រើសរើសតួនាទី
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="form-check d-flex">
                                                    <?php
                                                $select_teacher_role = "SELECT * FROM member where member.id = '$setion_edit_teacher'";
                                                $query_teachr_role = $conn->query($select_teacher_role);
                                                if($query_teachr_role->num_rows>0){
                                                    while($row_select_teacher_role = $query_teachr_role->fetch_assoc()){
                                                        if($select_teacher_role_main == 'បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់'){
                                                            ?>
                                                    <input onclick="onclickShow()" class="form-check-input" type="radio"
                                                        name="select_role" value="បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់" checked>
                                                    <label class="form-check-label"
                                                        style="font-family:Khmer OS System;">បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់
                                                    </label>,
                                                    <div class="form-check mx-4">
                                                        <input onclick="onclickRemove()" class="form-check-input"
                                                            type="radio" id="" name="select_role" value="គ្រូបង្រៀន">
                                                        <label class="form-check-label"
                                                            style="font-family:Khmer OS System;">គ្រូបង្រៀន</label>,
                                                    </div>
                                                    <?php

                                                    }elseif($select_teacher_role_main == 'គ្រូបង្រៀន'){
                                                    ?>
                                                    <input onclick="onclickShow()" class="form-check-input" type="radio"
                                                        name="select_role" value="បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់">
                                                    <label class="form-check-label"
                                                        style="font-family:Khmer OS System;">បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់
                                                    </label>,
                                                    <div class="form-check mx-4">
                                                        <input onclick="onclickRemove()" class="form-check-input"
                                                            type="radio" id="" name="select_role" value="គ្រូបង្រៀន"
                                                            checked>
                                                        <label class="form-check-label"
                                                            style="font-family:Khmer OS System;">គ្រូបង្រៀន</label>,
                                                    </div>
                                                    <?php
                                                    }

                                                    }
                                                    }
                                                    ?>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div id="teacher_passwords" class="col-sm-8">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="label-control" for=""
                                                            style="font-family:'Koulen', sans-serif;">លេខសម្ងាត់
                                                            <spatn class="text-danger">:*
                                                            </spatn>
                                                        </label>
                                                        <input type="text" name="teacher_password"
                                                            class="form-control form-control" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="label-control" for=""
                                                            style="font-family:'Koulen', sans-serif;">ផ្ទៀងផ្ទាត់លេខសម្ងាត់
                                                            <spatn class="text-danger">:*
                                                            </spatn>
                                                        </label>
                                                        <input type="text" name="" class="form-control form-control"
                                                            autocomplete="off">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="customFile"
                                                    style="font-family:'Koulen', sans-serif;">រូបភាព
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>

                                                <input type="file" class="btn btn-secondary" name="fileImg[]"
                                                    accept=".jpg, .jpeg, .png" multiple>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for=""
                                            style="font-family:'Koulen', sans-serif;">អំពីរពត៌មាន
                                            (- summary, -
                                            Education
                                            Background, - Spacail Skill, - Award, - Work Experiences) <spatn
                                                class="text-danger">:*
                                            </spatn></label>
                                        <textarea name="teacher_detials" id="" cols="30" rows="10"
                                            class="summernote form-control">
                                        <?php echo $row_select_edit_teahcer['detail']?>
                                        </textarea>
                                    </div>
                                    <?php
                                    }
                                    }
                                    ?>


                                    <button type="submit" name="submit" class=" btn"
                                        style="background-color: #336666; color: white;"><i
                                            class="fa-solid fa-circle-check"></i>
                                        Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Summernote -->
    <script src="vendor/summernote/summernote-bs4.min.js"></script>
    <script src="vendor/summernote/summernote-bs4.min.css"></script>
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
    function onclickShow() {
        document.getElementById("teacher_passwords").style.display = "block";
    }

    function onclickRemove() {
        document.getElementById("teacher_passwords").style.display = "none";
    }
    </script>
</body>

</html>