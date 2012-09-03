<p>Hover over an excused absence (yellow) to view the excuse</p>

<?php

foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM events WHERE id = '".$_POST['event_id']."'";
$result = mysql_query($query, $sqlserver);
$row = mysql_fetch_array($result);
if($row['mandatory'] == 1): ?>
<p><strong>Mandatory event</strong></p>
<?php endif;
$query = "SELECT * FROM members_events, members WHERE event_id = '".$_POST['event_id']."' AND member_id = members.id";
$result = mysql_query($query, $sqlserver);
?><ul><?php
while($member = mysql_fetch_array($result)):
	if($member['present'] == 1) $status = "present";
	elseif($member['present'] == 0) $status = "excused";
	elseif($member['present'] == 2) $status = "unexcused";
?>	
	<li class="<?=$status?>" title="<?=$member['excuse']?>"><?=$member['first']?> <?=$member['last']?></li>
<?php endwhile; ?>
</ul>
