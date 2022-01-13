var myStore = angular.module('myStoreApp', []);

myStore.controller('myStoreAppCtrl', ['$scope', '$http', function ($scope, $http) {

var writer_form = {};
var writings_form = {};
var login_form = {};
var admin_form  = {};
var work_status = {};
var add_writer_form = {};
var submit_date = {};
var team_work_form = {};
var remark_form = {};
var approval_form = {};


$scope.approve_reEdit = function(article_id){
	var r = confirm("are you sure you want to approve the request?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/approve_request_edit.php',
			data: article_id

		}).success(function(){
		location.href = '../../admin_index.php';
		});
	}
}

$scope.decline_reEdit = function(article_id){
	var r = confirm("are you sure you want to decline the request?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/decline_request_edit.php',
			data: article_id

		}).success(function(){
		location.href = '../../admin_index.php';
		});
	}
}



$scope.viewFullRemark = function(remark){
	$http({
		method: 'post',
		url: 'public/php_script/view_full_remark.php',
		data: remark

	}).success(function(data){
		$scope.view_remarks = data;
		$("#view_full_remarks").modal("show");
		$("#team_remarks").modal("hide");

	});
}

$scope.approveArticle = function(approval_form){
	var r = confirm("are you sure you want to approve this article?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/approve_article.php',
			data: approval_form 

		}).success(function(){
		location.reload();
		});
	}
}

$scope.repropose = function(approval_form){
	var r = confirm("are you sure you want to re-propose this article?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/repropose_article.php',
			data: approval_form 

		}).success(function(){
		location.reload();
		});
	}
}


$scope.decline_form = function(){
	$("#decline_form").modal("show");
}

$scope.declineArticle = function(approval_form){
	var r = confirm("are you sure you want to approve this article?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/decline_article.php',
			data: approval_form 

		}).success(function(){
		location.reload();
		});
	}
}



$scope.seeRemarks = function(team){
	$http({
		method: 'post',
		url: 'public/php_script/see_remark_editor.php',
		data: team
	}).success(function(data){
		$("#team_remarks").modal("show");
		$scope.team_remark = data;

	});

	$http({
		method: 'post',
		url: 'public/php_script/see_remark_editor_v2.php',
		data: team
	}).success(function(data){
		$("#team_remarks").modal("show");
		$scope.team_remark_v2 = data;

	});

}


$scope.seeMyRemarks = function(work){
	$http({
		method: 'post',
		url: 'public/php_script/see_remark_editor.php',
		data: work
	}).success(function(data){
		$scope.seeWork();
		$("#team_remarks").modal("show");
		$scope.team_remark = data;
	});

	$http({
		method: 'post',
		url: 'public/php_script/see_remark_editor_v2.php',
		data: work
	}).success(function(data){
		$scope.seeWork();
		$("#team_remarks").modal("show");
		$scope.team_remark_v2 = data;

	});

}


$scope.addRemark = function(){
	$("#remark_modal").modal("show");
}

$scope.addRemarkAdmin = function(){
	$("#remark_modal_admin").modal("show");
}

$scope.add_remark = function(remark_form){
	var r = confirm("are you sure you want to add remark?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/add_remark_editor.php',
			data: remark_form

		}).success(function(){
				$("#remark_modal").modal("hide");
		});
	}
}


$scope.add_remark_admin = function(remark_form){
	var r = confirm("are you sure you want to add remark?");
	if(r){
		$http({
			method: 'post',
			url: '../../public/php_script/add_remark_admin.php',
			data: remark_form

		}).success(function(){
				$("#remark_modal_admin").modal("hide");
		});
	}
}





$scope.seeTeamWorkViastatus = function(team_work_form){
	var team_status = document.getElementById("team_status");
	var team_submit_date = document.getElementById('team_submit_date');

	if(team_submit_date.value == "" && team_status.value == "ALL"){
			$http({
		method: 'post',
		url: 'public/php_script/see_team_work_via_status.php',
		data: team_work_form

	}).success(function(data){
		$scope.team_work = data;
		$("#team_work").modal("show");
	});
		
	}else if(team_submit_date.value != "" && team_status.value == "ALL"){
		$http({
			method: 'post',
			url: 'public/php_script/see_team_work_via_date.php',
			data: team_work_form

	}).success(function(data){
			$scope.team_work = data;
		$("#team_work").modal("show");

	});
		
	}
	else if(team_submit_date.value != "" && team_status.value != "ALL"){
		$http({
			method: 'post',
			url: 'public/php_script/see_team_work_via_filter.php',
			data: team_work_form

	}).success(function(data){
			$scope.team_work = data;
		$("#team_work").modal("show");

	});
		
	}
		else if(team_submit_date.value == "" && team_status.value != "ALL"){
	$http({
		method: 'post',
		url: 'public/php_script/see_team_work_via_status.php',
		data: team_work_form

	}).success(function(data){
		$scope.team_work = data;
		$("#team_work").modal("show");
	});
		
	}

}



