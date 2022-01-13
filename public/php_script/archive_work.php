<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$article_id = $form_data->article_id;


$archive_work = mysqli_query($pos_db, "UPDATE article_tbl set article_status = 'ARCHIVE' where article_id = '$article_id'");


?>