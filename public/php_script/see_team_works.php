<?php

session_start();
include("db_config.php");

$data = array();

if(isset($_SESSION['writer_id'])){
	$writer_id = $_SESSION['writer_id'];
}
global $writer_id;

	$get_writers_work = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.article_id ORDER BY article_id DESC");


while($work_data = mysqli_fetch_array($get_writers_work)){
	$article_body = htmlspecialchars_decode($work_data['article_body']);

$data[] =  array("article_title"=>$work_data['article_title'], "article_id"=>$work_data['article_id'], "article_category"=>$work_data['article_category'], "article_submit_date"=>$work_data['article_submit_date'], "article_body"=>$article_body, "article_type"=>$work_data['article_type'], "article_status"=>$work_data['article_status'], "article_picture"=>$work_data['article_picture'], "writer_name"=>$work_data['writer_name'], "writer_position"=>$work_data['writer_position']);


}
 echo json_encode($data);





?>