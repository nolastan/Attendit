<meta charset="utf-8">
	<style>
	#project-label {
		display: block;
		font-weight: bold;
		margin-bottom: 1em;
	}
	</style>
	<script>
	$(function() {
		var projects = [
		<?php
		
		foreach ($_POST as $k=>$v) { 
		    $_POST[$k] = mysql_real_escape_string($v); 
		}

		$sqlserver=mysql_connect('localhost','root','root');
		mysql_select_db('attendit',$sqlserver);
		$query = "SELECT * FROM members WHERE user_id = '".$_POST['userid']."'";
		$result = mysql_query($query, $sqlserver);
		$total = mysql_num_rows($result);
		while($member = mysql_fetch_array($result)): ?>		
			{
				value: "<?=$member['first'] ?> <?=$member['last'] ?>",
				id: "<?=$member['id']?>",
			},
		<?php endwhile; ?>
		];

		$( "#project" ).autocomplete({
			minLength: 0,
			source: projects,
			focus: function( event, ui ) {
				$( "#project" ).val( ui.item.value );
				return false;
			},
			select: function( event, ui ) {
				$( "#project" ).val( ui.item.value );
				mark_present(ui.item.id, ui.item.value)
				$( "#project-id" ).val( ui.item.value );

				return false;
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + item.value + "</a>" )
				.appendTo( ul );
		};
		
		function mark_present(id, name){
			$.post("mark_present.php", { member_id: id, event_id: <?=$_POST['event_id']?> }, function(data) {
				$("#notice").show().html(name + " marked present").delay(2000).fadeOut();
			 });				
			count = parseInt($("#count").html())
			count++;
			$("#count").html(count);
		}
		
		$(document).ready(function(){
			$(".absence_form").hide();
			$(".add_absence").click(function(){
				$(".absence_form").slideDown();
			});
			
			$( "#absent_input" ).autocomplete({
				minLength: 0,
				source: projects,
				focus: function( event, ui ) {
					$( "#absent_input" ).val( ui.item.value );
					return false;
				},
				select: function( event, ui ) {
					$( "#absent_input" ).val( ui.item.value );
					$( "#absent_id" ).val( ui.item.id );

					return false;
				}
			})
			.data( "autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a>" + item.value + "</a>" )
					.appendTo( ul );
			}


			$(".absence_form").submit(function(){	
				$.post("mark_absent.php", { event_id: <?=$_POST['event_id']?>, member_id: $("#absent_id").val(), excuse: $("#excuse").val() }, function(data) {

				 });			
				$(this).slideUp();	
				return false;
			});
			
			$("#done").click(function(){
				$.post("done.php", { user_id: $.cookie('userid'), event_id: <?=$_POST['event_id']?> }, function(data) {
					showArchives();
				 });								
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
			
		});
		
	});
	</script>

<?php

$query = "SELECT * FROM users WHERE id = '".$_POST['userid']."'";
$result = mysql_query($query, $sqlserver);
$user = mysql_fetch_array($result);
$needed = $total * $user['quorum'] / 100;

// get current  count
$query = "SELECT * FROM members_events WHERE event_id = " . $_POST['event_id'] . " AND present = 1";
$result = mysql_query($query, $sqlserver);
$count = mysql_num_rows($result);

?>

<p>Quorum: <span id="count"><?=$count?></span> / <?= round($needed, 0) ?>

<div class="demo">
	<label>Enter name:</label>
	<input id="project"/>
	<input type="hidden" id="project-id"/>
	<div id="notice" style="color:green; font-weight:bold"></div>
	<p class="add_absence"><a>Add an excused absence</a></p>
</div>

<form class="absence_form">
	Name: <input id="absent_input" type="text" /><br />
	<input id="absent_id" type="hidden" />
	Excuse: <input id="excuse" type="text"><br />
	<input type="submit" value="mark absent" />
</form>

<button id="done">DONE</button>


<!-- <ul> -->
<?php
/*
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM members WHERE user_id = '".$_POST['userid']."'";
$result = mysql_query($query, $sqlserver);
while($member = mysql_fetch_array($result)){ ?>
	<li id="<?= $member['id'] ?>"><?= $member['first'] ?> <?= $member['last'] ?></span></li>
<?php } ?>
</ul>
*/