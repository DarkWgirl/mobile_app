<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$password = $form_data->password;
$fname = $form_data->fname;
$lname = $form_data->lname;
$email = $form_data->email;
$snumber = $form_data->snumber;

$data = "";
$check_ac = mysqli_query($pos_db, "SELECT * from student_tbl where student_email = '$email'");
$check_access = mysqli_num_rows($check_ac);
$fetch_details = mysqli_fetch_array($check_ac);
$data = "";

if($check_access > 0){
    $_SESSION['warning'] = "Account<br>Already Exist";
		$_SESSION['writer_id'] = $fetch_details['writer_id'];
}else{
	$insertUser = mysqli_query($pos_db, "INSERT INTO student_tbl (student_fname, student_lname, student_email, student_password, student_number) VALUES ('$fname', '$lname', '$email', '$password', '$snumber')");
    $id = mysqli_insert_id($pos_db);
    $_SESSION['student_id'] = $id;
    echo $id;

}





?>