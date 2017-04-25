<?php
	$uname = $_GET['umane'];
	$receiver = $_GET['receiver'];
	$message = $_GET['message'];

	$user_name="fitfeed123_fitfeed";
	$dbpassword="fitfeed123";
	$database_name="fitfeed123_FITFEED";
	$conn = mysqli_connect($server_name, $user_name, $dbpassword, $database_name);

	if(!$conn){
		die("Database Connection Failed". mysqli_connect_error());
	}
	$querystring = "INSERT INTO Chatlog(sender, receiver, log) values ('$uname', '$receiver', '$message')";
	$query = mysqli_query($conn, $querystring);
	echo $uname . ": " . $message;

?>
