var fetch = angular.module('showCompany', []);

fetch.controller('showCompanyCtrl', ['$scope', '$http', function ($scope, $http) {

$scope.getCompany = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/fetch_company_data.php'
 }).success(function(data) {
  // Store response data
  $scope.company_table = data;
 });
};
$scope.getCompanyInactive = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/fetch_company_data_inactive.php'
 }).success(function(inactive) {
  // Store response data
  $scope.company_status = inactive;
 });
};
$scope.EditModal = function(company) {
        
 $('#update_company').modal('show');
        var edit_form = {};
        angular.copy(company, edit_form);
        $scope.company_form = edit_form;
    };

    $scope.EditModalInactive = function(icompany) {
        
 $('#update_company_inactive').modal('show');
        var new_form = {};
        angular.copy(Inactiveuser, new_form);
        $scope.company_form_inactive = new_form;
    };
    $scope.closeModal = function() {
        
        $('#update_company').modal('hide');
    };
   $scope.closeModalInactive = function() {
        
        $('#update_company_inactive').modal('hide');
    };


}]);
