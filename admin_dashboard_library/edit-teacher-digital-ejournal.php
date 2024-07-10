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

if(isset($_GET['id'])){
    $query_edit_digital_book_id = $_GET['id']; // Id Selct edit 
    
    if(isset($_POST['submit'])){
        $title = $_POST['title']; 
        $name_auther = $_POST['name_auther']; 
        $date = $_POST['date'];
        $teacher_mail = $_POST['teacher_mail'];
        $select_major = $_POST['select_major'];
        $digital_book =$_POST['digital_book'];
        $abstract = $_POST['abstract'];
        $comment = $_POST['comment'];
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
            $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword' WHERE id = $query_edit_digital_book_id";
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
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',name='$filename' WHERE id = $query_edit_digital_book_id";
                        }
                }
            }elseif($file==NULL && $imageName_one!=NULL && $imageName_two==NULL){
                $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date', teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',image_one='$filesArray_one' WHERE id = $query_edit_digital_book_id";
            }elseif($file==NULL && $imageName_one==NULL && $imageName_two!=NULL){
                $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date', teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',image_two='$filesArray_two' WHERE id = $query_edit_digital_book_id";
                
            }elseif($file==NULL && $imageName_one!=NULL && $imageName_two!=NULL){
                $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',image_one='$filesArray_one',image_two='$filesArray_two' WHERE id = $query_edit_digital_book_id";
                
            }elseif($file!=NULL && $imageName_one!=NULL && $imageName_two==NULL){
                if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                    echo "You file extension must be .zip, .pdf or .docx";
                } elseif ($_FILES['myfile']['size'] > 1000000000) { 
                //--- file shouldn't be larger than 1Megabyte ---//
                    echo "File too large!";
                } else {
                //-- move the uploaded (temporary) file to the specified destination --//
                    
                    if (move_uploaded_file($file, $destination)) {
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',image_one='$filesArray_one',name='$filename' WHERE id = $query_edit_digital_book_id";
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
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',image_two='$filesArray_two',name='$filename' WHERE id = $query_edit_digital_book_id";
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
                        $sql = "UPDATE digitalbook_tb SET title='$title',name_auther='$name_auther',date='$date',teacher_mail='$teacher_mail',select_major='$select_major',digital_book='$digital_book',abstract='$abstract',comment='$comment',keyword='$keyword',image_one='$filesArray_one',image_two='$filesArray_two',name='$filename' WHERE id = $query_edit_digital_book_id";
                        }
                }
            }
            
            $result_edit_digital = $conn->query($sql);
            if ($result_edit_digital==TRUE) {
                            echo "
                            <script>
                            alert('Successfully Added');
                            document.location.href = 'list-teacher-digital-ejournal.php';
                            </script>
                            ";
                        }

    }
    
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

<?php 

