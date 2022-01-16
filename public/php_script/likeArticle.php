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

if($check_exist > 0 && $fetchAid['liked_status'] === "0"){
    $sentId = $fetchAid['sentiment_id'];
    $updadate = mysqli_query($pos_db, "UPDATE sentiment_tbl set liked_status = '1' where sentiment_id = '$sentId'");
    
}else{

    $insert_sentiments = mysqli_query($pos_db, "INSERT INTO sentiment_tbl (student_id, article_id, liked_status) VALUES ('$sid', '$aid', '1')");


}


?>