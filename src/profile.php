<?php
include('database_connection.php');
session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}
$message='';

if(isset($_POST['Update']))
{

	$displayname = $_POST['displayname'];

	$query = "UPDATE login SET display_name = '".$displayname."' WHERE user_id = '".$_SESSION['user_id']."' ";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = "<label>Update Name Completed</label>";
		header("location:index.php");
	}

}
?>

<html>  
<head>  
	<title>Chat Application</title>  
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>  
<body>  
	<div class="container">
		<br />

		<h3 align="center"><i class="glyphicon glyphicon-pencil"></i> Edit Profile</h3><br />
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">Chat Application</div>
			<div class="panel-body">
				<p class="text-success"><?php echo $message; ?></p>
				<form method="post">
					<div class="form-group">
						<label>Change Name</label>
						<input type="text" name="displayname" class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="Update" class="btn btn-info" value="Update" />
					</div>
					
				</form>
				<br />
				<br />
				<br />
				<br />
			</div>
		</div>
	</div>

</body>  
</html>