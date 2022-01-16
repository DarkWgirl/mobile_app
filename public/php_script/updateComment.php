<?php

session_start();
include("db_config.php");



if(isset($_POST['submit'])){
$comment = $_POST['comment'];
$comment_id = $_POST['comment_id'];
$aid = $_POST['aid'];

$updateComment = mysqli_query($pos_db, "UPDATE comment_tbl set comments = '$comment' where comment_id = '$comment_id'");

header("location: ../../view_article.php?aid=".$aid."");
}
?>