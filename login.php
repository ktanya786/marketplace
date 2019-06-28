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
<link href="css/style.css" rel="stylesheet" type="text/css"/>

</head>

<body>

    <div class="login-container">
    <div class="login-right">
            <div class="consult-disc">
                <div class="login-logo">
                    <img src="images/Klera-login-logo.png" alt="Klera LLC" />
                </div>
                <div class="login-cont">
                    <h1>Welcome to <br> Klera’s App Store</h1>
                    <p>Experience and download 100+ apps and 40+ connectors to your tools.</p>
                    <div class="login-graphic">
                        <img src="images/login-graphic.png" alt="">
                    </div>
                </div>
                
            </div>
            <div class="shape-shkr"><img src="images/shape.svg" alt=""></div>
        </div>
        <div class="login-left">
        <div class="wrap">
        <div class="main">
            <div class="login-inr-cont"> 
                <div class="login-form" >
                    <?php
                    if(isset($_GET['error'])){
                        if($_GET['error']!==''){
                    ?>
                    <p style="color:red;font-size:12px;"><?php echo $_GET['error'];?></p>
                    <?php     
                        }
                    } 
                    ?>
                    
                    <form name="login" action="check.php" method="post">
                        <div class="login-form-hold">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div class="login-form-hold">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="login-form-btn">
                            <input type="submit" value="Log In" class="submit" id="submitForm">
                        </div>
                        <div class="login-form-checkbx">
                            <input type="checkbox" id="login-checkbox" name="remember_me">
                            <label for="login-checkbox">Remember me</label>
                        </div>
                    </form>
                </div>
                <div class="login-btm-msg">
                <p>Not a Klera user yet? <br><a href="http://klera.io/try_now/?pn=AppStore" target="_blank">Contact us</a> today.</p>
                </div>
            </div>
        </div>
    </div>
            <!-- <div class="copyright">&copy; 2019 Klera, LLC. All Rights Reserved. | <a href="https://klera.io/privacy-policy" target="_blank">Privacy</a></div> -->
        </div>
        
        <div class="clear"></div>
    </div>

<!-- scripts --> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 

<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script >// Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $(document).ready(function(){
    $("form[name='login']").validate({
        // Specify validation rules
        rules: {
      
        username: {
            required: true,
            // Specify that email should be validated
            // by the built-in "email" rule
            email: true
        },
        password: {
            required: true,
            minlength: 5
        }
        },
        // Specify validation error messages
        messages: {
            password: {
                required: "Please provide a password.",
                minlength: "Your password must be at least 5 characters long."
            },
            username: "Please enter a valid username."
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();

            
        }
    });
});
    </script>
</body>
</html>
