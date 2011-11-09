<?php
define('COMPANY_NAME', 'CSE 330');
define('DEV_NAME', 'Greg &amp; Stan');
define('DEV_URL', 'http://kappsig.wustl.edu');
define('PROJECT_NAME', 'Attendit');
?>

<html>
<head>
	<link rel="stylesheet" href="reset.css" />
	<link rel="stylesheet" href="one-page.css" />
	<title><?=PROJECT_NAME?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="script.js" type="text/javascript"></script>
	<script src="jquery.cookie.js" type="text/javascript"></script>
</head>
<body>
<div id="content">
<header class="clearfix">
	<h1 id="project_name"><?=PROJECT_NAME?></h1>
	<h2 id="company_name" class="logged_out"><a id="login_btn">Login</a> - <a id="register_btn">Register</a></h2>
	<h2 id="company_name" class="logged_in"><a id="logout_btn">Logout</a></h2>
</header>

<a id="edit_roster_btn">Edit Roster</a>
<a id="new_event_btn">New Attendance Sheet</a>
<a id="archives_btn">Archives</a>

<div id="edit_roster">

</div>

<div id="archives">
	
</div>

<div id="event">
	<form name="new_event">
		<fieldset>
			<legend>New Attendance Sheet</legend>
			<label for="name">Name of Event:</label><input type="text" name="name" class="name" /><br />
			<label for="date">Date:</label><input type="text" name="date" class="date" /><br />
			<label for="mandatory">Mandatory:</label><input type="checkbox" name="mandatory" class="mandatory" /><br />
			<input type="submit" value="Create Attendance Sheet" />
		</fieldset>	
	</form>
</div>

<form name="login" id="login">
	<fieldset>
	<legend>Login</legend>
	<label for="email">email:</label><input type="text" name="email" class="email" /><br />
	<label for="password">Password:</label><input type="password" name="password" class="password" /><br />
	<input type="submit" value="Log in" />
	</fieldset>	
</form>

<form name="register" id="register">
	<fieldset>
	<legend>Register</legend>
	<label for="email">email:</label><input type="text" name="email" class="email" /><br />
	<label for="password">Password:</label><input type="password" name="password" class="password" /><br />
	<input type="submit" value="Register" />
	</fieldset>
</form>


</div>
<footer>
<address>Developed by <a href="<?=DEV_URL?>"><?=DEV_NAME?></a>.</address>
</footer>

</body>
</html>