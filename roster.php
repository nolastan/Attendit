<a id="add_member_btn">Add Member</a>

<form id="add_member">
	<fieldset>
	<legend>Register</legend>
	<label for="first">First Name: </label><input name="first" class="first" /><br />
	<label for="last">Last Name: </label><input name="last" class="last" /><br />
	<label for="email">Email Address: </label><input name="email" class="email" /><br />
	<input type="submit" value="Add Member" />
	</fieldset>
</form>
<hr />
<ul class="roster">
<?php

foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM members WHERE user_id = '".$_POST['userid']."'";
$result = mysql_query($query, $sqlserver);
while($member = mysql_fetch_array($result)){ ?>
	<li id="<?= $member['id'] ?>"><a class="name"><?= $member['first'] ?> <?= $member['last'] ?></a> <span class="email"><?= $member['email'] ?></span><a class="delete">[x]</a></li>
<?php } ?>
</ul>
<hr />
<?php

$query = "SELECT * FROM users WHERE id = '".$_POST['userid']."'";
$result = mysql_query($query, $sqlserver);
$user = mysql_fetch_array($result)

?>
<form id="quorum_form">Quorum: <input type="text" id="quorum" size="3" value="<?=$user['quorum'] ?>" /> % <input type="submit" value="Save" />
	<p class="notice"></p></form>

<script type="text/javascript">
$(document).ready(function(){
	$("#quorum_form").submit(function(){
		$.post("save_quorum.php", { amount: $("#quorum_form #quorum").val(), userid: $.cookie('userid') }, function(data) {
			$("#quorum_form .notice").show().html("Set quorum to " + $("#quorum_form #quorum").val()).delay(2000).fadeOut();
		 });
		return false
	});
});
</script>