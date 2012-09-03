<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}


$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);

$query = "UPDATE users SET quorum = " . $_POST['amount'] . " WHERE id = " . $_POST['userid'];
mysql_query($query, $sqlserver) or die('false');