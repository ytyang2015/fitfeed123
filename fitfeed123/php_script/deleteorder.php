<?php 
   $orderID = $_GET["ID"];
   $status = $_GET['Status'];

  $server_name="engr-cpanel-mysql.engr.illinois.edu";
  $user_name="fitfeed123_fitfeed";
  $dbpassword="fitfeed123";
  $database_name="fitfeed123_FITFEED";
  $conn = mysqli_connect($server_name, $user_name, $dbpassword, $database_name);

  if(!$conn){
    die("Database Connection Failed". mysqli_connect_error());
  }
	
  if ($status != "complete") {
    $query = "DELETE FROM orders where orderID = '$orderID'";
    $bool = mysqli_query($conn, $query);
    if (!$bool)
       echo "ERROR: " . mysqli_error($conn);
  }
  else {
    $query = "UPDATE theorders SET status = '$status' where orderID = '$orderID'";
    $result = mysqli_query($connection, $queryStr);
    if (!$result)
       echo "ERROR: " . mysqli_error($connection);
  
     $_GET['Status'] = "";
  }
?>