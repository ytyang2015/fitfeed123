<?php 
  session_start();
  if (empty($_SESSION['user'])){
    header("Location:index.php");
  }
  $_SESSION['ifR']=true;
  if(isset($_POST['submit'])){
    $username = $_SESSION['user'];
    $server_name="localhost";
    $user_name="fitfeed123_fitfeed";
    $dbpassword="fitfeed123";
    $database_name="fitfeed123_FITFEED";
    $conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
    if (mysqli_connect_error()){
      die("Database Connection Failed" . mysqli_connect_error());
    }
    $username= mysqli_real_escape_string($conn, trim($_SESSION['user']));
    $userinfo_select = $conn->query("SELECT * FROM restaurant where name = '$username'");
    $row_num = $userinfo_select->num_rows;
    if($row_num>0){
      $Query_Record = $userinfo_select->fetch_assoc();
      $category = $Query_Record['category'];
      $address = $Query_Record['address'];
      $phone = $Query_Record['phone'];
      $price = $Query_Record['price'];
      $review = $Query_Record['review'];
    }
    $errors = array();
    
    $productname = mysqli_real_escape_string($conn, $_POST['productname']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sweet = mysqli_real_escape_string($conn, $_POST['sweet']);
    $spicy = mysqli_real_escape_string($conn, $_POST['spicy']);
    $salty = mysqli_real_escape_string($conn, $_POST['salty']);
    $sour = mysqli_real_escape_string($conn, $_POST['sour']);
    $file = $_FILES['image_upload']['temp_name'];
    $calories = mysqli_real_escape_string($conn, $_POST['calories']);
    $result = mysqli_query($conn, "SELECT * FROM Product WHERE user_name = '$username' AND product_name = '$productname'");
    $row_num = $result->num_rows;
    if($row_num>0){
      array_push($errors, "You already have this product, please chaeck the name of the item.");
    }
    if(!is_numeric($price)||price < 0)
      array_push($errors, "Please enter a valid price of the product.");
 //   if(!isset($file))
 //     array_push($errors, "Please upload a image of your prodect");
//    $imagename = file_get_contents($file);//file_get_contents() reads a file into a string.
    $imagename = mysqli_real_escape_string($conn, $_POST['productname']);
    //$imgsize = getimagesize($file);
    if(empty($errors)){
      $query = "INSERT INTO Product(user_name, product_name, price, image_name, calories, sweet, spicy, salty, sour) VALUES ('$username', '$productname', '$price', '$imagename', '$calories','$sweet','$spicy','$salty','$sour')";
      $queryresult = mysqli_query($conn, $query);
      if(!$result)
        die("Database error.");
      else
          $_POST['productname'] = "";
    }
  }
  /*function display_errors($errors = array()){
    $str = "";
    if(empty($errors)){
      foreach($errors as $key) {
        # code...
        $str .= "key <br />";
      }
    }
    return $str;
  }*/

?>
<!DOCTYPE html>
<html>
<head>
    <script src="JQuery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".scroll").click(function(event){   
          event.preventDefault();
          $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    
        //$("#Name").text(sessionStorage.User);
                var add_form = $('#item-form');
                var display_form = $('#display-form');
                var outer = $('.registration-form');
                var items = $('#all-items');
                var display_chat = $('#display-chats');
                var chats = $('#all-chats');
                var display_order = $('#display-orders');
                var orders = $('#all-orders');
                var user = "<?php echo $_SESSION['user']; ?>";
        setInterval(function(){
                	poll_order(user);
                }, 4000);
        $("#logout_link").click(function(){
          sessionStorage.clear();
        });
        $('#add-item-button').click(function(){
          display_form.hide();
          display_order.hide();
          display_chat.hide();
          add_form.toggle(300);
          //alert("success");
        });

        $("#order-button").click(function(){
          add_form.hide();
          display_form.hide();
          display_chat.hide();
          $.ajax({
            url: "php_script/getorders.php",
            type: "GET",
            data:{seller: user},
              success: function(response) {
              orders.html(response); 
              display_order.fadeIn(200);
            },
              error: function(xhr) {
                console.log("Failed to retrieve orders.");
              }
            });
        });
      });

       function poll_order(user){
          $.ajax({
            url: "php_script/poll_order.php",
            type: "get", 
            data:{User: user},
              success: function(response) {
                console.log(response);
                if (response == "alert")  
                  alert("You've received a new order. \nPlease go to MY ORDERS to view the details.");
            },
          });
       }
        function transaction_complete(product_name, seller){
           	 console.log(product_name);
           	 console.log(seller);
           	 $.ajax({
                   url: 'php_script/setcomplete.php',
                   data: {Item: product_name, Status: 'incomplete', User: seller},
                   type: 'GET',
                   success: function(){
                   	   alert("Transaction complete.");
                   	   location.reload();
                   	   console.log("sucess");
                   }
               });
        }
    //   function test_functioncall() {
     //      alert("testfunctioncal");
     //  }


   </script>             
    <title>FitFeed-WelcomeR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <style>
        body {font-family: "Times New Roman", Georgia, Serif;}
        h1,h2,h3,h4,h5,h6 {
            font-family: "Playfair Display";
            letter-spacing: 3px;
        }
    </style>
    <script src="JQuery/jquery-3.1.1.min.js"></script>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
    <a href="index.php" class="w3-bar-item w3-button w3-margin-right">Log Out</a>

      <a id="logging" ></a>
      <a id="register"></a>
    </div>
  </div>
