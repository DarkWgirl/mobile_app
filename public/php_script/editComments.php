<?php

session_start();
include("db_config.php");


$data = array();
$cid = json_decode(file_get_contents("php://input"));

$getComment = mysqli_query($pos_db, "SELECT * from comment_tbl where comment_id = '$cid'");

while($row = mysqli_fetch_array($getComment)){
    $data[] = array("comment"=>$row['comments'], "comment_id"=>$row['comment_id']);
}

echo json_encode($data);


    ?>