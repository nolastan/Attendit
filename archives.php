<ul id="archives_list">
<?php

foreach ($_POST as $k=>$v) { 
    $_POST[$k] = mysql_real_escape_string($v); 
}

$sqlserver=mysql_connect('localhost','root','root');
mysql_select_db('attendit',$sqlserver);
$query = "SELECT * FROM events WHERE user_id = '".$_POST['userid']."'";
$result = mysql_query($query, $sqlserver);
while($event = mysql_fetch_array($result)){ ?>
	<li id="<?= $event['id'] ?>"><a class="event"><?= $event['name'] ?></a> <span class="email"><?= $event['date'] ?></span><a class="delete">[x]</a></li>
<?php } ?>
</ul>

<script type="text/javascript">
$(document).ready(function(){
	$("#archives_list li").click(function(){
		$.post("archived_event.php", { event_id: $(this).attr('id') }, function(data) {
		   	$("#page").html(data);
		 });
	});
});
</script>