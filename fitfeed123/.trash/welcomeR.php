<?php 
  session_start();
  if (empty($_SESSION["user"])){
    header("Location:index.php");
  }
  if(isset($_POST['submit'])){
    $username = $_SESSION["user"];
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
    $productname = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $file = $_FILES['image_upload']['temp_name'];

    $calories = mysqli_real_escape_string($conn, $_POST['calories']);
    $result = mysqli_query($conn, "SELECT * FROM Product WHERE user_name = '$username' AND product_name = '$productname'");
    $row_num = $result->num_rows;
    if($row_num>0){
      array_push($errors, "You already have this product, please chaeck the name of the item.");
    }
    if(!is_numeric($price)||price < 0)
      array_push($errors, "Please enter a valid price of the product.");
    if(!isset($file))
      array_push($file, "Please upload a image of your prodect");
    $imagename = file_get_contents($file);//file_get_contents() reads a file into a string.

    $imgsize = getimagesize($file);
    if(empty($errors)){
      $query = "INSERT INTO Product(user_name, product_name, price, image_name, calories) VALUES ('$username', '$productname', '$price', '$imagename', '$calories')";
      $queryresult = mysqli_query($conn, $query);
      if(!$result)
        die("Database error.");
      else
          $_POST['productname'] = "";
    }
  }
  function display_errors($error=array()){
    $str = "";
    if(empty($error)){
      foreach ($error as $key) {
        # code...
        $str .= "key <br />";
      }
    }
    return $str;
  }

?>
<!DOCTYPE html>
<html>
<head>
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
                var user = "<?php echo $_SESSION['name']; ?>";
               // var chatCount = 0;
                setInterval(function(){
                  poll_chat(user);
                }, 4000);
                setInterval(function(){
                  poll_order(user);
                }, 5000);
          
        $("#logout_link").click(function(){
          sessionStorage.clear();
        });
        $('#add-item-button').click(function(){
          display_form.hide();
          display_order.hide();
          display_chat.hide();
          add_form.toggle(300);
        });
        $('#show-item-button').click(function(){
                    add_form.hide();
                    display_order.hide();
                    display_chat.hide();
                    $.post('php-scripts/getitems.php', {name: user}, function(data){
                        items.html(data);
                        display_form.fadeIn(100);
                    });
        });



   </script>             
    <title>welcome</title>
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
    <script src="JQuery/jquery-3.1.1.min.js">
    </script>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-opacity w3-wide ">
    <a href="welcomeC.php" class="w3-bar-item w3-button w3-margin-left" style="float:left;margin-top:20px;">Fit Feed</a>
      <form action = "profile.php" method="post" style="margin-top:20px;display:inline-block;">
        Find: <input type="text" name="age" value="food">
        <input type ="text" name="gender" value="type">
        <input type="submit" name="search" value="search">

      </p>
      </form>
    
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small" style="display:right;margin-top:20px;">
      <a href="order.php" class="material-icons">star_border</a>
      <a href='chatpage.php' class="material-icons">chat_bubble</a>
      <a class="material-icons" href="#home">face</a>
      <a href='register.php' class="w3-bar-item-button"></a>
    </div>
  </div>
</div>

<div style="width: 100%; height: 70px; border-bottom: 1px solid black; text-align: center; margin-bottom: 50px;"></div>
<div class="registration-form">
  <div class="container">
        <h3>Welcome, 
          <!--<span id="Name"></span>-->
          <?php echo $_SESSION['name']; ?>
        </h3><br /><br />
      <div id="buttons" align="center">
        <a class="hvr-shutter-in-horizontal button" id="add-item-button">Add New</a>
        <a class="hvr-shutter-in-horizontal button" id="show-item-button" name="show-item" style="margin-left:3%">My Items</a>
        <a class="hvr-shutter-in-horizontal button" id="order-button" style="margin-left:3%">My Orders</a>
        <a class="hvr-shutter-in-horizontal button" id="chat-button" style="margin-left:3%">My Chats</a>
      </div>
    <div id="item-form">
      <div class="reg-form" style="width:50%">
        <div class="reg">
           <p>Please tell us what you ant to sell! </p>
           <o>You can see the items added by clicking the "My Items" button above.</p>
           <form action="user_info.php" method="post" enctype="multipart/form-data">
             <ul>
               <li class="text-info">Name: </li>
               <li><input type="text" id="username "name="productname" placeholder="name of the item"></li>
             </ul>

             <ul>
               <li class="text-info">Nutrition info: </li>
              <li><input type="text" id="email "name="calories" placeholder="approximate calories per serving"></li>

             </ul>
              <ul>
               <li class="text-info">Price: </li>
               <li><input type="text" id="email "name="price" placeholder="without the dollar sign"></li>
             </ul>
                
                <ul>
                  <li class="text-info">Upload an Image of the Item: </li>
                  <li><input type="file" id="image-upload" name="image-upload" ></li>
                </ul>
             <p id="signup_error">
              <?php echo display_errors($errors); 
                            
                             if (sizeof($errors) > 0){
                                ?><script>alert("Error(s)");</script><?php 
                            }
              ?>
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

              </div>
      </div>
      <div class="clearfix"></div>
    </div>

    <!--display orders-->
     <div id="display-orders">
      <div class="reg-form">
        <div class="reg" id="all-orders">
            
              </div>
      </div>
      <div class="clearfix"></div>
    </div>

     <!--display chats-->
     <div id="display-chats">
      <div class="reg-form">
        <div class="reg" id="all-chats">

              </div>
      </div>
      <div class="clearfix"></div>
    </div>



  </div>
</div>




</body>
</html>