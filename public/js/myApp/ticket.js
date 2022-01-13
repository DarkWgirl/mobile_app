var fetch = angular.module('showTicket', []);

fetch.controller('showTicketCtrl', ['$scope', '$http', function ($scope, $http) {

$scope.master = {};
var search = {};
var new_t_form = {};



$scope.getTicket = function(){
 $http({
  method: 'get',
  url: 'php_script/employee/ticket_view.php',
 }).success(function(data) {
  // Store response data
  $scope.ticket_table = data;
   $scope.title = "Ticket Details";
 });
};

$scope.getOngoingTicket = function(ticket){
 $http({
  method: 'get',
  url: 'php_script/employee/filters/ongoing_filter.php',
 }).success(function(data) {
  // Store response data
  $scope.ticket_table = data;
  $scope.title = "Ongoing Ticket Details";
 });
};



$scope.recallticket = function(ticket){
  var recall = {};
angular.copy(ticket, recall);
$scope.new_recall = recall;
$('#show_recall_msg').modal('show');
};

$scope.closeRecall1 = function(){
$('#show_recall_msg').modal('hide');
};


$scope.submitRecall = function(new_recall){
  $http({
    method: 'POST',
    url: 'php_script/employee/recall_ticket.php',
    data: new_recall
  }).success(function(){
      $scope.getTicket();
  $scope.closeRecall1();
  });
};

$scope.submitSoloRecall = function(new_recall){
  $http({
    method: 'POST',
    url: 'php_script/employee/recall_ticket.php',
    data: new_recall
  }).success(function(){
      $scope.getUserTicket();
  $scope.closeRecall1();
  });
};

$scope.showFilterOnging = function(){
$http({
  method: 'get',
  url: 'php_script/employee/show_filter_ongoing_button.php'
}).success(function(disabled_ongoing){
$scope.show_ongoing = disabled_ongoing;
});
};

$scope.notifOngoing = function(){
$http({
  method: 'get',
  url: 'php_script/employee/notif_ongoing.php'
}).success(function(notif){
$scope.notif_ongoing = notif;
});
};


$scope.get_new_ticket = function(new_t_form){
var n_t = {};
angular.copy(new_t_form, n_t);
$scope.n_ticket = n_t;
  $('#create_new_ticket').modal('show');
};
$scope.closeNTForm = function(){
  $('#create_new_ticket').modal('hide');
};


$scope.insertticket = function(n_ticket){
  $http({
    method: 'POST',
    url: 'php_script/employee/create_ticket.php',
    data: n_ticket
  }).success(function(){
    $scope.closeNTForm();
    $scope.getTicket();

        $http({
    method: 'POST',
    url: 'php_script/employee/email.php',
    data: n_ticket
  });

  });
};





//Implemented //

$scope.notifImplemented = function(){
$http({
  method: 'get',
  url: 'php_script/employee/notif_implemented.php'
}).success(function(notif){
$scope.notif_implemented = notif;
});
};
$scope.viewAllImplementedTicket = function(){
$http({
  method: 'get',
  url: 'php_script/employee/filters/implemented_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Implemented Ticket Details";
});
};
$scope.showFilterImplemented = function(){
$http({
  method: 'get',
  url: 'php_script/employee/show_filter_implemented_button.php'
}).success(function(disabled_implemented){
$scope.show_implemented = disabled_implemented;
});
};

//Confiemd Ticket //








$scope.getTicketLive = function(search){
 $http({
  method: 'POST',
  url: 'php_script/employee/ticket_live_search.php',
  data: search
 }).success(function(data) {
  // Store response data
  $scope.ticket_table = data;
   $scope.title = "Ticket Details";
 });
};

$scope.getProject = function(){
 $http({
  method: 'get',
  url: 'php_script/employee/retrieve_project_for_employee.php'
 }).success(function(project) {
  // Store response data
  $scope.project_table = project;
 });
};

$scope.getUserTicket = function(){
 $http({
  method: 'get',
  url: 'php_script/employee/customer_ticket.php'
 }).success(function(data) {
  // Store response data
  $scope.ticket_id = data;
 });
};

$scope.addRemarks = function(ticket) {
        
 $('#add_remarks').modal('show');
        var ticket_form = {};
        angular.copy(ticket, ticket_form);
        $scope.new_remarks = ticket_form;
    };

$scope.Remarks = function(new_remarks){
 $('#show_remarks').modal('show');
        var another_ticket_form = {};
        angular.copy(new_remarks, another_ticket_form);
        $scope.new_ticket_form = another_ticket_form;
    };

$scope.InsertRemarks = function(new_ticket_form){
    $http({
method: 'POST',
url: 'php_script/employee/create_remarks.php',
data: new_ticket_form
  }).success(function(){
     $('#add_remarks').modal('hide');
      $('#show_remarks').modal('hide');
  });

};

   $scope.closeModal2 = function() {
        
$('#show_remarks').modal('hide');
    };

       $scope.closeModal1 = function() {
        
     $('#add_remarks').modal('hide');
    };


$scope.viewResolutionsTable = function(ticket){
  var reso_form = {}; 
  angular.copy(ticket, reso_form);
    $http({
method: 'POST',
url: 'php_script/employee/read_resolution_table.php',
data: reso_form
  }).success(function(data){
    $('#show_reso_table').modal('show');
    $scope.resolution_id  = data;
    $scope.notifPending();
    $scope.notifDeclined();
    $scope.notifForImplemenation();
        $scope.notifImplemented();
  });
};


       $scope.closeReso = function() {
        
     $('#show_reso_table').modal('hide');
    };



  $scope.closeCForm = function() {
        
  $('#password_form').modal('hide');
    };  


 $scope.pForm = function() {
  var change_form = {};
  $('#password_form').modal('show');
  $scope.new_change_form = change_form;

 };
$scope.validatePassword = function(new_change_form) {
var message = "Not Match, please try again";
var password1 = new_change_form.new_password;
var password2 = new_change_form.confirm_new_password;
if (password1 != password2) {
$scope.FormError = message;
}else if(password1.length < 6){
$scope.FormError = "Plese input atleast 6 characters";
}else{
  $http({
method: 'POST',
url: 'php_script/employee/change_password.php',
data: new_change_form
  }).success(function(){
      $('#password_form').modal('hide');
  });
};
};

$scope.viewAllPendingTicket = function(){
$http({
  method: 'get',
  url: 'php_script/employee/filters/pending_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Created Ticket Details";
});
};


$scope.allPDeclinedTicket = function(){
$http({
  method: 'get',
  url: 'php_script/employee/filters/declined_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Rejected Ticket Details";
});
};

$scope.showFilterDeclined = function(){
$http({
  method: 'get',
  url: 'php_script/employee/show_filter_declined_button.php'
}).success(function(disabled_declined){
$scope.show_declined = disabled_declined;
});
};

$scope.showFilterPending = function(){
$http({
  method: 'get',
  url: 'php_script/employee/show_filter_pending_button.php'
}).success(function(disabled_pending){
$scope.show_pending = disabled_pending;
});
};

$scope.notifPending = function(){
$http({
  method: 'get',
  url: 'php_script/employee/notif_pending.php'
}).success(function(notif){
$scope.notif_pending = notif;
});
};

$scope.notifDeclined = function(){
$http({
  method: 'get',
  url: 'php_script/employee/notif_declined.php'
}).success(function(notif){
$scope.notif_declined = notif;
});
};

$scope.forImplementationTicket = function(){
$http({
  method: 'get',
  url: 'php_script/employee/filters/for_implementation_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Approveds Ticket Details";
});
};


$scope.notifForImplemenation = function(){
$http({
  method: 'get',
  url: 'php_script/employee/notif_for_implementation.php'
}).success(function(notif){
$scope.notif_for_imple = notif;
});
};


$scope.showFilterForImple = function(){
$http({
  method: 'get',
  url: 'php_script/employee/show_filter_fimple_button.php'
}).success(function(disabled_fimple){
$scope.show_fimple = disabled_fimple;
});
};


}]);