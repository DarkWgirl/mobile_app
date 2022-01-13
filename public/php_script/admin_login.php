<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$username = $form_data->username;
$password = $form_data->password;


$login = mysqli_query($pos_db, "SELECT * from admin_tbl where admin_username = '$username' AND admin_password = '$password'");
$fetch_data = mysqli_fetch_array($login);
$check_data = mysqli_num_rows($login);

$data = "";
if($check_data > 0){

	$_SESSION['admin_id'] = $fetch_data['admin_id'];
	$_SESSION['admin_designation'] = $fetch_data['admin_designation'];
	$data = "";

}
else{
	$_SESSION['warning'] = "Wrong Username/Password";
}


echo $data;




?>