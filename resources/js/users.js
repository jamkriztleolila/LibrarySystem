function editUser(){
  var selectedID = document.getElementById("userID");
  var selectedSchool = document.getElementById("userSchool");
  $("#deactivateBtn").prop('disabled', true);
  $("#saveBtn").prop('disabled', true);
  $("#resetBtn").prop('disabled', true);
  $("#result").html("");
  alert($("#userInfo").data('url'));
  alert(selectedID.selectedIndex != 0 && selectedSchool.selectedIndex != 0);

  if(selectedID.selectedIndex != 0 && selectedSchool.selectedIndex != 0){
    $.post($("#userInfo").data('url') + "Admin/viewInfoTeacher",
      {
        id: selectedID.options[selectedID.selectedIndex].value,
        school: selectedSchool.options[selectedSchool.selectedIndex].value,
      },
      function(data){

        console.log(data);
        if(data != null){
          $("#schoolId").val(data["schoolId"]);
          $("#firstName").val(data["firstName"]);
          $("#middleName").val(data["middleName"]);
          $("#lastName").val(data["lastName"]);
          $("#email").val(data["email"]);
          $("#deactivateBtn").prop('disabled', false);
          $("#saveBtn").prop('disabled', false);
          $("#resetBtn").prop('disabled', false);
        }
        else{
          $("#schoolId").val("");
          $("#firstName").val("");
          $("#middleName").val("");
          $("#lastName").val("");
          $("#email").val("");

          var res = "User does not exist";
          $("#result").html(res.fontcolor("red"));
        }
      }, "json");
  }
  else{
      var res = "";

      if(selectedID.selectedIndex == 0) res = "Choose an ID";
      if(selectedSchool.selectedIndex == 0) res = "Choose a School";

      $("#schoolId").val("");
      $("#firstName").val("");
      $("#middleName").val("");
      $("#lastName").val("");
      $("#email").val("");
      $('#userID').prop('selectedIndex',0);
      $('#userSchool').prop('selectedIndex',0);
      $("#result").html(res.fontcolor("red"));
  }
}

function deactivateUser(){
  var selectedID = document.getElementById("userID");
  var selectedSchool = document.getElementById("userSchool");

  alert(selectedID.selectedIndex != 0 && selectedSchool.selectedIndex != 0);

  if(selectedID.selectedIndex != 0 && selectedSchool.selectedIndex != 0){
    $.post($("#userInfo").data('url') + "Admin/deactivateUser",
      {
        id: selectedID.options[selectedID.selectedIndex].value,
        school: selectedSchool.options[selectedSchool.selectedIndex].value,
      },
      function(data){

        console.log(data);
        var res = "";
        if(data == null){
          res = "Teacher (ID #: " + selectedID.options[selectedID.selectedIndex].value + ") was not deactivated";
          $("#result").html(res.fontcolor("red"));
        }
        else{
          res = "Teacher (ID #: " + selectedID.options[selectedID.selectedIndex].value + ") has been successfully deactivated";

          var $el = $("#userID");
          $el.empty(); // remove old options
          $el.append($("<option></option>").attr("value", "").text(" - - Select Teacher ID - - "));
          $.each(data["teachers"], function(key,value) {
            $el.append($("<option></option>").attr("value", value['id']).text(value['id']));
          });

          $("#schoolId").val("");
          $("#firstName").val("");
          $("#middleName").val("");
          $("#lastName").val("");
          $("#email").val("");
          $('#userID').prop('selectedIndex',0);
          $('#userSchool').prop('selectedIndex',0);
          $("#result").html(res.fontcolor("green"));
        }

      }, "json");
  }
}

function resetPassword(){
  var selectedID = document.getElementById("userID");
  var selectedSchool = document.getElementById("userSchool");

  alert(selectedID.selectedIndex != 0 && selectedSchool.selectedIndex != 0);

  if(selectedID.selectedIndex != 0 && selectedSchool.selectedIndex != 0){
    $.post($("#userInfo").data('url') + "Admin/resetPassword",
      {
        id: selectedID.options[selectedID.selectedIndex].value,
        school: selectedSchool.options[selectedSchool.selectedIndex].value,
      },
      function(data){

        console.log(data);
        var res = "";
        if(data == null){
          res = "Teacher (ID #: " + selectedID.options[selectedID.selectedIndex].value + ") reset password failed";
          $("#result").html(res.fontcolor("red"));
        }
        else{
          res = "Teacher (ID #: " + selectedID.options[selectedID.selectedIndex].value + ") reset password successfully";
          $("#schoolId").val("");
          $("#firstName").val("");
          $("#middleName").val("");
          $("#lastName").val("");
          $("#email").val("");
          $('#userID').prop('selectedIndex',0);
          $('#userSchool').prop('selectedIndex',0);
          $("#result").html(res.fontcolor("green"));
        }

      }, "json");
  }
}
