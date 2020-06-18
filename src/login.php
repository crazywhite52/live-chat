<!--
//login.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST['login']))
{
	$queryuser = "
	SELECT * FROM login 
	WHERE username = '".$_POST["username"]."'
	";
	$chk = $connect->query($queryuser);
	
	if($chk->num_rows>0){
		$result = mysqli_query($connect, $queryuser);
		foreach($result as $row)
		{
			if(password_verify($_POST["password"], $row["password"])){
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$sub_query = "
				INSERT INTO login_details 
				(user_id) 
				VALUES ('".$row['user_id']."')
				";
				$connect->query($sub_query);
				$last_id = mysqli_insert_id($connect);
				$_SESSION['login_details_id'] = $last_id;
				header('location:index.php');
			}else{
				$message = '<label>Wrong Username</labe>';
			}
		}
	}else{
		$message = '<label>Wrong Username</labe>';
	}

	
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Chat Login</title> 
	<link rel="shortcut icon" href="../live-chat/img/smartphone.png">
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			margin-left: 20px;
			margin-right: 20px;
			margin-bottom: 20px;
			margin-top: 20px;
		}
		form {border: 3px solid #f1f1f1;}

		input[type=text], input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		button {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
		}

		button:hover {
			opacity: 0.8;
		}

		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			background-color: #f44336;
		}

		.imgcontainer {
			text-align: center;
			margin: 24px 0 12px 0;
		}

		img.avatar {
			width: 20%;
			border-radius: 50%;
		}

		.container {
			padding: 20px;
		}

		span.psw {
			float: right;
			padding-top: 16px;
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
				display: block;
				float: none;
			}
			.cancelbtn {
				width: 100%;
			}
		}
	</style>
</head>
<body>
	<div class="imgcontainer">
		<h2>Login Chat Application</h2>
	</div>
	<form action="" method="post">
		<div class="imgcontainer">
			<img src="img/smartphone.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" required>

			<button type="submit" name="login" value="Login">Login</button>
			<label>
				<input type="checkbox" checked="checked" name="remember"> Remember me
			</label>
		</div>

		<div class="container" style="background-color:#f1f1f1">
			<button type="button" class="cancelbtn">Cancel</button>
			<span class="psw"> <a href="register.php">Register?</a></span>
		</div>
	</form>

</body>
</html>