if(isset($_GET['id'])){
    
    $edit_teacher_digital_ejournal = $_GET['id'];
    
    $query_teacher_digital_ejournal = "SELECT * FROM digitalbook_tb WHERE (((teacher_mail = '$email') AND (digital_book='e-journal'))) AND (id='$edit_teacher_digital_ejournal')";
    
    $result_teacher_digital_ejournal = $conn->query($query_teacher_digital_ejournal);
    
    if($result_teacher_digital_ejournal->num_rows>0){
        while($row_teacher_digital_ejournal = $result_teacher_digital_ejournal->fetch_assoc()){
            $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $details = strtr(html_entity_decode($row_teacher_digital_ejournal['abstract']),$trans);
            $details=str_replace(array("<li>","</li>"), array("",", "), $details);
            
            $transe = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
            unset($transe["\""], $transe["<"], $transe[">"], $transe["<h2"]);
            $detailse = strtr(html_entity_decode($row_teacher_digital_ejournal['comment']),$transe);
            $detailse =str_replace(array("<li>","</li>"), array("",", "), $detailse);
            
            $image_one = $row_teacher_digital_ejournal['image_one'];
            $image_two = $row_teacher_digital_ejournal['image_two'];
            ?>

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
                        </div>
                        <div class="card-body p-0">
                            <div class="p-5">
                                <?php
                            // $select_teacher = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                            // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE teacher_mail = '$email'";
                            $select_teacher="SELECT member.id, member.member_id, member.firstname, member.lastname, member.sex,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title
                            FROM member INNER JOIN major_tb ON member.select_major=major_tb.id WHERE email='$email'";
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
                                        <input type="text" name="title"
                                            value='<?php echo $row_teacher_digital_ejournal["title"]?>'
                                            class="form-control form-control" id="">
                                    </div>
                                    <div class="form-group">
                                        <div class="row mb-3">
                                            <div class="col-sm-5">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">ឈ្មោះអ្នកនិពន្ធ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="text" name="name_auther"
                                                    value='<?php echo $row_teacher_digital_ejournal["name_auther"]?>'
                                                    class="form-control form-control" id="">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">កាលបរិច្ឆេត
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <input type="date" name="date"
                                                    value='<?php echo $row_teacher_digital_ejournal["date"]?>'
                                                    class="form-control form-control" id="" aria-describedby="">


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


                                                <input type="text" name="select_major"
                                                    value='<?php echo $row_teacher_digital_ejournal["select_major"]?>'
                                                    class="form-control form-control" id="" aria-describedby=""
                                                    readonly>
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
                                                    <?php
                                                    if($row_teacher_digital_ejournal['digital_book']=='e-book'){
                                                        ?>
                                                    <input type="radio" name="digital_book" class="" id=""
                                                        value="e-book" checked>
                                                    <label for="">e-Book, </label>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($row_teacher_digital_ejournal['digital_book']=='e-project'){
                                                        ?>
                                                    <input type="radio" name="digital_book" class="" id=""
                                                        aria-describedby="" value="e-project" checked>
                                                    <label for="">e-Project, </label>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($row_teacher_digital_ejournal['digital_book']=='e-journal'){
                                                        ?>
                                                    <input type="radio" name="digital_book" class="" id=""
                                                        aria-describedby="" value="e-journal" checked>
                                                    <label for="">e-Journal </label>
                                                    <?php
                                                    }
                                                    ?>

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
                                                class="summernote form-control"><?php echo $details; ?>
                                            </textarea>
                                        </div>
                                        <div class="form-group">

                                            <label class="label-control" for=""
                                                style="font-family:'Koulen', sans-serif;">ពាក្យគន្លឺះ
                                                <spatn class=" text-danger">:*
                                                </spatn>
                                            </label>
                                            <input type="text" name="keyword" class="form-control form-control"
                                                value="<?php echo $row_teacher_digital_ejournal['keyword']?>">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4">
                                                <label class="label-control" for=""
                                                    style="font-family:'Koulen', sans-serif;">រូប Cover សៀវភៅ
                                                    <spatn class=" text-danger">:*
                                                    </spatn>
                                                </label>
                                                <div class="my-2">
                                                    <?php
                                                        foreach (json_decode($row_teacher_digital_ejournal["image_one"]) as $image_one) : ?>
                                                    <img src="uploads/<?php echo $image_one; ?>" width=200>
                                                    <?php endforeach; ?>
                                                </div>
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
                                                <div class="my-2 d-flex">
                                                    <?php
                                                        foreach (json_decode($row_teacher_digital_ejournal["image_two"]) as $image_two) : ?>
                                                    <img src="uploads/<?php echo $image_two; ?>" width=200>
                                                    <?php endforeach; ?>
                                                </div>
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
                                                            <h4>File Uploaded :<span class="detail-digital mx-4 h5"><a
                                                                        class=""
                                                                        href="view-digital-ebook.php?file_id_view=<?php echo $row_teacher_digital_ejournal['id'] ?>"
                                                                        target="_blank"><?php echo $row_teacher_digital_ejournal['name']?></a></span>
                                                            </h4>
                                                            <input class="btn btn-secondary" type="file" name="myfile">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control" for=""
                                                style="font-family:'Koulen', sans-serif;">មតិយោបល់
                                                <spatn class=" text-danger">:*
                                                </spatn>
                                            </label>
                                            <textarea name="comment" id="" cols="30" rows="10"
                                                class="summernote form-control"><?php echo $detailse; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary"><i
                                            class="fa-solid fa-circle-check"></i>
                                        Edit Digital Book
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
<?php
        }
    }
}

?>



</html>