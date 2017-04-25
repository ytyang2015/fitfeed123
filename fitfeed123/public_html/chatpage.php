<?php 
   session_start();
   //require_once("./settings.php");
if (isset($_POST['search'])){
     $_SESSION['queryString'] = $_POST['search'];
     //echo $_SESSION['queryString'];
     header('Location: results.php');
     exit();
}
   $buyer = $_GET['user1'];
   $seller = $_GET['user2'];
   $curUser = $_SESSION['name'];
   /*
   echo "buyer: " . $buyer;
   echo "seller: " . $seller;
   echo "User: " . $curUser;
   */
   
   if ($curUser != $buyer && $curUser != $seller){
   	  ?> 
   	     <script>history.go(-1);</script>
   	   <?php
   }
   if ($curUser == $buyer)
   	 $id = $seller;
   	else
   	 $id = $buyer;
  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
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
				/*
				$("#loginbutton").click(function(){
					sessionStorage.User = $('#username').val();
				});
*/              
                var User = "<?php echo $_SESSION['name']; ?>";
                var other = "<?php echo $id; ?>";
				if (!User){
					var content1 = "<ul><li id=\"login_link\"><a href=\"login.php\">Login</a></li>";
					    content1 += " | ";
						content1 += "<li id=\"register_link\"><a href=\"register.php\">Register</a></li></ul>";
					$(".login-section").html(content1);
				}
				else {
					var content2 = "<ul><li id=\"logout_link\">";
						content2 += "<form action=\"logout.php\" method=\"post\">";
						content2 += "<input type=\"submit\" name=\"submit\" value=\"Sign Out\" id=\"logoutbutton\" />";
						content2　+= " | ";
						content2 += "<a href=\"user.php\">My Homepage</a>";
						content2 += "</form></li></ul>";
					$(".login-section").html(content2);
				}
					$.ajaxSetup({cache: false});
					  //  var lastMsg = "";
						setInterval(function(){
							getMessages(User, other);
						}, 3000);
 	            // handle the chat
				$inputArea = $('#inputMessage');
				$displayArea = $('#display');
				$inputArea.keypress(function(key){
			         if (key.which === 13) {
			         	key.preventDefault();
			         	var msg = getMsg();
			         	if (!msg) return;
			         	clearMsg();
			 
                       // sendAJAX(User, msg);
                       /*
                        var xmlhttp = new XMLHttpRequest();
            			xmlhttp.onreadystatechange = function(){
	            		if (xmlhttp.readyState==4 && xmlhttp.status==200){
	            			alert("2");
	            			
	            		//	var newMsg = document.createTextNode(xmlhttp.responseText);
	            		//	var newP = document.createElement('p');
	            		//	newP.appendChild(newMsg);
	            			
	            			alert(xmlhttp.responseText);
	            			var content = "<p>" + xmlhttp.responseText + "</p><br />";
	            			document.getElementById('display').appendChild(content);
	            		}
	            		xmlhttp.open('GET', 'insert.php?uname='+User+'msg='+msg, true);
	            		xmlhttp.send();
				       }
						*/
						$.ajax({
							  url: "chat_script/insert.php",
							  type: "get", 
							  data:{uname:User, receiver: other, msg: msg},
							  success: function(response) {
							    var content = "<p>" + response + "</p>";
	            				$displayArea.append(content);
							  },
							  error: function(xhr) {
							    console.log("AJAX failed");
							  }
							});
				   }
				});
						
			});
			function getMsg(){
				return document.getElementById('inputMessage').value;
			}
			function clearMsg(){
				document.getElementById('inputMessage').value = "";
			}
            function getMessages(self,other){
				$.ajax({
					  url: "chat_scrpit/logs.php",
					  type: "get", 
					  data:{participant1: self, participant2: other},
					  success: function(response) {
					  	//console.log("Return text:  " + response);
					    $displayArea.html(response);	 
						scrollDown();
					  },
					  error: function(xhr) {
					    console.log("something weird happened");
					  }
					});
            }
            function scrollDown() {
			    var display = document.getElementById('display');
		     	display.scrollTop = display.scrollHeight ;
            }
		</script>
	<!-- start-smoth-scrolling -->

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
	
				</div>
				<!-- start search-->
				    <div class="search-box">
					    <div id="sb-search" class="sb-search">
							<form action="chat.php" method="post">
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
<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href='#contact' class="w3-bar-item w3-button">Contact</a>
      <a id="logging" ></a>
      <a id="register"></a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  
  <div class="w3-display-bottomleft w3-padding-xlarge w3-light-grey w3-opacity">
    <h1 class="w3-xxlarge">Fit Feed</h1>
  </div>
</header>

	<div id="display">

	</div>

	
	<div class="inputArea" align="center">
		<div id="heading">
		
	</div>
	<textarea id="inputMessage" placeholder="Enter your message here" maxlength="140"></textarea>
	
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green"><br></br>Wiki Page</a></p>
</footer>
</body>
</html>