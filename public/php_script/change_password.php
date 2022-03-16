<?php

session_start();
include("db_config.php");
include("../asset/mail.php");

$length = 5;
$randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz123456"), 0, $length);

$student_details = json_decode(file_get_contents("php://input"));
$verification = $student_details->verification;
$new_password = $student_details->new_password;
$get_details = mysqli_query($pos_db, "SELECT * from student_tbl where forgot_password_code = '$verification'");
$check_if_exist = mysqli_num_rows($get_details);
if($check_if_exist > 0){
$studentData = mysqli_fetch_array($get_details);
$id = $studentData['student_id'];

$get_student_details = mysqli_query($pos_db, "UPDATE student_tbl set student_password = '$new_password' where student_id = '$id'");
    
}else{
    echo "Error changing password";
}
    

?>