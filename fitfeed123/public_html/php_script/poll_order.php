<?php 
   $user = $_GET['User'];

  $user_name="fitfeed123_fitfeed";
  $dbpassword="fitfeed123";
  $database_name="fitfeed123_FITFEED";
  $conn = mysqli_connect($server_name, $user_name, $dbpassword, $database_name);

  if(!$conn){
    die("Database Connection Failed". mysqli_connect_error());
  }
    $seen = "unseen";
    $status = "incomplete";
    $queryStr = "SELECT * FROM theorder Where seller = '$user' AND status = '$status' AND seen = '$seen'";
    $query = mysqli_query($conn, $queryStr);
    
    if (!$query)
     echo "ERROR: " . mysqli_error($conn);
     
    $get_rows= mysqli_affected_rows($conn);
    if ($get_rows > 0){
        $seen = "seen";
//        echo $seen;
        echo "alert";
        $queryStr = "UPDATE theorder SET seen= '$seen' WHERE seller = '$user' AND status='$status'";
        $query = mysqli_query($conn, $queryStr);
    }
?>