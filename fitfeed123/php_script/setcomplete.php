<?php
    $item = $_GET['Item'];
    $Status = $_GET['Status'];
    $user = $_GET['User'];
    

  $user_name="fitfeed123_fitfeed";
  $dbpassword="fitfeed123";
  $database_name="fitfeed123_FITFEED";
  $conn = mysqli_connect($server_name, $user_name, $dbpassword, $database_name);

  if(!$conn){
    die("Database Connection Failed". mysqli_connect_error());
  }

    if($Status != 'complete'){
		$querystring = "UPDATE theorder SET status='complete' WHERE seller = '$user' and item  = '$item'";
    	$query = mysqli_query($conn, $querystring);
    	if(!$query)
    		echo "ERROR: " . mysqli_error($conn);
    		
    	$querystring2 = "DELETE * FROM theorder where seller='$user' and item = '$item'";
    	$query2 = mysqli_query($conn, $querystring2);
    	if(!$query2) {
    		echo "ERROR: " . mysqli_error($conn);
        }
    $_GET['Status'] = "";
    }
?>