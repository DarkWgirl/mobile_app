<?php

session_start();
include("db_config.php");


$form_data = json_decode(file_get_contents("php://input"));
$admin_name = $form_data->admin_name;
$admin_designation = $form_data->admin_designation;
$admin_password = $form_data->admin_password;
$admin_username = $form_data->admin_username;


$add_admin = mysqli_query($pos_db, "INSERT INTO admin_tbl (admin_name, admin_username, admin_password, admin_designation) VALUES ('$admin_name', '$admin_username', '$admin_password', '$admin_designation')");






?>