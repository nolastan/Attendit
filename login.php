<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$hash = "Gary McMuppet";
$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);


$query = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
$result = mysql_query($query, $sqlserver) or die('false');
$user = mysql_fetch_array( $result );


$correct_password = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($hash), base64_decode($user['password']), MCRYPT_MODE_CBC, md5(md5($hash))), "\0");

if($correct_password == $_POST['password']){
	echo $user['id'];
}else{
	echo "false";
}		


?>