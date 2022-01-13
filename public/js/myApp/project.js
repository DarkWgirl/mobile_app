var fetch = angular.module('showProject', []);

fetch.controller('showProjectCtrl', ['$scope', '$http', function ($scope, $http) {

$scope.getProject = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/fetch_project_data.php'
 }).success(function(data) {
  // Store response data
  $scope.project_id = data;
 });
};
$scope.getProjectInactive = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/fetch_project_inactive_data.php'
 }).success(function(inactive) {
  // Store response data
  $scope.project_status = inactive;
 });
};

$scope.getCompanyDetails = function(){
  $http({
method: 'get',
url: 'php_script/data_control/retrieve_company_for_project.php'
  }).success(function(c_name){
    $scope.company_id = c_name;
  });
};
$scope.EditModal = function(project) {
        
 $('#update_project').modal('show');
        var edit_form =  {};
        angular.copy(project, edit_form);
        $scope.project_form = edit_form;
    };

    $scope.EditModalInactive = function(inactiveProject) {
        
 $('#update_project_inactive').modal('show');
        var new_form = {};
        angular.copy(inactiveProject, new_form);
        $scope.project_form_inactive = new_form;
    };
    $scope.closeModal = function() {
        
        $('#update_project').modal('hide');
    };
   $scope.closeModalInactive = function() {
        
        $('#update_project_inactive').modal('hide');
    };


}]);
