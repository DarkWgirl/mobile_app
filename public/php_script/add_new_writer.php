<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$access_code = $form_data->access_code;
$writer_designation = $form_data->writer_designation;



$insert_new_writer = mysqli_query($pos_db, "INSERT INTO writer_tbl (writer_access_code, writer_position) VALUES ('$access_code', '$writer_designation')");





?>