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

if(isset($_GET['id'])){
    $representative = $_GET['id'];
    $delete_representative = "DELETE FROM member WHERE id = $representative";
    $result_delect_representative = $conn->query($delete_representative);
    if($result_delect_representative == TRUE){
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

    <title>Digital library management system for Kampong spue Institute of Technology</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="img/logo-around.png" type="image/x-icon">

    <!-- Link CND font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                     if(isset($_SESSION['status']))
                                     {
                                         ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>You Delete Teacher Success!</strong> .You Can Fine on List Teacher
                                </div>
                                <?php 
                                         unset($_SESSION['status']);
                                     }
                                    ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-warning">
                                        <tr>
                                            <th>#</th>
                                            <th>ឈ្មោះ</th>
                                            <th>ភេទ</th>
                                            <th>ជំនាញ</th>
                                            <th>ឯកទេស</th>
                                            <th>អ៊ីម៉ែល</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         $query_representative ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                         FROM member INNER JOIN major_tb ON member.select_major=major_tb.id WHERE member.select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់' ORDER BY id DESC";
                                        // $query_representative ="SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                        // teacher_tb.lastname,teacher_tb.sex,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                        // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                        // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_tb.select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់' ORDER BY id DESC";
                                        $result_representative = $conn->query($query_representative);
                                        $cnt = 1;
                                        if($result_representative->num_rows>0){
                                            while($row_representative = $result_representative->fetch_assoc()){
                                                ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row_representative['firstname']?>
                                                <?php echo $row_representative['lastname']?></td>
                                            <td><?php echo $row_representative['sex']?></td>
                                            <td><?php echo $row_representative['major_title']?></td>
                                            <td><?php echo $row_representative['specialty']?></td>
                                            <td><?php echo $row_representative['email']?></td>
                                            <td><?php echo $row_representative['phone']?></td>
                                            <td>
                                                <a href="view_representative.php?id=<?php echo $row_representative['id']?>"
                                                    class="btn btn-success btn-circle btn-sm">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="edit-teacher.php?id=<?php echo $row_representative['id']?>"
                                                    class="btn btn-primary btn-circle btn-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="list-representative.php?id=<?php echo $row_representative['id']?>"
                                                    class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $cnt = $cnt+1;
                                        }
                                        }
                                        ?>

                                    </tbody>
                                </table>
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