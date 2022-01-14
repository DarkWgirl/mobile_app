<?php
session_start();
include("public/php_script/db_config.php");

if(isset($_SESSION['student_id'])){

}
else{
    header("location: student_login.php");
}


$get_post_data = "";

if(isset($_POST['searchCategory'])){
   $category = $_POST['category'];
   if($category == "ALL"){
    $get_post_data = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id where article_status = 'APPROVED'");

   }else{
    $get_post_data = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id where article_status = 'APPROVED' AND article_category = '$category'");

   }

}else{
    $get_post_data = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id where article_status = 'APPROVED'");

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
    <div class="form-group">
        <form action="" method="POST">
        <label>Article Category:</label>

        <select class="form-control" name="category">
            <option value="ALL" disbaled selected>ALL</option>
            <option value="Intramurals">Intramurals</option>
       <option value="Achievements">Achievements</option>
       <option value="News and Announcement">News and Announcement</option>
        <option value="Entertainment">Entertainment</option>      
      <option value="News Writing">News Writing</option>
       <option value="Feature Writing">Feature Writing</option>
       <option value="Literary Writing">Literary Writing</option>
        <option value="Sports Writing">Sports Writing</option>
        <option value="Photojournalism">Photojournalism</option>
         <option value="Cartooning">Cartooning</option>
         <option value="Announcement">Announcement</option>
    </select>
<button type="submit" name="searchCategory" class="btn btn-primary" style="width: 100%;">Search</button>
    </form>
    </div>
<?php

while($fetchArticle = mysqli_fetch_array($get_post_data)){
?>

        <div class="col-md-3 catalogue" style="margin-left: 5%; margin-bottom: 5%;">
        <center>
    <p><img src="public/images/<?php echo $fetchArticle['article_picture']; ?>" width="200" height="200" style="border-radius: 40px;"></p>
    <p><b><h3><?php echo $fetchArticle['article_type']; ?></h3></b></p>
      <p>Written By: <?php echo $fetchArticle['writer_name']; ?></p><br><br>
        <a href="view_article.php?aid=<?php echo $fetchArticle['article_id']; ?>"><button class="pos-btn">See Artilce</button></a></center>

    </div>

    <?php
}
?>

    </div>
    <!--end of admin Content here-->
    </body>
    </div>
    </html>
