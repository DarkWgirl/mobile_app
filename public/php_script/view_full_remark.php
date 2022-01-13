<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$rid = $form_data->remark_id;


$get_full_remark =  mysqli_query($pos_db, "SELECT * from remark_tbl where remark_id = '$rid'");
while($row = mysqli_fetch_array($get_full_remark)){

	$data = $row['remark'];
}

 echo json_encode($data);







?>