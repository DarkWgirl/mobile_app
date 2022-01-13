<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data->article_id;
$remark = $form_data->remark;

if(isset($_SESSION['writer_id'])){
	$writer_id = $_SESSION['writer_id'];
}
global $writer_id;
$date_today = date('Y-m-d');
$add_remark = mysqli_query($pos_db, "INSERT INTO remark_tbl (remark, article_id, writer_id, remark_submit_date) VALUES ('$remark', '$aid', '$writer_id', '$date_today')");






?>