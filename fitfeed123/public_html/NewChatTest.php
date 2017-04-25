<!DOCTYPE html>
<?php
    session_start();
    if (empty($_SESSION['user'])){
    }else{
        $username = $_SESSION['user'];
        $ifR = $_SESSION['ifR'];
        $chat_restaurant = $_SESSION['chat_restaurant'];
    }
?>


<html>
<head>
    <html>
<head>
    <title>Fit Feed</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script type="text/javascript">
        console.log(document.domain);
    	$(document).ready(function($){
	    var User = "<?php echo $_SESSION['name'];?>";
	    if (!User){
	        var content1 = "<a class=\"w3-bar-item w3-button\" href=\"LogIn.php\">LogIn</a>";
	        var content2 = "<a class=\"w3-bar-item w3-button w3-margin-right\" href=\"register.php\">Register</a>";
	        $("#logging").html(content1);
	        $("#register").html(content2);
	    }else{
	        var content1 = "<a class=\"w3-bar-item w3-button\" href=\"LogIn.php\">LogIn</a>";
	        var content2 = "<a class=\"w3-bar-item w3-button w3-margin-right\" href=\"register.php\">Logout</a>";
	        $("#logging").html(content1);
	        $("#register").html(content2);
	    }
	});
     </script>

    <style>
        div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
    </style>
    <title></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <style>
        p {
            text-align: left;
            padding-left: 20px;
        }
    </style>

</head>

<body>
<!-- Navbar (sit on top) -->
<div class="w3-top ">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2  height: 1000px">
   <h4> <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a></h4>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <h4><a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href='#contact' class="w3-bar-item w3-button">Contact</a>
      <a href="index.php" class="w3-bar-item w3-button">Log Out</a></h4>

    </div>
  </div>
</div>
<div style="width: 800px;height: 600px;margin: 30px auto;text-align: center">
    <h1>Chat Page</h1>
    <div style="width: 800px;border: 1px solid gray;height: 300px;">
        <div style="width: 200px;height: 300px;float: left;text-align: left;">
            <p><span>Online:</span><span id="user_num">0</span></p>
            <div id="user_list" style="overflow: auto;">
            </div>
        </div>
        <div id="msg_list" style="width: 598px;border:  1px solid gray; height: 300px;overflow: scroll;float: left;">
        </div>
    </div>
    <br>
    <textarea id="msg_box" rows="6" cols="50" onkeydown="confirm(event)"></textarea><br>
    <input type="button" value="send" onclick="send()">

</div>
</body>

</html>

<script type="text/javascript">
    var uname = "<?php echo $username;?>"+'%'+ uuid(8, 16);
    console.log(uname);
    if (<?php echo json_encode($ifR);?>){
        window.toWho = '';
    }else{
        window.toWho = "<?php echo $chat_restaurant;?>"+'%'+ uuid(8, 16);
    }
   // var uname = prompt('请输入用户名', 'user' + uuid(8, 16));
    var ws = new WebSocket("ws://192.17.90.133:1234");
    ws.onopen = function () {
        var data = "Link Sucessed!";
        console.log(ws);
        listMsg(data);
    };
    /**
     * 
     * 
     * 
     */
    ws.onmessage = function (e) {
        var msg = JSON.parse(e.data);
        
        var sender, user_name, name_list, change_type,toUser=null;
        var MeToUser = false;
        switch (msg.type) {
            case 'system':
                sender = 'system: ';
                break;
            case 'user':
                toUser = msg.to ;
                console.log(window.toWho);
                window.toWho = msg.from;
                sender = msg.from + ': ';
                break;
            case 'handshake':
                toUser = null;
                var user_info = {'type': 'login', 'content': uname,'to':window.toWho};
                sendMsg(user_info);
                return;
            case 'login':
            case 'logout':
                toUser = null;
                user_name = msg.content;
                name_list = msg.user_list;
                change_type = msg.type;
                dealUser(user_name, change_type, name_list);
                return;
        }
        var data = sender + msg.content;
        
        listMsg(data);
    };
    ws.onerror = function () {
        var data = "Soory! Something wrong, please try again";
        listMsg(data);
    };
    /**
     * 
     *
     * @param event
     *
     * @returns {boolean}
     */
    function confirm(event) {
        var key_num = event.keyCode;
        if (13 == key_num) {
            send();
        } else {
            return false;
        }
    }
    /*
    *
    *  @param string
    *
    */
    function cutuuid(input_string){
        var the_index = input_string.indexOf('%');
        return (input_string.substring(0,the_index));
    }
    
    
    /**
     * 
     */
    function send() {
        var msg_box = document.getElementById("msg_box");
        var content = msg_box.value;
        var reg = new RegExp("\r\n", "g");
        content = content.replace(reg, "");
        console.log(this.toWho);
        listMsg(uname+content);
        var msg = {'content': content.trim(), 'type': 'user','to':window.toWho};
        sendMsg(msg);
        msg_box.value = '';
    }
    /**
     */
    function listMsg(data) {
        var msg_list = document.getElementById("msg_list");
        var msg = document.createElement("p");
        msg.innerHTML = data;
        msg_list.appendChild(msg);
        msg_list.scrollTop = msg_list.scrollHeight;
    }
    /*
    *
    *@param username
    *
    */
    
    function switch_chatter(theusername){
        var msg = {'content': 'switch', 'type': 'switch','to':theusername};
        sendMsg(msg);
    }
    
    
    /**
     * 
     *
     * @param user_name 
     * @param type  login/logout
     * @param name_list 
     */
    function dealUser(user_name, type, name_list) {
        var user_list = document.getElementById("user_list");
        var user_num = document.getElementById("user_num");
        while(user_list.hasChildNodes()) {
            user_list.removeChild(user_list.firstChild);
        }
        if(!<?php echo json_encode($if_R);?>){
            var usertab = document.createElement("div");
            usertab.className = "tab";
            var usert = document.createElement("button");
            usert.className = "tablinks";
            usert.innerHTML = cutuuid(window.toWho);
            usertab.appendChild(usert);
            user_list.appendChild(usertab);
        }else{
        for (var index in name_list) {
            if (cutuuid(name_list[index]) != cutuuid(this.uname)){
            var usertab = document.createElement("div");
            usertab.className = "tab";
            var usert = document.createElement("button");
            usert.className = "tablinks";
            usert.innerHTML = cutuuid(name_list[index]);
            usert.onclick = function(){
                switch_chatter(cutuuid(name_list[index]));
            };
            usertab.appendChild(usert);
            user_list.appendChild(usertab);
            }
        }
        }
        user_num.innerHTML = name_list.length;
        user_list.scrollTop = user_list.scrollHeight;
        var change = type == 'login' ? 'on' : 'off';
        var data = 'System: ' + user_name + ' has' + change;
        listMsg(data);
    }
    /**
     * 
     * @param msg
     */
    function sendMsg(msg) {
        var data = JSON.stringify(msg);
        ws.send(data);
    }
    /**
     *
     * @param len
     * @param radix
     * @returns {string}
     */
    function uuid(len, radix) {
        var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
        var uuid = [], i;
        radix = radix || chars.length;
        if (len) {
            for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random() * radix];
        } else {
            var r;
            uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
            uuid[14] = '4';
            for (i = 0; i < 36; i++) {
                if (!uuid[i]) {
                    r = 0 | Math.random() * 16;
                    uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
                }
            }
        }
        return uuid.join('');
    }
</script>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32" >

   <h5 style="text-align:center">Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green" ><br></br>Wiki Page</a></h5>

</footer>

</html>