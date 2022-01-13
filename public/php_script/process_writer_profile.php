<?php

session_start();
include("db_config.php");
if(isset($_SESSION['writer_id'])){
    $wid = $_SESSION['writer_id'];

    }
    global $wid;


$form_data = json_decode(file_get_contents("php://input"));
$writer_name = $form_data->writer_name;
$writer_course = $form_data->writer_course;
$writer_student_number = $form_data->writer_student_number;
$writer_username = $form_data->writer_username;
$writer_password = $form_data->writer_password;

$update_profile = mysqli_query($pos_db, "UPDATE writer_tbl set writer_name = '$writer_name', writer_course = '$writer_course', writer_school_number = '$writer_student_number', writer_username = '$writer_username', writer_password = '$writer_password', writer_status = 'ACTIVE' where writer_id = '$wid'");






?>