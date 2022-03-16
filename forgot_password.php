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


    $check_student_if_exist = mysqli_query($pos_db, "SELECT * from student_tbl where student_id = '$sid' AND student_status = 'VERIFIED'");
    $count_exist = mysqli_num_rows($check_student_if_exist);
    if($check_if_continue > 0){
        $mssg = "Please check your email address for your verification";     
    }
    else if($count_exist > 0){
    header("location: student_index.php");
    }
    else{
    
    }
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
<!--- Start of Design-->

        <div class="title-text">
            <div class="title login">
                Technopacer <br>Mobile <br>Application
            </div>
        </div>

        <div class="form-container">
            <center>
        <p style="color:red;">{{message_error}}</p><br>
        {{message_loading}}
</center>
            <div class="form-inner">
                <form method="POST" class="login" id="forgot_password" ng-submit="forgotPassword(login_form)">
                    <div class="field">
                    <i>Please input your signed email</i>
                        <input type="email" ng-model="login_form.email" placeholder="Email" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" value="Reset Password">
                    </div>

                </form>
        
        <!--Divider to verification and change passsword -->
        <form method="POST" class="login" style="display: none;" id="verfication_password" ng-submit="verifyPassword(login_form)">
                    <div class="field">
                    <i>Please Input Verification Code</i>
                        <input type="text" ng-model="login_form.verification" placeholder="Verification" required>
                    </div>
                    <div class="field">
                        <input type="password" ng-model="login_form.new_password" placeholder="New Password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" value="Change password">
                    </div>

                </form>
            </div>
            <!--End of Form-->

        </div>
    </div>

            </div>
</body>

</html>