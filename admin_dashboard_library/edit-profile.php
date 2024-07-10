<?php
include ('../config/conn_db.php');
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

    //chang password admin
    if(isset($_GET['id'])){
        $edit_profile_admin = $_GET['id'];
        if(isset($_POST['submit'])){
            $edit_name = mysqli_real_escape_string($conn, $_POST['edit_name']);
            $edit_email = mysqli_real_escape_string($conn, $_POST['edit_email']);
            $edit_password = mysqli_real_escape_string($conn, $_POST['edit_password']);
            $edit_cpassword = mysqli_real_escape_string($conn, $_POST['edit_cpassword']);
            
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
            
            //check password
            if($edit_password !== $edit_cpassword){
                echo "Confirm password not matched!";
            }else{
                $edit_code = 0;
                $edit_encpass = password_hash($edit_password, PASSWORD_BCRYPT);
                $edit_status = "verified";
                $edit_update_pass = "UPDATE member SET name = '$edit_name', email='$edit_email', password = '$edit_encpass', code='$edit_code', image='$filesArray', status='$edit_status'  WHERE (email='$email' && id = $edit_profile_admin) ";
                $edit_run_query = mysqli_query($conn, $edit_update_pass);
                if($edit_run_query){
                    echo
                    "
                    <script>
                    alert('Successfully Edit');
                    document.location.href = 'edit-profile.php';
                    </script>
                    ";
                }else{
                    echo "Failed to change your password!";
                }
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php
                                    $select_query_profile_admin = "SELECT * FROM member WHERE email='$email'";
                                    $result_select_query_profile_admin = $conn->query($select_query_profile_admin);
                                    if($result_select_query_profile_admin->num_rows>0){
                                        while($row_query_profile= $result_select_query_profile_admin->fetch_assoc()){
                                            ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">Name
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="edit_name" class=" form-control form-control"
                                                    id="" aria-describedby="" autocomplete="off"
                                                    value="<?php echo $row_query_profile['name']?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">Email
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="email" name="edit_email" class="form-control form-control"
                                                    id="" aria-describedby="" autocomplete="off"
                                                    value="<?php echo $row_query_profile['email']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">Password
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="password" name="edit_password"
                                                    class=" form-control form-control" id="" aria-describedby=""
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">Confirm Password
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="password" name="edit_cpassword"
                                                    class="form-control form-control " id="" aria-describedby=""
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">Image
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="file" class="btn btn-secondary" name="fileImg[]"
                                                    accept=".jpg, .jpeg, .png" required multiple>
                                            </div>
                                        </div>
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
</body>

</html>