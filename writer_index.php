<?php
session_start();
include("public/php_script/db_config.php");

if(isset($_SESSION['writer_id'])){
    $wid = $_SESSION['writer_id'];
$check_user = mysqli_num_rows(mysqli_query($pos_db, "SELECT * from writer_tbl where writer_id = '$wid' AND writer_status = 'INCOMPLETE'"));
if($check_user > 0){
  header("location: writer_completion_process.php");
}

}
else{
    header("location: login.php");
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
            <ul>
                     <li><a href="writer_index.php">Home</a></li>
                     <li><a href="" ng-click="seeWork()">My Works</a></li>
                     <li><a href="" ng-click="seeMyRequest()">Request For Edit</a></li>


                     <?php
                     if(isset($_SESSION['writer_position'])){
  if($_SESSION['writer_position'] == "Editor-in-Chief"){
    ?>
<li><a href="" ng-click="seeTeamWorks()">Submitted Works</a></li>
    <?php    
  }
}

                     ?>
                <li><a href="logout.php">logout</a></li>
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

    <br><br>
    <!--Admin Content Here-->
    <!--show user-->


        <div class="col-md-3 catalogue" style="margin-left: 5%; margin-bottom: 5%;">
        <center>
    <p><img src="public/asset/event_icon.jpg" width="200" height="200" style="border-radius: 40px;"></p>
    <p><b><h3>Event</h3></b></p>
      <p>Submit Writings to this category</p><br><br>
        <a href="" ng-click="addWritingEvent()"><button class="pos-btn">Submit Now</button></a></center>

    </div>



        
    <div class="col-md-3 catalogue" style="margin-left: 5%; margin-bottom: 5%;"><center>
    <p><img src="public/asset/announcement_icon.jpg" width="200" height="200" style="border-radius: 40px;"></p>
    <p><b><h3>Announcement</h3></b></p>
      <p>Submit Writings to this category</p><br><br>
         <a href="" ng-click="addWritingAnnouncement()"><button class="pos-btn">Submit Now</button></a></center>

    </div>


        <div class="col-md-3 catalogue" style="margin-left: 5%; margin-bottom: 5%;"><center>
    <p><img src="public/asset/writing_icon.jpg" width="200" height="200" style="border-radius: 40px;"></p>
    <p><b><h3>Writings</h3></b></p>
      <p>Submit Writings to this category</p><br><br>
         <a href="" ng-click="addWritingArticle()"><button class="pos-btn">Submit Now</button></a></center>

    </div>
   

  




  <!--Place your modal here -->
        <div class="modal fade" id="event_writing" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Writing Event: {{the_title}}</h4>
    </div>
    <div class="modal-body">

    <form method="POST" action="public/php_script/upload_event_article.php" enctype="multipart/form-data">
         <div class="form-group">
    <input type="text" placeholder="Article Title" class="form-control" ng-model="writings_form.article_title" name="article_title" ng-keyup="my_title(writings_form)">
    </div>
          <div class="form-group">
        <textarea class="row row-editor editor" ng-model="writings_form.article_body" name="article_body" id="editor_one">
    </textarea>
    </div>
       <div class="form-group">
     <input type="text" onfocus="(this.type='file')" required name="fileToUpload" class="form-control" placeholder="Image" id="fileToUpload" ng-model="writings_form.fileToUpload">
    </div>
             <div class="form-group">
      <select class="form-control" ng-model="writings_form.event_category" name="event_category">
           <option value="Event category" ng-selected="writings_form.event_category == EventCategory" disabled>Event Category
       <option value="Intramurals">Intramurals</option>
       <option value="Achievements">Achievements</option>
       <option value="News and Announcement">News and Announcement</option>
        <option value="Entertainment">Entertainment</option>
      
    </select>
    </div>

    <center><button type="submit" name="submit_event_writing" class="pos-btn">Submit Now</button></center>
    </form>



    </div>
    </div>
    </div>
    </div>


            <div class="modal fade" id="announcement_writing" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Writing Announcement: {{the_title}}</h4>
    </div>
    <div class="modal-body">

    <form method="POST" action="public/php_script/upload_announcement_article.php" enctype="multipart/form-data">
         <div class="form-group">
    <input type="text" placeholder="Article Title" class="form-control" ng-model="writings_form.article_title" name="article_title" ng-keyup="my_title(writings_form)">
    </div>
          <div class="form-group">
                  <textarea class="row row-editor editor" ng-model="writings_form.article_body" name="article_body" id="editor_two">
    </textarea>
      </div>
       <div class="form-group">
     <input type="text" onfocus="(this.type='file')" required name="fileToUpload" class="form-control" placeholder="Image" id="fileToUpload" ng-model="writings_form.fileToUpload">
    </div>

    <center><button type="submit" name="submit_announ_writing" class="pos-btn">Submit Now</button></center>
    </form>



    </div>
    </div>
    </div>
    </div>


            <div class="modal fade" id="article_writing" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Writing Article: {{the_title}}</h4>
    </div>
    <div class="modal-body">

    <form method="POST" action="public/php_script/upload_writing_article.php" enctype="multipart/form-data">
         <div class="form-group">
    <input type="text" placeholder="Article Title" class="form-control" ng-model="writings_form.article_title" name="article_title" ng-keyup="my_title(writings_form)">
    </div>
          <div class="form-group">
          <textarea class="row row-editor editor" ng-model="writings_form.article_body" name="article_body" id="editor_three">
    </textarea>
    </div>
       <div class="form-group">
     <input type="text" onfocus="(this.type='file')" required name="fileToUpload" class="form-control" placeholder="Image" id="fileToUpload" ng-model="writings_form.fileToUpload">
    </div>
             <div class="form-group">
      <select class="form-control" ng-model="writings_form.event_category" name="event_category">
           <option value="Event category" ng-selected="writings_form.event_category == EventCategory" disabled>Writing Category
       <option value="News Writing">News Writing</option>
       <option value="Feature Writing">Feature Writing</option>
       <option value="Literary Writing">Literary Writing</option>
        <option value="Sports Writing">Sports Writing</option>
        <option value="Photojournalism">Photojournalism</option>
         <option value="Cartooning">Cartooning</option>
      T
    </select>
    </div>

    <center><button type="submit" name="submit_article_writing" class="pos-btn">Submit Now</button></center>
    </form>



    </div>
    </div>
    </div>
    </div>



                <div class="modal fade" id="writers_work" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Writings/Work</h4>
    </div>
    <div class="modal-body">


        <table id="example" class="table table-striped table-bordered pos-table">
        <thead>
          <th>Category</th>
          <th>Title</th>
          <th>Submit Date
              <input type="text" id="submit_date" onfocus="(this.type='date')" placeholder="select date to see works" style="color: black;" ng-model="work_status.submit_date" 
              ng-change="seeWorkViastatus(work_status)">
          </th>
          <th>Status
          <select ng-model="work_status.work_status" ng-change="seeWorkViastatus(work_status)" class="form-control" id="status_work">
          <option value="ALL" ng-selected="work_status.work_status == ALL">ALL</option>
                  <option value="PENDING">PENDING</option>
           <option value="APPROVED">APPROVED</option>
          <option value="ARCHIVE">ARCHIVE</option>
          <option value="DECLINED">DECLINED</option>
          <option value="APPROVED FOR EDIT">APPROVED FOR EDIT</option>
          </select>
          </th>
          <th>Action</th>
        </thead>
        <tbody ng-repeat="work in writers_work">
        <tr>
          <td>{{work.article_category}}</td>
          <td>{{work.article_title}}</td>
           <td>{{work.article_submit_date}}</td>
           <td>{{work.article_status}}</td>
           <td>
            <p>
            <a href="" ng-click="view_work(work)" class="btn btn-default" style="width: 200px;">See Article</a></p>
              <p style="display: {{work.archive_btn}};">
            <a href="" ng-click="archiveWork(work)" class="btn btn-default" style="width: 200px;">Archive</a>
          </p>
          

            <a href="" class="btn btn-default" style="width: 200px; color: {{work.remark_btn}}" ng-click="seeMyRemarks(work)">Remarks({{work.remark_count}})</a></td>
        </tr>
          
        </tbody>
        </table>

    </div>
    </div>
    </div>
    </div>

                    <div class="modal fade" id="team_work" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Team Writings/Work</h4>
    </div>
    <div class="modal-body">


        <table id="example" class="table table-striped table-bordered pos-table">
        <thead>
          <th>Writer Name</th>
          <th>Writer Position</th>
          <th>Category</th>
          <th>Title</th>
          <th>Submit Date
              <input type="text" id="team_submit_date" onfocus="(this.type='date')" placeholder="select date to see works" style="color: black;" ng-model="team_work_form.submit_date" 
              ng-change="seeTeamWorkViastatus(team_work_form)">
          </th>
          <th>Status
          <select ng-model="team_work_form.work_status" ng-change="seeTeamWorkViastatus(team_work_form)" class="form-control" id="team_status">
          <option value="ALL" ng-selected="work_status.work_status == ALL">ALL</option>
                    <option value="PENDING">PENDING</option>
           <option value="APPROVED">APPROVED</option>
          <option value="ARCHIVE">ARCHIVE</option>
          <option value="DECLINED">DECLINED</option>
          <option value="APPROVED FOR EDIT">APPROVED FOR EDIT</option>
          </select>
          </th>
          <th>Action</th>
        </thead>
        <tbody ng-repeat="team in team_work">
        <tr>
          <td>{{team.writer_name}}</td>
          <td>{{team.writer_position}}</td>
          <td>{{team.article_category}}</td>
          <td>{{team.article_title}}</td>
           <td>{{team.article_submit_date}}</td>
           <td>{{team.article_status}}</td>
           <td><a href="" ng-click="view_team_work(team)" class="btn btn-default" style="width: 100px;">See Article</a><br><a href="" class="btn btn-default" style="width: 100px; color:{{team.remark_btn}}" ng-click="seeRemarks(team)">Remarks({{team.remark_count}})</a>
        </td>
        </tr>
          
        </tbody>
        </table>

    </div>
    </div>
    </div>
    </div>


                <div class="modal fade" id="request_work" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Request For Edit</h4>
    </div>
    <div class="modal-body">


        <table id="example" class="table table-striped table-bordered pos-table">
        <thead>
          <th>Category</th>
          <th>Title</th>
          <th>Submit Date
          </th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody ng-repeat="request in request_work">
        <tr>
          <td>{{request.article_category}}</td>
          <td>{{request.article_title}}</td>
           <td>{{request.article_submit_date}}</td>
           <td>{{request.article_status}}</td>
           <td>
            <p>
            <a href="" ng-click="view_work(request)" class="btn btn-default" style="width: 200px;">See Article</a><br><a href="" class="btn btn-default" style="width: 200px; color:{{request.remark_btn}}" ng-click="seeRemarks(request)">Remarks({{request.remark_count}})</a></td>
        </tr>
          
        </tbody>
        </table>

    </div>
    </div>
    </div>
    </div>




          <div class="modal fade" id="team_remarks" role="dialog">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Remarks</h4>
    </div>
    <div class="modal-body">

  <table id="example" class="table table-striped table-bordered pos-table">
        <thead>
          <th>Remark</th>
          <th>Remark Submit Date</th>
          <th>Editor</th>
          <th>Admin</th>
          <th>Action</th>
        </thead>
        <tbody ng-repeat="remark in team_remark">
          <tr>
            <td>{{remark.remark}}</td>
            <td>{{remark.remark_date}}</td>
            <td>{{remark.editor}}</td>
            <td></td>
            <td><a href="" class="btn btn-default" ng-click="viewFullRemark(remark)">View Full Remark</a></td>
          </tr>
        </tbody>
                <tbody ng-repeat="remark in team_remark_v2">
          <tr>
            <td>{{remark.remark}}</td>
            <td>{{remark.remark_date}}</td>
            <td></td>
            <td>{{remark.admin}}</td>
            <td><a href="" class="btn btn-default" ng-click="viewFullRemark(remark)">View Full Remark</a></td>
          </tr>
        </tbody>
      </table>

    </div>
    </div>
    </div>
    </div>
              <div class="modal fade" id="view_full_remarks" role="dialog">
<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Remarks</h4>
    </div>
    <div class="modal-body">
      <p>
        {{view_remarks}}
      </p>


    </div>
  </div>
</div>
</div>


      <div class="modal fade" id="view_work" role="dialog">
<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
          <div class="edit_work_btn">
          <div id="edit_btn" style="display: none;">
      <a href="views/writer/editEvent.php?article_id={{article_id}}" class="btn btn-default" style="display: none; width: 200px;" id="edit_event">Edit</a>
      <a href="views/writer/editAnnouncement.php?article_id={{article_id}}" class="btn btn-default" style="display: none; width: 200px;" id="edit_announcement">Edit</a>
      <a href="views/writer/editWriting.php?article_id={{article_id}}" class="btn btn-default" style="display: none; width: 200px;" id="edit_writing">Edit</a>
      </div>
       <a href="" ng-click="requestEdit(article_id)" class="btn btn-default" style="width: 200px; display: none;" id="permission_btn">Request to Edit</a>
        <a href="views/writer/viewFull.php?article_id={{article_id}}" class="btn btn-default" style="width: 200px;">View Full Article</a>
      </div>
      <h4 class="modal-title">Writings/Work:<br>{{article_title}}</h4>
          <div class="gap_filler"></div>
    </div>
    <div class="modal-body">
    <center><img src="public/images/{{article_picture}}" width="400px"></center>
    <div class="container">
    <br>
    <div class="col-lg-5">
     <h3>{{article_type}}: {{article_category}}</h3>

    </div>
    </div>


    </div>
    </div>
    </div>
    </div>

  







    <!--end of admin Content here-->
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
    
    watchdog.on( 'error', handleError );
    
    watchdog
      .create( document.querySelector( '#editor_one' ), {
        
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

          watchdog
      .create( document.querySelector( '#editor_two' ), {
        
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

          watchdog
      .create( document.querySelector( '#editor_three' ), {
        
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
