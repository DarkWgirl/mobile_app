var fetch = angular.module('Mylogin', []);

fetch.controller('showLoginCtrl', ['$scope', '$http', function ($scope, $http) {
$scope.insert = {};
$scope.logIn = function(){
 $http({
  method: 'POST',
  url: 'php_script/login.php',
  data:$scope.insert,
 });
};


}]);
