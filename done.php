<?php
foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}


$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);

$query = "UPDATE  `attendit`.`events` SET  `done` =  '1' WHERE  `events`.`id` = ".$_POST['event_id'].";";
mysql_query($query, $sqlserver) or die('false');



// get list of users members
$query = "SELECT * FROM members WHERE user_id = '".$_POST['user_id']."'";
echo $query;
$result = mysql_query($query, $sqlserver);

// check each member for present or excused
while($member = mysql_fetch_array($result)){
	$query3 = "SELECT * FROM members_events WHERE member_id = " . $member['id'] . " AND (present != 0 OR excused != 0)";
	echo $query3; echo "\n";
	$result3 = mysql_query($query3, $sqlserver);
	if(mysql_num_rows($result3) == 0){	
		// otherwise insert an absence
		$query2 = "INSERT INTO members_events values('', " . $member['id'] . ", ". $_POST['event_id'] . ", 2, 0, '')";
		$result2 = mysql_query($query2, $sqlserver);
		// then email them
		mail($member['email'], "Where you at?", "You weren't here");
	}
}