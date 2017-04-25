<?php 
    require('php_script/dbscan.php');
	session_start();
	if (empty($_SESSION["user"])){
		header("Location:index.php");
	}else{
	    $_SESSION['ifR']=false;
	    $username=$_SESSION['user'];
	    $material = $_POST['material'];
	    $input_flavor = isset($_POST['browser'])? htmlspecialchars($_POST['browser']) : '';;
	    $user_favor=array();
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
		    $calories = $Query_Record['calories'];
		    $favorite_food = $Query_Record['Food'];
		    $user_favor[0] = $Query_Record['sour'];
		    $user_favor[1] = $Query_Record['sweet'];
		    $user_favor[2] = $Query_Record['hot'];
		    $user_favor[3] = $Query_Record['salty'];
    	}
    	$Recommand_list = findrecommand($user_favor,$conn,$calories);
    	if ((!empty($_POST['material']))){
    	    $material = $_POST['material'];
        	if (isset($material)){
		        $Recommand = sortrecommand($user_favor,$material,$Recommand_list);
		        $foodlist = array();
		        foreach($Recommand as $x){
		            array_push($foodlist,$x[4]);
		        }
		        $read_food = $conn->query("SELECT * FROM user_food WHERE username= '$username'");
		        $row_num = $userinfo_select->num_rows;
		        if($row_num>0){
		            $conn->query("DELETE FROM user_food WHERE username='$username'");
		        }
		        insert_food($foodlist,$conn,$username);
		    	header('Location:recommand_result.php');
		    }
    	}else{
	
	 
	if((isset($_POST['searchfood']) )){
	    $_SESSION['searchfood']= $_POST['searchfood'];
	    $_SESSION['buyer'] = $username;
	    header('Location:results.php');
	}
    	}
	}

	
	
	
	
	function insert_food($foodlist,$conn,$username){
			for ($i=0;$i<count($foodlist);$i++){
				$food=$foodlist[$i];
				$write_user_food = $conn->query("INSERT INTO user_food (username,foodname,oder) VALUES ('$username','$food','$i') ");
			}
	}
	
	
	
	
	function sortrecommand($user_favor,$material,$Recommand_list){
	    $maxs = array_keys($user_favor, max($user_favor));
	    $index =$maxs[0];
	    $ForSort = array();
	    $tmparray=array();
        for ($i=0;$i<count($Recommand_list);$i++ ){
            if(strpos($Recommand_list[$i][4], $material) != false){
                array_push($ForSort,$Recommand_list[$i]);
            }else{
                array_push($tmparray,$Recommand_list[$i]);
            }
        }
        quickSort($ForSort,$index,0,(count($ForSort)-1));
        return(array_merge(array_reverse($ForSort),$tmparray));
	}
	function quickSort(&$m1,$index,$a,$b){
	    if($a>$b or $a == $b){
	        return ;
	    }
	    $i=$a;
	    $j=$b;
	    $p = $m1[0];
        while($i<$j){
            if ($m1[$j][$index]>$p[$index]){
	                $j--;
	                continue;
	        }else{
	                $m1[$i]=$m1[$j];
	                $i++;
	        }
            if ($m1[$i][$index]<$p[$index]){
                $i++;
                continue;
	        }else{
	            $m1[$j]=$m1[$i];
	            $j--;
	        }
        }
    	$m1[$i]=$p;
    	quickSort($m1,$index,$a,$i-1);
    	quickSort($m1,$index,$i+1,$b);
	}
	function findrecommand($user_favor,$conn,$calories){
	    $user_favor=Normalizate($user_favor);
	    $food_select = $conn -> query ("SELECT * FROM food where calories <= '$calories'");
    	$row_num = $food_select ->num_rows;
    	$food_favor = array();
    	if($row_num>0){
    	    while ($row = $food_select -> fetch_assoc()){
    	        $tmp = array();
    	        array_push($tmp,$row['sour']);
    	        array_push($tmp,$row['sweet']);
    	        array_push($tmp,$row['hot']);
    	        array_push($tmp,$row['salty']);
    	        $tmp=Normalizate($tmp);
    	        array_push($tmp,$row['name']);
    	        array_push($food_favor,$tmp);
    	    }
    	}
    	$cluster_result = dbscan($food_favor,1.2,3);
    	$cluster_center=array();
    	foreach ($cluster_result as $x){
    	    if ($x[5]==-1){
    	        $x[5]=0;
    	    }
    	    if($cluster_center[$x[5]]){
    	        $cluster_center[$x[5]][0]=$cluster_center[$x[5]][0]+$x[0];
    	        $cluster_center[$x[5]][1]=$cluster_center[$x[5]][1]+$x[1];
    	        $cluster_center[$x[5]][2]=$cluster_center[$x[5]][2]+$x[2];
    	        $cluster_center[$x[5]][3]=$cluster_center[$x[5]][3]+$x[3];
    	        $cluster_center[$x[5]][4]=$cluster_center[$x[5]][4]+1;
    	    }else{
    	        $cluster_center[$x[5]][0]=$x[0];
    	        $cluster_center[$x[5]][1]=$x[1];
    	        $cluster_center[$x[5]][2]=$x[2];
    	        $cluster_center[$x[5]][3]=$x[3];
    	        $cluster_center[$x[5]][4]=1;
    	    }
    	}
    	$tmp=array();
    	$k=pow(($user_favor[0]-$cluster_center[0][0]),2)+pow(($user_favor[1]-$cluster_center[0][1]),2)+pow(($user_favor[2]-$cluster_center[0][2]),2)+pow(($user_favor[3]-$cluster_center[0][3]),2);
    	$theIndex=0;
        for($i=1;$i<count($cluster_center);$i++){
            $cluster_center[$i][0]=$cluster_center[$i][0]/$cluster_center[$i][4];
            $cluster_center[$i][1]=$cluster_center[$i][1]/$cluster_center[$i][4];
            $cluster_center[$i][2]=$cluster_center[$i][2]/$cluster_center[$i][4];
            $cluster_center[$i][3]=$cluster_center[$i][3]/$cluster_center[$i][4];
            $m=pow(($user_favor[0]-$cluster_center[$i][0]),2)+pow(($user_favor[1]-$cluster_center[$i][1]),2)+pow(($user_favor[2]-$cluster_center[$i][2]),2)+pow(($user_favor[3]-$cluster_center[$i][3]),2);
            if ($k>$m){
                $k=$m;
                $theIndex = $i;
            }
        }
    	$recommandList=array();
    	foreach ($cluster_result as $x){
            if($x[5]==$theIndex){
                array_push($recommandList,array_slice($x,0,5));
            }
    	}
        return($recommandList);
	}
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>FitFeed-Welcome</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <style>
        body {font-family: "Times New Roman", Georgia, Serif;}
        h1,h2,h3,h4,h5,h6 {
            font-family: "Playfair Display";
            letter-spacing: 5px;
        }
    </style>

    </script>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-opacity w3-wide ">
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fitfeed</a>
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">About</a>
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Contact</a>
  <a href="index.php" class="w3-bar-item w3-button w3-margin-left">Log Out</a>

    
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#menu" class="w3-bar-item w3-button"></a>
      <a class="material-icons" href="#recommand_food_list">favorite_border</i>
      <a class="material-icons" href="profile.php">face</a>

      <a href='register.php' class="w3-bar-item-button"></a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="http://www.culinarynutrition.com/wp-content/uploads/2014/09/o-ORGANIC-FOODS-facebook.jpg" alt="Hamburger Catering" width="1600" height="800">

<div class="register-form">
   
    	<h1 class="w3-xxlarge w3-display-left" style:"margin-top:0px;margin-left:0px;">Fit Feed</h1>
  
  	<div class ="w3-card-2 w3-light-grey w3-display-middle w3-opacity-min" >
         <form action = "welcomeC.php" method="post" style="margin-top:30px;">
  		<p></p><h3 class="w3-display-topmiddle">Hi <?php echo $_SESSION['user']; ?> </h3></p>
  	<!--  <p><h5 class="w3-display-middle"><input type="button" onclick="window.location.href='NewChatTest.php'" value="chat"></h5><br></p> -->
                                <br>
                                <br>
  			Find Based on ML: <input type="text" name="material" placeholder="Enter your search item...">
  			<input type="submit"name="result" value="search">

            <br/>
            <br/>
			Find Based on DM: <input type="text" name="searchfood" placeholder="Enter your search item...">
			<input type="submit" name='nimabi' value="search">

  		</form>
  </div>
  
  

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-bottom w3-light-grey w3-padding-8">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green">  Wiki Page</a></p>
</footer>

</body>
</html>