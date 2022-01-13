<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$admin_status = $form_data->admin_status;


if($admin_status == "ALL"){

	$get_admin = mysqli_query($pos_db, "SELECT * from admin_tbl");

}else{
	$get_admin = mysqli_query($pos_db, "SELECT * from admin_tbl where admin_status = '$admin_status'");

}

$view_archive_btn = "";
$view_activate_btn = "";

while($row = mysqli_fetch_array($get_admin)){

	if($row['admin_status'] == "ACTIVE"){
		$view_archive_btn = "block";
		$view_activate_btn = "none";
	}
	else if($row['admin_status'] == "ARCHIVE"){
		$view_archive_btn = "none";
		$view_activate_btn = "block";
	}

	$data[] = array("admin_name"=>$row['admin_name'], "admin_designation"=>$row['admin_designation'], "admin_username"=>$row['admin_username'], "admin_password"=>$row['admin_password'], "active_btn"=>$view_activate_btn, "archive_btn"=>$view_archive_btn, "admin_id"=>$row['admin_id'], "admin_status"=>$row['admin_status']);
}


 echo json_encode($data);





?>