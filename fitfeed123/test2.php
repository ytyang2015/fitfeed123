<?php 
   session_start();
   if (!$_SESSION['name'])
   		header('Location: index.php');

if (isset($_POST['search'])){
     $_SESSION['queryString'] = $_POST['search'];
     //echo $_SESSION['queryString'];
     header('Location: results.php');
     exit();
}
if (isset($_POST['submit'])){
    $server_name="engr-cpanel-mysql.engr.illinois.edu";
	$user_name="eatiteat_Ray";
	$dbpassword="l!Jkaqc2)Z%J";
	$database_name="eatiteat_User";
	$connection = mysqli_connect($server_name,$user_name, $dbpassword);
	$errors = array();
	if (!$connection){
	    die("Database Connection Failed" . mysqli_connect_error());
	}
	$select_db = mysqli_select_db($connection,$database_name);
	if (!$select_db){
	    die("Database Selection Failed" . mysql_error());
	}
    if (!empty($_POST['itemname']) && ($_POST['category']!=="empty") && ($_POST['taste']!=="empty") && !empty($_POST['time'])
      			&& !empty($_POST['nutri-info'])  && !empty($_POST['price']))
    {
        $username = $_SESSION['name'];
        $itemname = mysqli_real_escape_string($connection, $_POST['itemname']);
		$type = $_POST['category'];
		$taste = $_POST['taste'];
        $time = mysqli_real_escape_string($connection, $_POST['time']);
        $nutrition = $_POST['nutri-info'];
       // $calories = preg_match_all('!\d+!', $nutrition, $matches);
       // $calories = $calories[0];
		$price = mysqli_real_escape_string($connection, $_POST['price']);
        $file = $_FILES['image-upload']['tmp_name'];
			$mysql_get_users = mysqli_query($connection, "SELECT * FROM Product where Username='$username' AND item_name='$itemname'");
			$get_rows = mysqli_affected_rows($connection);
			if($get_rows >=1){
				array_push($errors, "You already have an item that named ". "$itemname");
			}
	
            if (!is_numeric($time) || $time < 0)
            	array_push($errors,"Please enter a valid number for preparation time");
            if (!is_numeric($price) || $price < 0)
            	array_push($errors, "Please enter a valid price");
  
            if (!isset($file))
                array_push($errors, "Please upload an image of your item");
            $image = addslashes(file_get_contents($file));
            $image_size = getimagesize($file);
              
            // check to make sure it's an image, not a file of other types like text document
            if (!$image_size)
            	array_push($errors, "Please upload a valid image of your item");
       
		switch($nutrition){
			case "<200":
			   $calories = 1;
			   break;
			case "200 - 399":
			   $calories = 2;
			   break;
			case "400 - 599":
			   $calories = 3;
			   break;
			case "600 - 799":
			   $calories = 4;
			   break;
			case "800 - 999":
			   $calories = 5;
			   break;
			case ">1000":
			   $calories = 6;
			   break;         
			default:
			    $calories = 10;   
		}
            if (empty($errors)) {
	            $query = "INSERT INTO Product (Username, item_name, Type, Ready_time, Nutrition, image, Price, Taste) 
	 			VALUES ('$username', '$itemname', '$type', '$time', '$calories', '$image', '$price', '$taste')";
		        $result = mysqli_query($connection,$query);
		        if(!$result){
		        	die("Database error." );
		        }
		        $_POST['itemname'] = "";
            }
 			
    }
    else 
    	array_push($errors, "All fields are required");
}
   function display_errors($errors=array()){
   $output = "";
   if (!empty($errors)){ 
     foreach ($errors as $error){
    	$output .= "$error <br />";
     }
   }
   return $output;
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<!--fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	
	<!--//fonts-->
			<link href="css/bootstrap.css" rel="stylesheet">
			
	<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Eatit - food sharing platform for Champaign, Illinois">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->	
	<!-- js -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
	<!-- js -->
	<!-- cart -->
		<script src="js/simpleCart.min.js"> </script>
	<!-- cart -->
	<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
 		
				//$("#Name").text(sessionStorage.User);
                var add_form = $('#item-form');
                var display_form = $('#display-form');
                var outer = $('.registration-form');
                var items = $('#all-items');
                var display_chat = $('#display-chats');
                var chats = $('#all-chats');
                var display_order = $('#display-orders');
                var orders = $('#all-orders');
                var user = "<?php echo $_SESSION['name']; ?>";
               // var chatCount = 0;
                setInterval(function(){
                	poll_chat(user);
                }, 4000);
                setInterval(function(){
                	poll_order(user);
                }, 5000);
          
				$("#logout_link").click(function(){
					sessionStorage.clear();
				});
				$('#add-item-button').click(function(){
					display_form.hide();
					display_order.hide();
					display_chat.hide();
					add_form.toggle(300);
				});
				$('#show-item-button').click(function(){
                    add_form.hide();
                    display_order.hide();
                    display_chat.hide();
                    $.post('php-scripts/getitems.php', {name: user}, function(data){
                        items.html(data);
                        display_form.fadeIn(100);
                    });
				});
				$("#order-button").click(function(){
					add_form.hide();
					display_form.hide();
					display_chat.hide();
					$.ajax({
						url: "php-scripts/get-orders.php",
						type: "GET",
						data:{User: user},
						  success: function(response) {
							orders.html(response); // append() ?
							display_order.fadeIn(200);
						},
						  error: function(xhr) {
						    console.log("Failed to retrieve orders.");
						  }
						});
				});
				$('#chat-button').click(function(){
					add_form.hide();
					display_form.hide();
					display_order.hide();
					$.ajax({
						url: "php-scripts/get-requests.php",
						type: "get", 
						data:{User: user},
						  success: function(response) {
							chats.html(response);
							display_chat.fadeIn(100);
						},
						  error: function(xhr) {
						    console.log("Failed to retrieve chat request.");
						  }
						});
				});
			});
			 function poll_chat(user){
 		   	   		$.ajax({
						url: "php-scripts/poll-chat.php",
						type: "get", 
						data:{User: user}, //, Count, chatCount},
						  success: function(response) {
						  	console.log(response);
						  	if (response == "alert")	
						  		alert("You've received a new chat request. Please go to MY CHATS to respond.");
						  	//	chatCount = Number(response);
						},
					});
				//	return chatCount;
 		   }
 		   function poll_order(user){
 		   	   		$.ajax({
						url: "php-scripts/poll-orders.php",
						type: "get", 
						data:{User: user}, //, Count, chatCount},
						  success: function(response) {
						  	console.log(response);
						  	if (response == "alert")	
						  		alert("You've received a new order. \nPlease go to MY ORDERS to view the details.");
						  	//	chatCount = Number(response);
						},
					});
				//	return chatCount;
 		   }
           function delete_item(item){
           	   var target = item;
           	   var ans = confirm("Are you sure you want to delete this item?");
           	   if (!ans) return;
               $.ajax({
                   url: 'php-scripts/delete-item.php',
                   data: {item_name: target},
                   type: 'POST',
                   success: function(){
                   	   alert('Item deleted.');
                   	   location.reload();
                   }
               });
           }
           function transaction_complete(orderID){
           	 //var res = confirm("");
           	 $.ajax({
                   url: 'php-scripts/delete-order.php',
                   data: {ID: orderID, Status: "complete"},
                   type: 'GET',
                   success: function(){
                   	   alert("Transaction complete.");
                   	   location.reload();
                   }
               });
           }
           function deletePlacedOrder(orderID){
           	 var res = confirm("Are you sure you want to cancel this order?");
           	 if (!res) return;
	           	 $.ajax({
	                   url: 'delete-order.php',
	                   data: {ID: orderID, Status: ""},
	                   type: 'GET',
	                   success: function(){
	                   	   alert("Success. The order has been cancelled.");
	                   	   location.reload();
	                   }
	               });
           }
           function accept_chat(url){
           	    // first delete the request (mark the request as accepted)
           	    var user = "<?php echo $_SESSION['name']; ?>";
            	$.ajax({
                   url: 'php-scripts/delete-chat.php',
                   data: {User: user},
                   type: 'GET',
                   success: function(){
                   	     	// upon success, redirect user to chat interface
           	 				window.location = url;
                   }
               });
           }
           function view_chat(url){
           	   console.log(url);
           	   if (url)
           	   		window.location = url;
           }
		</script>
