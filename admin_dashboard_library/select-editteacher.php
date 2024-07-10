<?php 
require_once "ControlTeacher.php";
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
                <div class="container-fluid d-flex justify-content-center mt-5">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" style="width: 40rem">
                        <div class="card-header d-flex justify-content-between py-3">
                            <h6 class="m-0 float-start font-weight-bold text-primary">Email Teacher</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">
                                <form action="select-editteacher.php" method="post" enctype="multipart/form-data">
                                    <div class="text-center">
                                        <?php
                                        if(count($teacher_errors) > 0){
                                            ?>
                                        <div class="alert alert-danger text-center">
                                            <?php 
                                        foreach($teacher_errors as $teacher_error){
                                        echo $teacher_error;
                                            }
                                        ?>
                                        </div>
                                        <?php
                                        }
                                    ?>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">អ៊ីម៉ែល
                                                    <spatn class="text-danger">:*
                                                    </spatn>
                                                </label>
                                                <?php 
                                                if(isset($_GET['id'])){
                                                    $select_edit_teacher = $_GET['id'];
                                                    $query_select_edit_teacher = "SELECT * FROM teacher_tb WHERE id=$select_edit_teacher";
                                                    $result_select_edit_teacher = $conn->query($query_select_edit_teacher);
                                                    if($result_select_edit_teacher->num_rows>0){
                                                        while($row_select_edit_teacher = $result_select_edit_teacher->fetch_assoc()){
                                                            $teacher_email = $row_select_edit_teacher['teacher_mail'];
                                                            ?>

                                                <input type="email" name="teacher_email"
                                                    class="form-control form-control-user" id="exampleInputEmail"
                                                    aria-describedby="emailHelp" placeholder="Enter Email Address..."
                                                    value="<?php echo $teacher_email ?>">
                                                <?php
                                                
                                                }
                                                }
                                                }
                                                ?>

                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" name="teacher_check-email" class=" btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i> Continue</button>
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