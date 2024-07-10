<?php
require_once "ControlAdmin.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE email = '$email'";
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
            header('Location: admin-otp.php');
        }
    }
}else{
    header('Location: login.php');
}

if(isset($_GET['id'])){
    $select_teacher_id = $_GET['id'];
    $delete_teacher = "DELETE FROM member WHERE id=$select_teacher_id";
    $result_delete_teacher = $conn->query($delete_teacher);
    if($result_delete_teacher==TRUE){
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
                            <a class="m-0 btn  float-end font-weight-bold text-light" href="add-teacher.php"
                                style="background-color: #336666;"><i
                                    class="fa-solid fa-arrow-right text-danger fw-bold"></i>Add
                                Teacher</a>
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
                                            <th>ដេប៉ាតឺម៉ង់/ជំនាញ</th>
                                            <th>តួនាទី</th>
                                            <th>អ៊ីម៉ែល</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_teacher ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                        FROM member INNER JOIN major_tb ON member.select_major=major_tb.id WHERE member.select_role='គ្រូបង្រៀន' ORDER BY id DESC";
                                            // $select_teacher = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                            // teacher_tb.lastname,teacher_tb.sex,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_tb.select_role='គ្រូបង្រៀន' ORDER BY id DESC";
                                            $result_select_teacher = $conn->query($select_teacher);
                                            $cnt = 1;
                                            if($result_select_teacher->num_rows>0){
                                                while($row = $result_select_teacher->fetch_assoc()){
                                                    ?>
                                        <tr>
                                            <td><?php echo $cnt ?></td>
                                            <td><?php echo $row['firstname']?> <?php echo $row['lastname']?></td>
                                            <td><?php echo $row['sex']?></td>
                                            <td><?php echo $row['major_title']?></td>
                                            <td><?php echo $row['select_role']?></td>
                                            <td><?php echo $row['email']?></td>
                                            <td><?php echo $row['phone']?></td>
                                            <td>
                                                <a href="view_teacher.php?id=<?php echo $row['id']?>"
                                                    class="btn btn-success btn-circle btn-sm">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="edit-teacher.php?id=<?php echo $row['id']?>"
                                                    class="btn btn-primary btn-circle btn-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="list-teacher.php?id=<?php echo $row['id']?>"
                                                    class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $cnt = $cnt + 1;
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
</body>

</html>