</head>
<body>
<!-- header -->
<div class="header">
	<div class="container">
		<div class="top-header">
				<div class="header-left">
					<!--<p>Place your order and get 20% off on each price</p>-->
				</div>
				<div class="login-section">
					<ul>
						<li id="logout_link">
						<form action="logout.php" method="post">
							<input type="submit" name="submit" value="Sign Out" id="logoutbutton"/> |
							<a href="myprofile.php">My Profile</a>
						</form>
						</li>
					</ul>
				</div>
				<!-- start search-->
				    <div class="search-box">
						<div id="sb-search" class="sb-search">
							<form action="user.php" method="post">
								<input class="sb-search-input" placeholder="Enter your search item..." type="search" name="search" id="search">
								<input class="sb-search-submit" type="submit" value="">
								<span class="sb-icon-search"> </span>
							</form>
						</div>
				    </div>
					<!-- search-scripts -->
					<script src="js/classie.js"></script>
					<script src="js/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>
				<!-- //search-scripts -->
				<div class="header-right">
					<!--
						<div class="cart box_1">
							<a href="checkout.html">
								<h3> <span class="simpleCart_total"> $0.00 </span> (<span id="simpleCart_quantity" class="simpleCart_quantity"> 0 </span> items)<img src="images/bag.png" alt=""></h3>
							</a>	
							<p><a href="javascript:;" class="simpleCart_empty">Empty cart</a></p>
							<div class="clearfix"> </div>
						</div>
					-->
				</div>
				<div class="clearfix"></div>
		</div>
	</div>
