<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>ClearTrail - LI MarketPlace</title>
<link rel="apple-touch-icon" sizes="57x57" href="images/fav-icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/fav-icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/fav-icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/fav-icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/fav-icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/fav-icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/fav-icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/fav-icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/fav-icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/fav-icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/fav-icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/fav-icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/fav-icon/favicon-16x16.png">
<link rel="manifest" href="images/fav-icon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/fav-icon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="inr-body">
<div class="header">
    <div class="container">
        <div class="header-left">
            <a href="#"><img src="images/logo.png" alt="ClearTrail - Marketplace"></a>
        </div>
        <div class="header-right">
            <div class="navigation">
                <a class="toggleMenu" href="javascript:void(0)">Menu</a>
                
                <ul class="nav">
                    <li>
                        <a href="javascript:void(0)" class="active">Welcome Tanmay <i class="fas fa-caret-down"></i></a>
                        <div class="submenu">
                            <ul>
                            <li><a href="#" class="">Manage Templates</a></li>
                            <li><a href="#" class="">Change Password</a></li>
                            <li><a href="#" class="">Log Out</a></li>
                        </ul>
                        </div>
                    </li>
                    </ul>
            </div>
            <div class="upload-btn"><a href="#">Upload</a></div>
        </div>
        <div class="header-center">
            <div class="search-hold">
                <form action="">
                    <input type="text" placeholder="Search Templates">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- banner -->
<div class="banner-area">
    <div class="container">
        <h2>Upload Template</h2>
    </div>
</div>
        <div class="container" >
            <input type="file" name="file" id="file">

            <!-- Drag and Drop container-->
            <div class="upload-area"  id="uploadfile">
                <h1>Drag and Drop file here<br/>Or<br/>Click to select file</h1>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© 2019 ClearTrail Technologies, inc. All rights reserved. | <a href="https://www.clear-trail.com/privacy-policy.html" target="_blank">Privacy</a></p>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="script.js" type="text/javascript"></script>
        <script src="js/menu.js" type="text/javascript"></script>
        <script>
        $(document).ready(function(){
           $(".navigation").dropdowns();
        });
        </script>
    </body>
</html>