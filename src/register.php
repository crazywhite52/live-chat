<!--
//register.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';
$pass= '';
if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST["register"]))
{
	$display_name = trim($_POST["display_name"]);
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$check_query = "
	SELECT * FROM login 
	WHERE username = '".$username."' ";
	
	$result = $connect->query($check_query);

	if($result->num_rows>0){
		$message .= '<p><label>Username already taken</label></p>';
	}else{
		if(empty($username))
		{
			$message .= '<p><label>Username is required</label></p>';
		}
		if(empty($display_name))
		{
			$message .= '<p><label>Display Name is required</label></p>';
		}
		if(empty($password))
		{
			$message .= '<p><label>Password is required</label></p>';
		}
		else
		{
			if($password != $_POST['confirm_password'])
			{
				$message .= '<p><label>Password not match</label></p>';
			}else{
				$pass=password_hash($password, PASSWORD_DEFAULT);
			}
		}

		if(empty($message)){
			//$pass=password_hash($password, PASSWORD_DEFAULT)
			
			$sqlins="INSERT INTO login SET display_name='".$display_name."',username='".$username."', password='".$pass."' ";
			
			if ($connect->query($sqlins) === TRUE) {
				$message = "<label>Registration Completed</label>";
			} else {
				echo "Error insert record: " . $connect->error;
			}

			$connect->close();
		}
	}
}

?>

<html>  
<head>  
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="../live-chat/img/smartphone.png">
	<title>Chat Register</title>  
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>  
<body>  
	<div class="container">
		<br />

		<h3 align="center"><i class="glyphicon glyphicon-comment"></i> Live Chat[MIS-TEAM]</a></h3><br />
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">Chat Application Register</div>
			<div class="panel-body">
				<form method="post">
					<span class="text-danger"><?php echo $message; ?></span>
					<div class="form-group">
						<label>Display Nname</label>
						<input type="text" name="display_name" class="form-control" />
					</div>
					<div class="form-group">
						<label>Enter Username</label>
						<input type="text" name="username" class="form-control" />
					</div>
					<div class="form-group">
						<label>Enter Password</label>
						<input type="password" name="password" class="form-control" />
					</div>
					<div class="form-group">
						<label>Re-enter Password</label>
						<input type="password" name="confirm_password" class="form-control" />
					</div>
					<div class="form-group">
						<input type="submit" name="register" class="btn btn-info" value="Register" />
					</div>
					<div align="center">
						<a href="login.php">Login</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>  
</html>
