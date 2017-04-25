<?php
	//not updating. So it should be _get?
	$initiator = $_GET['initiator'];
    $responder = $_GET['responder'];
    $url = $_GET['URL'];

	$user_name="fitfeed123_fitfeed";
	$dbpassword="fitfeed123";
	$database_name="fitfeed123_FITFEED";
	$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);

	if (mysqli_connect_error()){
		die("Database Connection Failed" . mysqli_connect_error());
	}
	//relation chat_requests(initiator, responder, url, status, viewed)---add time?
	$status = "pending";
	$viewed = "no";
	$requeststring = "INSERT INTO chat_requests(initiator, responder, url, status, viewed) values ('$initiator','$responder', '$url', '$status', '$viewed')";
	$query = mysql_query($conn, $requeststring);
	if (!$query)
       echo "ERROR: " . mysqli_error($connection);
?>