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
if(isset($_GET['id'])){
    $delete_digital_book = $_GET['id'];
    $query_delete_digital_book = "DELETE FROM digitalbook_tb WHERE id='$delete_digital_book'";
    $result_delete_digital_book = $conn->query($query_delete_digital_book);
    if($result_delete_digital_book==TRUE){
        echo"
        <script>
        alert('You Delete Success');
        document.location.href='e-books.php';
        </script>
        ";
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

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-danger"> e-Books</h1> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-warning">
                                        <tr>
                                            <th>#</th>
                                            <th>ប្រធានបទ</th>
                                            <th>ជំនាញ</th>
                                            <th>អ្នកនិពន្ធ</th>
                                            <th>អត្ថបទ</th>
                                            <th>ថ្ងៃ-ទី</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_select_digital_book_notification = "SELECT * FROM digitalbook_tb WHERE status=0 ORDER BY id DESC";
                                        $result_select_digital_ebook_notification = $conn->query($query_select_digital_book_notification);
                                        
                                        $cnt= 1;
                                       
                                        if($result_select_digital_ebook_notification->num_rows>0){
                                            while($row_select_digital_ebook_notification = $result_select_digital_ebook_notification->fetch_assoc()){
                                                ?>
                                        <tr class="text-primary">
                                            <td><?php echo $cnt?></td>
                                            <td>
                                                <?php echo $row_select_digital_ebook_notification['title']?></td>
                                            <td><?php echo $row_select_digital_ebook_notification['select_major']?></td>
                                            <td><?php echo $row_select_digital_ebook_notification['name_auther']?></td>
                                            <td><a class=""
                                                    href="e-books.php?file_id_view=<?php echo $row_select_digital_ebook_notification['id'] ?>"
                                                    target="_blank"><?php echo $row_select_digital_ebook_notification['name']?></a>
                                            </td>
                                            <td><?php echo $row_select_digital_ebook_notification['date']?></td>
                                            <td>
                                                <a href="view-all-digital.php?id=<?php echo $row_select_digital_ebook_notification['id']?>"
                                                    class="btn btn-secondary btn-circle btn-sm">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="edit-digital-book.php?id=<?php echo $row_select_digital_ebook_notification['id']?>"
                                                    class="btn btn-primary btn-circle btn-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <!-- <a href="e-books.php?id=<?php //echo $row_select_digital_ebook_notification['id']?>"
                                                    class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <?php
                                        $cnt=$cnt+1;
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