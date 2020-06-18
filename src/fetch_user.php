<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * FROM login 
WHERE user_id != '".$_SESSION['user_id']."' 
";

$result = mysqli_query($connect, $query);

$output = '
<table id="customers" class="table table-bordered table-striped">
<tr>
<th width="5%">No</td>
<th width="60%">Username</td>
<th width="20%">Status</td>
<th width="15%">Chat</td>
</tr>
';
foreach($result as $key => $row) {
	$status = '';
	$current = strtotime(date("Y-m-d H:i:s") ) - 285; // 10 minutes == 600 seconds

	$current_timestamp = date('Y-m-d H:i:s', $current);
	//echo 'ต้องน้อยกว่า=:'.$current_timestamp.'<br>';
	$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
	//echo 'ต้องมากกว่า=:'.$user_last_activity;
	if($user_last_activity > $current_timestamp)
	{
		$status = '<p class="text-success">Online</p>';
	}
	else
	{
		$status = '<p class="text-danger">Offline</p>';
	}
	$output .= '
	<tr>
	<td><div style="margin-top:10px">'.($key+1).'</div></td>
	<td><div style="margin-top:10px">'.chkuser_name($row['user_id'],$connect).' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</div></td>
	<td class="text-center"><div style="margin-top:10px">'.$status.'</div></td>
	<td class="text-center"><button type="button" class="btn btn-amber btn-sm start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>