<?php 
require_once "Control-Change-Password-teacher.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE ((select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់') AND (email = '$email'))";
    $run_Sql = mysqli_query($conn, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['teacher_status']; 
        $code = $fetch_info['teacher_code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: teacher-reset-codes.php');
            }
        }else{
            header('Location: index-teacher.php');
        }
    }
}else{
    header('Location: login-teacher.php');
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
    $view_teacher_ejournal = $_GET['id'];

    $query_view_teacher_ejournal = "SELECT * FROM digitalbook_tb WHERE (((teacher_mail = '$email') AND (digital_book='e-journal'))) AND (id='$view_teacher_ejournal')";
    
    $result_view_teacher_ejournal = $conn ->query($query_view_teacher_ejournal);

    if($result_view_teacher_ejournal->num_rows>0){
        
        while($row_select_teacher_ejournal = $result_view_teacher_ejournal -> fetch_assoc()){
           ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('sidebar-teacher.php')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include ('teacher-topbar.php')?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Add e-Book</h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">
                                <?php

                            $select_teacher ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                            FROM member INNER JOIN major_tb ON member.select_major=major_tb.id  WHERE email = '$email'";
                            // $select_teacher = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                            // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_mail = '$email'";
                            // WHERE teacher_mail='$teacher_email'
                            $result_select_teacher = $conn->query($select_teacher);
                            if($result_select_teacher->num_rows >0){
                                while($row_select_teacher = $result_select_teacher->fetch_assoc()){
                                    ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="label-control" for=""
                                            style="font-family:'Koulen', sans-serif;">ប្រធានបទ e-Book
                                            <spatn class=" text-danger">:*
                                            </spatn>
                                        </label>
                                        <input type="text" name="title" class="form-control form-control" id=""
                                            value="<?php echo $row_select_teacher_ejournal['title']?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ឈ្មោះអ្នកនិពន្ធ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="name_auther" class="form-control form-control"
                                                    id=""
                                                    value="<?php echo $row_select_teacher_ejournal['name_auther']?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កាលបរិច្ឆេត
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="date" name="date" class="form-control form-control" id=""
                                                    aria-describedby=""
                                                    value="<?php echo $row_select_teacher_ejournal['date']?>">


                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កម្រងរូបភាព
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="file-input">
                                                    <input type="file" class="file-control" name="fileImg[]"
                                                        accept=".jpg, .jpeg, .png" required multiple>
                                                </div> -->

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="label-control" for=""
                                                style="font-family:'Koulen', sans-serif;">ប្រភេទអត្ថបទ
                                                <spatn class=" text-danger">:*
                                                </spatn>
                                            </label>
                                            <div class="radio-control">
                                                <input type="input" name="digital_book" class="form-control" id=""
                                                    value="<?php echo $row_select_teacher_ejournal['digital_book']?>">
                                            </div>
                                            <!-- select_major -->

                                        </div>
                                        <div class="col-sm-6">
                                            <label class="label-control" for=""
                                                style="font-family:'Koulen', sans-serif;">ជំនាញ
                                                <spatn class=" text-danger">:*
                                                </spatn>
                                            </label>
                                            <!-- select_major -->
                                            <input type="hidden" name="teacher_mail" class="form-control form-control"
                                                id="" value="<?php echo $row_select_teacher['teacher_mail']?>">

                                            <input type="input" name="select_major" class="form-control form-control"
                                                id="" aria-describedby=""
                                                value="<?php echo $row_select_teacher['major_title']?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-control" for=""
                                            style="font-family:'Koulen', sans-serif;">មូលន័យសង្ខេប
                                            <spatn class=" text-danger">:*
                                            </spatn>
                                        </label>
                                        <textarea name="abstract" id="" cols="30" rows="20"
                                            class="summernote form-control">
                                            <?php echo $row_select_teacher_ejournal['abstract']?>
                                    </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="wrapper">
                                            <div class="upload-files">
                                                <div class="select-image">
                                                    <div class="img-areas" data-img="">
                                                        <?php
                                                        foreach (json_decode($row_select_teacher_ejournal["image_one"]) as $image) : ?>
                                                        <img src="uploads/<?php echo $image; ?>" width=200>
                                                        <?php endforeach; ?>
                                                        <?php
                                                        foreach (json_decode($row_select_teacher_ejournal["image_two"]) as $image) : ?>
                                                        <img src="uploads/<?php echo $image; ?>" width=200>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                            <!-- <button type="submit" name="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-circle-check"></i>
                                    Add e-Book
                                </button> -->
                            </form>
                            <?php
                            }
                            }

                            ?>
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
<?php
}

}
}

?>



</html>