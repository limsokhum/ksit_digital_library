<?php 
session_start();
require "../config/conn_db.php";
$email = "";
$name = "";
$errors = array();

// Start Section PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../phpmailer/src/Exception.php';
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';
// End Section PHPMailer

if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $select_role = "អ្នកប្រើប្រាស់";
    $teacher_advisor = mysqli_real_escape_string($conn, $_POST['teacher_advisor']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "បញ្ជាក់ពាក្យសម្ងាត់មិនត្រូវគ្នា!";
    }
    $email_check = "SELECT * FROM member WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "អ៊ីមែលមានក្នុងប្រព័ន្ធរួចហើយ!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO member (name, email, select_role,teacher_advisor , password, code, status)
                        values('$name', '$email', '$select_role', '$teacher_advisor', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($conn, $insert_data);
        
        if($data_check){
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
               $info = "យើងបានផ្ញើលេខកូដផ្ទៀងផ្ទាត់ទៅអ៊ីមែលរបស់អ្នក។ - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
            }
        }else{
            $errors['db-error'] = "បរាជ័យពេលបញ្ចូលទិន្នន័យទៅក្នុងមូលដ្ឋានទិន្នន័យ!";
        }
        
        // if($data_check){
        //     $subject = "លេខកូដផ្ទៀងផ្ទាត់អ៊ីមែល";
        //     $message = "លេខកូដផ្ទៀងផ្ទាត់របស់អ្នកគឺ $code";
        //     $sender = "From: sokhumlim@gmail.com";
        //     if(mail($email, $subject, $message, $sender)){
        //         $info = "យើងបានផ្ញើលេខកូដផ្ទៀងផ្ទាត់ទៅអ៊ីមែលរបស់អ្នក។ - $email";
        //         $_SESSION['info'] = $info;
        //         $_SESSION['email'] = $email;
        //         $_SESSION['password'] = $password;
        //         header('location: user-otp.php');
        //         exit();
        //     }else{
        //         $errors['otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
        //     }
        // }else{
        //     $errors['db-error'] = "បរាជ័យពេលបញ្ចូលទិន្នន័យទៅក្នុងមូលដ្ឋានទិន្នន័យ!";
        // }
        
    }

}


    //if user click verification code submit button
if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM member WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE member SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: welcome_page.php');
                exit();
            }else{
                $errors['otp-error'] = "បរាជ័យ​ពេល​ធ្វើ​បច្ចុប្បន្នភាព​កូដ!";
            }
        }else{
            $errors['otp-error'] = "អ្នក​បាន​បញ្ចូល​កូដ​មិន​ត្រឹមត្រូវ!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $check_email = "SELECT * FROM member WHERE (email = '$email' AND select_role='អ្នកប្រើប្រាស់')";
        $res = mysqli_query($conn, $check_email); 
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                $user_role =  $fetch['user_role'];
                if(($status == 'verified') and ($user_role == '1')){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: index-user.php');
                }else{
                    // $info = "វាហាក់ដូចជាអ្នកមិនទាន់បានផ្ទៀងផ្ទាត់អ៊ីមែលរបស់អ្នកនៅឡើយ - $email";
                    // $_SESSION['info'] = $info;
                    $errors['email'] = "អ្នកមិនទាន់ជាសមាជិក! សូមរងចាំការអនុញ្ញាតិពីគ្រូជំនួយការរបស់អ្នកជាមុនសិន។ <br>ចុកទីនេះ <a class='text-decoration-underline mt-2' href='index.php'>ទំព័រដើម</a>";
                    // header('location: user-otp.php');
                    // header('location: welcome_page.php');
                }
            }else{
                $errors['email'] = "ពាក្យសម្ងាត់របស់អ្នកមិនត្រឹមត្រូវ!";
            }
        }else{
            $errors['email'] = "វាហាក់ដូចជាអ្នកមិនទាន់បានផ្ទៀងផ្ទាត់អ៊ីមែលរបស់អ្នកនៅឡើយ - $email";
            // header('location: welcome_page.php');
        }   
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
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

            
            // if($run_query){
            //     $subject = "លេខកូដកំណត់ពាក្យសម្ងាត់ឡើងវិញ";
            //     $message = "លេខកូដកំណត់ពាក្យសម្ងាត់របស់អ្នកឡើងវិញ $code";
            //     $sender = "From: sokhumlim@gmail.com.com";
            //     if(mail($email, $subject, $message, $sender)){
            //         $info = "យើងបានផ្ញើលេខសម្ងាត់ឡើងវិញ otp ទៅកាន់អ៊ីមែលរបស់អ្នក។ - $email";
            //         $_SESSION['info'] = $info;
            //         $_SESSION['email'] = $email;
            //         header('location: reset-code.php');
            //         exit();
            //     }else{
            //         $errors['otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
            //     }
            // }else{
            //     $errors['db-error'] = "Something went wrong!";
            // }
            
        }else{
            $errors['email'] = "អាសយដ្ឋានអ៊ីមែលនេះមិនមានទេ!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM member WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "សូមបង្កើតពាក្យសម្ងាត់ថ្មីដែលអ្នកមិនប្រើនៅលើគេហទំព័រផ្សេងទៀតណាមួយឡើយ។";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "អ្នក​បាន​បញ្ចូល​កូដ​មិន​ត្រឹមត្រូវ!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "បញ្ជាក់ពាក្យសម្ងាត់មិនត្រូវគ្នា!";
        }else{
            $code = 0;
            $email = $_SESSION['email'];
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE member SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "ពាក្យសម្ងាត់របស់អ្នកបានផ្លាស់ប្តូរ។ ឥឡូវនេះ អ្នកអាចចូលដោយប្រើពាក្យសម្ងាត់ថ្មីរបស់អ្នក។";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "បរាជ័យក្នុងការផ្លាស់ប្តូរពាក្យសម្ងាត់របស់អ្នក!";
            }
        }
    }


        //if user click continue button in forgot password form
        if(isset($_POST['check-email'])){
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
    
                
                // if($run_query){
                //     $subject = "លេខកូដកំណត់ពាក្យសម្ងាត់ឡើងវិញ";
                //     $message = "លេខកូដកំណត់ពាក្យសម្ងាត់របស់អ្នកឡើងវិញ $code";
                //     $sender = "From: sokhumlim@gmail.com.com";
                //     if(mail($email, $subject, $message, $sender)){
                //         $info = "យើងបានផ្ញើលេខសម្ងាត់ឡើងវិញ otp ទៅកាន់អ៊ីមែលរបស់អ្នក។ - $email";
                //         $_SESSION['info'] = $info;
                //         $_SESSION['email'] = $email;
                //         header('location: reset-code.php');
                //         exit();
                //     }else{
                //         $errors['otp-error'] = "បរាជ័យ​ពេល​ផ្ញើ​លេខ​កូដ!";
                //     }
                // }else{
                //     $errors['db-error'] = "Something went wrong!";
                // }
                
            }else{
                $errors['email'] = "អាសយដ្ឋានអ៊ីមែលនេះមិនមានទេ!";
            }
        }
    
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>