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
	$username= mysqli_real_escape_string($conn, trim($_SESSION['user']));
	$userinfo_select = $conn->query("SELECT * FROM user_info where username = '$username'");
	$row_num = $userinfo_select->num_rows;
	if($row_num>0){
		$Query_Record = $userinfo_select->fetch_assoc();
		$age = $Query_Record['age'];
		$gender = $Query_Record['gender'];
		$weight = $Query_Record['weight'];
		$height = $Query_Record['height'];
		$activitylevel = $Query_Record['activitylevel']; //added here
		$foodlist= read_food($conn,$username);
	}
	if (!empty($_POST['submit'])){
		$server_name="localhost";
		$user_name="fitfeed123_fitfeed";
		$dbpassword="fitfeed123";
		$database_name="fitfeed123_FITFEED";
		$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
		$errors = array();
		if (mysqli_connect_error()){
		// <script> alert('connection fail')</script>
	    		die("Database Connection Failed" . mysqli_connect_error());
		}

		//echo "sucess!";
		
//		$database = mysqli_select_db($conn,$databsename);
		
//		if (!database){
//			die('Can not connect to Database' . mysql_error());
//		}
		
		if ((!empty($_POST['age']))&&(!empty($_POST['gender']))&&(!empty($_POST['weight']))&&(!empty($_POST['height'])) && (!empty($_POST['activitylevel']))){//added
			$username= mysqli_real_escape_string($conn, trim($_SESSION['user']));		
			$userinfo_select = $conn->query("SELECT * FROM user_info where username = '$username'");
			$row_num = $userinfo_select->num_rows;
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$weight = $_POST['weight'];
			$height = $_POST['height'];
			$activitylevel = $_POST['activitylevel'];
			if ($age<0){
				$error['age']='age can not be less than 0!';
			}else{
				if ($gender=="male"){
					$gender = 'm';
				}else{
					$gender = 'f';
				}
			}
			if (empty($error)){
				if($row_num>0){
					$update = $conn->query("UPDATE user_info SET user_info.age={$age}, user_info.gender='$gender', user_info.weight={$weight}, user_info.height={$height}, user_info.activitylevel={$activitylevel} where user_info.username = '$username'");
					$car_intake = getintake($gender, $weight, $height, $age, $activitylevel);
					$foodlist=food_rec($car_intake,$conn);
					insert_food($foodlist,$conn,$username,TRUE);
					

				}else{
					
					$insert = $conn->query("INSERT INTO user_info (username,age,height,weight,gender, activitylevel) VALUES ('$username',{$age},{$height},{$weight},'$gender', {$activitylevel})");
					$car_intake = getintake($gender, $weight, $height, $age, $activitylevel);
					$foodlist=food_rec($car_intake,$conn);
					
					insert_food($foodlist,$conn,$username,FALSE);
					
				}
			}
	}
	}
	function getintake($gender, $weight, $height, $age, $activitylevel) {
		$rmr = 0;
		$rmrindex = array("1" => "1.2", "2" => "1.375", "3" => "1.55", "4" => "1.725", "5" => "1.9");
		if (1 == $gender) {							//gender = 1 is male
			$rmr = 9.99 * $weight + 6.25* $height - 4.92 * $age + 5;
		}
		else {										//else is female
			$rmr = 9.99 * $weight + 6.25 * $height - 4.92 * $age - 161;
		}

		$rmr = $rmr * $rmrindex[$activitylevel];
		$intake = round($rmr - 500);
		print "your daily intake should be $intake calories to lose weight at a rate of 1 pound per week.";

		return $intake;
	}
	function read_food($conn,$username){
		$foodlist=array();
		$k=0;
		$read_user_food = $conn->query("SELECT * FROM user_food WHERE username='$username'");
		$row_num = $read_user_food->num_rows;
		if ($row_num>0){
			while($row =$read_user_food->fetch_assoc()){
				$foodlist[$k]=$row['foodname'];
				$k++;
			}
			 return $foodlist;
		}else{
			return NULL;
		}
	}
	function insert_food($foodlist,$conn,$username,$is_change){
		if($is_change){
			$delete_user_food = $conn -> query ("DELETE FROM user_food WHERE username='$username'");
			for ($i=0;$i<count($foodlist);$i++){
				$food=$foodlist[$i];	
				$write_user_food = $conn->query("INSERT INTO user_food (username,foodname) VALUES ('$username','$food') ");
			}
		}else{
		for ($i=0;$i<count($foodlist);$i++){
			$food=$foodlist[$i];
			$write_user_food = $conn->query("INSERT INTO user_food (username,foodname) VALUES ('$username','$food') ");
		}
		}
	}
	function food_rec($intake,$connection){
		$foodlist1=array();
		$k=0;
		$find_Carl = $connection->query("SELECT * FROM food WHERE calories <{$intake}");
		$row_num = $find_Carl->num_rows;
		if($row_num>0){
			while($row= $find_Carl->fetch_assoc()){
				$foodlist1[$k]=$row['name'];
				$k++;
			}
			return $foodlist1;
		}else{
			return NULL;
		}
	}
	function show_error($error=array()){
		$output = "";
		if (!empty($error)){
			foreach ($error as $key => $error){
				$output .= "{$error}<br />";
			}
		}
		return $output;
	}	

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="welcomeC.php" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href='#contact' class="w3-bar-item w3-button">Contact</a>
      <a href='LogIn.php' class="w3-bar-item w3-button" ></a>
      <a href='register.php' class="w3-bar-item-button"></a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="http://www.culinarynutrition.com/wp-content/uploads/2014/09/o-ORGANIC-FOODS-facebook.jpg" alt="Hamburger Catering" width="1600" height="800">

  <div class="register-form">
  	<div class ="w3-card-2 w3-light-grey w3-display-middle w3-opacity-min" style="width:60%">

  		<h3 class="w3-display-topmiddle">welcome <?php echo $_SESSION['user']; ?></h3>
  		<form action = "User_Info.php" method="post">
  			age:<input type="text" name="age" value="<?php echo $age; ?>" ><br></br>
  			gender:<input type ="text" name="gender" value="<?php echo $gender; ?>"><br></br>
  			height:<input type="text" name="height" value="<?php echo $height; ?>"><br></br>
  			weight:<input type="text" name="weight" value="<?php echo $weight; ?>"><br></br>
  			activitylevel:<input type="text" name="activitylevel" value="<?php echo $activitylevel; ?>"><br></br> <!--added-->
  			<input type="submit"name="submit" value="submit">
  			<p id = "iput_error"></p>
  			<?php echo show_error($error);?>
  		</p>
  		</form>
  		<?php 
  			for($i=0;$i<count($foodlist);$i++){
  				echo($foodlist[$i]);
  				echo('<br>');
  			}
  		?>
  	</div>
  </div>
  
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-8">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<br><a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green">  Wiki Page</a></p>
</footer>

</body>
</html>