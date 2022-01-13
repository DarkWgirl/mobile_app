<?php
session_start();

if(isset($_SESSION['admin_id'])){
    header("location: admin_index.php");
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
        </div>
        <div class="form-container">
            </div>
              <p id="message" style="color:red;">
            <?php
            if(isset($_SESSION['warning'])){
                 echo $_SESSION['warning'];
                }
            ?></p>
            <div class="form-inner">
                <form method="POST" class="login" id="login" ng-submit="loginAdmin(login_form)">
                    <div class="field">
                        <input type="tex" ng-model="login_form.username" placeholder="Username" required>
                    </div>
                    <div class="field">
                        <input type="password" ng-model="login_form.password" placeholder="Password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" value="Login">
                    </div>

                </form>
            </div>
        </div>
    </div>


</body>

</html>