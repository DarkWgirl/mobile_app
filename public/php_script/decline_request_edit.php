<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data;

if(isset($_SESSION['admin_id'])){
	$admin_id = $_SESSION['admin_id'];
}
global $admin_id;

$date_today = date('Y-m-d');


$approve_article = mysqli_query($pos_db, "UPDATE article_tbl set request_for_reedit = 'NO' where article_id = '$aid'");

$add_remark = mysqli_query($pos_db, "INSERT INTO remark_tbl (remark, admin_id, remark_submit_date, article_id) VALUES ('DECLINED FOR EDIT REQUEST', '$admin_id', '$date_today', '$aid')");






?>