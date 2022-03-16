<?php

session_start();
include("db_config.php");
include("../asset/mail.php");

$length = 5;
$randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz123456"), 0, $length);

$student_details = json_decode(file_get_contents("php://input"));
$email = $student_details->email;
$get_details = mysqli_query($pos_db, "SELECT * from student_tbl where student_email = '$email'");
$check_if_exist = mysqli_num_rows($get_details);
if($check_if_exist > 0){
$studentData = mysqli_fetch_array($get_details);
$id = $studentData['student_id'];
$fname = $studentData['student_fname'];

$get_student_details = mysqli_query($pos_db, "UPDATE student_tbl set forgot_password_code = '$randomletter' where student_id = '$id'");
    
    echo "Success";
    $mail->addAddress($email, $fname);
    $mail->Subject = "Reset Your password";
    $mail->msgHTML("This is an automated email from Technopacer.<br>To reset your account, please use the code below<br><b>".$randomletter."</b><br><br>Thank you");
    $mail->send();
}else{
    echo "Email Not existing";
}
    

?>