$scope.seeWorkViastatus = function(work_status){
	var status_work = document.getElementById("status_work");
	var submit_date = document.getElementById('submit_date');

	if(submit_date.value == "" && status_work.value == "ALL"){
			$http({
		method: 'post',
		url: 'public/php_script/see_work_via_status.php',
		data: work_status

	}).success(function(data){
		$scope.writers_work = data;
		$("#writers_work").modal("show");
	});
		
	}else if(submit_date.value != "" && status_work.value == "ALL"){
		$http({
			method: 'post',
			url: 'public/php_script/see_work_via_date.php',
			data: work_status

	}).success(function(data){
			$scope.writers_work = data;
		$("#writers_work").modal("show");

	});
		
	}
	else if(submit_date.value != "" && status_work.value != "ALL"){
		$http({
			method: 'post',
			url: 'public/php_script/see_work_via_filter.php',
			data: work_status

	}).success(function(data){
			$scope.writers_work = data;
		$("#writers_work").modal("show");

	});
		
	}
		else if(submit_date.value == "" && status_work.value != "ALL"){
	$http({
		method: 'post',
		url: 'public/php_script/see_work_via_status.php',
		data: work_status

	}).success(function(data){
		$scope.writers_work = data;
		$("#writers_work").modal("show");
	});
		
	}
}
  




$scope.requestEdit = function(article_id){
	var r = confirm("are you sure you want to request for re-eiting?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/requestEditArticle.php',
		data: article_id

	}).success(function(){
		location.reload();
	});
}

}


$scope.view_team_work = function(team){
	$("#view_work").modal("show");
	var event = document.getElementById('edit_event');
	var announcement = document.getElementById('edit_announcement');
	var writing = document.getElementById('edit_writing');
	var edit_btn = document.getElementById('edit_btn');
	var permission_btn = document.getElementById('permission_btn');

	$scope.article_title = team.article_title;
	$scope.article_body = team.article_body;
	$scope.article_category = team.article_category;
	$scope.article_type = team.article_type;
	$scope.article_picture = team.article_picture;
	$scope.article_id = team.article_id;
	if(team.article_status == 'PENDING'){
		edit_btn.style.display = "none";
		permission_btn.style.display = "none";
	}
	else if(team.article_status == 'APPROVED'){
		edit_btn.style.display = "none";
		permission_btn.style.display = "none";
	}
	else if(team.article_status == 'APPROVED FOR EDIT'){
		edit_btn.style.display = "none";
		permission_btn.style.display = "none";
	}

	if(team.article_type == 'Event'){
	event.style.display = "block";
	announcement.style.display = "none";
	writing.style.display = "none";

	}else if(team.article_type == 'Announcement'){
		announcement.style.display = "block";
		event.style.display = "none";
		writing.style.display = "none";

	}else if(team.article_type == 'Writing'){
		writing.style.display = "block";
		announcement.style.display = "none";
			event.style.display = "none";

	}

}

$scope.view_team_work_admin = function(team){
	$("#view_work").modal("show");
	var event = document.getElementById('edit_event');
	var announcement = document.getElementById('edit_announcement');
	var writing = document.getElementById('edit_writing');

	$scope.article_title = team.article_title;
	$scope.article_body = team.article_body;
	$scope.article_category = team.article_category;
	$scope.article_type = team.article_type;
	$scope.article_picture = team.article_picture;
	$scope.article_id = team.article_id;
	
}





