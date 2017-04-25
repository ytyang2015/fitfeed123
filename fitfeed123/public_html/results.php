<?php 
   session_start();

   /*if (!$_SESSION['queryString'])
   		header('Location: user.php');
  */

  	if (empty($_POST['searchfood']) && empty($_SESSION['searchfood'])){
   		?>
   		<script>
   	    alert("This page cannot be refreshed. Please start a new search.");
   			history.go(-1); 
   		</script>
   	<?php
   	} 

   	

      $server_name="localhost";
      $user_name="fitfeed123_fitfeed";
      $dbpassword="fitfeed123";
      $database_name="fitfeed123_FITFEED";
      $conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
      if (mysqli_connect_error()){
         die("Database Connection Failed" . mysqli_connect_error());
      }

      $items = array();
       $_SESSION['user_name']=array();

      $queryString = $_SESSION['searchfood'];
     $obj = mysqli_query($conn, "SELECT * FROM Product where product_name like '%$queryString%'");

      while($row = mysqli_fetch_assoc($obj)) {
       $search_item['product_name']=$row['product_name'];
       $search_item['calories']=$row['calories'];
       $search_item['price']=$row['price'];
       $search_item['user_name']=$row['user_name'];
        $search_item['button'] = '<h3 <div align="center"><input type="submit" name="test" id="test" value="placeorder"/><br/>';

       $_SESSION['product_name']=$row['product_name'];
       $_SESSION['calories']=$row['calories'];
       $_SESSION['price']=$row['price'];
        $_SESSION['counter'] = 0;
        array_push($items, $search_item);
        array_push($_SESSION['user_name'], $row['user_name']);
      }
          


function placeorder1()
{
        
        $item = $_SESSION['product_name'];
        $buyer = $_SESSION['buyer'];
        $seller = $_SESSION['user_name'][0];
        $status = "incomplete";
        $seen = "unseen";
        
    	$user_name="fitfeed123_fitfeed";
        $user_name="fitfeed123_fitfeed";
        $dbpassword="fitfeed123";
        $database_name="fitfeed123_FITFEED";
        $conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
        
        if (mysqli_connect_error()){
            die("Database Connection Failed" . mysqli_connect_error());
        }
/*update restaurant info and userinfo*/ 

        $productquery = mysqli_query($conn, "SELECT * FROM Product WHERE product_name='$item' AND user_name = '$seller'");
        if(!$productquery)
    		echo "ERROR: " . mysqli_error($conn);
    	$get_rows= mysqli_fetch_assoc($productquery);
    	$sweetness = $get_rows['sweet'];
    	$spicyness = $get_rows['spicy'];
    	$sourness = $get_rows['sour'];
    	$saltyness = $get_rows['salty'];
    	echo "<script>console.log( " . $sweetness . " );</script>";
        echo "<script>console.log( " . $sourness . " );</script>";
        echo "<script>console.log( " . $saltyness . " );</script>";
        echo "<script>console.log( " . $spicyness . " );</script>";

        $buyer = $_SESSION['buyer'];
//        echo "<script>console.log( " . $buyer . " );</script>";
        $userquery = mysqli_query($conn, "SELECT * FROM user_info WHERE username = '$buyer'");
        if (!userquery) 
    		echo "ERROR: " . mysqli_error($conn);
    	$userrows= mysqli_fetch_assoc($userquery);
        $user_sweetness = $userrows['sweet'];
        $user_spicyness = $userrows['hot'];
        $user_saltyness = $userrows['salty'];
        $user_sourness = $userrows['sour'];

        $user_sweetness = $user_sweetness + $sweetness;
        $user_spicyness = $user_spicyness + $spicyness;
        $user_saltyness = $user_saltyness + $saltyness;
        $user_sourness = $user_sourness + $sourness;
        echo "<script>console.log( " . $user_sweetness . " );</script>";
        echo "<script>console.log( " . $user_sourness . " );</script>";
        echo "<script>console.log( " . $user_saltyness . " );</script>";
        echo "<script>console.log( " . $user_spicyness . " );</script>";

        
        $updateuser = $conn->query("UPDATE user_info SET user_info.sweet={$user_sweetness}, user_info.sour='$user_sourness', user_info.hot={$user_spicyness}, user_info.salty={$user_saltyness}");

        $qstr2 = "UPDATE";
        $updatequery = mysqli_query($conn);        
////////////////////////////////////////////        
        $insert = $conn->query("INSERT INTO theorder (buyer, seller, item, status, seen) VALUES ('$buyer', '$seller', '$item', '$status', '$seen')");
 //       if (!$query)
  //          echo "ERROR: " . mysqli_error($conn);

}
      if(array_key_exists('forchat1',$_POST)){
          $_SESSION['chat_restaurant']= $_SESSION['user_name'][0];
          header("refresh:1;url=NewChatTest.php");
      }

      if(array_key_exists('forchat2',$_POST)){
          $hehe = $hehe = count($_SESSION['user_name']);
          $_SESSION['chat_restaurant']= $_SESSION['user_name'][$hehe-1];
          header("refresh:1;url=NewChatTest.php");
      }
      
