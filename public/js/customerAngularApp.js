var myStore = angular.module('myStoreApp', []);

myStore.controller('myStoreAppCtrl', ['$scope', '$http', function ($scope, $http) {

var sign_up = {};
var login_seller = {};
var id_number = "";
var item_status = {};
var seller_add_info = {};
var edit_seller_info = {};
var process_cart = {};
var shipping_form = {};




$scope.get_available_item = function(){
	$http({
		method: 'get',
		url: '/get_items_catalogue'
	}).success(function(data){
		$scope.item = data.data;

	});
}

$scope.viewQuantity = function(x){
	$http({
		method: 'POST',
		url: '/item_count_catalogue',
		data: x
	}).success(function(record){
		$scope.oat =  record.record;
		$("#count").modal("show");
	
	});
}



$scope.addToCart = function(x){
	var cart_form = {};
	angular.copy(x, cart_form);
	$("#cart").modal("show");
	$scope.modal_title = x.item_name;
	$scope.my_cart = cart_form;
}


$scope.add_to_cart = function(my_cart){
	$http({
		method: 'POST',
		url: '/add_to_cart',
		data: my_cart
	}).success(function(){
		$("#cart").modal("hide");
		location.reload();

	});
}

$scope.seeCart = function(){
	$http({
		method: 'get',
		url: '/get_cart_item'
	}).success(function(data){
			$("#itemsInCart").modal("show");
		$scope.cart_items = data.data;

	});
}

$scope.totalCart = function(){
	$http({
		method: 'get',
		url: '/total_cart_item'
	}).success(function(data){
		$scope.total_items = data.data;

	});
}

$scope.removeCart = function(x){
	var r = confirm("Are you sure to remove it from cart?");
	if(r){
	$http({
		method: 'POST',
		url: '/remove_from_cart',
		data: x
	}).success(function(){
		location.reload();
	});
}
}


$scope.processCart = function(){
	$("#shipping_form").modal("show");
}

$scope.orderProcess = function(shipping_form){
	$http({
		method: 'POST',
		url: '/processOrder',
		data: shipping_form

	}).success(function(){
	location.reload();
	});

}




}]);