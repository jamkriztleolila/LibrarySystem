<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.0.0
	</div>
	<strong>Copyright &copy; 2018 <a href="https://www.feutech.edu.ph/">FEU TECH</a>.</strong> All rights
	reserved.
</footer>
</div>
<!-- ./wrapper
<script>
$.widget.bridge('uibutton', $.ui.button);
</script> -->
<!-- jQuery 2.2.3
<script src="<?php //echo base_url(); ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- jQuery 3.2.1 -->
<script src="<?php echo base_url(); ?>resources/plugins/jQuery/jquery-3.2.1.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>resources/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>resources/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>resources/dist/js/app.min.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url(); ?>resources/plugins/ckeditor/ckeditor.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>resources/js/moment.min.js"></script>
<!--User-->
<script src="<?php echo base_url(); ?>resources/js/js_user.js"></script>

<script src="<?=base_url();?>resources/js/users.js"></script>

<script>
	if($('#school').length > 0 && $("#userInfo").data('page') == "Librarian"){
		alert("val");
		document.getElementById('school').onchange = function() {
			$("#result").html("");
			$.post($("#userInfo").data('url') + $("#userInfo").data('user') + "/viewAvailPosition",
	      {
	        school: this.value,
	      },
	      function(data){
					if(!Array.isArray(data) || !data.length){
						res = "No position Available at the moment";
						$("#result").html(res.fontcolor("red"));
	          $("#userLevel").prop('disabled', true);
					}
					else{
						var $el = $("#userLevel");
	          $el.empty(); // remove old options
	          $el.append($("<option></option>").attr("value", "").text(" - - Select Position - - "));
	          if(data[0] < 10){
							$el.append($("<option></option>").attr("value", 1).text("Librarian"));
						}
						if(data[1] < 5){
							$el.append($("<option></option>").attr("value", 2).text("Assistant Librarian"));
						}
						if(data[2] < 1){
							$el.append($("<option></option>").attr("value", 3).text("Head Librarian"));
						}

	          $('#userLevel').prop('selectedIndex',0);
	          $("#userLevel").prop('disabled', false);
					}
				}, "json");
		};
	}

	if($('#userSchool').length > 0){
		alert("val 2");

		document.getElementById('userSchool').onchange = function() {
			$("#result").html("");
			resetUpdateForm();
			if(this.value != ""){
				$.post($("#userInfo").data('url') + $("#userInfo").data('user') + "/" + $("#userInfo").data('avail'),
					{
						school: this.value,
					},
					function(data){
						if(!Array.isArray(data) || !data.length){
							res = "No " +  $("#userInfo").data('page') + " Available at the moment";
							$("#result").html(res.fontcolor("red"));
							$("#userID").prop('disabled', true);

							var $el = $("#userID");
							$el.empty(); // remove old options
							$el.append($("<option></option>").attr("value", "").text(" - - Select Librarian ID - - "));

							$('#userID').prop('selectedIndex',0);

						}
						else{
							var $el = $("#userID");
							$el.empty(); // remove old options
							$el.append($("<option></option>").attr("value", "").text(" - - Select "+ $("#userInfo").data('page') +" ID - - "));
							$.each(data, function(key,value) {
								$el.append($("<option></option>").attr("value", value['schoolId']).text(value['schoolId']));
							});

							$('#userID').prop('selectedIndex',0);
							$("#userID").prop('disabled', false);
						}
					}, "json");
			}
			else{
				$('#userID').prop('selectedIndex',0);
				$("#userID").prop('disabled', true);
			}
		};
	}

	if($('#userID').length > 0){
		alert("val 3");

		document.getElementById('userID').onchange = function() {
			$("#result").html("");
			resetUpdateForm();
		};
	}
</script>
</body>
</html>
