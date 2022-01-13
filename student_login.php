<?php
session_start();

include("public/php_script/db_config.php");


$publickey = "";
$privatekey = "";
$mssg = "";


if(isset($_SESSION['student_id'])){
    $sid = $_SESSION['student_id'];

    $check_student_status = mysqli_query($pos_db, "SELECT * from student_tbl where student_id = '$sid' AND student_status = 'NOT-VERIFIED'");
    $check_if_continue = mysqli_num_rows($check_student_status);
    if($check_if_continue > 0){
        $mssg = "Please check your email address for your verification"; 
    }else{
        header("location: student_index.php");   
    }
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
    <script src="public/js/studentApp.js"></script>

</head>

<body>
<div ng-app="myStoreApp" ng-controller="myStoreAppCtrl">


    <div class="wrapper" style="box-shadow: 4px 3px  15px #888888;">
        <div class="title-text">
            <div class="title login">
                Technopacer <br>Mobile <br>Application</div>
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
            if($mssg !== ""){
                echo $mssg;
            }
            if(isset($_SESSION['warning'])){
                 echo $_SESSION['warning'];
                }
            ?></p>
            <div class="form-inner">
                <form method="POST" class="login" id="login" ng-submit="loginWriter(login_form)">
                    <div class="field">
                        <input type="email" ng-model="login_form.email" placeholder="Email" required>
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

                </form>
                <form method="POST" class="signup" ng-submit="studentSignUp(writer_form)" id="signup">
                    <div class="field">
                        <input type="password" id="signup_password" ng-model="student_signup_form.password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input type="email" id="signup_email" ng-model="student_signup_form.email" placeholder="E-mail" required>
                    </div>
                    <div class="field">
                        <input type="text" id="signup_fname" ng-model="student_signup_form.fname" placeholder="First Name" required>
                    </div>
                    <div class="field">
                        <input type="text" id="signup_lname" ng-model="student_signup_form.lname" placeholder="Last Name" required>
                    </div>
                    <div class="field">
                        <input type="text" id="signup_snumber" ng-model="student_signup_form.snumber" placeholder="Student Number" required>
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