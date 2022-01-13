<?php

session_start();
include("db_config.php");


$data = array();
$form_data = json_decode(file_get_contents("php://input"));




$query = mysqli_query($pos_db, "UPDATE article_tbl set request_for_reedit = 'YES' where article_id = '$form_data'");

?>