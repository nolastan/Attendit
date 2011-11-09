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
<ul>
<?php

foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM members WHERE user_id = '".$_POST['userid']."'";
$result = mysql_query($query, $sqlserver);
while($member = mysql_fetch_array($result)){ ?>
	<li id="<?= $member['id'] ?>"><?= $member['first'] ?> <?= $member['last'] ?> <span class="email"><?= $member['email'] ?></span><a class="delete">[x]</a></li>
<?php } ?>
</ul>