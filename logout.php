<?php
session_start();
//print_r($_SESSION);
if(isset($_SESSION['user_logged_in'])){
    session_destroy();
    header("Location:login.php");
}

?>