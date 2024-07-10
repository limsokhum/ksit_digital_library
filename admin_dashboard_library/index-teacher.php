<?php 
require_once "Control-Change-Password-teacher.php";
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


?>
<?php
 if(isset($_POST['submit'])){
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $teacher_mail = mysqli_real_escape_string($conn, $_POST['teacher_mail']);
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

    move_uploaded_file($tmpName, 'uploads/' . $newImageName);
    $filesArray[] = $newImageName;
    }

    $filesArray = json_encode($filesArray);
    
    $teacher_code = 0;
    
    $teacher_status = "verified";
    
    if($password==NULL && $cpassword==NULL && $filesArray==NULL){
        $update_pass = "UPDATE member SET 	firstname ='$firstname', lastname ='$lastname', email='$teacher_mail',code='$teacher_code',	status='$teacher_status' WHERE email = '$email'";
    }elseif($password==NULL && $cpassword==NULL && $filesArray!==NULL){
        
        $update_pass = "UPDATE member SET firstname ='$firstname', lastname ='$lastname', email='$teacher_mail', image='$filesArray',code='$teacher_code',	status='$teacher_status' WHERE email = '$email'";
    }else{
        
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE member SET firstname ='$firstname', lastname ='$lastname', email='$teacher_mail', password = '$encpass',  image='$filesArray',code='$teacher_code',	status='$teacher_status'  WHERE email = '$email'";
    }
    $result_editprofile =$conn ->query($update_pass);
    if($result_editprofile==true){
        $_SESSION['status'] = "<Type Your success message here>";
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
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Digital library management system for Kampong spue Institute of Technology</title>

    <!-- Link Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total e-Books</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $conn->query("SELECT * FROM digitalbook_tb WHERE digital_book='e-book' AND teacher_mail = '$email'")->num_rows;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total
                                                e-Journal
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php echo $conn->query("SELECT * FROM digitalbook_tb WHERE digital_book='e-journal' AND teacher_mail = '$email'")->num_rows;?>
                                                    </div>
                                                </div>
                                                <!-- <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total e-Project</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $conn->query("SELECT * FROM digitalbook_tb WHERE digital_book='e-project' AND teacher_mail = '$email'")->num_rows;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
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


    <?php
    $query_teacher_representative = "SELECT * FROM member WHERE email = '$email'";
    $result_teacher_representative = $conn->query($query_teacher_representative);
    if($result_teacher_representative->num_rows>0){
        while($row_teacher_representative = $result_teacher_representative->fetch_assoc()){
            ?>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"
                                style="font-family:'Koulen', sans-serif; color: #336666;">
                                Chang Profile</h5>
                            <button class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label-control mb-1" for=""
                                            style="font-family:'Koulen', sans-serif;">នាមត្រកូល
                                            <spatn class="text-danger">:*
                                            </spatn>
                                        </label>
                                        <input type="text" name="firstname" class="form-control" id=""
                                            value="<?php echo $row_teacher_representative['firstname']?>"
                                            style="font-family: 'Noto Serif Khmer', serif;">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label-control mb-1" for=""
                                            style="font-family:'Koulen', sans-serif;">នាមខ្លួន
                                            <spatn class=" text-danger">:*
                                            </spatn>
                                        </label>
                                        <input type="text" name="lastname" class="form-control" id=""
                                            value="<?php echo $row_teacher_representative['lastname']?>"
                                            style="font-family: 'Noto Serif Khmer', serif;">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group my-2">
                                <label class="label-control mb-1" for=""
                                    style="font-family:'Koulen', sans-serif;">អ៊ីម៉ែល
                                    <spatn class=" text-danger">:*
                                    </spatn>
                                </label>
                                <input type="email" name="teacher_mail" class="form-control" id=""
                                    value="<?php echo $row_teacher_representative['email']?>"
                                    style="font-family: 'Noto Serif Khmer', serif;">
                            </div>
                            <div class="form-group my-2">
                                <label class="label-control" for=""
                                    style="font-family:'Koulen', sans-serif;">តើអ្នកចង់ប្ដូលេខសម្ងាត់ឬ ?

                                </label>
                                <div class="form-check d-flex">
                                    <input onclick="onclickShow()" class="form-check-input" type="radio"
                                        name="select_role" value="">
                                    <label class="form-check-label mx-1" style="font-family:Khmer OS System;">
                                        ប្ដូលេខសម្ងាត់
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
                                    <label class="label-control" for=""
                                        style="font-family:'Koulen', sans-serif;">បញ្ជាក់
                                        <spatn class=" text-danger">:*
                                        </spatn>
                                    </label>
                                    <input type="password" name="cpassword" class="form-control form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="label-control my-1" for=""
                                        style="font-family:'Koulen', sans-serif;">រូប
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

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class=" btn btn-primary"><i
                                    class="fa-solid fa-circle-check"></i>
                                Submit</button>
                        </div>
                </div>

                </form>
            </div>



        </div>
    </div>
    <?php
        }
    }
    ?>





    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>
    function onclickShow() {
        document.getElementById('passwords').style.display = "block";
    }

    function onclickRemove() {
        document.getElementById('passwords').style.display = "none";
    }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>