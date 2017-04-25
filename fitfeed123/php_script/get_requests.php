<?php 

/////////////////////////not finished/////////////////////////////

    $user = $_GET['User'];
    //$server_name="engr-cpanel-mysql.engr.illinois.edu";
	$user_name="fitfeed123_fitfeed";
	$dbpassword="fitfeed123";
	$database_name="fitfeed123_FITFEED";
	$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);

	if (mysqli_connect_error()){
		die("Database Connection Failed" . mysqli_connect_error());
	}


    // first display pending requests
    $status = "pending";
    $queryStr = "SELECT * FROM chat_requests where responder = '$user' AND status = '$status'"; 
    $query = mysqli_query($conn, $queryStr);
    $get_rows= mysqli_affected_rows($conn);
    $output = "<h4>Pending Chat Requests: </h4>";
    if($get_rows != 0){
			while($row = mysqli_fetch_assoc($query)){
				$content = "<b>" . $row['initiator'] . "</b>" . " wants to chat with you" . "&nbsp;&nbsp;&nbsp;&nbsp;";
				$url = $row['url'];
				$content .= '<button id="accept-chat" onclick="accept_chat(\'' .$url . '\')">Accept</button><br /><br />';
				$output .= $content;
		}
}
     else
        $output .= "<p>You have no pending chat request at this time.</p>";
	 $output .= "<br /><h4>My Chat History: </h4>";
     $status = "completed";
	 
	// $queryStr2 = "SELECT DISTINCT initiator, responder FROM chat_requests where status= '$status'"; // Distinct initiator
       $queryStr2 = "SELECT initiator, responder, url FROM chat_requests GROUP BY initiator, responder";
	      $result = mysqli_query($conn, $queryStr2);
	      if (!$result){
	         echo "ERROR ";
	      }
	      
	      else {
	          while($row = mysqli_fetch_assoc($result)){
	          	    if ($user == $row['initiator'])
	          	    	$person = $row['responder'];
	          	    else 
	          	    	$person = $row['initiator'];
	          		$content = "My chat with " . "<b>" . $person . "</b>" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";//No-break space.
					$url = $row['url'];
					$content .= '<button id="accept-chat" onclick="view_chat(\'' .$url . '\')">View Conversation</button><br /><br />';
					$output .= $content;
	        }
	      }
	      echo $output;
?>