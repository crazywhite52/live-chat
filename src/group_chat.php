<?php

//group_chat.php

include('database_connection.php');

session_start();

if($_POST["action"] == "insert_data")
{

	$query = "
	INSERT INTO chat_message 
	(from_user_id, chat_message, status) 
	VALUES ('".$_SESSION["user_id"]."', '".$_POST['chat_message']."', 1)
	";

	if ($connect->query($query) === TRUE) {
		echo fetch_group_chat_history($connect);
	} else {
		echo "Error group_chat record: " . $connect->error;
	}


}

if($_POST["action"] == "fetch_data")
{
	echo fetch_group_chat_history($connect);
}

?>