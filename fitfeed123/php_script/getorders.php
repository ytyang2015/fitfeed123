<?php 
  $user = $_GET['seller'];

  $user_name="fitfeed123_fitfeed";
  $dbpassword="fitfeed123";
  $database_name="fitfeed123_FITFEED";
  $conn = mysqli_connect($server_name, $user_name, $dbpassword, $database_name);

  if(!$conn){
    die("Database Connection Failed". mysqli_connect_error());
  }

    $queryString = "SELECT * FROM theorder WHERE seller='$user'";
    $query = mysqli_query($conn, $queryString);
    $get_rows= mysqli_affected_rows($conn);
    if (!$query)
       echo "ERROR: " . mysqli_error($conn);
    else {
      $orders = '<p>Only click on "CONFIRM" after the transaction has been completed.</p><br />';
      $orders .= "<h4>Orders I've received: </h4>";
  if ($get_rows != 0){
    while($row = mysqli_fetch_assoc($query)){
        $content = "<b>" . $row['buyer'] . "</b>" . " placed an order on your item: " . '<b>' . $row['item'] . '<br />';
        $content .= "Order status: " . $row['status'] .  '<br /><br />';
        $it = $row['item'];
        //echo $item;
        $seller = $row['seller'];
        $status = $row['status'];
        $query2 = mysqli_query($conn, "SELECT * FROM Product WHERE user_name = '$seller' AND product_name = '$it'");
        $row1 = mysqli_fetch_assoc($query2);
        $productname = $row1['product_name'];
        echo $product_name;

        if ($status != "complete")
            $content .= '<div align="center"><button onclick="transaction_complete(\''.$productname .'\',\''.$seller.'\')">CONFIRM</button></div><br /><br />';
        $orders .= $content;

      }
    }
    else 
      $orders .= "<p>You have no pending orders at this time.</p>";
  
    echo $orders;
   }
    
?>