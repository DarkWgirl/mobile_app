<?php

session_start();
include("db_config.php");

$cid = json_decode(file_get_contents("php://input"));

$deleteComment = mysqli_query($pos_db, "DELETE from comment_tbl where comment_id = '$cid'");



    ?>