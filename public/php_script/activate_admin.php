<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));
$aid = $form_data->admin_id;



$query = mysqli_query($pos_db, "UPDATE admin_tbl set admin_status = 'ACTIVE' where admin_id = '$aid'");





?>