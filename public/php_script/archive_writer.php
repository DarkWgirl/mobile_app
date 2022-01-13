<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$wid = $form_data->writer_id;


$update_writer = mysqli_query($pos_db, "UPDATE writer_tbl set writer_status = 'ARCHIVE' where writer_id = '$wid'");






?> 