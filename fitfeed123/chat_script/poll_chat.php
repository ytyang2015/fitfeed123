<?php 
    $user = $_GET['User'];

	$user_name="fitfeed123_fitfeed";
    $user_name="fitfeed123_fitfeed";
    $dbpassword="fitfeed123";
    $database_name="fitfeed123_FITFEED";
    $conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);

    if (mysqli_connect_error()){
        die("Database Connection Failed" . mysqli_connect_error());
    }

    $status = "pending";
    $viewed = "no";
    $querystring = "SELECT * FROM chat_requests where responder = '$user' and status = '$status' and viewed = '$viewed'";

    $query = mysqli_query($conn, $querystring);
    if (!$query)
        echo "ERROR: " . mysqli_error($conn);

    $get_rows= $query->num_rows; //mysqli_affected_rows($conn);
    if ($get_rows > 0){
        echo "You have a message! ";//////////////
        $viewed = "yes";
        $setviewed = "UPDATE chat_requests SET viewed ='$viewed' where responder = '$user' and status ='$status'";
        $query = mysqli_query($conn, $setviewed);
    }

?>

