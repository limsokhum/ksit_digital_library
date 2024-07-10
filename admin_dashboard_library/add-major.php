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

if(isset($_POST["submit"])){
$major_code = $_POST['major_code'];
$major_title = $_POST['major_title'];
$select_department = $_POST['select_department'];
$major_detials = $_POST['major_detials'];
$status = 1;
$totalFiles = count($_FILES['fileImg']['name']);
$filesArray = array();

for($i = 0; $i < $totalFiles; $i++){ $imageName=$_FILES["fileImg"]["name"][$i];
    $tmpName=$_FILES["fileImg"]["tmp_name"][$i]; $imageExtension=explode('.', $imageName);
    $imageExtension=strtolower(end($imageExtension)); $newImageName=uniqid() . '.' . $imageExtension;
    move_uploaded_file($tmpName, 'uploads/' . $newImageName); $filesArray[]=$newImageName; }
    $filesArray=json_encode($filesArray); $query="INSERT INTO major_tb(major_code,	major_title,   select_department,	major_detials,	image,	status) 
    VALUES('$major_code', '$major_title', '$select_department', '$major_detials', '$filesArray', '$status')" ;
    mysqli_query($conn, $query); 
    
    $_SESSION['status'] = "<Type Your success message here>"; 
    } ?>
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
                                    <strong>You Add Major Success!</strong> .You Can Fine on List Major
                                </div>
                                <?php 
                                         unset($_SESSION['status']);
                                     }
                                    ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">លេខកូដ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="number" name="major_code"
                                                    class=" form-control form-control" id="" aria-describedby=""
                                                    placeholder="001...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជំនាញ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="major_title" class="form-control form-control"
                                                    id="" aria-describedby="" placeholder="បច្ចេកវិទ្យាកុំព្យូទ័រ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ដេប៉ាតឺម៉ង់
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>

                                                <select name="select_department" class="form-control"
                                                    aria-label="Default select">
                                                    <option selected>ជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                                                    <?php
                                                $department_tb = "SELECT * FROM department_tb";
                                                $department_tb_result = $conn -> query($department_tb);
                                                if($department_tb_result->num_rows > 0){
                                                    while($row = $department_tb_result -> fetch_assoc()){
                                                        ?>
                                                    <option value="<?php echo ($row['id'])?>">
                                                        <?php echo ($row['department_title'])?>
                                                    </option>
                                                    <?php
                                                }
                                                }
                                                ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for=""
                                            style="font-family:'Koulen', sans-serif;">អំពីរជំនាញ
                                            <spatn class="text-danger">:*
                                            </spatn>
                                        </label>
                                        <textarea name="major_detials" id="" cols="30" rows="10"
                                            class="summernote form-control">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="wrapper">
                                            <div class="upload-files">
                                                <div class="select-file">
                                                    <div class="file-areas" data-img="">
                                                        <i class='bx bxs-cloud-upload icon'></i>
                                                        <h3>Images Upload</h3>
                                                        <p>Image size must be note limited</p>
                                                        <input type="file" class="btn btn-secondary" name="fileImg[]"
                                                            accept=".jpg, .jpeg, .png" multiple>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
        document.getElementById("popup-profile").style.display = "block";
    }

    function onclickRemove() {
        document.getElementById("popup-profile").style.display = "none";
    }
    </script>
</body>

</html>