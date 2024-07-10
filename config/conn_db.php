<?php

$server_name = "localhost";
$user_name = "root";
$pass_word = "";
$db_name = "digital_labrary";

$conn = mysqli_connect($server_name,$user_name,$pass_word,$db_name);

if($conn-> connect_error){
    die("You connect Error.".$conn-> connect_error);
    
}

?>