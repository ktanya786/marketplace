<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
//print_R($_POST);
// get all templates

$email = "admin@clear-trail.com";
$password = md5("Cle@rtrail#212");// Cle@rtrail#212
$insert_query = "INSERT INTO `tbl_users`
                (`u_email`,`password`)
                VALUES
                ('".$email."','". $password."')";
echo $insert_query;//die();
echo "<br>";
$insert_result = mysqli_query($sql,$insert_query);
echo $insert_result;
echo mysqli_insert_id($sql);
die();


?>