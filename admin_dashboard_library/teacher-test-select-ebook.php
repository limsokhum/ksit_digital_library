<?php 
require_once "Control-Change-Password-teacher.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE email = '$email'";
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
            header('Location: admin-otp.php');
        }
    }
}else{
    header('Location: login-teacher.php');
}

if (isset($_POST['submit'])) { 
    
    $title = $_POST['title'];
    $name_auther = $_POST['name_auther'];
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
    
    $select_major = $_POST['select_major'];
    $date = $_POST['date'];
    $abstract = $_POST['abstract'];
    
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    $status = 0;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO ebook_tb (title,name_auther,image,select_major,date,abstract,name, size, downloads,status) VALUES ('$title','$name_auther','$filesArray','$select_major','$date','$abstract','$filename', $size, 0,'$status')";
            if (mysqli_query($conn, $sql)) {
                echo "
                <script>
                alert('Successfully Added');
                document.location.href = 'teacher-add-ebook.php';
                </script>
                ";
            }
        } else {
            echo "Failed to upload file.";
        }
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
                            <h6 class="m-0 float-start font-weight-bold text-primary">Insert Data</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">
                                <?php
                                $select_data_test_ebook = "SELECT * FROM ebook_tb";
                                $result_select_data_test_ebook = $conn->query($select_data_test_ebook);
                                if($result_select_data_test_ebook->num_rows>0){
                                    while($row_select_data_test_ebook = $result_select_data_test_ebook->fetch_assoc()){
                                        ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="label-control" for=""
                                            style="font-family:'Koulen', sans-serif;">ប្រធានបទ e-Book
                                            <spatn class=" text-danger">:*
                                            </spatn>
                                        </label>
                                        <input type="text" name="title" class="form-control form-control" id="">
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
                                                    id="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កម្រងរូបភាព
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="file-input">
                                                    <input type="file" class="file-control" name="fileImg[]"
                                                        accept=".jpg, .jpeg, .png" required multiple value="<?php
                                                        foreach (json_decode($row["image"]) as $image) : ?>
                                                        <img src=" uploads/<?php echo $image; ?>" width=200>
                                                    <?php endforeach; ?>">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជំនាញ
                                                    <spatn class=" text-danger">:*
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
                                                        <?php echo ($row['id'].$row['major_title'])?>
                                                    </option>
                                                    <?php
                                                }
                                                }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កាលបរិច្ឆេត
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="date" name="date" class="form-control form-control" id=""
                                                    aria-describedby=""
                                                    value="<?php echo $row_select_data_test_ebook['date']?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="label-control" for=""
                                                style="font-family:'Koulen', sans-serif;">មូលន័យសង្ខេប
                                                <spatn class=" text-danger">:*
                                                </spatn>
                                            </label>
                                            <textarea name="abstract" id="" cols="30" rows="10"
                                                class="summernote form-control">
                                        </textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="wrapper">
                                                <div class="upload-files">
                                                    <div class="select-file">
                                                        <div class="file-areas" data-img="">
                                                            <h3>File Upload</h3>
                                                            <p>Image size must be less than <span>1000MB</span>
                                                            </p>
                                                            <input class="btn btn-primary" type="file" name="myfile"
                                                                value="<?php echo $row_select_data_test_ebook['name']?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i>
                                        Add e-Book
                                    </button>
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

</html>