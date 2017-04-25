<?php
    $item = $_SESSION['Item'];
    $buyer = $_SESSION['Buyer'];
    $seller = $_SESSION['Seller'];
    $status = "incomplete";

	
	$user_name="fitfeed123_fitfeed";
    $user_name="fitfeed123_fitfeed";
    $dbpassword="fitfeed123";
    $database_name="fitfeed123_FITFEED";
    $conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);

    if (mysqli_connect_error()){
        die("Database Connection Failed" . mysqli_connect_error());
    }

   
    $queryString = "INSERT INTO theorder (buyer, seller, item, status) values ('$buyer', '$seller', '$item', '$status')";
    $query = mysqli_query($conn, $queryString);
    if (!$query)
       echo "ERROR: " . mysqli_error($conn);
       echo "order success";


?>
