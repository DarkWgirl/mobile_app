var myStore = angular.module('myStoreApp', []);

myStore.controller('myStoreAppCtrl', ['$scope', '$http', function ($scope, $http) {

var student_signup_form = {};
var login_form = {};

$scope.loginStudent = function(login_form){
	$http({
		method: 'post',
		url: 'public/php_script/login_student.php',
		data: login_form

	}).success(function(data){
		location.reload();
	});
}


$scope.studentSignUp = function(student_signup_form){
    $http({
        method: 'post',
        url: 'public/php_script/sign_up_student.php',
        data: student_signup_form
        });
        
	$http({
	method: 'post',
	url: 'public/php_script/sign_up_student.php',
	data: student_signup_form
	}).success(function(data){
		location.reload();
	});
}



}]);