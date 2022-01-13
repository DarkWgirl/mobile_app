<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data->writer_id;



$query = mysqli_query($pos_db, "UPDATE writer_tbl set writer_status = 'INCOMPLETE' where writer_id = '$aid'");





?>