</div>


<body background="http://i.huffpost.com/gen/1905866/images/o-ORGANIC-FOOD-STUDY-facebook.jpg ">
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small" style="display:right;margin-top:20px;">
      <a href="order.php" class="material-icons">star_border</a>
      <a href='NewChatTest.php' class="material-icons">chat_bubble</a>
      <a class="material-icons" href="#home">face</a>
      <a href='register.php' class="w3-bar-item-button"></a>
    </div>
  </div>
</div>

<div style="width: 100%; height: 70px; "></div>
<div class="registration-form" style="text-align: center;">
  <div class="container" >
        <h2 style="text-align:center; color: #FFFAFA">Welcome, 
        


<script>
       function poll_order(user){
          $.ajax({
            url: "php_script/poll_order.php",
            type: "get", 
            data:{User: user},
              success: function(response) {
                console.log(response);
                if (response == "alert")  
                  alert("You've received a new order. \nPlease go to MY ORDERS to view the details.");
            },
          });
       }
</script>

          <!--<span id="Name"></span>-->
          <?php echo $_SESSION['user']; ?>
        </h2><br /><br />
      <div id="buttons" align="center">
        <button type="button" id="add-item-button">Add New</button>
        
        <button type="button" id="order-button" style="margin-left:3%">My Orders</button>
        <button type="button" id="chat-button" style="margin-left:3%" onclick ="location.href='NewChatTest.php';">My Chats</button>
      </div>
    <div id="item-form" align="center">
      <div class="reg-form" style="width:50%;">
        <div class="reg" style="text-align: center;">
           <h5 style="color: #F5FFFA">Please tell us what you ant to sell!</h5>
           <h5 style="color: #F5FFFA">You can see the items added by clicking the "My Items" button above.</h5>
           <form action="welcomeR.php" method="post" enctype="multipart/form-data">
             <ul>
               <h5 style="color: #F5FFFA"><li class="text-info">Name: </li></h5>
               <li><input type="text" id="username "name="productname" placeholder="name of the item"></li>
             </ul>

             <ul>
               <h5 style="color: #F5FFFA"><li class="text-info">Nutrition info: </li></h5>
              <li><input type="text" id="email "name="calories" placeholder="approximate calories per serving"></li>

             </ul>
              <ul>
               <h5 style="color: #F5FFFA"><li class="text-info">Price: </li></h5>
               <li><input type="text" id="email "name="price" placeholder="without the dollar sign"></li>
             </ul>
             <ul>
			     <h5 style="color: #F5FFFA"><li class="text-info">Please describe the flavor:</li></h5>
			    <h5 style="color: #F5FFFA"><li class="text-info">You may inter the number to represent the degree of the flavors.</li></h5>
                <li><input type="text" id="email "name="sweet" placeholder="sweetness"></li>
                <li><input type="text" id="email "name="spicy" placeholder="spicy"></li>
                <li><input type="text" id="email "name="salty" placeholder="salty"></li>
                <li><input type="text" id="email "name="sour" placeholder="sour"></li>
			</ul> 
                
                
                <ul>
                  <h5 style="color: #F5FFFA"><li class="text-info">Upload an Image of the Item: </li></h5>
                  <li><input type="file" id="image-upload" name="image-upload" ></li>
                </ul>
             <p id="signup_error">

             </p>
             <div align="center" style="margin-top:2%">
             <input type="submit" name="submit" value="CREATE">
            </div>

           </form>
         </div>
      </div>
      <div class="clearfix"></div>
    </div>
 
        <!--display items-->
        <div id="display-form">
      <div class="reg-form">
        <div class="reg" id="all-items">
            <p> </p>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

    <!--display orders-->
    <h6 style="color: #F5FFFA">
     <div id="display-orders">
      <div class="reg-form">
        <div class="reg" id="all-orders">

            <p> </p>
              </div>
      </div>
      <div class="clearfix"></div>
    </div>
    </h6>

     <!--display chats-->
     <div id="display-chats">
      <div class="reg-form">
        <div class="reg" id="all-chats">

            <p> </p>
              </div>
      </div>
      <div class="clearfix"></div>
    </div>



  </div>
</div>


<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green"><br></br>Wiki Page</a></p>
</footer>

</body>
</html>