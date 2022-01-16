<?php

session_start();
include("db_config.php");

if(isset($_SESSION['student_id'])){
    $sid = $_SESSION['student_id'];
  }

  global $sid;



$aid = json_decode(file_get_contents("php://input"));


$check_if_already_liked = mysqli_query($pos_db, "SELECT * from sentiment_tbl where article_id = '$aid' AND student_id = '$sid'");
$check_exist = mysqli_num_rows($check_if_already_liked);
$fetchAid = mysqli_fetch_array($check_if_already_liked);

if($check_exist > 0 && $fetchAid['liked_status'] === "1"){
    $sentId = $fetchAid['sentiment_id'];
    $updadate = mysqli_query($pos_db, "DELETE from sentiment_tbl where sentiment_id = '$sentId'");
    
}


?>