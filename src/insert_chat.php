<?php

//insert_chat.php

include('database_connection.php');

session_start();


$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES ('".$_POST['to_user_id']."', '".$_SESSION['user_id']."', '".$_POST['chat_message']."', 1)
";

if ($connect->query($query) === TRUE) {
	echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
} else {
	echo "Error chat_history record: " . $connect->error;
}




?>