<?php
	$user1 = $_GET['user1'];
	$user2 = $_GET['user2'];

	$user_name="fitfeed123_fitfeed";
	$dbpassword="fitfeed123";
	$database_name="fitfeed123_FITFEED";
	$conn = mysqli_connect($server_name, $user_name, $dbpassword, $database_name);

	if(!$conn){
		die("Database Connection Failed", mysqli_connect_error());
	}
	//database select check necessary?
	$query = "SELECT * FROM Chatlog 
			where sender = '$user1' and receiver = '$user2'
			union select * FROM Chatlog 
			where sender ='$user2' and receiver = '$user1'
			order by timelog asc";//not sure about this
	$getchatlot = mysqli_query($conn, $query);
	$get_rows = mysqli_affected_rows($conn); //how many rows it has
	if($get_rows > 0){
		//fetch_assoc()--Returns an associative array that corresponds to the fetched row or NULL if there are no more rows. oop style
		while($extractedlog = $result->mysqli_fetch_assoc()){
			echo $extractedlog['sender'] . ":   " . $extractedlog['log'] . "<br />";
		}
	}


?>