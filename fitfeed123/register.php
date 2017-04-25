<?php 
	session_start();
	if (isset($_POST['submit'])){
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
		
		if ((!empty($_POST['username']))&&(!empty($_POST['password']))&&(!empty($_POST['repassword']))){
		
			$fitfeed_user_name = mysqli_real_escape_string($conn, trim($_POST['username']));
			$passwordinput = mysqli_real_escape_string($conn, trim($_POST['password']));
			$repasswordinput = mysqli_real_escape_string($conn, trim ($_POST['repassword']));
			$usertype = $_POST['type'];
			$username_select = $conn->query("SELECT * FROM user where username = {$fitfeed_user_name}");
			$row_num = $username_select->num_rows;
			
			if($row_num>0){
				$error['register_user']="Username '$fitfeed_user_name'has already existed!";	
			}
			if($repasswordinput != $passwordinput){
				$error['repassword']="the password is not match";
			}
			if (empty($error)){
				$insert_sql = "INSERT INTO user (username,password,type) VALUES ('$fitfeed_user_name','$passwordinput','$usertype')";
				$user_insert = $conn->query($insert_sql);
				if ($user_insert){
					$msg="User Create!";
					header('Location: profile.php');
				}else{
					die("Can not insert your username to database!" . mysqli_error($conn));
				}
				
			}
		}else{
			$error['input_missing']="Field is empty!";
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
    <title>FitFFeed-Register</title>
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
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="LogIn.php" class="w3-bar-item w3-button">Log In</a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="http://www.culinarynutrition.com/wp-content/uploads/2014/09/o-ORGANIC-FOODS-facebook.jpg" alt="Hamburger Catering" width="1600" height="800">

  
<div class="register-form">
  <div class ="w3-card-2 w3-light-grey w3-display-middle w3-opacity-min" style="margin-left:40px;width:70%;height:50%">
  	<img class="img-log" style="border-radius: 60%;float:right; margin-top:90px" src="source/img/login_fit.png">
  	    <div style="margin-left:10px">
  		<p class="display-topleft">Sign up for Fit Feed</p>
  		<p class="display-topleft"> Find the best way to keep fit</p>
  		<form action = "register.php" method="post">
  			<input type="text" id = "username" name="username" style="width: 30%;"  value = "<?php echo 'username'; ?>" placeholder = "username"
      				style="background-color:white; 
             			border: solid 1px #6E6E6E;
              			height: 30px; 
              			font-size:18px; 
              			vertical-align:9px;color:#bbb" 
        			onfocus="if(this.value == 'username') {
             			this.value = '';
                  		this.style.color='#000';
                		}"><br></br>
  			<input type="password" id = "repassword" name="password" style="width: 30%;"  value = "<?php echo 'password'; ?>" placeholder = "password"
                    echo 'password:';
$oldStyle = shell_exec('stty -g');
shell_exec('stty cbreak -echo');
$passwd = "";
while(true) {
 $c = fgetc(STDIN);
 if ($c != PHP_EOL) {
     $passwd .= $c;
 } else {
     break;
 }
 echo "*";
}
echo shell_exec('stty ' . $oldStyle);
echo PHP_EOL . "password ".$passwd;
      				style="background-color:white; 
             			border: solid 1px #6E6E6E;
              			height: 30px; 
              			font-size:18px; 
              			vertical-align:9px;color:#bbb" 
        			onfocus="if(this.value == 'password') {
             			this.value = '';
                  		this.style.color='#000';
                		}"><br></br>
  			<input type="password" id = "retype password" name="repassword" style="width: 30%;"  value = "<?php echo 'password'; ?>" placeholder = "retype password"
      				style="background-color:white; 
             			border: solid 1px #6E6E6E;
              			height: 30px; 
              			font-size:18px; 
              			vertical-align:9px;color:#bbb" 
        			onfocus="if(this.value == 'password') {
             			this.value = '';
                  		this.style.color='#000';
                		}"><br></br>
                	
                	<input type="radio" name="type" value="C" checked> customer  or
  			<input type="radio" name="type" value="R"> restaurant<br>

  			<input type="submit"name="submit" value="REGIST">
  			<p id = "register_error"></p>
  			<?php echo show_error($error);?>
  		</p>
  		</form>
  	   </div>
  </div>
</div>
  
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-8">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green">  Wiki Page</a></p>
</footer>

</body>
</html>
