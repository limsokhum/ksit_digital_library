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

if (isset($_GET['file_id_view'])) {
    
    $id = $_GET['file_id_view'];

    $sql = "SELECT * FROM digitalbook_tb WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Type: application/pdf');
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        // $viewCount = $file['view'] + 1;
        // $viewQuery = "UPDATE files SET view=$viewCount WHERE id=$id";
        // mysqli_query($conn, $viewQuery);
        // exit;
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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon">

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

    .detail-abstract {
        line-height: 40px;
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
                    <!-- <h1 class="h3 mb-2 text-gray-800">Add e-Book</h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3">
                            <a class="m-0 btn float-start font-weight-bold text-light" href="e-books.php"
                                style="background-color: #336666;"><i class="fa-solid fa-backward"></i> Back</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">
                                <?php
                                if(isset($_GET['id'])){
                                $query_view_digital_book_id = $_GET['id'];
                                $query_select_digital_book = "SELECT * FROM digitalbook_tb WHERE id='$query_view_digital_book_id'";
                                $result_select_digital_book = $conn->query($query_select_digital_book);
                                if($result_select_digital_book->num_rows>0){
                                    while($row_select_digital_book = $result_select_digital_book->fetch_assoc()){
                                        ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="list-staf fw-bolder">ប្រធានបទ</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span
                                                                class="detail-digital mx-4"><?php echo $row_select_digital_book['title']?></span>
                                                        </div>
                                                    </div>


                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="list-staf fw-bolder">អត្ថបទ</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span class="detail-digital mx-4"><a class=""
                                                                    href="view-digital-ebook.php?file_id_view=<?php echo $row_select_digital_book['id'] ?>"
                                                                    target="_blank"><?php echo $row_select_digital_book['name']?></a></span>
                                                        </div>
                                                    </div>

                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="list-staf fw-bolder">ឈ្មោះអ្នកនិពន្ធ</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span
                                                                class="detail-digital mx-4"><?php echo $row_select_digital_book['name_auther']?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="detail-digital fw-bolder">កាលបរិច្ឆេត</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span
                                                                class="detail-digital mx-4"><?php echo $row_select_digital_book['date']?></span>
                                                        </div>
                                                    </div>

                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="list-staf fw-bolder">ប្រភេទអត្ថបទ</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span
                                                                class="detail-digital mx-4"><?php echo $row_select_digital_book['digital_book']?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="list-staf fw-bolder">បច្ចុប្បន្នភាព</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span class="detail-digital mx-4">
                                                                <?php
                                                        if($row_select_digital_book['status']==='0'){
                                                            echo "New File Upload";
                                                        }elseif($row_select_digital_book['status']==='1'){
                                                            echo "File Have Publish";
                                                        }elseif($row_select_digital_book['status']==='2'){
                                                            echo "File Have Editing";
                                                        }else{
                                                            echo "File Have Rejected";
                                                        }
                                                        ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <span class="list-staf fw-bolder">ជំនាញ</span>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <span class="text-primary fw-bolder"> :*</span>
                                                            <span
                                                                class="detail-digital mx-4"><?php echo $row_select_digital_book['select_major']?></span>
                                                        </div>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="cover-digital-book" style="height: 24rem;">
                                                <img src="uploads/660b774e0d514.png" alt=""
                                                    style="width: 100%; height: 100%;">
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <form action="" method="post" enctype="multipart/form-data">



                                    <ul class="list-group list-group-flush">

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <span class="list-staf fw-bolder">មូលន័យសង្ខេប</span>
                                                </div>
                                                <div class="col-sm-10">
                                                    <span
                                                        class="detail-digital detail-abstract mx-4"><?php echo $row_select_digital_book['abstract']?></span>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <span class="list-staf fw-bolder">កម្រងរូបភាព</span>
                                                </div>
                                                <div class="col-sm-10">
                                                    <?php

                                        if($row_select_digital_book['image_two']==''){
                                            echo "Null Callery.";
                                        }else{
                                            foreach (json_decode($row_select_digital_book["image_two"]) as $image) : ?>
                                                    <img src="uploads/<?php echo $image; ?>" width=200>
                                                    <?php endforeach; 
                                                    }

                                                    ?>
                                                </div>
                                            </div>

                                        </li>
                                        <!-- <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <span class="list-staf fw-bolder">Status</span>
                                                </div>
                                                <div class="col-sm-10">

                                                    <div class="radio-control">
                                                        <span class="text-primary fw-bolder"> :*</span>

                                                        <input type="radio" name="digital_book" class="" id=""
                                                            value="e-book">
                                                        <label for="">Upblic, </label>

                                                        <input type="radio" name="digital_book" class="" id=""
                                                            aria-describedby="" value="e-project">
                                                        <label for="">With Editer, </label>
                                                        <input type="radio" name="digital_book" class="" id=""
                                                            aria-describedby="" value="e-journal">
                                                        <label for="">Rejected</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li> -->
                                    </ul>

                                    <!-- <button type="submit" name="submit" class="btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i>
                                        Add e-Book
                                    </button> -->
                                </form>
                                <?php
                                    }
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

</html>