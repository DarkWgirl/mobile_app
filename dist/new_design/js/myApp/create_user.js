 var app = angular.module('myApp',[]);
    app.controller('myCtrl',function($scope,$http){    
        $scope.insertData=function(){      
            $http.post("php_script/data_control/create_user.php", {
                'employee_fname':$scope.employee_fname,
                'employee_lname':$scope.employee_lname,
                'employee_email':$scope.employee_email,
                'employee_unit':$scope.employee_unit,
                'employee_position':$scope.employee_position,
                'employee_level':$scope.employee_level,
                'employee_id_number':$scope.employee_id_number
            });
        }
    });