<?php 
	session_start();
	if (empty($_SESSION["user"])){
		header("Location:index.php");
	}
	$server_name="localhost";
	$user_name="fitfeed123_fitfeed";
	$dbpassword="fitfeed123";
	$database_name="fitfeed123_FITFEED";
	$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
	if (mysqli_connect_error()){
		// <script> alert('connection fail')</script>
		die("Database Connection Failed" . mysqli_connect_error());
	}
	$food_information=array();
	$username= mysqli_real_escape_string($conn, trim($_SESSION['user']));
	$Recommand_list = $conn->query("SELECT * FROM user_food where username = '$username' order by oder");
	$Food_info = $conn->query("SELECT * FROM food INNER JOIN user_food ON user_food.foodname=food.name where user_food.username='$username' order by user_food.oder");
	while($row = $Food_info->fetch_assoc()){
	    $max_flavor = max($row['hot'],$row['sweet'],$row['salty'],$row['sour']);
	    if($max_flavor == $row['hot']){
	        $theflavor = 'hot';
	    };
	    if($max_flavor == $row['salty']){
	        $theflavor = 'salty';
	    };
	    if($max_flavor == $row['sour']){
	        $theflavor = 'sour';
	    };
	    if($max_flavor == $row['sweet']){
	        $theflavor = 'sweet';
	    };
	    array_push($food_information,array('name'=>$row['foodname'],'flavor'=>$theflavor,'calories'=>$row['calories'],'fat'=>$row['fat'],'order'=>$row['oder']));

	}
	$output = json_encode($food_information);
?>


<!DOCTYPE html>
<html>
<title>recommendationResult</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
</style>
<body>
    

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href='#contact' class="w3-bar-item w3-button">Contact</a>
      <a href='welcomeC.php' class="w3-bar-item w3-button" >Search</a>
      <a href="index.php" class="w3-bar-item w3-button">Log Out</a>

      <a href='register.php' class="w3-bar-item-button"></a>
    </div>
  </div>
</div>

<!-- Header -->



<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px" id="thisis">

  <!-- First Photo Grid-->
  <div class="w3-row-padding w3-padding-16 w3-center" id="food">
      
   
  </div>
  
  <!-- Second Photo Grid-->
  <div class="w3-row-padding w3-padding-16 w3-center" id="food2">
    
  </div>

  <!-- Pagination -->
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">Â«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">Â»</a>
    </div>
  </div>
  
  <hr id="about">

</div>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-8 w3-bottom">
   <h5><p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<br><a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green">  Wiki Page</a></p></h5>
</footer>

</body>
</html>
<script type='text/javascript'>
    var foroutput = JSON.parse('<?php echo $output;?>');
    var tmp = document.getElementById('thisis');

    console.log(foroutput);
    var food_div1 = document.getElementById('food');
    console.log(food_div1);
    var food_div2 = document.getElementById('food2');
    
    for (var i=0;i<foroutput.length;i++){
            var sub_quarter = document.createElement("div");
            sub_quarter.className = "w3-quarter";
            var pic = document.createElement("img");
            pic.width = 250;
            pic.height = 200;
            pic.src = "source/img/"+String(i)+'.jpg';
            console.log(foroutput[i].name);
            pic.alt = foroutput[i]['name'];
            //pic.style = "width:100%";
            
            var text1 = document.createElement("p");
            text1.innerHTML = String(foroutput[i].name);
            
            var thbr = document.createElement("br");
            
            var text2 = document.createElement("p");
            text2.innerHTML = String("this food tastes little ".concat(foroutput[i].flavor));
            
            var text3 = document.createElement("p");
            text3.innerHTML = String("Calories:".concat(foroutput[i].calories));
            
            var text4 = document.createElement("p");
            text4.innerHTML = String("Fats:".concat(foroutput[i].fat));
            
            
            sub_quarter.appendChild(pic);
            sub_quarter.appendChild(text1);
            sub_quarter.appendChild(thbr);
            sub_quarter.appendChild(text2);
            sub_quarter.appendChild(thbr);
            sub_quarter.appendChild(text3);
            sub_quarter.appendChild(thbr);
            sub_quarter.appendChild(text4);
            sub_quarter.appendChild(thbr);
            
            if (i==0 || i==1 ||i==3||i==4){
                food_div1.appendChild(sub_quarter);
            }
            if (i==5 || i==6 ||i==7 || i==8 ){
                food_div2.appendChild(sub_quarter);
            }
    }

</script>
<!-- End page content -->

