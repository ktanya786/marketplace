<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
//print_R($_POST);
// get all templates
$delete_query = "DELETE FROM `tbl_template`
 WHERE tpl_id IN (".$_POST['t_ids'].")";

//echo $delete_query;die();
$delete_result = mysqli_query($sql,$delete_query);
echo $delete_result;
die();


?>