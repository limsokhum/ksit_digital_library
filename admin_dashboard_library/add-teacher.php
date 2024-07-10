<?php
require_once "ControlAdmin.php";
require_once "ControlTeacher.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE ((select_role='អ្នកគ្រប់គ្រង') AND (email = '$email'))";
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
            header('Location: login.php');
        }
    }
}else{
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
    <style>
    #teacher_passwords {
        display: none;
    }
    </style>
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
                                <form action="add-teacher.php" method="post" enctype="multipart/form-data">
                                    <?php
                                    if(count($teacher_errors) == 1){
                                        ?>
                                    <div class="alert alert-danger text-center">
                                        <?php
                                    foreach($teacher_errors as $teacher_showerror){
                                        echo $teacher_showerror;
                                    }
                                    ?>
                                    </div>
                                    <?php
                                    }elseif(count($teacher_errors) > 1){
                                        ?>
                                    <div class="alert alert-danger">
                                        <?php
                                    foreach($teacher_errors as $teacher_showerror){
                                        ?>
                                        <li><?php echo $teacher_showerror; ?></li>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <?php
                                    }
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
                                                    class=" form-control form-control" autocomplete="off">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">នាមត្រកូល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="firstname" class="form-control form-control"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">នាមខ្លួន
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="lastname" class="form-control form-control"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">

                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ភេទ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="radio" name="sex"
                                                        value="ប្រុស" checked="checked">
                                                    <label class="form-check-label"
                                                        style="font-family:Khmer OS System;">ប្រុស
                                                    </label>,
                                                    <div class="form-check mx-4">
                                                        <input class="form-check-input" type="radio" id="" name="sex"
                                                            value="ស្រី">
                                                        <label class="form-check-label"
                                                            style="font-family:Khmer OS System;">ស្រី</label>,
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">


                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">អ៊ីម៉ែល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="email" name="teacher_email"
                                                    class=" form-control form-control" autocomplete="off"
                                                    value="<?php echo $teacher_email ?>">

                                            </div>
                                            <div class="col-sm-4">


                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">លេខទូរស័ព្ទ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="phone" class="form-control form-control"
                                                    autocomplete="off">


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">


                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជំនាញ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>

                                                <select name="select_major" class="form-control"
                                                    aria-label="Default select">
                                                    <option selected>ជ្រើសរើសជំនាញ</option>
                                                    <?php
                                                $department_tb = "SELECT * FROM major_tb";
                                                $department_tb_result = $conn -> query($department_tb);
                                                if($department_tb_result->num_rows > 0){
                                                    while($row = $department_tb_result -> fetch_assoc()){
                                                        ?>
                                                    <option value="<?php echo ($row['id'])?>">
                                                        <?php echo ($row['major_title'])?>
                                                    </option>
                                                    <?php
                                                }
                                                }
                                                ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-4">



                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ឯកទេស
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="specialty" class="form-control form-control"
                                                    autocomplete="off">


                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជ្រើសរើសតួនាទី
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="form-check d-flex">
                                                    <input onclick="onclickShow()" class="form-check-input" type="radio"
                                                        name="select_role" value="បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់">
                                                    <label class="form-check-label"
                                                        style="font-family:Khmer OS System;">ដំណាងដេប៉ាតឺម៉ង់
                                                    </label>,
                                                    <div class="form-check mx-4">
                                                        <input class="form-check-input" type="radio" id=""
                                                            name="select_role" value="គ្រូបង្រៀន" checked>
                                                        <label class="form-check-label"
                                                            style="font-family:Khmer OS System;">គ្រូបង្រៀន</label>,
                                                    </div>
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
                                                        <input type="password" name="teacher_password"
                                                            class="form-control form-control" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="label-control" for=""
                                                            style="font-family:'Koulen', sans-serif;">ផ្ទៀងផ្ទាត់លេខសម្ងាត់
                                                            <spatn class="text-danger">:*
                                                            </spatn>
                                                        </label>
                                                        <input type="password" name="teacher_cpassword"
                                                            class="form-control form-control" autocomplete="off">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="customFile"
                                                    style="font-family:'Koulen', sans-serif;">រូបភាព
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="image">
                                                    <input type="file" class="btn btn-secondary" name="fileImg[]"
                                                        accept=".jpg, .jpeg, .png" multiple>
                                                </div>

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
                                        </textarea>
                                    </div>

                                    <button type="submit" name="teacher_signup" class=" btn btn-primary"><i
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
        document.getElementById('teacher_passwords').style.display = "block";
    }
    </script>
</body>

</html>