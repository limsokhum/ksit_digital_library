<?php

include('../config/conn_db.php');
if(isset($_GET['id'])){
if(isset($_POST["submit"])){
$select_department_id = $_GET['id'];
$department_code = $_POST['department_code'];
$department_title = $_POST['department_title'];
$department_detials = $_POST['department_detials'];
$status = 1;
$totalFiles = count($_FILES['fileImg']['name']);
$filesArray = array();

for($i = 0; $i < $totalFiles; $i++){ $imageName=$_FILES["fileImg"]["name"][$i];
    $tmpName=$_FILES["fileImg"]["tmp_name"][$i]; $imageExtension=explode('.', $imageName);
    $imageExtension=strtolower(end($imageExtension)); $newImageName=uniqid() . '.' . $imageExtension;
    move_uploaded_file($tmpName, 'uploads/' . $newImageName); $filesArray[]=$newImageName; }
    $filesArray=json_encode($filesArray);
    $query="UPDATE department_tb SET department_code='$department_code',	department_title='$department_detials',	department_detials='$department_detials', image='$filesArray',	status=1 WHERE id=$select_department_id"
    ; mysqli_query($conn, $query); echo "
        <script>
          alert('Successfully Added');
          document.location.href = 'index.php';
        </script>
        " ; } } ?>
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
                            <h6 class="m-0 float-start font-weight-bold text-primary">Edit Department</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php
                                   if(isset($_GET['id'])){
                                    $select_department_id = $_GET['id'];
                                    $select_department = "SELECT * FROM department_tb WHERE id=$select_department_id";
                                    $result_department = $conn->query($select_department);
                                    if($result_department->num_rows>0){
                                        while($row = $result_department-> fetch_assoc()){
                                            $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($row['department_detials']),$trans);
                                                $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                                            ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">លេខកូដ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="number" name="department_code"
                                                    class=" form-control form-control"
                                                    value="<?php echo $row['department_code']?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ដេប៉ាតឺម៉ង់
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="department_title"
                                                    class=" form-control form-control"
                                                    value="<?php echo $row['department_title']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for=""
                                            style="font-family:'Koulen', sans-serif;">អំពីរដេប៉ាតឺម៉ង់
                                            <spatn class="text-danger">:*
                                            </spatn>
                                        </label>
                                        <textarea name="department_detials" id="" cols="30" rows="10"
                                            class="summernote form-control">
                                            <?php echo $desc; ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="wrapper">
                                            <div class="upload-files">
                                                <div class="file-image">
                                                    <!-- <input type="file" name="" id=""> -->
                                                    <div class="file-areas" data-img="">
                                                        <i class='bx bxs-cloud-upload icon'></i>
                                                        <h3>Images Upload</h3>
                                                        <p>Image size must be note limited</p>
                                                        <input type="file" class="btn btn-secondary" name="fileImg[]"
                                                            accept=".jpg, .jpeg, .png" required multiple>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class=" btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i> Submit</button>
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