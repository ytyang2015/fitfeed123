<?php 
	session_start();
	if (isset($_POST['submit'])){
		$user_name="fitfeed123_fitfeed";
		$dbpassword="fitfeed123";
		$database_name="fitfeed123_FITFEED";
		$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
		$error = array();
		if (mysqli_connect_error()){
	    		die("Database Connection Failed" . mysqli_connect_error());
		}
		if ((! empty($_POST['username']))&& (!empty($_POST['password']))){
		
			$fitfeed_user_name = mysqli_real_escape_string($conn, $_POST['username']);
			$passwordinput = mysqli_real_escape_string($conn,$_POST['password']);
			$result = $conn->query("SELECT * FROM user where username = '$fitfeed_user_name'");
			$row_num = $result->num_rows;
			if($row_num>0){
				while ($row = $result->fetch_assoc()){
					$user=$row['username'];
					$userpass = $row['password'];
					$usertype = $row['type'];
				}
				//echo "<script type='text/javascript'>alert('$usertype');</script>";
				if($userpass == $passwordinput){
					$_SESSION['user']=$user;
					if ($usertype == 'R'){
						header ('Location: welcomeR.php');
					}else{
						header ('Location:profile.php');
					}
					exit;
				}else{
					$error['authorirty']="password is not correct";
				}
			}else{
				$error['usernull']="user not found";
			
			}
		}else{
			$error['missing']="all field is required";
		}	
	}
	function show_error($error=array()){
		$output = "";
		if (!empty($error)){
			foreach ($error as $key=>$value){
				$output.="{$value}<br></br>";
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
    <a href="index.php" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="http://www.culinarynutrition.com/wp-content/uploads/2014/09/o-ORGANIC-FOODS-facebook.jpg" alt="Hamburger Catering" width="1600" height="800">

  
  <div class="register-form">
  
  	<div class ="w3-card-2 w3-light-grey w3-display-middle w3-opacity-min" style="margin-left:40px;width:70%;height:47%">
  	<img class="img-log" style="border-radius: 60%;float:right; margin-top:90px" src="source/img/login_fit.png">
  	    <div style="margin-left:10px">
  		<p class="display-topleft">Log In to FitFeed<p>
  		<p class="display-topleft"> New to FitFeed? <a href='register.php'> Sign Up</a><p> 
  		<div style="width: 30%; height: 0.5px; border-bottom: 1px solid black; text-align: center; margin-bottom: 10px;"></div>
  		<form action = "LogIn.php" method="post">
  			<input type="text" style="width: 30%;" id = "username" name="username" value = "<?php echo 'username'; ?>" placeholder = "username"
      				style="background-color:white; 
             			border: solid 1px #6E6E6E;
              			height: 30px; 
              			font-size:18px; 
              			vertical-align:9px;color:#bbb" 
        			onfocus="if(this.value == 'username') {
             			this.value = '';
                  		this.style.color='#000';
                		}"><br></br>
  			<input type="password" style="width: 30%;" id = "password" name='password' value = "<?php echo 'password'; ?>" placeholder = "password"
      				style="background-color:white; 
             			border: solid 1px #6E6E6E;
              			height: 30px; 
              			font-size:18px; 
              			vertical-align:9px;color:#bbb" 
        			onfocus="if(this.value == 'password') {
             			this.value = '';
                  		this.style.color='#000';
                		}"><br></br>
                	
                		<p>  </p>
                	<p>  </p>
            <input type="submit"name="submit" value="LogIn" style="width:30%">
  			<p class="display-topleft"> New to FitFeed? <a href='register.php'> Sign Up</a><p>
  			    <p>  </p>
  			<p id = "register_error">
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
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green"><br></br>Wiki Page</a></p>
</footer>

</body>
</html>
