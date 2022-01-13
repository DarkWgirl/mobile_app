<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$username = $form_data->username;
$password = $form_data->password;


$login = mysqli_query($pos_db, "SELECT * from writer_tbl where writer_username = '$username' AND writer_password = '$password' AND writer_status != 'ARCHIVE'");
$fetch_data = mysqli_fetch_array($login);
$check_data = mysqli_num_rows($login);

$data = "";
if($check_data > 0){

	$_SESSION['writer_id'] = $fetch_data['writer_id'];
	$_SESSION['writer_position'] = $fetch_data['writer_position'];
	$data = "";

}
else{
	$_SESSION['warning'] = "Wrong Username/Password";
}


echo $data;




?>