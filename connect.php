<?php

error_reporting(E_ALL & ~E_WARNING);
ini_set('display_errors', 1);

$hostname = $_SERVER['SERVER_NAME'];    
if($hostname=="localhost"){
    // for local
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'klera_store';
}else if($hostname=="www.clear-trail.com"){
    $host = 'db.dc.impetus.com';
	$user = 'ctweb';
    $pass = 'CtMp@123#';
    $database ='ct_marketplace';
}else{
    $hostname=="localhost";
    $host = 'localhost';
    $user = 'root';
    $pass = 'ctadmin';
    $database ='klera_store';
}
// $hostname=="www.clear-trail.com";
// $host = 'db.dc.impetus.com';
// $user = 'ctweb';
// $pass = 'CtMp@123#';
// $database ='ct_marketplace';


    
$sql = new mysqli($host, $user, $pass, $database);

// Check connection
if ($sql->connect_error) {
	die("Connection failed: " . $sql->connect_error);
}
    

?>