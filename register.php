<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}



$hash = "Gary McMuppet";
$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);

$password = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($hash), $_POST['password'], MCRYPT_MODE_CBC, md5(md5($hash))));
$query = "insert into users values ('','".$_POST['email']."','".$password."')";
mysql_query($query, $sqlserver) or die('false');

echo mysql_insert_id();