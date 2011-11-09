<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);

$query = "insert into events values ('', '".$_POST['name']."', '".$_POST['mandatory']."', '".$_POST['date']."', '".$_POST['userid']."')";
mysql_query($query, $sqlserver) or die('false');

echo mysql_insert_id();