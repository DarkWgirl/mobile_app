 <?php
session_start();
include("../../public/php_script/db_config.php");
if(isset($_GET['article_id'])){
  $article_id = $_GET['article_id'];
}
global $article_id;
$get_article = mysqli_query($pos_db, "SELECT * from article_tbl where article_id = '$article_id'");
$fetch_data = mysqli_fetch_array($get_article);

?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../public/css/simple.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/pos_style.css">
      <link rel="stylesheet" type="text/css" href="../../public/ckeditor5/sample/style.css">
    <script src="../../public/js/angular.js"></script>
  <script src="../../public/js/angular-route.js"></script>
     <script src="../../public/js/myAngularApp.js"></script>
      <script src="../../public/ckeditor5/build/ckeditor.js"></script>
       <script src="../../public/ckeditor5/webpack.config.js"></script>
      <script src="../../public/ckeditor5/build/ckeditor.js.map"></script>
  <script type="text/javascript" src="../../public/js/jquery-3.1.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
  <script type="text/javascript" src="../../public/js/bootstrap.min.js"></script>
  <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    
                   

</head>
<div ng-app="myStoreApp" ng-controller="myStoreAppCtrl">
<body data-editor="ClassicEditor" data-collaboration="false">
<style type="text/css">
  .my-nav{
    background-color: lightgreen;
    padding: 10px;
}
#decline_btn{
  position: absolute;
  left: 18%;
  width: 100px;
}
#approve_btn{
   width: 100px;
}
#add_remark_btn{
   position: absolute;
  left: 34%;
  width: 100px;
}
.footer{
  padding: 20px;
}
</style>
    <nav class="navbar navbar-default navbar-static-top my-nav">
        <div class="menu">
            <div class="logo">
                <a href="#">Technopacer Mobile Application</a>
            </div>
            <ul>
                    <?php
         if(isset($_SESSION['admin_id'])){
    ?>
<li><a href="../../admin_index.php">Home</a></li>
    <?php
  }else{
    ?>
<li><a href="../../writer_index.php">Home</a></li>
    <?php
  }
  ?>
                <li><a href="../../logout.php">logout</a></li>
            </ul>
        </div>
    </nav>  
    <div class="container">
    <div class="col-lg-2">
    </div>
        <div class="col-lg-8">
            <?php
            if(isset($_SESSION['writer_id'])){
          if($fetch_data['article_status'] == "ARCHIVE"){
            ?><form method="POST" ng-submit="repropose(approval_form)">
                <input type="hidden" ng-model="approval_form.article_id" ng-init="approval_form.article_id='<?php echo $fetch_data['article_id']; ?>'">
              <button class="btn btn-primary" type="submit">Re-propose Article</button>
            </form>
            <?php
          }
        }
         ?>
        <center>
        <h1><?php echo $fetch_data['article_title']; ?></h1>
        <div style="background-color: black;">
        <img src="../../public/images/<?php echo $fetch_data['article_picture']; ?>" style="width: 500px;">
        </div>
        </center><br>
         <?php echo htmlspecialchars_decode($fetch_data['article_body']); ?><br>
         <br><br>
         <?php
         if(isset($_SESSION['writer_position'])){
  if($_SESSION['writer_position'] == "Editor-in-Chief"){
    ?>
    <button class="btn btn-default" ng-click="addRemark()">Add Remark</button>
            <div class="modal fade" id="remark_modal" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add Remark</h4>
    </div>
    <div class="modal-body">

  <form method="POST" ng-submit="add_remark(remark_form)">
    <input type="hidden" ng-model="remark_form.article_id" ng-init="remark_form.article_id='<?php echo $fetch_data['article_id']; ?>'">
    <textarea class="form-control" ng-model="remark_form.remark" placeholder="Your remark about the article..." style="height: 200px;">
    </textarea><br>
    <center>
    <button type="submit" class="pos-btn" name="submit">Add Remark</button>
  </center>
  </form>

</div>
</div>
</div>
</div>

    <?php

  }else{
         if($fetch_data['article_status'] == 'PENDING' || $fetch_data['article_status'] == 'APPROVED FOR EDIT'){
         if($fetch_data['article_type'] == 'Event'){

          ?>
          <!--This is where you put the edit btn-->
          <a href="editEvent.php?article_id=<?php echo $fetch_data['article_id']; ?>" class="btn btn-default" style="width: 200px;">Edit</a>

          <?php

         }else if($fetch_data['article_type'] == 'Writing'){
             ?>
          <!--This is where you put the edit btn-->
                    <a href="editWriting.php?article_id=<?php echo $fetch_data['article_id']; ?>" class="btn btn-default" style="width: 200px;">Edit</a>
          <?php

         }else{
             ?>
          <!--This is where you put the edit btn-->
                    <a href="editAnnouncement.php?article_id=<?php echo $fetch_data['article_id']; ?>" class="btn btn-default" style="width: 200px;">Edit</a>
          
          <?php

         }
       }
     }
   }

         ?>
         <?php
         if(isset($_SESSION['admin_id'])){
    ?>
    <?php
    if($fetch_data['article_status'] =="PENDING"){
    ?>
      <button class="btn btn-default" ng-click="addRemarkAdmin()" id="add_remark_btn">Add Remark</button>
    <button class="btn btn-warning" ng-click="decline_form()" id="decline_btn">Decline</button>
    
     <form method="POST" ng-submit="approveArticle(approval_form)">
         <input type="hidden" ng-model="approval_form.article_id" ng-init="approval_form.article_id='<?php echo $fetch_data['article_id']; ?>'">
    <button class="btn btn-primary" type="submit" id="approve_btn">Approve</button>
  </form>

<div class="modal fade" id="decline_form" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Decline article</h4>
    </div>
    <div class="modal-body">

   <form method="POST" ng-submit="declineArticle(approval_form)">
         <input type="hidden" ng-model="approval_form.article_id" ng-init="approval_form.article_id='<?php echo $fetch_data['article_id']; ?>'">
    <textarea class="form-control" ng-model="approval_form.remark" placeholder="Remark about declining this article..">
    </textarea><br>
    <center>
    <button type="submit" class="btn btn-warning" name="submit">Decline Article</button>
  </center>
  </form>

</div>
</div>
</div>
</div>
    <?php
  }else if($fetch_data['article_status'] == "APPROVED"){
    if($fetch_data['request_for_reedit'] == "YES"){
    ?>
<button class="btn btn-primary" ng-click="approve_reEdit(<?php echo $fetch_data['article_id']; ?>)">Approve For Re-edit</button>
<button class="btn btn-warning" ng-click="decline_reEdit(<?php echo $fetch_data['article_id']; ?>)">Declined For Re-Edit</button>
<?php
}
?>
<button class="btn btn-default" ng-click="addRemarkAdmin()">Add Remark</button>
    <?php
  }else if($fetch_data['article_status'] == "DECLINED"){
    ?>
<button class="btn btn-primary">Re-Open Article</button>
  <button class="btn btn-default" ng-click="addRemarkAdmin()">Add Remark</button>
    <?php
  }
  ?>
            <div class="modal fade" id="remark_modal_admin" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add Remark</h4>
    </div>
    <div class="modal-body">

  <form method="POST" ng-submit="add_remark_admin(remark_form)">
    <input type="hidden" ng-model="remark_form.article_id" ng-init="remark_form.article_id='<?php echo $fetch_data['article_id']; ?>'">
    <textarea class="form-control" ng-model="remark_form.remark" placeholder="Your remark about the article..." style="height: 200px;">
    </textarea><br>
    <center>
    <button type="submit" class="pos-btn" name="submit">Add Remark</button>
  </center>
  </form>

</div>
</div>
</div>
</div>

    <?php

  }
?>
    </div>
        <div class="col-lg-2">
    </div>

   </div>

    </body>
    <div class="footer"></div>
    </div>
    </html>
