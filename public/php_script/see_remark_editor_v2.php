<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data->article_id;


if(isset($_SESSION['writer_id'])){
	$wid = $_SESSION['writer_id'];
	$update_remark = mysqli_query($pos_db, "UPDATE remark_tbl INNER JOIN article_tbl on article_tbl.article_id = remark_tbl.article_id INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id set remark_read_status = 'READ' where remark_tbl.article_id = '$aid' AND remark_tbl.remark_read_status = 'PENDING' AND writer_tbl.writer_id = '$wid'");

}


$get_remark = mysqli_query($pos_db, "SELECT * FROM remark_tbl INNER JOIN admin_tbl on admin_tbl.admin_id = remark_tbl.admin_id where article_id = '$aid' ORDER BY remark_submit_date DESC");

while($row = mysqli_fetch_array($get_remark)){

	$data[] =  array("remark_date"=>$row['remark_submit_date'], "remark"=>$row['remark'], "admin"=>$row['admin_name'], "remark_id"=>$row['remark_id']);

}
 echo json_encode($data);







?>