</div>

<!-- //header -->
<!-- banner -->
<div class="banner-slider">
	<div class="banner-pos">
					<div class="banner one page-head">
						<div class="container">
							<div class="navigation text-center">
								<span class="menu"><img src="images/menu.png" alt=""/></span>
									<ul class="nav1">
										<li><a href="index.php">HOME</a></li>
										<li><a href="#">ABOUT</a></li>
										<li><a href="#">MENU</a></li>
										<li><a href="#">GALLERY</a></li>
										<li><a href="#">TODAY'S SPECIAL</a>
										<li><a href="#">CONTACT</a></li>
										<div class="clearfix"></div>
									</ul>
									<!-- script for menu -->
										<script> 
											$( "span.menu" ).click(function() {
											$( "ul.nav1" ).slideToggle( 300, function() {
											 // Animation complete.
											});
											});
										</script>
									<!-- //script for menu -->

							</div>
							<!-- point burst circle -->
							<div class="logo">
								<a href="index.php">
									<div class="burst-36 ">
									   <div>
											<div><span><img src="images/logo.png" alt=""/></span></div>
									   </div>
									</div>
									<div align="center">
									<h1>EATIT</h1>
								</div>
								</a>
							</div>
							<!-- //point burst circle -->
							
						</div>
					</div>
	</div>
</div>
<!-- //banner -->
<!-- registration-form -->

