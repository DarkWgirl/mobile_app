<?php

session_start();
include("db_config.php");

if(isset($_SESSION['student_id'])){
    $sid = $_SESSION['student_id'];
  }

  global $sid;


if(isset($_POST['submit'])){
    
$comment = $_POST['comment'];
$aid = $_POST['aid'];

$insert_comment = mysqli_query($pos_db, "INSERT INTO comment_tbl (student_id, article_id, comments) VALUES ('$sid', '$aid', '$comment')");

header("location: ../../view_article.php?aid=".$aid."");
}
    ?>