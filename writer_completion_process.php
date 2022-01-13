<?php
session_start();
include("public/php_script/db_config.php");

if(isset($_SESSION['writer_id'])){
    $wid = $_SESSION['writer_id'];

    }
    global $wid;

$check_user = mysqli_query($pos_db, "SELECT * from writer_tbl where writer_id = '$wid'");
$fetch_user = mysqli_fetch_array($check_user);


    $wid = $_SESSION['writer_id'];
$check_user = mysqli_num_rows(mysqli_query($pos_db, "SELECT * from writer_tbl where writer_id = '$wid' AND writer_status = 'INCOMPLETE'"));
if($check_user > 0){

}
else{
      header("location: writer_index.php");
}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/css/simple.css">
    <link rel="stylesheet" type="text/css" href="public/css/pos_style.css">
      <link rel="stylesheet" type="text/css" href="public/ckeditor5/sample/style.css">
    <script src="public/js/angular.js"></script>
  <script src="public/js/angular-route.js"></script>
     <script src="public/js/writer_completion_process.js"></script>
          <script src="public/js/profile_completion_process.js"></script>
      <script src="public/ckeditor5/build/ckeditor.js"></script>
      <script src="public/ckeditor5/build/ckeditor.js.map"></script>
  <script type="text/javascript" src="public/js/jquery-3.1.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
  <script type="text/javascript" src="public/js/bootstrap.min.js"></script>

  <script>
     ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    </script>  
    
                   

</head>
<div ng-app="myStoreApp" ng-controller="myStoreAppCtrl">
<body data-editor="ClassicEditor" data-collaboration="false">
<style type="text/css">
  .my-nav{
    background-color: lightgreen;
    padding: 10px;
}
</style>
    <nav class="navbar navbar-default navbar-static-top my-nav">
        <div class="menu">
            <div class="logo">
                <a href="#">Technopacer Mobile Application</a>
            </div>
            <ul>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </div>
    </nav>  
    <style type="text/css">
    .process_style{
      background-color: lightgray;
      color: white;
      border-radius: 90px;
      padding: 30px 38px 30px;
      height: 100px;
      width: 100px;
      font-size: 24px;
    } 
    .active-process{
      background-color: blue;
    }
    .identity_style{
      margin-top: 10%;
    }
    label{
      font-size: 12px;
      font-family: 'Century Gothic';
      font-style: initial;
    }
    </style>
    <div class="container">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-8">
        <br><br><br>
        <center>
      <span class="process_style active-process">1</span>________________
      <span class="process_style">2</span>________________
      <span class="process_style">3</span>
    </center>
      <div id="writer_identity" class="identity_style">
         <center><h4>My Profile</h4></center>
      <form method="POST" ng-submit="processProfile(writer_form)">
<!--Part 1-->
        <div id="identity_p1">
        <div class="form-group">
          <label>Name:</label>
          <input type="text" class="form-control part_one" placeholder="Name" ng-model="writer_form.writer_name" onkeyup="check_part_one()">
        </div>
           <div class="form-group">
            <label>Course:</label>
          <input type="text" class="form-control part_one" placeholder="Course/Strand" ng-model="writer_form.writer_course" onkeyup="check_part_one()">
        </div>
              <div class="form-group">
                <label>Student Number:</label>
          <input type="text" class="form-control part_one" placeholder="Student Number" ng-model="writer_form.writer_student_number" onkeyup="check_part_one()">
        </div>
        <center>
        <a href="" class="btn btn-primary" id="first_btn" style="width: 50%; display: none;" ng-click="process_two()">Next >></a>
      </center>
      </div>

      <!--Part 2-->
        <div id="identity_p2" style="display: none;">
        <div class="form-group">
           <label>Username:</label>
          <input type="text" class="form-control" placeholder="Username" ng-model="writer_form.writer_username" ng-init="writer_form.writer_username='<?php echo $fetch_user['writer_username']; ?>'">
        </div>
           <div class="form-group">
            <label>Password:</label>
          <input type="password" class="form-control" placeholder="Password" ng-model="writer_form.writer_password" ng-init="writer_form.writer_password='<?php echo $fetch_user['writer_password']; ?>'" id="password">
        </div>
              <div class="form-group">
                 <label>Confirm Password:</label>
          <input type="password" class="form-control" placeholder="Confirm Password" ng-model="writer_form.writer_confirm_password" ng-keyup="verifypassword(writer_form)" id="confirm_password">
        </div>
        <center>
        <a href="" class="btn btn-primary" id="second_btn" style="width: 50%; display: none;" ng-click="process_three()">Next >></a><br>
           <a href="" class="btn btn-primary" style="width: 50%;" ng-click="process_one()"><< Back</a>
         </center>
      </div>



        <div id="identity_p3" style="display: none;">
                <div class="form-group">
                  <label>Position:</label>*<i>This field cannot be change</i>
          <input type="text" class="form-control" value="<?php echo $fetch_user['writer_position']; ?>" disabled>
        </div>
        <center>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" style="width: 50%; background-color: green;">Confirm and Submit</button>
            <br><br>
           <a href="" class="btn btn-primary" style="width: 50%;" ng-click="process_two()"><< Back</a>
          </div>
        </center>
        </div>


      </form>
    </div>

    </div>

        <div class="col-lg-2">
      </div>


    </div>
    <!--end of admin Content here-->




    </body>

    </div>
    </html>
