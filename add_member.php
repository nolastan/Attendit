<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}


$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);

$query = "insert into members values ('', '".$_POST['first']."', '".$_POST['last']."', '".$_POST['email']."', '".$_POST['userid']."')";
mysql_query($query, $sqlserver) or die('false');

echo mysql_insert_id();