<?php

session_start();
include("db_config.php");
include("../asset/mail.php");

$id = json_decode(file_get_contents("php://input"));
$update_account = mysqli_query($pos_db, "UPDATE student_tbl set student_status = 'VERIFIED' where student_id = '$id'");

$get_student_details = mysqli_query($pos_db, "SELECT * from student_tbl where student_id = '$id'");
$studentData = mysqli_fetch_array($get_student_details);
$email = $studentData['student_email'];
$fname = $studentData['student_fname'];
    
    
    $mail->addAddress($email, $fname);
    $mail->Subject = "VerifyiedAccount";
    $mail->msgHTML("This is an automated email from Technopacer.<br>This is to confirm that your email: ".$email." is now verified<br><br>Thank you");
    $mail->send();
    

?>