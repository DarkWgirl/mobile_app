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
</style>
    <nav class="navbar navbar-default navbar-static-top my-nav">
        <div class="menu">
            <div class="logo">
                <a href="#">Technopacer Mobile Application</a>
            </div>
            <ul>
                     <li><a href="../../writer_index.php">Home</a></li>
                <li><a href="../../logout.php">logout</a></li>
            </ul>
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
    <div class="col-lg-2">
    </div>
        <div class="col-lg-8">
        <a href="viewFull.php?article_id=<?php echo $fetch_data['article_id']; ?>" class="btn btn-default" style="width: 200px;">View Full Article</a><br><br>
        <form method="POST" action="../../public/php_script/update_event_article.php" enctype="multipart/form-data">
         <div class="form-group">
         
    <input type="text" placeholder="Article Title" class="form-control" name="article_title" ng-keyup="my_title(writings_form)" value="<?php echo $fetch_data['article_title']; ?>">
    </div>
          <div class="form-group">
         
          <textarea class="row row-editor editor" id="editor_edit_event" name="article_body">
          <?php echo htmlspecialchars_decode($fetch_data['article_body']); ?>
          </textarea>
          </div>
                <div class="form-group">
     <input type="text" onfocus="(this.type='file')" name="fileToUpload" class="form-control" placeholder="Image" id="fileToUpload" value="">
    </div>
     <div class="form-group">
      <select class="form-control" name="event_category">
          <option selected value="<?php echo $fetch_data['article_category']; ?>"><?php echo $fetch_data['article_category']; ?></option>
       <option value="Intramurals">Intramurals</option>
       <option value="Achievements">Achievements</option>
       <option value="News and Announcement">News and Announcement</option>
        <option value="Entertainment">Entertainment</option>
      
    </select>
    </div>
<input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
    <center><button type="submit" name="submit_event_writing" class="pos-btn">Update Now</button></center>
        </form>
    </div>
        <div class="col-lg-2">
    </div>

   </div>

    </body>

    <script>
    const watchdog = new CKSource.Watchdog();
    
    window.watchdog = watchdog;
    
    watchdog.setCreator( ( element, config ) => {
      return CKSource.Editor
        .create( element, config )
        .then( editor => {        
          
    
          return editor;
        } )
    } );
    
    watchdog.setDestructor( editor => {
      
      
    
      return editor.destroy();
    } );

    
    watchdog
      .create( document.querySelector( '#editor_edit_event' ), {
        
        toolbar: {
          items: [
            'heading',
            '|',
            'bold',
            'italic',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'insertTable',
            'undo',
            'redo'
          ]
        },
        language: 'en',
        table: {
          contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells'
          ]
        },
        licenseKey: '',
        
        
      } )
      .catch( handleError );
    
    function handleError( error ) {
      console.error( 'Oops, something went wrong!' );
      console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
      console.warn( 'Build id: yaxlpal2gmwi-nohdljl880ze' );
      console.error( error );
    }

    
  </script>
    </div>
    </html>
