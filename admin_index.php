<?php
session_start();
include("public/php_script/db_config.php");
include("random.php");
$new_code = "";
$check_code = mysqli_num_rows(mysqli_query($pos_db, "SELECT * from writer_tbl where writer_access_code = '$access_code'"));
if($check_code > 0){
  header("location: admin_index.php");
}else{
$new_code = $access_code;
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
     <script src="public/js/myAngularApp.js"></script>

  <script type="text/javascript" src="public/js/jquery-3.1.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
  <script type="text/javascript" src="public/js/bootstrap.min.js"></script>

  
    
                   

</head>
<div ng-app="myStoreApp" ng-controller="myStoreAppCtrl">
<body>
<style type="text/css">
  .my-nav{
    background-color: lightgreen;
    padding: 10px;
}
.admin_tbl_border{
  position: absolute; 
  margin-left: 20%;
}

@media screen and (max-width: 767px) {
.admin_tbl_border{
  position: absolute; 
  margin-left: 0%;
}

  }
  .menu > ul > li > a:hover {
    text-decoration: none;
    background-color: blue;
    font-size: 18px;
    font-weight: 500;
    padding: 8px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
}
</style>
    <nav class="navbar navbar-default-top my-nav">
        <div class="menu">
            <div class="logo">
                <a href="#">Technopacer Mobile Application</a>
            </div>
            <ul>
                     <li><a href="admin_index.php">Home</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </div>
    </nav>  
    
  <div class="container">
  <!--Content Start-->
      <div class="col-lg-5">
      <div style="margin-top: 10%;">
      <?php
      if(isset($_SESSION['admin_designation'])){
    if($_SESSION['admin_designation'] == "Super Admin"){
      ?>
     <button class="pos-btn" style="font-family: Century Gothic;" ng-click="showAdmin()">Admin Management</button><br><br>
     <?php
   }
   }
   ?>
        <button class="pos-btn" style="font-family: Century Gothic;" ng-click="showWriter()">Writer Management</button><br><br>
        <button class="pos-btn" style="font-family: Century Gothic;" ng-click="showTeam()">Writings Management</button><br><br>
         <button class="pos-btn" style="font-family: Century Gothic;" ng-click="seeRequest()">Request For Re-Edit</button><br><br>
         <button class="pos-btn" style="font-family: Century Gothic;" ng-click="seeReported()">See Reported</button>

        </div>
      </div>


      <div class="col-lg-5 admin_tbl_border">
      <!--Admin Table Are-->
      <div id="admin_management" style="display: none;" data-ng-init="all_admin_init()">
        <center style="margin-top: 5%">

       <table id="example" class="table table-striped table-bordered pos-table">
       <thead><th>
       Admin Name
       </th>
       <th>Admin Designation</th>
         <th>
         Admin Username
       </th>
       <th>Admin Password</th>
           <th>
        Admin Status
        <select ng-model="admin_status.admin_status" ng-change="allAdminDetails(admin_status)" style="color: black;">
        <option value="ALL" ng-selected="admin_status.admin_status == ALL">ALL</option>
        <option value="ACTIVE">Active</option>
        <option value="ARCHIVE">Archive</option>
        </select>
       </th>  
       <th>
        Action&nbsp&nbsp&nbsp<button class="btn btn-default" ng-click="add_admin()">+</button>
       </th>
       </thead>
       <tbody ng-repeat="admin in admin_record">
       <tr>
       <td>{{admin.admin_name}}</td>
       <td>{{admin.admin_designation}}</td>
        <td>{{admin.admin_username}}</td>
        <td>{{admin.admin_password}}</td>
        <td>{{admin.admin_status}}</td>
        <td>
        <button class="btn btn-default" style="width: 200px; display: {{admin.archive_btn}}" ng-click="archiveAdmin(admin)">Archive Admin</button><button class="btn btn-default" style="width: 200px; display: {{admin.active_btn}}" ng-click="activateAdmin(admin)">Activate Admin</button>
       <button class="btn btn-default" style="width: 200px;" ng-click="edit_admin(admin)">Edit Admin</button>
       </td>

       </tr>
       </tbody>
       </table>
       </center>
       </div>
       <!--End of Admin Table -->


             <!--Admin Table Are-->
      <div id="writer_management" data-ng-init="all_writer_init()" style="display: none;">
        <center style="margin-top: 5%">

       <table id="example" class="table table-striped table-bordered pos-table">
       <thead><th>
       Writer Name
       </th>
       <th>Designation</th>
         <th>
        Course
       </th>
       <th>School Number</th>
       <th>Writer Status
          <select ng-model="writer_status.writer_status" ng-change="allWriterDetails(writer_status)" style="color: black;">
        <option value="ALL" ng-selected="writer_status.writer_status == ALL">ALL</option>
        <option value="INCOMPLETE">Incomplete</option>
        <option value="ACTIVE">Active</option>
        <option value="ARCHIVE">Archive</option>
        </select>

       </th>
        <th>Writer Username</th>
         <th>Writer Access Code</th> 
       <th>
        Action&nbsp&nbsp&nbsp<button class="btn btn-default" ng-click="add_new_writer()">+</button>
       </th>
       </thead>
       <tbody ng-repeat="writer in writer_record">
       <tr>
       <td>{{writer.writer_name}}</td>
        <td>{{writer.writer_position}}</td>
      <td>{{writer.writer_course}}</td>
    <td>{{writer.school_number}}</td>
       <td>{{writer.writer_status}}</td>
       <td>{{writer.writer_username}}</td>
        <td>{{writer.writer_accesscode}}</td>
        <td><button class="btn btn-default" style="width: 200px; display: {{writer.archive_btn}}" ng-click="archiveWriter(writer)">Archive User</button><button class="btn btn-default" style="width: 200px; display: {{writer.active_btn}}" ng-click="activateWriter(writer)">Activate User</button><button class="btn btn-default" style="width: 200px;" ng-click="incompleteWriter(writer)">Incomplete</button>
        </td>

       </tr>
       </tbody>
       </table>   
       </center>
       </div>
       <!--End of Admin Table -->


       <div id="team_work" style="display: none;">
        <table id="example" class="table table-striped table-bordered pos-table">
        <thead>
          <th>Writer Name</th>
          <th>Writer Position</th>
          <th>Category</th>
          <th>Title</th>
          <th>Submit Date
              <input type="text" id="team_submit_date" onfocus="(this.type='date')" placeholder="select date to see works" style="color: black;" ng-model="team_work_form.submit_date" 
              ng-change="showTeamWorkViastatus(team_work_form)">
          </th>
          <th>Status
          <select ng-model="team_work_form.work_status" ng-change="showTeamWorkViastatus(team_work_form)" class="form-control" id="team_status">
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
           <td><a href="" ng-click="view_team_work_admin(team)" class="btn btn-default" style="width: 100px;">See Article</a><br><a href="" class="btn btn-default" style="width: 100px; color:{{team.remark_btn}}" ng-click="seeRemarks(team)">Remarks({{team.remark_count}})</a>
        </td>
        </tr>
          
        </tbody>
        </table>
      </div>

      </div>

   <!--End of Content   -->
 
  <!--Place your modal here -->


    <!--Place your modal here -->
        <div class="modal fade" id="add_admin" role="dialog">
<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add Admin</h4>
    </div>
    <div class="modal-body">

    <form method="POST" ng-submit="addAdmin(admin_form)">
         <div class="form-group">
         <label>Admin Name:</label>
    <input type="text" placeholder="Admin Name" class="form-control" ng-model="admin_form.admin_name">
    </div>
          <div class="form-group">
            <label>Admin Designation:</label>
          <select class="form-control" ng-model="admin_form.admin_designation">
           <option value="SuperAdmin" ng-selected="admin_form.admin_designation == SuperAdmin" disabled>Admin Designation</option>
           <option value="Super Admin">Super Admin</option>
            <option value="Admin">Admin</option>
            <option value="Adviser">Adviser</option>
          </select>
    </div>
              <div class="form-group">
                <label>Admin Username:</label>
    <input type="text" placeholder="Admin Username" class="form-control" ng-model="admin_form.admin_username">
    </div>
                  <div class="form-group">
                    <label>Admin Password:</label>
    <input type="text" placeholder="Admin Password" class="form-control" ng-model="admin_form.admin_password">
    </div>
    <center><button type="submit" class="pos-btn">Submit Now</button></center>
    </form>



    </div>
    </div>
    </div>
    </div>



            <div class="modal fade" id="edit_admin" role="dialog">
<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Admin: {{edit_admin_form.admin_name}}</h4>
    </div>
    <div class="modal-body">

    <form method="POST" ng-submit="editAdmin(edit_admin_form)">
         <div class="form-group">
         <label>Admin Name:</label>
    <input type="text" placeholder="Admin Name" class="form-control" ng-model="edit_admin_form.admin_name">
    </div>
          <div class="form-group">
            <label>Admin Designation:</label>
          <select class="form-control" ng-model="edit_admin_form.admin_designation">
           <option value="SuperAdmin" ng-selected="edit_admin_form.admin_designation == SuperAdmin" disabled>Admin Designation</option>
           <option value="Super Admin">Super Admin</option>
            <option value="Admin">Admin</option>
            <option value="Adviser">Adviser</option>
          </select>
    </div>
              <div class="form-group">
                <label>Admin Username:</label>
    <input type="text" placeholder="Admin Username" class="form-control" ng-model="edit_admin_form.admin_username">
    </div>
                  <div class="form-group">
                    <label>Admin Password:</label>
    <input type="text" placeholder="Admin Password" class="form-control" ng-model="edit_admin_form.admin_password">
    </div>
    <center><button type="submit" class="pos-btn">Update Now</button></center>
    </form>



    </div>
    </div>
    </div>
    </div>




           <div class="modal fade" id="add_new_writer_n" role="dialog">
<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add Writer</h4>
    </div>
    <div class="modal-body">
    <form method="POST" ng-submit="addNewWriter(add_writer_form)">

             <div class="form-group">
         <label>Writer Access Code:</label>
    <input type="text" placeholder="Writer Code" class="form-control" ng-model="add_writer_form.access_code" ng-init="add_writer_form.access_code='<?php echo $new_code; ?>'" disabled>
    </div>

       <div class="form-group">
            <label>Writer Designation:</label>
          <select class="form-control" ng-model="add_writer_form.writer_designation">
           <option value="Writer Designation" ng-selected="add_writer_form.writer_designation == WriterDesignation" disabled>Writer Designation</option>
           <option value="Editor-in-Chief">Editor-in-Chief</option>
            <option value="Associate Editor">Associate Editor</option>
            <option value="Managing Editor">Managing Editor</option>
            <option value="News Editor">News Editor</option>
             <option value="Feature Editor">Feature Editor</option>
              <option value="Literary Editor">Literary Editor</option>
              <option value="Sports Editor">Sports Editor</option>
              <option value="Writer">Writer</option>
              <option value="Photojournalist">Photojournalist</option>
                <option value="Cartoonist">Cartoonist</option>
                <option value="Cartoonist">Graphic Artist</option>
                <option value="Layout Artist">Layout Artist</option>

          </select>
    </div>
    <div class="form-group">
    <center><button class="pos-btn" type="submit">Add New Writer</button></center>
    </div>


    </form>

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



    <div class="modal fade" id="student_reported" role="dialog">
<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Admin: {{edit_admin_form.admin_name}}</h4>
    </div>
    <div class="modal-body">
      
        <table id="example" class="table table-striped table-bordered pos-table">
        <thead>
          <th>Student Name</th>
          <th>Student Number</th>
          <th>Status Report</th>
          <th>Reason</th>
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
           <td><a href="" ng-click="view_team_work_admin(team)" class="btn btn-default" style="width: 100px;">See Article</a><br><a href="" class="btn btn-default" style="width: 100px; color:{{team.remark_btn}}" ng-click="seeRemarks(team)">Remarks({{team.remark_count}})</a>
        </td>
        </tr>
          
        </tbody>
        </table>



    </div>
    </div>
    </div>
    </div>





  </div>
    <!--end of admin Content here-->
    </body>
    </div>
    </html>
