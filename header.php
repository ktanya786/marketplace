
<?php
session_start();

if(!isset($_SESSION['user_logged_in'])){
    
    header("Location:login.php");
}
error_reporting(0);
include("connect.php");
include("variables.php");
$filename=basename(__FILE__, '.php'); 
//print_r($_SESSION);

//Triming username to first word
$trim_user = $_SESSION['name'];
$trimmed = explode(' ',trim($trim_user));

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Klera App Store</title>
<link rel="shortcut icon" href="images/favicon-1.png" type="image/x-icon">

<link rel="manifest" href="images/fav-icon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/favicon-1.png">
<meta name="theme-color" content="#ffffff">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="css/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="vizjs/vis.css">
<link rel="stylesheet" href="vizjs/vis-network.min.css">
<link rel="stylesheet" href="app/graphrender.css">
<link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="inr-body">
<div class="header">
    <div class="container">
        <div class="header-left">
           <p> <a href="home.php"><img src="images/Klera-login-logo.png" alt="Klera  App Store"></a></p>
        </div>
        <div class="header-right">
            <div class="navigation">
                <a class="toggleMenu" href="javascript:void(0)">Menu</a>
                
                <ul class="nav">
                    <li>
                        <a href="javascript:void(0)" class="active"><span>Welcome</span> <?php echo $trimmed[0]; //echo $_SESSION['name'];?> <i class="fas fa-caret-down"></i></a>
                        <div class="submenu">
                            <ul>
                            <?php if($_SESSION['role']!="end-user"){?>
                                <li><a href="manage_templates.php" class="">Manage Templates</a></li>
                            <?php } ?>
                            <li><a href="logout.php" class="">Log Out</a></li>
                        </ul>
                        </div>
                    </li>
                    </ul>
            </div>
            <?php if($_SESSION['role']!="end-user"){?>
            <div class="upload-btn"><a href="upload-template.php">Upload</a></div>
            <?php } ?>
        </div>
        <?php 
        
        $paths = explode('/',$_SERVER['REQUEST_URI']);
        //print_r($paths);
        $file_names = explode('.',$paths[2]);
        //print_r($file_names);
        if($file_names[0]=="manage_templates" || $file_names[0]=="edit_templete" || $file_names[0]=="upload-template" || $file_names[0]=="preview"){
            $class ="search_manage";
        }else{
            $class ="search_home";
        }
        ?>
        <div class="header-center">
            <div class="search-hold">
                <form name="search" class="<?php echo $class;?>">
                    <input type="text" placeholder="Search" name="search_field" class="search_field" id="search_field">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>