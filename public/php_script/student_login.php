<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$username = $form_data->email;
$password = $form_data->password;


$login = mysqli_query($pos_db, "SELECT * from student_tbl where student_email = '$username' AND student_password = '$password'");
$fetch_data = mysqli_fetch_array($login);
$check_data = mysqli_num_rows($login);

$data = "";
if($check_data > 0){

	$_SESSION['student_id'] = $fetch_data['student_id'];
	$data = "";

}
else{
	$_SESSION['warning'] = "Wrong Username/Password";
    $data = "1";
}


echo $data;




?>