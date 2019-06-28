<?php
echo "123";
die();
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");

$checkUser_query = "SELECT * FROM `tbl_users`
WHERE u_email='".$_POST['username']."'
AND password ='".md5($_POST['password'])."'";

echo $checkUser_query;
die();


$update_result = mysqli_query($sql,$checkUser_query);
echo $update_result;
die();


?>