<?php 
require_once "Control-Change-Password-teacher.php";
// $email = $_SESSION['email'];
// $password = $_SESSION['password'];
// if($email != false && $password != false){
//     $sql = "SELECT * FROM member WHERE ((select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់') AND (email = '$email'))";
//     $run_Sql = mysqli_query($conn, $sql);
//     if($run_Sql){
//         $fetch_info = mysqli_fetch_assoc($run_Sql);
//         $status = $fetch_info['teacher_status']; 
//         $code = $fetch_info['teacher_code'];
//         if($status == "verified"){
//             if($code != 0){
//                 header('Location: teacher-reset-codes.php');
//             }
//         }else{
//             header('Location: index-teacher.php');
//         }
//     }
// }else{
//     header('Location: login-teacher.php');
// }

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

if(isset($_POST['submit'])){
    $title = $_POST['title']; 
    $name_auther = $_POST['name_auther']; 
    $date = $_POST['date'];
    $teacher_mail = $_POST['teacher_mail'];
    $select_major = $_POST['select_major'];
    $digital_book =$_POST['digital_book'];
    $abstract = $_POST['abstract'];
    $keyword = $_POST['keyword'];
    $status = 0;
    
    // start upload image one
    $totalFiles_one = count($_FILES['fileImg_one']['name']);
    $filesArray_one = array();
    for($i = 0; $i < $totalFiles_one; $i++){
    $imageName_one = $_FILES["fileImg_one"]["name"][$i];
    $tmpName_one = $_FILES["fileImg_one"]["tmp_name"][$i];

    $imageExtension_one = explode('.', $imageName_one);
    $imageExtension_one = strtolower(end($imageExtension_one));

    $newImageName_one = uniqid() . '.' . $imageExtension_one;

    move_uploaded_file($tmpName_one, 'uploads/' . $newImageName_one);
    $filesArray_one[] = $newImageName_one;
    }

    $filesArray_one = json_encode($filesArray_one);
    // ent upload image one

    // start upload image two
    $totalFiles_two = count($_FILES['fileImg_two']['name']);
    $filesArray_two = array();
    for($i = 0; $i < $totalFiles_two; $i++){
    $imageName_two = $_FILES["fileImg_two"]["name"][$i];
    $tmpName_two = $_FILES["fileImg_two"]["tmp_name"][$i];

    $imageExtension_two = explode('.', $imageName_two);
    $imageExtension_two = strtolower(end($imageExtension_two));

    $newImageName_two = uniqid() . '.' . $imageExtension_two;

    move_uploaded_file($tmpName_two, 'uploads/' . $newImageName_two);
    $filesArray_two[] = $newImageName_two;
    }

    $filesArray_two = json_encode($filesArray_two);
    // ent upload image two
    
    // Start set file
    
    $filename = $_FILES['myfile']['name'];
    //--- destination of the file on the server ---//
    $destination = 'uploads/' . $filename;
    //--- get the file extension ---//
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    //--- the physical file on a temporary uploads directory on the server ---//
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if($file==NULL && $imageName_one==NULL && $imageName_two==NULL){
        $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$status')";
    }
    elseif($file!=NULL && $imageName_one==NULL && $imageName_two==NULL){
            if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                echo "You file extension must be .zip, .pdf or .docx";
            } elseif ($_FILES['myfile']['size'] > 1000000000) { 
            //--- file shouldn't be larger than 1Megabyte ---//
                echo "File too large!";
            } else {
                
            //-- move the uploaded (temporary) file to the specified destination --//
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,name,size,downloads,view,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filename','$size',0,0,'$status')";
                    }
            }
        }elseif($file==NULL && $imageName_one!=NULL && $imageName_two==NULL){
            $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,image_one,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filesArray_one','$status')";
        }elseif($file==NULL && $imageName_one==NULL && $imageName_two!=NULL){
            $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,image_two,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filesArray_two','$status')";
        }elseif($file==NULL && $imageName_one!=NULL && $imageName_two!=NULL){
            $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,image_one,image_two,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filesArray_one','$filesArray_two','$status')";
            
        }elseif($file!=NULL && $imageName_one!=NULL && $imageName_two==NULL){
            if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                echo "You file extension must be .zip, .pdf or .docx";
            } elseif ($_FILES['myfile']['size'] > 1000000000) { 
            //--- file shouldn't be larger than 1Megabyte ---//
                echo "File too large!";
            } else {
            //-- move the uploaded (temporary) file to the specified destination --//
                
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,image_one,name,size,downloads,view,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filesArray_one','$filename','$size',0,0,'$status')";
                    }
            }
        }elseif($file!=NULL && $imageName_one==NULL && $imageName_two!=NULL){
            if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                echo "You file extension must be .zip, .pdf or .docx";
            } elseif ($_FILES['myfile']['size'] > 1000000000) { 
            //--- file shouldn't be larger than 1Megabyte ---//
                echo "File too large!";
            } else {
                
            //-- move the uploaded (temporary) file to the specified destination --//
                
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,image_two,name,size,downloads,view,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filesArray_two','$filename','$size',0,0,'$status')";
                    }
            }
        }else{
            if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                echo "You file extension must be .zip, .pdf or .docx";
            } elseif ($_FILES['myfile']['size'] > 1000000000) { 
            //--- file shouldn't be larger than 1Megabyte ---//
                echo "File too large!";
            } else {
                
            //-- move the uploaded (temporary) file to the specified destination --//
                
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO digitalbook_tb (title,name_auther,date,teacher_mail,select_major,digital_book,abstract,keyword,image_one,image_two,name,size,downloads,view,status) VALUES('$title','$name_auther','$date','$teacher_mail','$select_major','$digital_book','$abstract','$keyword','$filesArray_one','$filesArray_two','$filename','$size',0,0,'$status')";

                    }
            }
        }

        
        $result_edit_digital = $conn->query($sql);
        if ($result_edit_digital==TRUE) {
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
                                     if(isset($_SESSION['status']))
                                     {
                                         ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>You Add Department Success!</strong> .You Can Fine on List Department
                                </div>
                                <?php 
                                         unset($_SESSION['status']);
                                     }
                                    ?>
                                <?php
                                $select_teacher ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                FROM member INNER JOIN major_tb ON member.select_major=major_tb.id WHERE email = '$email'";
                                // $select_teacher = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_mail = '$email'";
                                // WHERE teacher_mail='$teacher_email'
                                $result_select_teacher = $conn->query($select_teacher);
                                if($result_select_teacher->num_rows >0){
                                    while($row_select_teacher = $result_select_teacher->fetch_assoc()){
                                        ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="label-control" for=""
                                            style="font-family:'Koulen', sans-serif;">ប្រធានបទ Digital Book
                                            <spatn class=" text-danger">:*
                                            </spatn>
                                        </label>
                                        <input type="text" name="title" class="form-control form-control" id="">
                                    </div>
                                    <div class="form-group">
                                        <div class="row mb-3">
                                            <div class="col-sm-5">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ឈ្មោះអ្នកនិពន្ធ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="name_auther" class="form-control form-control"
                                                    id="">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កាលបរិច្ឆេត
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="date" name="date" class="form-control form-control" id=""
                                                    aria-describedby="">


                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ជំនាញ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <!-- select_major -->
                                                <input type="hidden" name="teacher_mail"
                                                    class="form-control form-control" id=""
                                                    value="<?php echo $row_select_teacher['email']?>">

                                                <input type="text" name="select_major" class="form-control form-control"
                                                    id="" value="<?php echo $row_select_teacher['major_title']?>"
                                                    readonly>

                                                <!-- <select name="select_major" class="form-control"
                                                    aria-label="Default select">
                                                    <option selected>ជ្រើសរើសជំនាញ</option>
                                                    <?php
                                                // $department_tb = "SELECT * FROM major_tb";
                                                // $department_tb_result = $conn -> query($department_tb);
                                                // if($department_tb_result->num_rows > 0){
                                                //     while($row = $department_tb_result -> fetch_assoc()){
                                                        ?>
                                                    <option value="<?php //echo ($row['major_title'])?>">
                                                        <?php //echo ($row['major_title'])?>
                                                    </option>
                                                    <?php
                                                // }
                                                // }
                                                ?>
                                                </select> -->
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ប្រភេទអត្ថបទ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="radio-control">
                                                    <input type="radio" name="digital_book" class="" id=""
                                                        value="e-book">
                                                    <label for="">e-Book, </label>

                                                    <input type="radio" name="digital_book" class="" id=""
                                                        aria-describedby="" value="e-project">
                                                    <label for="">e-Project, </label>
                                                    <input type="radio" name="digital_book" class="" id=""
                                                        aria-describedby="" value="e-journal">
                                                    <label for="">e-Journal</label>
                                                </div>
                                                <!-- select_major -->

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

                                            <label class="label-control" for=""
                                                style="font-family:'Koulen', sans-serif;">ពាក្យគន្លឺះ
                                                <spatn class=" text-danger">:*
                                                </spatn>
                                            </label>
                                            <input type="text" name="keyword" class="form-control form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">រូប Cover សៀវភៅ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="file-input">
                                                    <input type="file" class="btn btn-secondary" name="fileImg_one[]"
                                                        accept=".jpg, .jpeg, .png" multiple>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កម្រងរូបភាព
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="file-input">
                                                    <input type="file" class="btn btn-secondary" name="fileImg_two[]"
                                                        accept=".jpg, .jpeg, .png" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="wrapper">
                                                <div class="upload-files">
                                                    <div class="select-file">
                                                        <div class="file-areas" data-img="">
                                                            <h3>File Upload</h3>
                                                            <p>Digital book must be less than <span>1G</span>
                                                            </p>
                                                            <input class="btn btn-secondary" type="file" name="myfile">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i>
                                        Add Digital Book
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