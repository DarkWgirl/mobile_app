<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data->article_id;


$approve_article = mysqli_query($pos_db, "UPDATE article_tbl set article_status = 'PENDING' where article_id = '$aid'");






?>