<?php 
	session_start();
	
	if (empty($_SESSION["user"])){
	}else{
		$server_name="localhost";
		$user_name="fitfeed123_fitfeed";
		$dbpassword="fitfeed123";
		$database_name="fitfeed123_FITFEED";
		$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
		if (mysqli_connect_error()){
		// <script> alert('connection fail')</script>
		die("Database Connection Failed" . mysqli_connect_error());
		}
		$username= mysqli_real_escape_string($conn, trim($_SESSION['user']));
		$userinfo_select = $conn->query("SELECT * FROM user_info where username = '$username'");
		$row_num = $userinfo_select->num_rows;
		if($row_num>0){
			$Query_Record = $userinfo_select->fetch_assoc();
			$age = $Query_Record['age'];
			$gender = $Query_Record['gender'];
			$weight = $Query_Record['weight'];
			$height = $Query_Record['height'];
			$intake = $Query_Record['calories'];
		}
	}
	$chatnumber = 0;
	$ordernum = 0;
?>
<!DOCTYPE html>
<html>
<title>FitFeed-UserProfile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">


    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img class="w3-image" src="source/img/xuli_profile.jpg" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2><font color="white"><?php global $username; echo $_SESSION['user'];?></font></h2>
          </div>
        </div>
        <div class="w3-container">
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php global $gender; echo $gender;?><br></p>
           <div class="information">
 	<form action="profile.php">
 		<input type="button" onclick = "location.href='profile.php'"value="Overview"><br>
 		<input type="button" onclick = "location.href='User_Info.php'"value="Edit Info"><br>
 		<input type="button" onclick ="location.href='order.php'"value="Order List"><br>
 		<input type="button" onclick = "location.href='welcomeC.php'"value="Search"><br>

 	</form>
 </div>
        
          <hr>

          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Recommend Food</b></p>
          <p>Chicken Breast</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">healthy meet</div>
          </div>
          <p>Oats</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
              <div class="w3-center w3-text-white">healthy cereal</div>
            </div>
          </div>
          <p>Cabbage</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">healthy vegetables</div>
          </div>
          <p>Apple</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">healthy fruit</div>
          </div>
          <br>

          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Recommend Nutrition</b></p>
          <p>Water</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
          </div>
          <p>Protein</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
          </div>
          <p>Dietery Fiber</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
          </div>
         <p>carbohydrate</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:30%"></div>
          </div>
          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
     </div>
   

<!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Body Information</h2>
        
        <div class="w3-container">
          <h5 class="w3-opacity"><b> <h3> Age: <p style="display: inline-block;"><?php global $age;echo $age;?><p></h3>
</b></h5>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b><h3>Height: <p style="display: inline-block;"><?php global $height;echo $height;?><p></h3></b></h5>
        </div>
        
         <div class="w3-container">
          <h5 class="w3-opacity"><b><h3>Weight: <p style="display: inline-block;"><?php global $weight;echo $weight;?><p></h3></b></h5>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b><h3>Carlonis intake: <p style="display: inline-block;"><?php global $intake;echo $intake*10;?><p></h3></b></h5>
        </div>
 </div>
    
 <div class="w3-container w3-card-2 w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Best Restaurant</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>M Sushi & Grill</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>8am - 10pm</h6>
          <p>$$  Sushi Bars, Japanese, Korean</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Kohinoor Indian Restaurant and Lounge</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>11am - 10pm</h6>
          <p>$$  Indian</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Miga</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>11am - 8pm</h6>
          <p>$$$  American (New), Asian Fusion, Desserts</p><br>
        </div>
      </div>
    

    <!-- End Right Column -->


  
<!-- End page content -->




