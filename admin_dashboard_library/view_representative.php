<?php

require_once "ControlAdmin.php";
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
    <link rel="stylesheet" href="css/style-admin.css">
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
                            <a class="m-0 btn float-start font-weight-bold text-light" href="list-representative.php"
                                style="background-color: #336666;"><i class="fa-solid fa-backward"></i> Back</a>

                        </div>
                        <div class="card-body p-0">


                            <div class="container">
                                <div class="">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <?php
                                    if(isset($_GET['id'])){
                                        $select_teacher_id = $_GET['id'];
                                        $select_teacher ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                        FROM member INNER JOIN major_tb ON member.select_major=major_tb.id WHERE  member.id=$select_teacher_id";
                                        // $select_teacher = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                        //     teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                        //     teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                        //     teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_tb.id=$select_teacher_id";

                                        $result_select_teacher = $conn->query($select_teacher);
                                        if($result_select_teacher->num_rows>0){
                                            while($row_select_teacher = $result_select_teacher->fetch_assoc()){
                                                $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($row_select_teacher['detail']),$trans);
                                                $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                                                
                                                ?>
                                        <div class="">
                                            <div class="card shadow my-4">

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3 d-flex justify-content-center">
                                                            <div class="profile-teacher-representative"
                                                                style=" height: 10rem; width: 10rem; border-radius: 50%; border: 2px solid #336666;">
                                                                <?php
                                                                if($row_select_teacher["image"]==''){
                                                                    ?>
                                                                <img src="uploads/6623e85eb58a1.png" alt=""
                                                                    style="width: 100%; height: 100%; border-radius: 50%;">
                                                                <?php
                                                                }else{
                                                                    ?><?php
                                                                foreach (json_decode($row_select_teacher["image"]) as
                                                                $image) : ?>
                                                                <img src="uploads/<?php echo $image; ?>"
                                                                    style="width: 100%; height: 100%; border-radius: 50%;">
                                                                <?php endforeach; 
                                                                }
?>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                            <span
                                                                                class="list-staf fw-bolder">អត្ថលេខ</span>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <span class="main-conlor fw-bolder">
                                                                                :*</span>
                                                                            <span
                                                                                class="detail-digital"><?php echo $row_select_teacher['id']?></span>
                                                                        </div>
                                                                    </div>

                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                            <span
                                                                                class="list-staf fw-bolder">ឈ្មោះ</span>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <span class="main-conlor fw-bolder">
                                                                                :*</span>
                                                                            <span class="detail-digital mx-4">
                                                                                <?php echo $row_select_teacher['firstname'] .$row_select_teacher['firstname']?>
                                                                            </span>
                                                                        </div>
                                                                    </div>


                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                            <span
                                                                                class="list-staf fw-bolder">អ៊ីម៉ែល</span>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <span class="main-conlor fw-bolder">
                                                                                :*</span>
                                                                            <span
                                                                                class="detail-digital mx-4"><?php echo $row_select_teacher['email']?></span>
                                                                        </div>
                                                                    </div>

                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                            <span
                                                                                class="detail-digital fw-bolder">លេខទូរស័ព្ទ</span>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <span class="main-conlor fw-bolder">
                                                                                :*</span>
                                                                            <span
                                                                                class="detail-digital mx-4"><?php echo $row_select_teacher['phone']?></span>
                                                                        </div>
                                                                    </div>

                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <span class="list-staf fw-bolder">ជំនាញ</span>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <span class="main-conlor fw-bolder"> :*</span>
                                                        <span
                                                            class="detail-digital mx-4"><?php echo $row_select_teacher['major_title']?></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <span class="list-staf fw-bolder">ឯកទេស</span>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <span class="main-conlor fw-bolder"> :*</span>
                                                        <span
                                                            class="detail-digital mx-4"><?php echo $row_select_teacher['specialty']?></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <span class="list-staf fw-bolder">តួនាទី</span>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <span class="main-conlor fw-bolder"> :*</span>
                                                        <span
                                                            class="detail-digital mx-4"><?php echo $row_select_teacher['select_role']?></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <span class="list-staf fw-bolder">អំពីរពត៌មាន</span>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <span class="main-conlor fw-bolder"> :*</span>
                                                        <span class="detail-digital"><?php echo $desc?></span>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>



                                        <?php
                                            }
                                        }
                                    }
                                    ?>

                                    </form>
                                </div>
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

</body>

</html>