<?php

session_start();
include("db_config.php");

if(isset($_SESSION['writer_id'])){
	$writer_id = $_SESSION['writer_id'];
}
global $writer_id;

if(isset($_POST['submit_announ_writing'])){


$article_title = $_POST['article_title'];
$article_body = $_POST['article_body'];
$fileToUpload = $_FILES['fileToUpload']["name"];
$article_category = "Announcement";
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
$date_today = date('Y-m-d');

$insert_event_article = mysqli_query($pos_db, "INSERT INTO article_tbl (article_title, article_body, article_category, article_type, article_picture, article_submit_date, writer_id) VALUES ('$article_title', '$article_body', '$article_category', 'Announcement', '$fileToUpload', '$date_today', '$writer_id')");
if($insert_event_article){
	header("location: ../../writer_index.php");
}



}





?>