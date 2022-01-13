var fetch = angular.module('showTicket', []);

fetch.controller('showTicketCtrl', ['$scope', '$http', function ($scope, $http) {

$scope.master = {};
var search = {};
var pending = {};
var approval = {};


$scope.getCompanyDetails = function(){
  $http({
method: 'get',
url: 'php_script/data_control/retrieve_company_for_project.php'
  }).success(function(c_name){
    $scope.company_id = c_name;
  });
};

$scope.getProject = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/retrieve_project_for_employee.php'
 }).success(function(project) {
  // Store response data
  $scope.project_table = project;
 });
};



$scope.getTicket = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/dc_ticket_view.php',
 }).success(function(data) {
  // Store response data
  $scope.ticket_table = data;
  $scope.title = "Ticket Details";
 });
};

$scope.submitRecall = function(new_recall){
  $http({
    method: 'POST',
    url: 'php_script/data_control/recall_ticket.php',
    data: new_recall
  }).success(function(){
      $scope.getTicket();
  $scope.closeRecall1();
  });
};


$scope.formreport = function(){
$('#report_form').modal('show');
};

$scope.closereport = function(){
  $('#report_form').modal('hide');
}



$scope.notifconfirmed = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/notif_confirmed.php'
}).success(function(notif){
$scope.notif_confirmed = notif;
});
};
$scope.viewAllconfirmedTicket = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/filters/confirmed_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Confirmed Ticket Details";
});
};
$scope.showFilterconfirmed = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/show_filter_confirmed_button.php'
}).success(function(disabled_confirmed){
$scope.show_confirmed = disabled_confirmed;
});
};



//Implemented //

$scope.notifImplemented = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/notif_implemented.php'
}).success(function(notif){
$scope.notif_implemented = notif;
});
};
$scope.viewAllImplementedTicket = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/filters/implemented_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Implemented Ticket Details";
});
};
$scope.showFilterImplemented = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/show_filter_implemented_button.php'
}).success(function(disabled_implemented){
$scope.show_implemented = disabled_implemented;
});
};

//Confiemd Ticket //






$scope.getOngoingTicket = function(ticket){
 $http({
  method: 'get',
  url: 'php_script/data_control/filters/ongoing_filter.php',
 }).success(function(data) {
  // Store response data
  $scope.ticket_table = data;
  $scope.title = "Ongoing Ticket Details";
 });
};

$scope.showFilterOnging = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/show_filter_ongoing_button.php'
}).success(function(disabled_ongoing){
$scope.show_ongoing = disabled_ongoing;
});
};

$scope.notifOngoing = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/notif_ongoing.php'
}).success(function(notif){
$scope.notif_ongoing = notif;
});
};

$scope.getTicketLive = function(search){
 $http({
  method: 'POST',
  url: 'php_script/data_control/approver_live_view.php',
  data: search
 }).success(function(data) {
  // Store response data
  $scope.ticket_table = data;
  $scope.title = "Ticket Details";
 });
};

$scope.soloResolutions = function(ticket){
  $('#solo_reso').modal('show');
 $http({
  method: 'get',
  url: 'php_script/data_control/solo_reso.php'
 }).success(function(data) {
  // Store response data
  $scope.resolution_id = data;
 });
};


$scope.getUserTicket = function(){
 $http({
  method: 'get',
  url: 'php_script/data_control/customer_ticket.php'
 }).success(function(data) {
  // Store response data
  $scope.ticket_id = data;
 });
};

       $scope.closeSoloReso = function() {
        
     $('#solo_reso').modal('hide');
    };



$scope.declinedTicket = function(ticket) {
        
 $('#declined_ticket').modal('show');
        var declined_form = {};
        angular.copy(ticket, declined_form);
        $scope.declined_remarks = declined_form;
    };

$scope.declinedRemarks = function(declined_remarks){
 $('#show_remarks').modal('show');
        var new_dremarks = {};
        angular.copy(declined_remarks, new_dremarks);
        $scope.new_declined_ticket = new_dremarks;
    };

$scope.InsertDeclinedRemarks = function(new_declined_ticket){
    $http({
method: 'POST',
url: 'php_script/data_control/declined_ticket.php',
data: new_declined_ticket
  }).success(function(){
$('#declined_ticket').modal('hide');
      $('#show_remarks').modal('hide');
       $scope.getTicket();
  });

    $http({
method: 'POST',
url: 'php_script/data_control/email/email_requestor_rejected.php',
data: new_declined_ticket
  });

};



   $scope.closeModal2 = function() {
        
$('#show_remarks').modal('hide');
    };

       $scope.closeModal1 = function() {
        
     $('#declined_ticket').modal('hide');
    };


