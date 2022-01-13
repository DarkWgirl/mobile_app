<?php

session_start();
include("db_config.php");

if(isset($_SESSION['writer_id'])){
	$writer_id = $_SESSION['writer_id'];
}
global $writer_id;

if(isset($_POST['submit_event_writing'])){


$article_title = $_POST['article_title'];
$article_body = $_POST['article_body'];
$fileToUpload = $_FILES['fileToUpload']["name"];
$target_dir = "../images/";
$article_id = $_POST['article_id'];


if($fileToUpload == ""){

	$update_event = mysqli_query($pos_db, "UPDATE article_tbl set article_title = '$article_title', article_body = '$article_body', article_status = 'PENDING' where article_id = '$article_id'");
	if($update_event){
	header("location: ../../writer_index.php");
}
}
else{
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
$update_event = mysqli_query($pos_db, "UPDATE article_tbl set article_title = '$article_title', article_body = '$article_body', article_picture = '$fileToUpload' where article_id = '$article_id'");
if($update_event){
	header("location: ../../writer_index.php");
}
}

}





?>