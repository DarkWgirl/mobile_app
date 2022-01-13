<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$writer_status = $form_data->writer_status;


if($writer_status == "ALL"){


	$get_writer = mysqli_query($pos_db, "SELECT * from writer_tbl");
}
else{

	$get_writer = mysqli_query($pos_db, "SELECT * from writer_tbl where writer_status = '$writer_status'");
}


$view_archive_btn = "";
$view_activate_btn = "";
while($row = mysqli_fetch_array($get_writer)){

		if($row['writer_status'] == "ACTIVE" || $row['writer_status'] == "INCOMPLETE"){
		$view_archive_btn = "block";
		$view_activate_btn = "none";
	}
	else if($row['writer_status'] == "ARCHIVE"){
		$view_archive_btn = "none";
		$view_activate_btn = "block";
	}


	$data[] =  array("writer_name"=>$row['writer_name'], "writer_position"=>$row['writer_position'], "writer_course"=>$row['writer_course'], "school_number"=>$row['writer_school_number'], "writer_status"=>$row['writer_status'], "writer_username"=>$row['writer_username'], "writer_id"=>$row['writer_id'], "active_btn"=>$view_activate_btn, "archive_btn"=>$view_archive_btn, "writer_accesscode"=>$row['writer_access_code']);

	
}


 echo json_encode($data);





?>