<div class="registration-form">
	<div class="container">
		    <h3>Welcome, 
		    	<!--<span id="Name"></span>-->
		    	<?php echo $_SESSION['name']; ?>
		    </h3><br /><br />
      
      <div id="buttons" align="center">
     		<a class="hvr-shutter-in-horizontal button" id="add-item-button">ADD NEW ITEM</a>
     		<a class="hvr-shutter-in-horizontal button" id="show-item-button" name="show-item" style="margin-left:1%">MY ITEMS</a>
     		<a class="hvr-shutter-in-horizontal button" id="order-button" style="margin-left:1%">MY ORDERS</a>
     		<a class="hvr-shutter-in-horizontal button" id="chat-button" style="margin-left:1%">MY CHATS</a>
  		</div>
		
		<div id="item-form">
			<div class="reg-form" style="width:50%">
				<div class="reg">
					 <p>Please enter the following information for the new item you plan to sell.</p>
					 <o>Having added the item successfully, the item will show up upon clicking the "MY ITEMS" button above.</p>
					 <form action="user.php" method="post" enctype="multipart/form-data">
						 <ul>
							 <li class="text-info">Name: </li>
							 <li><input type="text" id="username "name="itemname" placeholder="name of the item"></li>
						 </ul>
						<ul>
							 <li class="text-info">Category: </li>
							 <select class="sel-dropdown" name="category">
							  <option value="empty" ></option> 	
							  <option value="Dessert" >Desserts</option>
							  <option value="Snacks/Appetizers">Snacks/Appetizers</option>
							  <option value="Entrees">Entrees</option>
							  <option value="Salads">Salads</option>
							  <option value="Burgers/Sandwiches">Burgers/Sandwiches</option>
							  <option value="Drinks">Drinks</option>
							  <option value="Other">Other</option>
							</select>
						</ul>
						<ul>
							 <li class="text-info">Taste: </li>
							 <select class="sel-dropdown" name="taste">
							  <option value="empty" ></option> 	
							  <option value="Sweet">Sweet</option>
							  <option value="Sweet/Sour">Sweet/Sour</option>
							  <option value="Salty">Salty</option>
							  <option value="Spicy">Spicy</option>
							  <option value="Bitter">Bitter</option>
							  <option value="Other">Other</option>
							</select>
						</ul>
						<ul>
							 <li class="text-info">Preparation Time: </li>
							 <li><input type="text" id="email "name="time" placeholder="can be made in _____ minutes?"></li>
						 </ul>
						 <ul>
							 <li class="text-info">Nutrition info: </li>
							<!-- <li><input type="text" id="email "name="nutri-info" placeholder="approximate calories per serving"></li> -->
							 <select class="sel-dropdown" name="nutri-info">
							  <option value="empty"></option> 	
							  <option value="<200">&lt;200 cal</option>
							  <option value="200 - 399">200 - 399 cal</option>
							  <option value="400 - 599">400 - 599 cal</option>
							  <option value="600 - 799">600 - 799 cal</option>
							  <option value="800 - 999">800 - 999 cal</option>
							  <option value=">1000">&gt; 1000 cal</option>
							</select>
						
						 </ul>
						  <ul>
							 <li class="text-info">Price: </li>
							 <li><input type="text" id="email "name="price" placeholder="without the dollar sign"></li>
						 </ul>
								
								<ul>
									<li class="text-info">Upload an Image of the Item: </li>
									<li><input type="file" id="image-upload" name="image-upload" ></li>
								</ul>
						 <p id="signup_error">
						 	<?php echo display_errors($errors); 
                            
                             if (sizeof($errors) > 0){
                                ?><script>alert("Error(s) detected in your input. \nPlease fill out the form again.");</script><?php 
                            }
						 	?>
						 </p>
						 <div align="center" style="margin-top:2%">
						 <input type="submit" name="submit" value="CREATE">
						</div>
						 <!--
						 <p class="click">By clicking this button, you are agree to my  <a href="#">Policy Terms and Conditions.</a></p> 
						-->
					 </form>
				 </div>
			</div>
			<div class="clearfix"></div>
		</div>
 
        <!--display items-->
        <div id="display-form">
			<div class="reg-form">
				<div class="reg" id="all-items">

        	    </div>
			</div>
			<div class="clearfix"></div>
		</div>

		<!--display orders-->
		 <div id="display-orders">
			<div class="reg-form">
				<div class="reg" id="all-orders">
						
        	    </div>
			</div>
			<div class="clearfix"></div>
		</div>

		 <!--display chats-->
		 <div id="display-chats">
			<div class="reg-form">
				<div class="reg" id="all-chats">

        	    </div>
			</div>
			<div class="clearfix"></div>
		</div>



	</div>
</div>

<!-- //footer-top -->
<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="footer-left">
			<p>Copyright &copy; 2016 Eatit</p>
		</div>
		
		<div class="footer-right">
			<ul>
			   <li>Yiwei Zhuang<li>
			   <li>Daocun Yang<li>
			   	<li>Yang Yao<li>
			   <li>Yang Song<li>		
			</ul>
		</div>
	
		<div class="clearfix"></div>
	</div>
</div>
<!-- //footer -->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->

</body>
</html>