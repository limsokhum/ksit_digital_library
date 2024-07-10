<?php 
// session_start();
require "../config/conn_db.php";
$teacher_email = "";
$teacher_name = "";
$teacher_errors = array();

// Start Section PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../phpmailer/src/Exception.php';
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';
// End Section PHPMailer

//if teacher signup button
if(isset($_POST['teacher_signup'])){
    $teacher_id = $_POST['teacher_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $teacher_email = $_POST['teacher_email'];
    $phone = $_POST['phone'];
    $select_major = $_POST['select_major'];
    $specialty = $_POST['specialty'];
    $select_role = $_POST['select_role'];
    $teacher_password = $_POST['teacher_password'];
    $teacher_cpassword= $_POST['teacher_cpassword'];
    
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
    
    $teacher_detials = $_POST['teacher_detials'];
    
    if($teacher_password !== $teacher_cpassword){
        $teacher_errors['teacher_password'] = "បញ្ជាក់ពាក្យសម្ងាត់មិនត្រូវគ្នា!";
    }
    $teacher_email_check = "SELECT * FROM member WHERE email = '$teacher_email'";
    $teacher_res = mysqli_query($conn, $teacher_email_check);
    if(mysqli_num_rows($teacher_res) > 0){
        $teacher_errors['teacher_email'] = "អ៊ីមែលដែលអ្នកបានបញ្ចូលមានរួចហើយ!";
    }
    if(count($teacher_errors) === 0){
        // $teacher_encpass = password_hash($teacher_password, PASSWORD_BCRYPT);
        $teacher_encpass = password_hash($teacher_password, PASSWORD_BCRYPT);
        $teacher_code = rand(999999, 111111);
        $teacher_status = "notverified";
        $teacher_insert_data = "INSERT INTO member (member_id,firstname,lastname,sex,email,phone,select_major,specialty,select_role,password,image,detail,code,status) 
        VALUES('$teacher_id','$firstname','$lastname','$sex','$teacher_email','$phone','$select_major','$specialty','$select_role','$teacher_encpass','$filesArray','$teacher_detials','$teacher_code','$teacher_status')";
        // $teacher_insert_data = "INSERT INTO teacher_tb (teacher_id,	firstname,	lastname, sex,	teacher_mail,	phone,	select_major,	specialty,	select_role,	teacher_password, image, teacher_detials,	teacher_code,	teacher_status)
        //                                       values('$teacher_id', '$firstname', '$lastname', '$sex', '$teacher_email', '$phone', '$select_major', '$specialty', '$select_role', '$teacher_encpass', '$filesArray', '$teacher_detials', '$teacher_code', '$teacher_status')";
        // $teacher_data_check = mysqli_query($conn, $teacher_insert_data);
        $teacher_data_check = mysqli_query($conn, $teacher_insert_data);

        if($teacher_data_check){
            $mail = new PHPMailer(true);
            $mail -> isSMTP();
            $mail -> Host = 'smtp.gmail.com';
            $mail -> SMTPAuth = true;
            $mail -> Username = 'sokhunlim36@gmail.com';
            $mail -> Password = 'btoymsrjwznwohor'; 
            $mail -> SMTPSecure = 'ssl'; 
            $mail -> Port = 465;
            $mail -> setFrom('sokhunlim36@gmail.com'); 
            $mail -> addAddress($teacher_email);
            $mail -> isHTML(true); 
            $mail -> Body = "លេខកូដផ្ទៀងផ្ទាត់របស់អ្នកគឺ $teacher_code";
            $function_send = $mail -> send();
        
            if($function_send==true){
               $info = "យើងបានផ្ញើលេខកូដផ្ទៀងផ្ទាត់ទៅអ៊ីមែលរបស់អ្នក - $teacher_email";
                $_SESSION['info'] = $info;
                $_SESSION['teacher_email'] = $teacher_email;
                $_SESSION['teacher_password'] = $teacher_password;
                header('location: teacher-otp.php');
                exit();
            }else{
                $errors['teacher_otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
            }
            
    }else{
        $errors['teacher_db-error'] = "បរាជ័យពេលបញ្ចូលទិន្នន័យទៅក្នុងមូលដ្ឋានទិន្នន័យ!";
    }

        
        // if($teacher_data_check){
        //     $subject = "លេខកូដផ្ទៀងផ្ទាត់អ៊ីមែល";
        //     $message = "លេខកូដផ្ទៀងផ្ទាត់របស់អ្នកគឺ $teacher_code";
        //     $sender = "From: sokhumlim@gmail.com";
        //     if(mail($teacher_email, $subject, $message, $sender)){
        //         $info = "យើងបានផ្ញើលេខកូដផ្ទៀងផ្ទាត់ទៅអ៊ីមែលរបស់អ្នក។ - $teacher_email";
        //         $_SESSION['teacher_info'] = $info;
        //         $_SESSION['teacher_email'] = $teacher_email;
        //         $_SESSION['teacher_password'] = $teacher_password;
        //         header('location: teacher-otp.php');
        //         exit();
        //     }else{
        //         $errors['teacher_otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
        //     }
        // }else{
        //     $errors['teacher_db-error'] = "បរាជ័យពេលបញ្ចូលទិន្នន័យទៅក្នុងមូលដ្ឋានទិន្នន័យ!";
        // }
        
    }

}

    //if teacher click verification code submit button
    if(isset($_POST['teacher_check'])){
        $_SESSION['teacher_info'] = "";
        $teacher_otp_code = mysqli_real_escape_string($conn, $_POST['teacher_otp']);
        $teacher_check_code = "SELECT * FROM member WHERE code = $teacher_otp_code";
        $teacher_code_res = mysqli_query($conn, $teacher_check_code);
        if(mysqli_num_rows($teacher_code_res) > 0){
            $teacher_fetch_data = mysqli_fetch_assoc($teacher_code_res);
            $teacher_fetch_code = $teacher_fetch_data['code'];
            $teacher_email = $teacher_fetch_data['email'];
            $teacher_code = 0;
            $teacher_status = 'verified';
            $teacher_update_otp = "UPDATE member SET code = $teacher_code, status = '$teacher_status' WHERE code = $teacher_fetch_code";
            $teacher_update_res = mysqli_query($conn, $teacher_update_otp);
            if($teacher_update_res){
                $_SESSION['teacher_name'] = $teacher_name;
                $_SESSION['teacher_email'] = $teacher_email;
                header('location: list-teacher.php');
                exit();
            }else{
                $teacher_errors['teacher_otp-error'] = "បរាជ័យ​ពេល​ធ្វើ​បច្ចុប្បន្នភាព​កូដ!";
            }
        }else{
            $teacher_errors['teacher_otp-error'] = "អ្នក​បាន​បញ្ចូល​កូដ​មិន​ត្រឹមត្រូវ!";
        }
    }


    //if teacher click continue button in forgot password form for teacher dashboard
    if(isset($_POST['teacher_check-email'])){
        $teacher_email = mysqli_real_escape_string($conn, $_POST['teacher_email']);
        $teacher_check_email = "SELECT * FROM member WHERE email='$teacher_email'";
        $teacher_run_query = mysqli_query($conn, $teacher_check_email);
        if(mysqli_num_rows($teacher_run_query) > 0){
            $teacher_code = rand(999999, 111111);
            $teacher_insert_code = "UPDATE member SET code = $teacher_code WHERE email = '$teacher_email'";
            $teacher_run_query =  mysqli_query($conn, $teacher_insert_code);

            if($teacher_run_query){
                $mail = new PHPMailer(true);
                $mail -> isSMTP();
                $mail -> Host = 'smtp.gmail.com';
                $mail -> SMTPAuth = true;
                $mail -> Username = 'sokhunlim36@gmail.com';
                $mail -> Password = 'btoymsrjwznwohor'; 
                $mail -> SMTPSecure = 'ssl'; 
                $mail -> Port = 465;
                $mail -> setFrom('sokhunlim36@gmail.com'); 
                $mail -> addAddress($teacher_email);
                $mail -> isHTML(true); 
                $mail -> Body = "លេខកូដផ្ទៀងផ្ទាត់របស់អ្នកគឺ $teacher_code";
                $function_send = $mail -> send();
            
                if($function_send==true){
                   $info = "យើងបានផ្ញើលេខកូដផ្ទៀងផ្ទាត់ទៅអ៊ីមែលរបស់អ្នក - $teacher_email";
                    $_SESSION['teacher_info'] = $info;
                    $_SESSION['teacher_email'] = $teacher_email;
                    header('location: teacher_teacher_reset-code.php');
                    exit();
                }else{
                    $teacher_errors['teacher_otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
                }
                
        }else{
            $errors['teacher_db-error'] = "បរាជ័យពេលបញ្ចូលទិន្នន័យទៅក្នុងមូលដ្ឋានទិន្នន័យ!";
        }

            
        }else{
            $teacher_errors['teacher_email'] = "អាសយដ្ឋានអ៊ីមែលនេះមិនមានទេ!";
        }
    }
    
    // if(isset($_POST['teacher_check-email'])){
    //     $teacher_email = mysqli_real_escape_string($conn, $_POST['teacher_email']);
    //     $teacher_check_email = "SELECT * FROM member WHERE email='$teacher_email'";
    //     $teacher_run_sql = mysqli_query($conn, $teacher_check_email);
    //     if(mysqli_num_rows($teacher_run_sql) > 0){
    //         $teacher_code = rand(999999, 111111);
    //         $teacher_insert_code = "UPDATE member SET code = $teacher_code WHERE email = '$teacher_email'";
    //         $teacher_run_query =  mysqli_query($conn, $teacher_insert_code);
            
    //         if($teacher_run_query){
    //             $subject = "លេខកូដផ្ទៀងផ្ទាត់អ៊ីមែល";
    //             $message = "លេខកូដផ្ទៀងផ្ទាត់របស់អ្នកគឺ $teacher_code";
    //             $sender = "From: sokhumlim@gmail.com";
    //             if(mail($teacher_email, $subject, $message, $sender)){
    //                 $info = "យើងបានផ្ញើលេខកូដផ្ទៀងផ្ទាត់ទៅអ៊ីមែលរបស់អ្នក។ - $teacher_email";
    //                 $_SESSION['teacher_info'] = $info;
    //                 $_SESSION['teacher_email'] = $teacher_email;
    //                 header('location: teacher-otp.php');
    //                 exit();
    //             }else{
    //                 $errors['teacher_otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
    //             }
    //         }else{
    //             $errors['teacher_db-error'] = "បរាជ័យពេលបញ្ចូលទិន្នន័យទៅក្នុងមូលដ្ឋានទិន្នន័យ!";
    //         }
            
    //     }else{
    //         $teacher_errors['teacher_email'] = "អាសយដ្ឋានអ៊ីមែលនេះមិនមានទេ!";
    //     }
    // }
    
    //if teacher click check reset otp button for teacher databoard
    if(isset($_POST['teacher_check-reset-otp'])){
        $_SESSION['teacher_info'] = "";
        $teacher_otp_code = mysqli_real_escape_string($conn, $_POST['teacher_otp']);
        $teacher_check_code = "SELECT * FROM member WHERE code = $teacher_otp_code";
        $teacher_code_res = mysqli_query($conn, $teacher_check_code);
        if(mysqli_num_rows($teacher_code_res) > 0){
            $teacher_fetch_data = mysqli_fetch_assoc($teacher_code_res);
            $teacher_email = $teacher_fetch_data['email'];
            $_SESSION['teacher_email'] = $teacher_email;
            $teacher_info = "សូមបង្កើតពាក្យសម្ងាត់ថ្មីដែលអ្នកមិនប្រើនៅលើគេហទំព័រផ្សេងទៀតណាមួយឡើយ។";
            $_SESSION['teacher_info'] = $teacher_info;
            header('location: teacher_teacher_new_password.php');
            exit();
        }else{
            $teacher_errors['teacher_otp-error'] = "អ្នក​បាន​បញ្ចូល​កូដ​មិន​ត្រឹមត្រូវ!";
        }
    }
    
    //if teacher click change password button
    if(isset($_POST['teacher_change-password'])){
        $_SESSION['teacher_info'] = "";
        $teacher_password = mysqli_real_escape_string($conn, $_POST['teacher_password']);
        $teacher_cpassword = mysqli_real_escape_string($conn, $_POST['teacher_cpassword']);
        if($teacher_password !== $teacher_cpassword){
            $teacher_errors['teacher_password'] = "បញ្ជាក់ពាក្យសម្ងាត់មិនត្រូវគ្នា!";
        }else{
            $teacher_code = 0;
            $teacher_email = $_SESSION['teacher_email']; //getting this email using session
            $teacher_encpass = password_hash($teacher_password, PASSWORD_BCRYPT);
            $teacher_update_pass = "UPDATE member SET code = $teacher_code, password = '$teacher_encpass' WHERE email = '$teacher_email'";
            $teacher_run_query = mysqli_query($conn, $teacher_update_pass);
            // $teacher_run_query = mysqli_query($conn, $teacher_update_pass);
            if($teacher_run_query){
                $teacher_info = "ពាក្យសម្ងាត់របស់អ្នកបានផ្លាស់ប្តូរ។ ឥឡូវនេះ អ្នកអាចចូលដោយប្រើពាក្យសម្ងាត់ថ្មីរបស់អ្នក។";
                $_SESSION['teacher_info'] = $teacher_info;
                header('Location: teacher_teacher_password_changed.php');
            }else{
                $teacher_errors['teacher_db-error'] = "បរាជ័យក្នុងការផ្លាស់ប្តូរពាក្យសម្ងាត់របស់អ្នក!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['teacher_login-now'])){
        header('Location: login-teacher.php');
    }




    
 // Teacher Representative allow use
 if(isset($_POST['check-allow'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM member WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    if(mysqli_num_rows($run_sql) > 0){
        
        $code = rand(999999, 111111);
        
        $insert_code = "UPDATE member SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        
        if($run_query){
            $mail = new PHPMailer(true);
            $mail -> isSMTP();
            $mail -> Host = 'smtp.gmail.com';
            $mail -> SMTPAuth = true;
            $mail -> Username = 'sokhunlim36@gmail.com';
            $mail -> Password = 'btoymsrjwznwohor'; 
            $mail -> SMTPSecure = 'ssl';
            $mail -> Port = 465;
            $mail -> setFrom('sokhunlim36@gmail.com'); 
            $mail -> addAddress($email);
            $mail -> isHTML(true); 
            $mail -> Body = "លេខកូដផ្ទៀងផ្ទាត់របស់អ្នកគឺ $code"; 
            $function_send = $mail -> send();
        
            if($function_send==true){
               $info = "យើងបានផ្ញើលេខសម្ងាត់ឡើងវិញ otp ទៅកាន់អ៊ីមែលរបស់អ្នក។ - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            }else{
                $errors['otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
            }
        }else{
            $errors['db-error'] = "មាន​អ្វីមួយ​មិន​ប្រក្រតី!";
        }

     
        
    }else{
        $errors['email'] = "អាសយដ្ឋានអ៊ីមែលនេះមិនមានទេ!";
    }
}

    
?>