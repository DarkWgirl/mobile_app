<?php
session_start();
include("public/php_script/db_config.php");

if(isset($_SESSION['student_id'])){
  $sid = $_SESSION['student_id'];
}

global $sid;

$get_post_data = "";

$reaction = "";
$get_comments = "";

if(isset($_GET['aid'])){
   $aid = $_GET['aid'];
   global $aid;
    $get_post_data = mysqli_query($pos_db, "SELECT * from article_tbl INNER JOIN writer_tbl on writer_tbl.writer_id = article_tbl.writer_id where article_status = 'APPROVED' AND article_id = '$aid'");


$get_comments = mysqli_query($pos_db, "SELECT * from comment_tbl INNER JOIN student_tbl on student_tbl.student_id = comment_tbl.student_id where article_id = '$aid'");

 $check_sentiments_like = mysqli_query($pos_db, "SELECT * from sentiment_tbl where student_id = '$sid' AND liked_status = '1' AND article_id = '$aid'");
 $exist_like = mysqli_num_rows($check_sentiments_like);
 
 $check_sentiments_unlike = mysqli_query($pos_db, "SELECT * from sentiment_tbl where student_id = '$sid' AND liked_status = '0' AND article_id = '$aid'");
 $exist_unlike = mysqli_num_rows($check_sentiments_unlike);

if($exist_like > 0){
  $reaction = "liked";
}else if($exist_unlike > 0){
  $reaction = "unliked";
}else{
  $reaction = "none";
}


}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/css/simple.css">
    <link rel="stylesheet" type="text/css" href="public/css/pos_style.css">
    <script src="public/js/angular.js"></script>
  <script src="public/js/angular-route.js"></script>
     <script src="public/js/studentApp.js"></script>

  <script type="text/javascript" src="public/js/jquery-3.1.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
  <script type="text/javascript" src="public/js/bootstrap.min.js"></script>

  

    
                   

</head>
<div>
<body ng-app="myStoreApp" ng-controller="myStoreAppCtrl">
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
                <a href="student_index.php">Technopacer Mobile Application</a>
            </div>
        </div>
        <?php
        if(isset($_SESSION['student_id'])){
        ?>
        
        &nbsp&nbsp<a href="student_logout.php" style="color: black; text-decoration: none;">Log out</a>
          <?php

        }
        ?>
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
<br><br>
<!--Condition on sentiments-->
<?php
if(isset($_SESSION['student_id'])){
if($reaction === "liked"){
?>
<a href="" ng-click="removeLike(<?php echo $fetchArticle['article_id']; ?>)" style="background-color: blue; padding: 10px 10px; border-radius: 20px 20px;"><img src="public/asset/liked.png"></a>&nbsp&nbsp&nbsp&nbsp<a href="" ng-click="unlikeArticle(<?php echo $fetchArticle['article_id']; ?>)"><img src="public/asset/unlike.png"></a>
<?php
}else if($reaction === "unliked"){

  ?>
<a href="" ng-click="likeArticle(<?php echo $fetchArticle['article_id']; ?>)"><img src="public/asset/like.png"></a>&nbsp&nbsp&nbsp&nbsp<a href="" ng-click="removeUnlike(<?php echo $fetchArticle['article_id']; ?>)" style="background-color: blue; padding: 10px 10px; border-radius: 20px 20px;"><img src="public/asset/unliked.png"></a>
<?php
}else{
?>
<a href="" ng-click="likeArticle(<?php echo $fetchArticle['article_id']; ?>)"><img src="public/asset/like.png"></a>&nbsp&nbsp&nbsp&nbsp<a href="" ng-click="unlikeArticle(<?php echo $fetchArticle['article_id']; ?>)"><img src="public/asset/unlike.png"></a>


<?php
}
?>
<br><br>
<!--Start of Comment Box -->
<form method="POST"  action="public/php_script/addComment.php">
<textarea class="form-control" name="comment">
</textarea>
<input type="hidden" name="aid" value="<?php echo $aid; ?>">
<button type="submit"name="submit" class="btn btn-primary" style="width: 100%;">Add Comment</button>
</form>

<br><br>
<?php
$edit = false;
while($comments = mysqli_fetch_array($get_comments)){
  if($comments['student_id'] === $sid){
    $edit = true;
  }
?>

<b>Commented By: <?php echo $comments['student_fname']." ".$comments['student_lname']; ?></b><br>
<i><?php echo $comments['comments']; ?>
<br><br>
<?php
if($edit === true){
?>

<a href="" class="btn btn-default" ng-click="editComment(<?php echo $comments['comment_id']; ?>)">Edit</a><a href="" class="btn btn-default" ng-click="deleteComment(<?php echo $comments['comment_id']; ?>)">Delete</a>
<br><br>
<?php
}
?>
</i>

<?php
} // end for comment query
?>
<!--End of Comment Box-->
<?php
} //end for sid if
?>

<!--End of Condition on sentiments-->


<br><br>

    </div>

    <?php
}
?>

    </div>

      <!-- Modal content-->
<div class="modal fade" id="edit_comment" role="dialog">
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Comment</h4>
    </div>
    <div class="modal-body">
    <form method="POST" action="public/php_script/updateComment.php">
    <div ng-repeat="comment in comments">
<textarea class="form-control" name="comment">
  {{comment.comment}}
</textarea>
<input type="hidden" name="comment_id" value="{{comment.comment_id}}">
<input type="hidden" name="aid" value="<?php echo $aid; ?>">
<button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">Update Comment</button>
</div>
</form>
</div>
</div>
</div>
</div>



    <!--end of body Content here-->
    </body>
    </div>
    </html>
