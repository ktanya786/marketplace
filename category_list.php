<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");

$category ="Continuous integration
Continuous deployment 
Code Repository
Collaboration
Social Media
Collaboration for Code review
Code Repository
Code Repository
Google
Google
Social Media
Social Media
Project Management
Build Management
Continuous integration
Continuous deployment 
Project Management
Ticket Management
Finance
Project Management
Customer Relationship Management
ITSM
Ticket Management
Code Quality
Continuous integration
Continuous deployment 
Talent and Acquisition
Code Repository
Project Management
continuous integration
Continuous deployment 
Testing
Continuous integration
Continuous deployment 
Social Media
Social Media
Social Media
Ticket Management
continuous integration
Continuous deployment
Container Mgmt Tool
Continuous integration
Continuous deployment
Project Management
Collaboration
System Monitoring
Continuous integration
Continuous deployment 
Development Repository Manager
Collaboration
Security Policy Engine
Collaboration
Social Media
Project Management";

$categoryList = explode(PHP_EOL, $category);
print_r($categoryList);
$categoryList = array_map('trim', $categoryList);
$uniqueCat = array_unique($categoryList);
$uniqueCat = array_values(array_filter($uniqueCat));
print_r($uniqueCat);

for($i=0;$i<count($uniqueCat);$i++){
    echo $insertCat= "INSERT INTO tbl_category (`cat_name`) VALUES ('".$uniqueCat[$i]."')";
    $query = mysqli_query($sql,$insertCat);
    echo "<br>";
    echo $insertedid = mysqli_insert_id($sql);
}
?>