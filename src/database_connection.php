<?php

//database_connection.php

//$connect = new PDO("mysql:host=172.18.9.120;dbname=chat_live;charset=utf8mb4", "mis", "mis999*");
//$connect = new PDO("mysql:host=172.18.0.155;dbname=msystem;charset=utf8mb4", "jib999", "jibxtranet999*");

$servername = "172.18.0.155";
$username = "apiuser";
$password = "h1YWF%g5esa5";
$dbname ="chat_live";

$connect = new mysqli($servername, $username, $password, $dbname);
$connect -> set_charset("utf8mb4");
date_default_timezone_set("Asia/Bangkok");
if ($connect->connect_error) {
	die("Connection failed: " . $connect->connect_error);
}else{
	//echo "Connection";
}


function chkuser_name($user_id, $connect)
{
	$query = "SELECT display_name,username FROM login WHERE user_id = '$user_id'";
	$result = mysqli_query($connect, $query);

	foreach($result as $row)
	{
		if($row['display_name']==null){
			return $row['username'];
		}else{
			return $row['display_name'];
		}
		
	}
}

function fetch_user_last_activity($user_id, $connect)
{
	$query = "
	SELECT * FROM login_details 
	WHERE user_id = '$user_id' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";
	$result = mysqli_query($connect, $query);

	foreach($result as $row)
	{
		return $row['last_activity'];
	}
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp DESC
	";
	$result = mysqli_query($connect, $query);
	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $from_user_id)
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			}
			else
			{
				$chat_message = $row['chat_message'];
				// $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
				$user_name = '<span class="badge badge-danger remove_chat" id="'.$row['chat_message_id'].'">x</span>&nbsp;<b class="text-success">You</b>';
			}


			$dynamic_background = 'background-color:#ffe6e6;';
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
			}
			else
			{
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
			$dynamic_background = 'background-color:#ffffe6;';
		}
		$output .= '
		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
		<p>'.$user_name.'  '.$chat_message.'
		<div align="right">
		- <small><em>'.$row['timestamp'].'</em></small>
		</div>
		</p>
		</li>
		';
	}
	$output .= '</ul>';
	$query = "
	UPDATE chat_message 
	SET status = '0' 
	WHERE from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."' 
	AND status = '1'
	";
	$connect->query($query);
	$connect->close();
	return $output;
}

function get_user_name($user_id, $connect)
{
	$query = "SELECT username FROM login WHERE user_id = '$user_id'";
	$result = mysqli_query($connect, $query);
	foreach($result as $row)
	{
		return $row['username'];
	}
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE from_user_id = '$from_user_id' 
	AND to_user_id = '$to_user_id' 
	AND status = '1'
	";
	// $statement = $connect->query($query);
	// $statement->execute();
	// $count = $statement->rowCount();

	$result = mysqli_query($connect, $query);
	$rowcount=mysqli_num_rows($result);
	$output = '';
	if($rowcount > 0)
	{
		// $output = '<span class="label label-success">'.$rowcount.'</span>';
		$output = '<span class="badge badge-danger ml-2">'.$rowcount.'</span><span class="sr-only">unread messages</span>';
	}
	return $output;
}

function fetch_is_type_status($user_id, $connect)
{
	$query = "
	SELECT is_type FROM login_details 
	WHERE user_id = '".$user_id."' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";	
	$result = mysqli_query($connect, $query);
	$output = '';
	foreach($result as $row)
	{
		if($row["is_type"] == 'yes')
		{
			$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
		}
	}
	return $output;
}

function fetch_group_chat_history($connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE to_user_id = '0'  
	ORDER BY timestamp DESC
	";

	$result = mysqli_query($connect, $query);

	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $_SESSION["user_id"])
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			}
			else
			{
				$chat_message = $row["chat_message"];
				// $user_name = '<button type="button" class="remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
				$user_name = '<span class="badge badge-danger remove_chat" id="'.$row['chat_message_id'].'">x</span>&nbsp;<b class="text-success">You</b>';
			}

			$dynamic_background = 'background-color:#ffe6e6;';
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
			}
			else
			{
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b class="text-danger">'.chkuser_name($row['from_user_id'], $connect).'</b>';
			$dynamic_background = 'background-color:#ffffe6;';
		}

		$output .= '

		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
		<p>'.$user_name.'</p>
		<p>'.$chat_message.'
		<div align="right">
		- <small><em>'.$row['timestamp'].'</em></small>
		</div>
		</p>
		</li>
		';
	}
	$output .= '</ul>';
	return $output;
}


?>