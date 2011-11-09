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
		$("#event").show();
	})
		
	$("#archives_btn").click(function(){
		$.post("archives.php", { userid: $.cookie('userid') }, function(data) {
			$("#archives").html(data);
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
	
	$("#event form").submit(function(){
		if($("#event form .mandatory").is(':checked')){
			mandatory = 1;
		}else{
			mandatory = 0;
		}
		$.post("new_event.php", { name: $("#event form .name").val(), mandatory: mandatory, date: $("#event form .date").val(), userid: $.cookie('userid') }, function(data) {
		   	if(data == "false"){
				alert("Error");
			}else{
				createEvent();
			}
		 });				
		return false;
		
	});

	$("#edit_roster_btn").click(function(){
		loadRoster();
		return false;
	});
	
	function createEvent(){
		alert("yay!");
	}
	
	function showArchivedEvent(){
		
	}
	
	function loadRoster(){
		$.post("roster.php", { userid: $.cookie('userid') }, function(data) {
		   	if(data == "false"){
				alert("Shit broke");
			}else{
				$("#edit_roster").html(data);
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