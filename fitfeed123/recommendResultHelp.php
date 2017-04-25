<?php 
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
	$Food_info = $conn->query("SELECT * FROM food INNER JOIN user_food ON user_food.foodname=food.name where user_food.username='$username'");
	while($row = $Food_info->fetch_assoc()){
	    array_push($food_information,$row['foodname']);

	}
	$food_info =array();
	if ($Recommand_list->num_rows>0){
	    $foodname = array();
	    	while($row =$Recommand_list->fetch_assoc()){
				array_push($foodname,$row['foodname']);
			}
			
		$foodname =json_encode($foodname);
	}

?>