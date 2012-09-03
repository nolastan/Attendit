$(document).ready(function(){
	

	$("#register, #login, #event").hide();
	$(".logged_in").hide();
	
	
	if($.cookie('userid')){
		loginUser($.cookie('userid'));
	}
	
	
	$("#logout_btn").click(function(){
		logoutUser()
	});
	$("#login_btn").click(function(){
		$("#login").slideDown();
		$("#register").slideUp();
	});
	
	$("#register_btn").click(function(){
		$("#register").slideDown();
		$("#login").slideUp();
	});
	
	$("#logout_btn").click(function(){
			logoutUser()
		});
		
	$("#new_event_btn").click(function(){
		// if there is already a current event:
		$.post("get_current_event.php", { userid: $.cookie('userid') }, function(data) {
		   	if(data == "false"){
				// if no current event:
				$("#page").html('<form name="new_event" id="new_event"> \
					<fieldset> \
						<legend>New Attendance Sheet</legend> \
						<label for="name">Name of Event:</label><input type="text" name="name" class="name" /><br /> \
						<label for="date">Date:</label><input type="text" name="date" class="date" /><br /> \
						<label for="mandatory">Mandatory:</label><input type="checkbox" name="mandatory" class="mandatory" /><br /> \
						<input type="submit" value="Create Attendance Sheet" /> \
					</fieldset>	\
				</form>');
				$("#new_event").submit(function(){
					if($("#event form .mandatory").is(':checked')){
						mandatory = 1;
					}else{
						mandatory = 0;
					}
					$.post("new_event.php", { name: $("#new_event .name").val(), mandatory: mandatory, date: $("#new_event .date").val(), userid: $.cookie('userid') }, function(data) {
					   	if(data == "false"){
							alert("Error");
						}else{
							createEvent(data);
						}
					 });				
					return false;

				});				
			}else{
				takeAttendance(data);
			}
		 });				
		
		

	})
		
	$("#archives_btn").click(function(){
		showArchives();
		return false;		
	});
		
	$("#register").submit(function(){
		$.post("register.php", { email: $("#register .email").val(), password: $("#register .password").val() }, function(data) {
		   	if(data == "false"){
				alert("email taken");
			}else{
				loginUser(data);
			}
		 });				
		return false;
	});

	$("#login").submit(function(){
		$.post("login.php", { email: $("#login .email").val(), password: $("#login .password").val() }, function(data) {
		   	if(data == "false"){
				alert("Invalid email/password");
			}else{
				loginUser(data);
			}
		 });				
		return false;
	});

	$("#edit_roster_btn").click(function(){
		loadRoster();
		return false;
	});
	
	function showArchives(){
		$.post("archives.php", { userid: $.cookie('userid') }, function(data) {
			$("#page").html(data);
			$(".delete").click(function(){
				event = $(this).parent().attr('id');
				parent_li = $(this).parent();
				$.post("delete_event.php", { event: event }, function(data) {
				   	if(data == "false"){
						alert("Error");
					}else{
						parent_li.fadeOut();
					}
				 });				
				return false;
			});
			
		 });
	}
	
	function createEvent(id){
		takeAttendance(id);		
	}
	
	function showArchivedEvent(){
		
	}
	
	function takeAttendance(event_id){
		$.post("take_attendance.php", { userid: $.cookie('userid'), event_id: event_id }, function(data) {
			$('#page').html(data);
		 });				
		return false;		
	}
	
	function loadRoster(){
		$.post("roster.php", { userid: $.cookie('userid') }, function(data) {
		   	if(data == "false"){
				alert("Shit broke");
			}else{
				$("#page").html(data);
				$("#add_member").hide();
				$("#add_member_btn").click(function(){
					$("#add_member").slideDown();
				});
				$("#add_member").submit(function(){
					$.post("add_member.php", { email: $("#add_member .email").val(), first: $("#add_member .first").val(), last: $("#add_member .last").val(), userid: $.cookie('userid') }, function(data) {
					   	if(data == "false"){
							alert("Invalid email/password");
						}else{
							loadRoster();
						}
					 });					
					return false;
				});
				$(".delete").click(function(){
					member = $(this).parent().attr('id');
					parent_li = $(this).parent();
					$.post("delete_member.php", { member: member }, function(data) {
					   	if(data == "false"){
							alert("Error");
						}else{
							parent_li.fadeOut();
						}
					 });				
					return false;
				});
				$("ul.roster li a.name").click(function(){
					$.post("profile.php", { id: $(this).parent().attr('id'), name: $(this).html() }, function(data) {
					   	$("#page").html(data);
					 });
				});
			}
		 });				
	}
	function loginUser(id){
		$.cookie('userid', id);
		$("#register").slideUp();
		$("#login").slideUp();
		$(".logged_in").show();
		$(".logged_out").hide();		
	}
	function logoutUser(){
		$.cookie('userid', null);
		$(".logged_in").hide();
		$(".logged_out").show();
		$("#add_event").slideUp();
		$("#event_info").slideUp();
	}
	
});