$scope.view_work = function(work){
	$("#view_work").modal("show");
	var event = document.getElementById('edit_event');
	var announcement = document.getElementById('edit_announcement');
	var writing = document.getElementById('edit_writing');
	var edit_btn = document.getElementById('edit_btn');
	var permission_btn = document.getElementById('permission_btn');

	$scope.article_title = work.article_title;
	$scope.article_body = work.article_body;
	$scope.article_category = work.article_category;
	$scope.article_type = work.article_type;
	$scope.article_picture = work.article_picture;
	$scope.article_id = work.article_id;
	if(work.article_status == 'PENDING'){
		edit_btn.style.display = "block";
		permission_btn.style.display = "none";
	}
	else if(work.article_status == 'APPROVED'){
		edit_btn.style.display = "none";
		permission_btn.style.display = "block";
	}
	else if(work.article_status == 'APPROVED FOR EDIT'){
		edit_btn.style.display = "block";
		permission_btn.style.display = "none";
	}

	if(work.article_type == 'Event'){
	event.style.display = "block";
	announcement.style.display = "none";
	writing.style.display = "none";

	}else if(work.article_type == 'Announcement'){
		announcement.style.display = "block";
		event.style.display = "none";
		writing.style.display = "none";

	}else if(work.article_type == 'Writing'){
		writing.style.display = "block";
		announcement.style.display = "none";
			event.style.display = "none";

	}

}



$scope.archiveWork = function(work){
	$http({
		method: 'post',
		url: 'public/php_script/archive_work.php',
		data: work

	}).success(function(){
		location.reload();

	});
}


$scope.seeMyRequest = function(){
	$http({
		method: 'get',
		url: 'public/php_script/request_for_edit.php'
	}).success(function(data){
		$scope.request_work = data;
		$("#request_work").modal("show");	

	});
}

$scope.seeRequest = function(){
	$http({
		method: 'get',
		url: 'public/php_script/request_for_edit_admin.php'
	}).success(function(data){
		$scope.request_work = data;
		$("#request_work").modal("show");	

	});
}


$scope.seeWork = function(){
	$http({
		method: 'get',
		url: 'public/php_script/writers_work.php'
	}).success(function(data){
		$scope.writers_work = data;
		$("#writers_work").modal("show");	

	});
}


$scope.seeTeamWorks = function(){
	$http({
		method: 'get',
		url: 'public/php_script/team_work.php'
	}).success(function(data){
		$scope.team_work = data;
		$("#team_work").modal("show");
	});
}

$scope.showTeamWorkViastatus = function(team_work_form){
	var team_status = document.getElementById("team_status");
	var team_submit_date = document.getElementById('team_submit_date');

	if(team_submit_date.value == "" && team_status.value == "ALL"){
			$http({
		method: 'post',
		url: 'public/php_script/see_team_work_via_status.php',
		data: team_work_form

	}).success(function(data){
		$scope.team_work = data;
		document.getElementById("team_work").style.display = "block";
	});
		
	}else if(team_submit_date.value != "" && team_status.value == "ALL"){
		$http({
			method: 'post',
			url: 'public/php_script/see_team_work_via_date.php',
			data: team_work_form

	}).success(function(data){
			$scope.team_work = data;
		document.getElementById("team_work").style.display = "block";

	});
		
	}
	else if(team_submit_date.value != "" && team_status.value != "ALL"){
		$http({
			method: 'post',
			url: 'public/php_script/see_team_work_via_filter.php',
			data: team_work_form

	}).success(function(data){
			$scope.team_work = data;
		document.getElementById("team_work").style.display = "block";

	});
		
	}
		else if(team_submit_date.value == "" && team_status.value != "ALL"){
	$http({
		method: 'post',
		url: 'public/php_script/see_team_work_via_status.php',
		data: team_work_form

	}).success(function(data){
		$scope.team_work = data;
		document.getElementById("team_work").style.display = "block";
	});
		
	}

}



$scope.showTeam = function(){
	$http({
		method: 'get',
		url: 'public/php_script/team_work.php'
	}).success(function(data){
		$scope.team_work = data;
		document.getElementById("team_work").style.display = "block";
		document.getElementById("admin_management").style.display = "none";
		document.getElementById("writer_management").style.display = "none";
	});
}



$scope.my_title = function(writings_form){
	var title = writings_form.article_title;
	$scope.the_title = title;
}
 


$scope.writerSignUp = function(writer_form){
	$http({
	method: 'post',
	url: 'public/php_script/sign_up_writer.php',
	data: writer_form
	}).success(function(data){
		location.reload();
	});
}

