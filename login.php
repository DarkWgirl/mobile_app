<?php
session_start();


$publickey = "";
$privatekey = "";


if(isset($_SESSION['writer_id'])){
    header("location: writer_index.php");
}
else{
    
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="public/js/general_script.js"></script>
      <script src="public/js/angular.js"></script>
  <script src="public/js/angular-route.js"></script>
    <script src="public/js/myAngularApp.js"></script>

</head>

<body>
<div ng-app="myStoreApp" ng-controller="myStoreAppCtrl">


    <div class="wrapper" style="box-shadow: 4px 3px  15px #888888;">
        <div class="title-text">
            <div class="title login">
                Technopacer Mobile Application</div>
            <div class="title signup">
                Signup Form</div>
        </div>

        <div class="form-container">
                <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab">
                </div>
            </div>
            <p id="message" style="color:red;">
            <?php
            if(isset($_SESSION['warning'])){
                 echo $_SESSION['warning'];
                }
            ?></p>
            <div class="form-inner">
                <form method="POST" class="login" id="login" ng-submit="loginWriter(login_form)">
                    <div class="field">
                        <input type="tex" ng-model="login_form.username" placeholder="Username" required>
                    </div>
                    <div class="field">
                        <input type="password" ng-model="login_form.password" placeholder="Password" required>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" value="Login">
                    </div>
                   <div class="pass-link"><br>
                        <a href="admin_login.php">Contributor Admin</a></div>

                </form>
                <form method="POST" class="signup" ng-submit="writerSignUp(writer_form)" id="signup">
                   <div class="field">
                        <input type="text" id="signup_username" placeholder="Username" ng-model="writer_form.username" required>
                    </div>
                    <div class="field">
                        <input type="text" id="signup_accesscode" ng-model="writer_form.accescode" placeholder="Access Code" required>
                    </div>
                    <div class="field">
                        <input type="password" id="signup_password" ng-model="writer_form.password" placeholder="Password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" name="sign_up" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="public/js/login.js"></script>


</body>

</html>