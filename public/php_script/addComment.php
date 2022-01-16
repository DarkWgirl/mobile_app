<?php

session_start();
include("db_config.php");

if(isset($_SESSION['student_id'])){
    $sid = $_SESSION['student_id'];
  }

  global $sid;



$form_data = json_decode(file_get_contents("php://input"));

    
$comment = $form_data->comment;
$aid = $form_data->aid;

$insert_comment = mysqli_query($pos_db, "INSERT INTO comment_tbl (student_id, article_id, comments) VALUES ('$sid', '$aid', '$comment')");



?>