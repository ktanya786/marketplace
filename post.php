<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
//print_R($_POST);
// get all templates
$update_query = "UPDATE `tbl_template`
SET `template_name`='".trim(mysqli_real_escape_string($sql,$_POST['template_name']))."',
`description`='".trim(mysqli_real_escape_string($sql,$_POST['description']))."' WHERE tpl_id =".$_POST['t_id'];

//echo $update_query;die();
$update_result = mysqli_query($sql,$update_query);
echo $update_result;
die();


?>