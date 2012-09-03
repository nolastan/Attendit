<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}


$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);

$query = "insert into members_events values ('', '".$_POST['member_id']."', '".$_POST['event_id']."', '0', '1', '".$_POST['excuse']."') ON DUPLICATE KEY UPDATE present = 1";
echo $query;
mysql_query($query, $sqlserver) or die('false');

echo mysql_insert_id();