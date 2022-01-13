<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data->article_id;
$remark = $form_data->remark;

if(isset($_SESSION['admin_id'])){
	$admin_id = $_SESSION['admin_id'];
}
global $admin_id;
$date_today = date('Y-m-d');
$add_remark = mysqli_query($pos_db, "INSERT INTO remark_tbl (remark, article_id, admin_id, remark_submit_date) VALUES ('$remark', '$aid', '$admin_id', '$date_today')");






?>