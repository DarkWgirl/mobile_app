var myStore = angular.module('myStoreApp', []);

myStore.controller('myStoreAppCtrl', ['$scope', '$http', function ($scope, $http) {

var student_signup_form = {};
var login_form = {};

var student_form = {};


$scope.addComment = function(student_form){
	$http({
		method: 'post',
		url: 'public/php_script/addComment.php',
		data: student_form

	}).success(function(){
	location.reload();
	});
}


$scope.deleteComment = function(data){

	var r = confirm("are you sure you want to delete this comment?");
	if(r){
	$http({
		method: 'post',
		url: 'public/php_script/deleteComment.php',
		data: data	

	}).success(function(res){
location.reload();

	});

	}
}


$scope.editComment = function(data){

	var r = confirm("are you sure you want to edit this comment?");
	if(r){
	
	$("#edit_comment").modal("show");
	$http({
		method: 'post',
		url: 'public/php_script/editComments.php',
		data: data	

	}).success(function(res){
	$scope.comments = res;

	});

	}
}



$scope.likeArticle = function(data){
	$http({
	method: 'post',
	url: 'public/php_script/likeArticle.php',
	data: data	

	}).success(function(){
		location.reload();		
	});
}

$scope.unlikeArticle = function(data){
	$http({
	method: 'post',
	url: 'public/php_script/unlikeArticle.php',
	data: data	

	}).success(function(){
		location.reload();		
	});
}

$scope.removeUnlike = function(data){
	$http({
	method: 'post',
	url: 'public/php_script/removeUnlike.php',
	data: data	

	}).success(function(){
		location.reload();		
	});
}

$scope.removeLike = function(data){
	$http({
	method: 'post',
	url: 'public/php_script/removeLike.php',
	data: data	

	}).success(function(){
		location.reload();		
	});
}




$scope.loginStudent = function(login_form){
	$http({
		method: 'post',
		url: 'public/php_script/student_login.php',
		data: login_form

	}).success(function(data){
		if(data !=="1"){
		location.reload();
		}
		else{
			$scope.message_login_error = "Invalid username/password";
		}
	});
}


$scope.verifyStudent = function(student_form){

	let code = student_form.code;
	const code_count = code.length;
	var new_code = code.slice(3, code_count);
	$http({
		method: 'post',
		url: 'public/php_script/verify_student.php',
		data: new_code

	}).success(function(){
		location.reload();
	});
	
}



$scope.messageStudent = function(data){
	$http({
	   method: 'post',
	   url: 'public/php_script/email_verification_student.php',
	   data: data
	   }).success(function(){
		   location.reload();
	   });
   }


$scope.studentSignUp = function(student_signup_form){

    $http({
        method: 'post',
        url: 'public/php_script/sign_up_student.php',
        data: student_signup_form
        }).success(function(data){
			$scope.messageStudent(data);
		});
        
}


$scope.forgotPassword = function(login_form){
	$http({
	method: 'post',
	url: 'public/php_script/email_forgot_password.php',
	data: login_form
	}).success(function(data){
		if(data === "Email Not existing"){
		$scope.message_error = data;
		}else if(data === "Success"){
		document.getElementById("verfication_password").style.display = "block";
		document.getElementById("forgot_password").style.display = "none";
		}
	});
}

$scope.verifyPassword = function(login_form){
	$http({
		method: "post",
		url: 'public/php_script/change_password.php',
		data: login_form
	}).success(function(data){
		if(data === "Error changing password"){
			$scope.message_error = data;
		}else{
			const redirectlogIn = async () =>{
				location.href = "student_login.php";
			}
			document.getElementById("verfication_password").style.display = "none";
			$scope.message_error = "Please login using your new password";
			$scope.message_loading = "***Loading...***";
			setTimeout(redirectlogIn, 2000);
		}
	});
}






}]);