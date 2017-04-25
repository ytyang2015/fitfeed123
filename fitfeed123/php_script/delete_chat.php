<?php 
    $user = $_GET['User'];
    //$server_name="engr-cpanel-mysql.engr.illinois.edu";
	$user_name="fitfeed123_fitfeed";
	$dbpassword="fitfeed123";
	$database_name="fitfeed123_FITFEED";
	$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);

	if (mysqli_connect_error()){
		die("Database Connection Failed" . mysqli_connect_error());
	}
    // 0 for request hasn't been answered, 1 for the contrary
    //$queryStr = "DELETE FROM ChatRequests where responder = '$user'"; // or initiator = '$user' ";
    $status = "completed";
    $querystring = "UPDATE chat_requests SET status = '$status' where responder='$user'";
    $query = mysqli_query($conn, $querystring);
    //echo "success";
?>