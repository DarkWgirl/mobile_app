var myStore = angular.module('myStoreApp', []);

myStore.controller('myStoreAppCtrl', ['$scope', '$http', function ($scope, $http) {


var writer_form = {};

$scope.process_two = function(){
	var part_one = document.getElementById("identity_p1");
	var part_two = document.getElementById("identity_p2");
	var part_three = document.getElementById("identity_p3");
	var span_one = document.getElementsByClassName("process_style");
	span_one[1].style.backgroundColor = "blue";
		span_one[2].style.backgroundColor = "lightgray";
	part_one.style.display = "none";
	part_three.style.display = "none";
	part_two.style.display = "block";
}

$scope.process_one = function(){
	var part_one = document.getElementById("identity_p1");
	var part_two = document.getElementById("identity_p2");
	var part_three = document.getElementById("identity_p3");
	var span_one = document.getElementsByClassName("process_style");
	span_one[1].style.backgroundColor = "lightgray";
	span_one[2].style.backgroundColor = "lightgray";
	part_one.style.display = "block";
	part_three.style.display = "none";
	part_two.style.display = "none";
}

$scope.process_three = function(){
	var part_one = document.getElementById("identity_p1");
	var part_two = document.getElementById("identity_p2");
	var part_three = document.getElementById("identity_p3");
	var span_one = document.getElementsByClassName("process_style");
	span_one[1].style.backgroundColor = "blue";
	span_one[2].style.backgroundColor = "blue";
	part_one.style.display = "none";
	part_three.style.display = "block";
	part_two.style.display = "none";
}

$scope.verifypassword = function(writer_form){
	if(writer_form.writer_password == writer_form.writer_confirm_password){
		document.getElementById("confirm_password").style.borderColor = "";
		document.getElementById("password").style.borderColor = "";
		document.getElementById('second_btn').style.display = "block";
	}
	else{
		document.getElementById("confirm_password").style.borderColor = "red";
		document.getElementById("password").style.borderColor = "red";
	}
}



$scope.processProfile = function(writer_form){
let part_one = document.getElementsByClassName("form-control");
	var temp_hold_one = [];
	for(var i = 0; i < part_one.length; i++){
		if(part_one[i].value ==""){

		}else{
		temp_hold_one.push(part_one[i].value);
	}
	}
	
	if(temp_hold_one.length == 7){
var r = confirm("Are you sure you want to submit these data?");
	if(r){
		$http({
		method: 'post',
		url: 'public/php_script/process_writer_profile.php',
		data: writer_form	

		}).success(function(){
		location.reload();
		});
	}
}
else{
	alert("Complete The Field Below");
}
}

}]);