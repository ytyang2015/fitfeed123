

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



</head>
<body>


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
  <img class="w3-image" src="/source/healthy-food-wallpaper-full-hd.jpg" alt="Hamburger Catering" width="1600" height="100">
 


	


<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green"  style="text-align:center"><br></br>Wiki Page</a></p>
</footer>
</body>
</html>