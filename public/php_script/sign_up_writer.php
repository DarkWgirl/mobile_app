<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$username = $form_data->username;
$accescode = $form_data->accescode;
$password = $form_data->password;

$data = "";
$check_ac = mysqli_query($pos_db, "SELECT * from writer_tbl where writer_access_code = '$accescode'");
$check_access = mysqli_num_rows($check_ac);
$fetch_details = mysqli_fetch_array($check_ac);


if($check_access > 0){
		$_SESSION['writer_id'] = $fetch_details['writer_id'];
		$update_access = mysqli_query($pos_db, "UPDATE writer_tbl set writer_username = '$username', writer_password = '$password' where writer_access_code = '$accescode'");
		$data = "";

}else{
$_SESSION['warning'] = "Access Code Does Not Exist";

}





?>