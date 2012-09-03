<?php

foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM events WHERE user_id = '".$_POST['userid']."' AND done = 0";
$result = mysql_query($query, $sqlserver) or die('false');
$row = mysql_fetch_array($result);
if(mysql_num_rows($result) == 0) echo "false";
echo $row['id'];

?>