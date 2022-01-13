<?php

session_start();
include("db_config.php");

$data = array();

$remark_btn = "";
$archive_btn = "";


$get_writers_work = mysqli_query($pos_db, "SELECT * from article_tbl where request_for_reedit = 'YES' ORDER BY article_submit_date DESC");
while($work_data = mysqli_fetch_array($get_writers_work)){
	$article_id = $work_data['article_id'];
	$get_pending_remark = mysqli_num_rows(mysqli_query($pos_db, "SELECT * from remark_tbl where article_id = '$article_id' AND remark_read_status = 'PENDING'"));

	if($get_pending_remark > 0){
$remark_btn = "red";
	}
	else{
		$remark_btn = "";
	}


	if($work_data['article_status'] == "APPROVED" || $work_data['article_status'] == "DECLINED" || $work_data['article_status'] == "ARCHIVE"){
		$archive_btn = "none";
	}else{
		$archive_btn = "block";
	}


	$article_body = htmlspecialchars_decode($work_data['article_body']);

$data[] =  array("article_title"=>$work_data['article_title'], "article_id"=>$work_data['article_id'], "article_category"=>$work_data['article_category'], "article_submit_date"=>$work_data['article_submit_date'], "article_body"=>$article_body, "article_type"=>$work_data['article_type'], "article_status"=>$work_data['article_status'], "article_picture"=>$work_data['article_picture'], "remark_count"=>$get_pending_remark, "remark_btn"=>$remark_btn, "archive_btn"=>$archive_btn);

}
 echo json_encode($data);





?>