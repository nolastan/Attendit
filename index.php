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
	<link rel="stylesheet" href="jquery.autocomplete.css" />
	<title><?=PROJECT_NAME?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>
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
<nav class="logged_in">
	<a id="edit_roster_btn">Edit Roster</a>
	<a id="new_event_btn">Attendance Sheet</a>
	<a id="archives_btn">Archives</a>
</nav>
<p class="logged_out">Please login or register.</p>
<div id="page" class="logged_in">
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