$scope.viewResolutionsTable = function(ticket){
  var reso_form = {}; 
  angular.copy(ticket, reso_form);
    $http({
method: 'POST',
url: 'php_script/data_control/read_resolution_table.php',
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
url: 'php_script/data_control/change_password.php',
data: new_change_form
  }).success(function(){
      $('#password_form').modal('hide');
  });
};
};

$scope.viewAllPendingTicket = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/filters/pending_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Created Ticket Details";
});
};

$scope.forImplementationTicket = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/filters/for_implementation_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Approved Ticket Details";
});
};


$scope.notifForImplemenation = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/notif_for_implementation.php'
}).success(function(notif){
$scope.notif_for_imple = notif;
});
};


$scope.showFilterForImple = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/show_filter_fimple_button.php'
}).success(function(disabled_fimple){
$scope.show_fimple = disabled_fimple;
});
};

$scope.allPDeclinedTicket = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/filters/declined_filter.php'
}).success(function(data){
$scope.ticket_table = data;
$scope.title = "Rejected Ticket Details";
});
};

$scope.showFilterDeclined = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/show_filter_declined_button.php'
}).success(function(disabled_declined){
$scope.show_declined = disabled_declined;
});
};

$scope.showFilterPending = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/show_filter_pending_button.php'
}).success(function(disabled_pending){
$scope.show_pending = disabled_pending;
});
};


$scope.notifPending = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/notif_pending.php'
}).success(function(notif){
$scope.notif_pending = notif;
});
};

$scope.notifDeclined = function(){
$http({
  method: 'get',
  url: 'php_script/data_control/notif_declined.php'
}).success(function(notif){
$scope.notif_declined = notif;
});
};


$scope.approveTicket = function(ticket){
$('#approval_modal').modal('show');
angular.copy(ticket, approval);
$scope.new_approval_form = approval;
};

$scope.closeApprovalModal = function(){
  $('#approval_modal').modal('hide');
};

$scope.showApproval = function(new_approval_form){
  $('#show_approval').modal('show');
  var show_approval_remarks = {};
  angular.copy(new_approval_form, show_approval_remarks);
  $scope.show_approval = show_approval_remarks;

};

$scope.InsertApproveRemarks = function(new_approval_form){
    $http({
method: 'POST',
url: 'php_script/data_control/approve_ticket.php',
data: new_approval_form
  }).success(function(){
$('#approval_modal').modal('hide');
      $('#show_approval').modal('hide');
      $scope.getTicket();

  });
          $http({
method: 'POST',
url: 'php_script/data_control/email/email_to_all.php',
data: new_approval_form
  });
};

$scope.InsertSoloApproveRemarks = function(new_approval_form){
    $http({
method: 'POST',
url: 'php_script/data_control/approve_ticket.php',
data: new_approval_form
  }).success(function(){
$('#approval_modal').modal('hide');
      $('#show_approval').modal('hide');
      $scope.getUserTicket();

  });
          $http({
method: 'POST',
url: 'php_script/data_control/email/to_dc_head.php',
data: new_approval_form
  });
};

$scope.InsertSoloDeclined = function(new_declined_ticket){
    $http({
method: 'POST',
url: 'php_script/data_control/declined_ticket.php',
data: new_declined_ticket
  }).success(function(){
$('#declined_ticket').modal('hide');
      $('#show_remarks').modal('hide');
       $scope.getUserTicket();
  });

    $http({
method: 'POST',
url: 'php_script/data_control/email/email_requestor_rejected.php',
data: new_declined_ticket
  });

};

$scope.closeShowApprovalModal = function(){
$('#show_approval').modal('hide');
};


$scope.addRemarks = function(ticket) {
        
 $('#add_remarks').modal('show');
        var ticket_form = {};
        angular.copy(ticket, ticket_form);
        $scope.new_remarks = ticket_form;
    };

$scope.Remarks = function(new_remarks){
 $('#new_remarks').modal('show');
        var another_ticket_form = {};
        angular.copy(new_remarks, another_ticket_form);
        $scope.new_ticket_form = another_ticket_form;
    };

$scope.InsertRemarks = function(new_ticket_form){
    $http({
method: 'POST',
url: 'php_script/data_control/create_remarks.php',
data: new_ticket_form
  }).success(function(){
     $('#add_remarks').modal('hide');
      $('#new_remarks').modal('hide');
  });

};

   $scope.closeModal2 = function() {
        
$('#new_remarks').modal('hide');
    };

       $scope.closeModal1 = function() {
        
     $('#add_remarks').modal('hide');
    };

           $scope.closeDeclined = function() {
        
     $('#declined_ticket').modal('hide');
    };



}]);