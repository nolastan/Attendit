<strong><?=$_POST['name']?></strong><br />
<?php

foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM members_events WHERE member_id = '".$_POST['id']."' AND present = 1";
$result = mysql_query($query, $sqlserver);
$present = mysql_num_rows($result);

$query = "SELECT * FROM members_events WHERE member_id = '".$_POST['id']."' AND present = 0 AND excused = 0";
$result = mysql_query($query, $sqlserver);
$unexcused = mysql_num_rows($result);

$query = "SELECT * FROM members_events WHERE member_id = '".$_POST['id']."' AND excused = 1";
$result = mysql_query($query, $sqlserver);
$excused = mysql_num_rows($result);

?>

Present: <?=$present?><br />
Unexcused: <?=$unexcused?><br />
Excused: <?=$excused?><br />