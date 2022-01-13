var fetch = angular.module('showUser', []);

fetch.controller('showUserCtrl', ['$scope', '$http', function ($scope, $http) {

$scope.getUser = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/fetch_user_data.php'
 }).success(function(data) {
  // Store response data
  $scope.employee_table = data;
 });
};
$scope.getUserInactive = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/fetch_user_data_inactive.php'
 }).success(function(inactive) {
  // Store response data
  $scope.employee_status = inactive;
 });
};
$scope.EditModal = function(user) {
        
 $('#update_account').modal('show');
        var edit_form = {};
        angular.copy(user, edit_form);
        $scope.user_form = edit_form;
    };

    
$scope.getCompanyDetails = function(){
  $http({
method: 'get',
url: 'php_script/data_control/retrieve_company_for_user.php'
  }).success(function(c_name){
    $scope.company_id = c_name;
  });
};


    $scope.EditModalInactive = function(Inactiveuser) {
        
 $('#update_account_inactive').modal('show');
        var new_form = {};
        angular.copy(Inactiveuser, new_form);
        $scope.user_form_inactive = new_form;
    };
    $scope.closeModal = function() {
        
        $('#update_account').modal('hide');
    };
   $scope.closeModalInactive = function() {
        
        $('#update_account_inactive').modal('hide');
    };


}]);
