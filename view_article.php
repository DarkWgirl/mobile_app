<?php
session_start();
include("public/php_script/db_config.php");

if(isset($_SESSION['student_id'])){

}
else{
    header("location: student_login.php");
}


$get_post_data = "";

if(isset($_GET['aid'])){
   $aid = $_GET['aid'];
    $get_post_data = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id where article_status = 'APPROVED' AND article_id = '$aid'");

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
     <script src="public/js/myAngularApp.js"></script>
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
.my_nav, a{
  font-size: 12px;
}
</style>
   <nav class="navbar navbar-default navbar-static-top my-nav">
        <div class="menu">
            <div class="logo">
                <a href="#">Technopacer Mobile Application</a>
            </div>
        </div>
    </nav>  
    <style type="text/css">
      .catalogue{
        background-color: #ebf9ff;
        padding: 20px 20px;
        box-shadow: 4px 3px  15px #888888;
        border-radius: 40px;
      }
    </style>

    
    <div class="container">

    <br><br>
    <!--Admin Content Here-->
    <!--show user-->

<?php

while($fetchArticle = mysqli_fetch_array($get_post_data)){
?>

<div class="col-8">

<img width="300" src="public/images/<?php echo $fetchArticle['article_picture']; ?>">
<?php

echo $fetchArticle['article_body'];

?>
      <a href><img src="public/asset/like.png"></a>&nbsp&nbsp&nbsp&nbsp<a href><img src="public/asset/unlike.png"></a><br><br>

    </div>

    <?php
}
?>

    </div>
    <!--end of admin Content here-->
    </body>
    </div>
    </html>