$scope.loginWriter = function(login_form){
	$http({
		method: 'post',
		url: 'public/php_script/login_writer.php',
		data: login_form

	}).success(function(data){
		location.reload();
	});
}


$scope.addWritingEvent = function(){
	$("#event_writing").modal("show");
}

$scope.addWritingAnnouncement = function(){
	$("#announcement_writing").modal("show");
}

$scope.addWritingArticle = function(){
	$("#article_writing").modal("show");
}


//Admin Side 



var admin_status = {};
var writer_status = {};

$scope.loginAdmin =  function(login_form){
	$http({
		method: 'post',
		url: 'public/php_script/admin_login.php',
		data: login_form

	}).success(function(data){
		location.reload();
	});

}


$scope.allAdminDetails = function(admin_status){
	$http({
		method: 'post',
		url: 'public/php_script/get_all_admin.php',
		data: admin_status

	}).success(function(data){
		$scope.admin_record = data;

	});
}

$scope.all_admin_init = function(){
	$http({
		method: 'get',
		url: 'public/php_script/all_admin_init.php',

	}).success(function(data){
		$scope.admin_record = data;

	});
}


$scope.archiveAdmin = function(admin){
	var r = confirm("are you sure you want to archive this account?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/archive_admin.php',
		data: admin
	}).success(function(){
	$scope.all_admin_init();
	});
}
}


$scope.addAdmin = function(admin_form){
	var r = confirm("are you sure you want to add this user?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/add_admin.php',
		data: admin_form
	}).success(function(){
		$scope.all_admin_init();
		$("#add_admin").modal("hide");
	});
}
}


$scope.editAdmin = function(edit_admin_form){
	var r = confirm("are you sure you want to update this user?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/edit_admin.php',
		data: edit_admin_form
	}).success(function(){
		$scope.all_admin_init();
		$("#edit_admin").modal("hide");
	});
}
}



$scope.activateAdmin = function(admin){
		var r = confirm("are you sure you want to archive this user?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/activate_admin.php',
		data: admin
	}).success(function(){
	$scope.all_admin_init();
	});
}
}

$scope.edit_admin = function(admin){
	var edit_admin = {};
  angular.copy(admin, edit_admin);
	var r = confirm("are you sure you want to edit this user's details?");
	if(r){
	
	$("#edit_admin").modal("show");
	$scope.edit_admin_form = edit_admin;

	}
}

$scope.add_admin = function(){
	$("#add_admin").modal("show");
}



$scope.showAdmin = function(){
	document.getElementById("team_work").style.display = "none";
	document.getElementById("admin_management").style.display = "block";
	document.getElementById("writer_management").style.display = "none";
}
$scope.showWriter = function(){
	document.getElementById("team_work").style.display = "none";
	document.getElementById("admin_management").style.display = "none";
	document.getElementById("writer_management").style.display = "block";
}


$scope.all_writer_init = function(){
	$http({
	method: 'get',
	url: 'public/php_script/all_writer_init.php'
	}).success(function(data){
	$scope.writer_record = data;
	});
}


$scope.allWriterDetails = function(writer_status){
	$http({
		method: 'post',
		url: 'public/php_script/get_all_writer.php',
		data: writer_status

	}).success(function(data){
		$scope.writer_record = data;

	});
}



$scope.archiveWriter = function(writer){
		var r = confirm("are you sure you want to archive this user?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/archive_writer.php',
		data: writer
	}).success(function(){
	$scope.all_writer_init();
	});
}
}

$scope.activateWriter = function(writer){
		var r = confirm("are you sure you want to activate this user?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/activate_writer.php',
		data: writer
	}).success(function(){
	$scope.all_writer_init();
	});
}
}


$scope.incompleteWriter = function(writer){
		var r = confirm("are you sure you want to re-update this user to incomplete?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/incomplete_writer.php',
		data: writer
	}).success(function(){
	$scope.all_writer_init();
	});
}
}

$scope.add_new_writer = function(){
	$("#add_new_writer_n").modal("show");
}


$scope.addNewWriter = function(add_writer_form){
	var r = confirm("are you sure you want to add a new user?");
	if(r){
		$http({
			method: 'post',
			url: 'public/php_script/add_new_writer.php',
			data: add_writer_form
		}).success(function(){
			$("#add_new_writer_n").modal("hide");
			$scope.all_writer_init();

		});
	}
}







}]);