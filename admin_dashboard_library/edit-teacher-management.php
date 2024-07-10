<?php
include_once "../config/conn_db.php";
require_once "ControlAdmin.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE ((select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់') AND (email = '$email'))";
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

if(isset($_GET['id'])){
    $setion_edit_teacher = $_GET['id'];
    if(isset($_POST["submit"])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $select_role = $_POST['select_role'];
        $detials = $_POST['detials'];
        $totalFiles = count($_FILES['fileImg']['name']);
        $filesArray = array();
        
        for($i = 0; $i < $totalFiles; $i++){ $imageName=$_FILES["fileImg"]["name"][$i];
            $tmpName=$_FILES["fileImg"]["tmp_name"][$i]; $imageExtension=explode('.', $imageName);
            $imageExtension=strtolower(end($imageExtension)); $newImageName=uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'uploads/' . $newImageName); $filesArray[]=$newImageName; }
            $filesArray=json_encode($filesArray); 
            $query="UPDATE  member SET firstname='$firstname',	lastname='$lastname',	email='$email',	phone='$phone',	select_role='$select_role',	image='$filesArray',	detail='$detials' WHERE id= $setion_edit_teacher" ;
            $result_edit_teacher_management = $conn->query($query);
            // mysqli_query($conn, $query); 
            if($result_edit_teacher_management==true){
                echo "
            <script>
              alert('Successfully Added');
              document.location.href = 'index.php';
            </script>
            " ; 
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
                                <form action="" method="post" enctype="multipart/form-data">

                                    <?php
                                    $setion_edit_teacher = $_GET['id'];
                                    $select_edit_teacher = "SELECT * FROM member WHERE member.id = '$setion_edit_teacher'";
                                    $result_select_edit_teacher = $conn -> query($select_edit_teacher);
                                    if($result_select_edit_teacher -> num_rows > 0){
                                        while($row_select_edit_teahcer = $result_select_edit_teacher-> fetch_assoc()){
                                           ?>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">នាមត្រកូល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="firstname" class="form-control form-control"
                                                    autocomplete="off"
                                                    value="<?php echo $row_select_edit_teahcer['firstname']?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">នាមខ្លួន
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="lastname" class="form-control form-control"
                                                    autocomplete="off"
                                                    value="<?php echo $row_select_edit_teahcer['lastname']?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">អ៊ីម៉ែល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="email" name="email" class="form-control form-control"
                                                    autocomplete="off"
                                                    value="<?php echo $row_select_edit_teahcer['email']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">លេខទូរស័ព្ទ
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="phone" class="form-control form-control"
                                                    autocomplete="off"
                                                    value="<?php echo $row_select_edit_teahcer['phone']?>">
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជ្រើសរើសតួនាទី
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="form-check d-flex">

                                                    <input class="form-check-input" type="radio" name="select_role"
                                                        value="នាយក">
                                                    <label class="form-check-label"
                                                        style="font-family:Khmer OS System;">នាយក
                                                    </label>,
                                                    <div class="form-check mx-4">
                                                        <input class="form-check-input" type="radio" id=""
                                                            name="select_role" value="នាយករង">
                                                        <label class="form-check-label"
                                                            style="font-family:Khmer OS System;">នាយករង</label>,
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
                                                    accept=".jpg, .jpeg, .png" required multiple>
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
                                        <textarea name="detials" id="" cols="30" rows="10"
                                            class="summernote form-control">
                                            <?php echo $row_select_edit_teahcer['details']?>
                                        </textarea>
                                    </div>

                                    <button type="submit" name="submit" class=" btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i>
                                        Submit</button>

                                    <?php
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