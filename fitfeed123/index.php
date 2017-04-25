<?php 
    session_start();
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
      <a id="logging" ></a>
      <a id="register"></a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:50000px;min-width:500px" id="home">
  <?php include 'test.php';?>

</header>



<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="https://www.ipha.com/content/uploads/contributor/food2.jpg" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="750">
    </div>

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">About Fitfeed</h1><br>
      <h5 class="w3-center">A Healthy Food Recommendation Platform </h5>
      <p class="w3-large w3-text-grey w3-hide-medium" >Our platform recommends healthy food choices based on calories and nutrition facts. It also serves as a buy/sell platform of homemade healthy food at lower prices(no intermediate costs), in which users can search for food, order food, sell food and receive recommendation of the intake calories per day as well as fitness facts at one place. </p>
    </div>
  </div>
  
  <hr>
  
  <!-- Menu Section -->
  <div class="w3-row w3-padding-64" id="menu">
    <div class="w3-col l6 w3-padding-large">
      <h1>Restaurant Menu</h1><br>
      <h4>Original Pancake House</h4>
      <p class="w3-text-grey">Weight Watchers Barbacoa Beef</p><br>
    
      <h4>Caribbean Grill Food Truck</h4>
      <p class="w3-text-grey">Southern Chicken and Corn Chowder</p><br>
    
      <h4>Miga</h4>
      <p class="w3-text-grey">Slow Cooker Busy Day Stew</p><br>
    
   
    </div>
    
    <div class="w3-col l6 w3-padding-large">
      <img src="https://media-cdn.tripadvisor.com/media/photo-s/03/4c/ab/dd/natures-health-food-cafe.jpg" class="w3-round w3-image w3-opacity-min" alt="Menu" width="500" height="750">
    </div>
  </div>

  <hr>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-64" id="contact">
    <h1>Contact</h1><br>
    <p>This is a web application for food recommendation and odering</p>
    <p class="w3-text-blue-grey w3-large"><b>University of Illinois at Urbana-Champaign, Champaign, IL</b></p>
    <p>You can also contact us by phone 555-273-2545 or email fitfeed123@fitfeed.com, or you can send us a message here:</p>
    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-padding-16" type="number" placeholder="How many people" required name="People"></p>
      <p><input class="w3-input w3-padding-16" type="datetime-local" placeholder="Date and time" required name="date" value="2017-11-16T20:00"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Message \ Special requirements" required name="Message"></p>
      <p><button class="w3-button w3-light-grey w3-section" type="submit">SEND MESSAGE</button></p>
    </form>
  </div>
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green"><br></br>Wiki Page</a></p>
</footer>

</body>
</html>