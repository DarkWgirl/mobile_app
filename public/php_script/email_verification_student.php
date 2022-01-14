<?php

session_start();
include("db_config.php");
include("../asset/mail.php");

$id = json_decode(file_get_contents("php://input"));
$get_student_details = mysqli_query($pos_db, "SELECT * from student_tbl where student_id = '$id'");
$studentData = mysqli_fetch_array($get_student_details);
$email = $studentData['student_email'];
$fname = $studentData['student_fname'];
    
    
    $mail->addAddress($email, $fname);
    $mail->Subject = "Verify Email Account";
    $mail->msgHTML("This is an automated email from Technopacer.<br>To verify your account, please use the code below<br><b>TCP".$id."<br><br>Thank you");
    $mail->send();
    

?>