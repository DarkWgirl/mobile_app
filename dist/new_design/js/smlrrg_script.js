	
		function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function showForm(){
							document.getElementById('my-log-in').style.display = "block";
						document.getElementById('hideWhenClick').style.display = "none";

}
function showActiveUser(){
    document.getElementById("activeUser").checked = true;
    document.getElementById("inactiveUser").checked = false;
}
function showInActiveUser(){
    document.getElementById("activeUser").checked = false;
    document.getElementById("inactiveUser").checked = true;
}

$(document).ready(function(){
      $("#ShowinactiveUser").hide();
     $("#ShowactiveUser").show();
  $("#activeUser").click(function(){
    $("#ShowinactiveUser").hide();
     $("#ShowactiveUser").show();
  });
  $("#inactiveUser").click(function(){
    $("#ShowinactiveUser").show();
     $("#ShowactiveUser").hide();
  });
});

$(document).ready(function(){
      $("#general_report").hide();
          $("#company_report").hide();
              $("#project_report").hide();

      $("#show_ticket_created").hide();
     $("#create_ticket").show();
  $("#showFormTicket").click(function(){
    $("#show_ticket_created").hide();
     $("#create_ticket").show();
  });
  $("#showCreatedticket").click(function(){
      $("#show_ticket_created").show();
     $("#create_ticket").hide();
  });
});

$(document).ready(function(){
      $("#general_report").hide();
          $("#company_report").hide();
              $("#project_report").hide();

                $("#company_f_report").click(function(){
            $("#company_report").show();
             $("#project_report").hide();
              $("#general_report").hide();
          });
                              $("#project_f_report").click(function(){
   $("#general_report").hide();
          $("#company_report").hide();
            $("#project_report").show();
                   });
                                    $("#general_f_report").click(function(){
             $("#general_report").show();
             $("#company_report").hide();
              $("#project_report").hide();
                });

              });