if(array_key_exists('test1',$_POST)){
   placeorder1();
}


function placeorder2()
{
        $hehe = count($_SESSION['user_name']);
        $item = $_SESSION['product_name'];
        $buyer = $_SESSION['buyer'];
        $seller = $_SESSION['user_name'][$hehe-1];
        $status = "incomplete";
        $seen = "unseen";
        
    	$user_name="fitfeed123_fitfeed";
        $user_name="fitfeed123_fitfeed";
        $dbpassword="fitfeed123";
        $database_name="fitfeed123_FITFEED";
        $conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
        
        if (mysqli_connect_error()){
            die("Database Connection Failed" . mysqli_connect_error());
        }
        
        $insert = $conn->query("INSERT INTO theorder (buyer, seller, item, status, seen) VALUES ('$buyer', '$seller', '$item', '$status', '$seen')");
 //       if (!$query)
  //          echo "ERROR: " . mysqli_error($conn);

}

if(array_key_exists('test2',$_POST)){
   placeorder2();
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Fit Feed</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <style>
        body {font-family: "Times New Roman", Georgia, Serif;}
        h1,h2,h3,h4,h5,h6 {
            font-family: "Playfair Display";
            letter-spacing: 5px;
        }
    </style>
    <script src="JQuery/jquery-3.1.1.min.js">
    </script>
    <script type="text/javascript">
        console.log(document.domain);
    	$(document).ready(function($){
	    var User = "<?php echo $_SESSION['name'];?>";
	    if (!User){
	        var content1 = "<a class=\"w3-bar-item w3-button\" href=\"LogIn.php\">LogIn</a>";
	        var content2 = "<a class=\"w3-bar-item w3-button w3-margin-right\" href=\"register.php\">Register</a>";
	        $("#logging").html(content1);
	        $("#register").html(content2);
	    }else{
	        var content1 = "<a class=\"w3-bar-item w3-button\" href=\"LogIn.php\">LogIn</a>";
	        var content2 = "<a class=\"w3-bar-item w3-button w3-margin-right\" href=\"register.php\">Logout</a>";
	        $("#logging").html(content1);
	        $("#register").html(content2);
	    }
	});
     </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
</head>

<body>
    <!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href='#contact' class="w3-bar-item w3-button">Contact</a>
      <a href="welcomeC.php" class="w3-bar-item w3-button">Search</a>
    </div>
  </div>
</div>


     
        <br>
        <br>
        <br>
        <br>
     
        <h2 style="background-color:#E6E6FA; text-align:center;">Here are the results we provide for you</h2>
        <br>
         <h3 style="color:#778899; text-align:center;">
         
         
         <?php 
            $counter = $_SESSION['counter'];
            if ($counter <= count($items)) {
         echo("---------------------------");
         echo('<br>');
            echo("product:"); 
            echo($items[$counter]['product_name']);
            echo '<br>';  
            echo("  calories:");
            echo($items[$counter]['calories']);
            echo '<br>';  
            echo("  price:");
            echo($items[$counter]['price']);
            echo '<br>';  
            echo("  sold by:");
            echo($items[$counter]['user_name']);
            echo('<br>');
           // echo "<input type='submit' name='test' id='test' value='placeorder'>";
            }
            $counter = $counter + 1;
            $_SESSION['counter'] = $counter;
      ?>
      
      </h3>
	   <form method="post">
   <h3 <div align="center"><input type="submit" name="test1" id="test1" value="placeorder"/><br/>
   <input type="submit" name="forchat1" id="forchat1" value="chat"></div> </h3>
</form>
<h3 style="color:#778899; text-align:center;">
         <?php 
            echo("---------------------------");
            echo('<br>');
            ?>

         <?php 
            $index = count($items);
            if ($counter < count($items)) {
         echo("---------------------------");
         echo('<br>');
            echo("product:"); 
            echo($items[$index-1]['product_name']);
            echo '<br>';  
            echo("  calories:");
            echo($items[$index-1]['calories']);
            echo '<br>';  
            echo("  price:");
            echo($items[$index-1]['price']);
            echo '<br>';  
            echo("  sold by:");
            echo($items[$index-1]['user_name']);
            echo('<br>');
           // echo "<input type='submit' name='test' id='test' value='placeorder'>";
            }
      ?>
	   <form method="post">
   <h3 <div align="center"><input type="submit" name="test2" id="test2" value="placeorder"/><br/>
   <input type="submit" name="forchat2" id="forchat2" value="chat"></div> </h3>
</form>

         <?php 
            echo("---------------------------");
            echo('<br>');
            ?>
  <?php
   if($_POST["test"]=="placeorder"){echo "order success";}
?>
</h3>



</body>
</html>