<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$admin_name = $form_data->admin_name;
$admin_designation = $form_data->admin_designation;
$admin_password = $form_data->admin_password;
$admin_username = $form_data->admin_username;
$aid = $form_data->admin_id;


$update_admin = mysqli_query($pos_db, "UPDATE admin_tbl set admin_name = '$admin_name', admin_username = '$admin_username', admin_designation = '$admin_designation', admin_password = '$admin_password' where admin_id = '$aid'");





?>