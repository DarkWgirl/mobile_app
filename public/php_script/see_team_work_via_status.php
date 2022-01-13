<?php

session_start();
include("db_config.php");

$data = array();

if(isset($_SESSION['writer_id'])){
	$writer_id = $_SESSION['writer_id'];
}
global $writer_id;
$form_data = json_decode(file_get_contents("php://input"));
$work_status = $form_data->work_status;
$remark_btn = "";


if($work_status == 'ALL'){

$get_writers_work = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id ORDER BY article_submit_date DESC");

}else{

	$get_writers_work = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id where article_status = '$work_status' ORDER BY article_submit_date DESC");

}
while($work_data = mysqli_fetch_array($get_writers_work)){
	$article_id = $work_data['article_id'];
	$get_pending_remark = mysqli_num_rows(mysqli_query($pos_db, "SELECT * from remark_tbl where article_id = '$article_id' AND remark_read_status = 'PENDING'"));

	if($get_pending_remark > 0){
$remark_btn = "red";
	}
	else{
		$remark_btn = "";
	}


	$article_body = htmlspecialchars_decode($work_data['article_body']);

$data[] =  array("writer_name"=>$work_data['writer_name'], "writer_position"=>$work_data['writer_position'], "article_title"=>$work_data['article_title'], "article_id"=>$work_data['article_id'], "article_category"=>$work_data['article_category'], "article_submit_date"=>$work_data['article_submit_date'], "article_body"=>$article_body, "article_type"=>$work_data['article_type'], "article_status"=>$work_data['article_status'], "article_picture"=>$work_data['article_picture'], "remark_count"=>$get_pending_remark, "remark_btn"=>$remark_btn);

}
 echo json_encode($data);





?>