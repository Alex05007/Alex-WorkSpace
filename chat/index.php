<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo "<title>Alex Chat - " . $_COOKIE['un'] . "</title>" ?>
  <link rel="icon" href="../logo/chat.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header('Location: http://gnets.myds.me/work/');
		die();
	}
	//if ($_COOKIE['id2'] != $_GET['id2']) {
	if ($_GET['id2'] != "" or $_GET['id2'] != "no") {
		setcookie("id2", $_GET['id2'], time() + 3600);
	}
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$myId = $_COOKIE['login'];
	if ($_GET['id2'] == "") {
		header("Location: ?id2=no");
	}
	$sql = "UPDATE chat SET citit = 'true' WHERE deLa = '" . $_GET['id2'] . "' and catre = '" . $myId . "' and citit='false'";
	$stmt = $conn->query($sql);
?>

<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
.input-data{
  margin-bottom: 10px;
  height: 40px;
  width: 100%;
  position: relative;
}
.input-data input:focus ~ label,
.input-data input:valid ~ label{
  transform: translateY(-20px);
  font-size: 15px;
  color: #09F;
}
.input-data label{
  position: absolute;
  bottom: 10px;
  left: 0;
  color: grey;
  pointer-events: none;
  transition: all 0.3s ease;
}
.input-data .underline:before{
  position:absolute;
  content: "";
  height: 100%;
  width: 100%;
  background: #09F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
.input-data input{
  background-color:transparent;
  height: 100%;
  width: 100%;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
  transition:all 0.5s;
}
.input-data .underline{
	transition:all 0.5s;
  position: absolute;
  height: 2px;
  width: 100%;
  bottom: 0px;
}
#sendButton {
	position:absolute;
	opacity:0;
	transform:translateX(50%);
	transition:all 0.5s;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  width:90%;
  transform: scaleX(1);
}
.input-data input:focus, .input-data input:valid {
	width:90% !important;
}
.input-data input:focus ~ #sendButton, .input-data input:valid ~ #sendButton {
	opacity:1;
	transform:translateX(0%);
}


@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
.myChat {
  font: 14px/20px "Lato", Arial, sans-serif;
  padding: 40px 0;
}
.people-list .search {
  padding: 20px;
}
.people-list input {
  border-radius: 3px;
  border: none;
  padding: 14px;
  color: white;
  background: #6A6C75;
  width: 90%;
  font-size: 14px;
}
.people-list .fa-search {
  position: relative;
  left: -25px;
}
.people-list ul li {
  padding-bottom: 20px;
}
.people-list img {
  float: left;
}
.people-list .about {
  float: left;
  margin-top: 8px;
}
.people-list .about {
  padding-left: 8px;
}
.people-list .status {
  color: #92959E;
}

.chat {
  width: 490px;
  float: left;
  height: 800px;
  background: #F2F5F8;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  color: #333;
  z-index:-1;
}
.chat .chat-header img {
  float: left;
}
.chat .chat-header .chat-about {
  float: left;
  padding-left: 10px;
  margin-top: 6px;
}
.chat .chat-header .chat-with {
  font-weight: bold;
  font-size: 16px;
}
.chat .chat-header .chat-num-messages {
  color: #92959E;
}
.chat .chat-header .fa-video {
  float: right;
  margin-top: 30px;
}
.chat-header .fa-video {
  color:#666;
  font-size: 20px;
  transition:all 0.3s ease-in-out;
}
.chat-header .fa-video:hover {
	color:#09F;
}
.chat .chat-history .message-data-time {
  color: #a8aab1;
  padding-left: 6px;
  margin-bottom:-10px;
}
.chat .chat-history .message {
  color: white;
  padding: 4px 10px;
  line-height: 26px;
  font-size: 16px;
  border-radius: 20px;
  width: 80% !important;
  position: relative;
  transition:all ease-in-out 0.3s;
  white-space: pre-wrap;
}
.chat .chat-history .message {
	width:100%;
	overflow:auto;
}
::-webkit-scrollbar-track {
  background-color:transparent !important; 
}
.message:hover {
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
}
.message i {
	float:right;
	color:#F00;
	transform:translateY(70%);
	opacity:0;
	transition:all 0.3s;
	display:none;
}
.message:hover i {
	transform:translateY(0%);
	opacity:1;
}
.chat .chat-history .my-message {
  background: #86BB71;
  width:inherit;
}
.chat .chat-history .other-message {
  background: #94C2ED;
}
.chat .chat-history .other-message:after {
  border-bottom-color: #94C2ED;
  left: 93%;
}
.chat .chat-message {
  padding: 10px 30px;
}
.chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
  font-size: 16px;
  color: gray;
  cursor: pointer;
}
.chat .chat-message .but {
  float: right;
	color:#666;
	background-color:transparent;
	font-size:18px;
	padding:10px;
	border-radius:10px;
	transition: all 0.3s ease-in-out;
}
.chat .chat-message .but:hover {
	color:#09F;
	font-size:20px;
	transform:translate(10%,-10%);
}

.online, .offline, .me {
  margin-right: 3px;
  font-size: 10px;
}

.online {
  color: #86BB71;
}

.offline {
  color: #E38968;
}

.me {
  color: #94C2ED;
}

.align-left {
  text-align: left;
}

.align-right {
  text-align: right;
}

.float-right {
  float: right;
}

.clearfix:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}
.refresh {
	transform:rotate(0deg);
	transition:all 0.5s ease-in-out;
}
.refresh:hover {
	transform:rotate(360deg);
}
.contact {
	border-radius:16px;
	box-shadow:none;
	padding:2px;
	transform:scale(1,1);
	transition:all ease-in-out 0.3s;
	z-index:2;
}
.contact:hover {
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
	transform:scale(1.1,1.1);
	z-index:999;
}
.contact .butt {
	margin-top:10px;
	margin-right:10px;
	font-size:18px;
	display:none;
	float:right;
}
.contact:hover .butt {
	display:block;
}
.contactSelected {
	border-radius:5px;
	padding:2px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
	background-color:#FFF;
	z-index:999;
}
	
.img {
	border-radius:16px;
	box-shadow:none;
	padding:10px;
	transform:scale(1,1);
	transition:all ease-in-out 0.3s;
}
.img:hover {
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
	transform:scale(1.1,1.1);
}
@keyframes chat {
	0% {
		transform:translateX(0%);
		opacity:1;
	}
	100% {
		transform:translateX(300%);
		opacity:0;
	}
}

@media screen and (min-width: 721px) {
	.chat .chat-history .message-data {
		margin:15px;
	}
	.continer2 {
	  background: rgba(204,204,204,0.1);
	  border-radius: 10px;
	  box-shadow:5px 10px 25px #CCC;
	  color:#333;
	  width:750px;
	  height:800px;
	  margin-left:auto;
	  margin-right:auto;
	  margin-top:50px;
	  background-color: rgba(234,234,234,1);
	}
	.chat {
	  width: 490px;
	  float: left;
	  height: 800px;
	  background: #F2F5F8;
	  border-top-right-radius: 5px;
	  border-bottom-right-radius: 5px;
	  color: #333;
	  z-index:-1;
	}
	.people-list {
	  width: 260px;
	  float: left;
	}
	.smiley {
		width:85%;
		height:50px;
		font-size:24px;
		overflow:auto;
		float:right;
	}
	.file {
		font-size:20px;
	}
	.chat .chat-history {
	  padding: 30px 30px 20px;
	  border-bottom: 2px solid white;
	  overflow-y: scroll;
	  height: 575px;
	}
	.chat .chat-header {
	  padding: 20px;
	  border-bottom: 2px solid white;
	}
	.people-list ul {
	  padding: 20px;
	  height: 650px;
	  overflow: auto;
	}
}
@media screen and (max-width: 721px) {
	.chat .chat-history .message-data {
		margin:10px;
	}
	.continer2 {
	  background: rgba(204,204,204,0.1);
	  border-radius: 10px;
	  box-shadow:5px 10px 25px #CCC;
	  color:#333;
	  width:450px;
	  height:600px;
	  margin-left:auto;
	  margin-right:auto;
	  margin-top:50px;
	  background-color: rgba(234,234,234,1);
	}
	.chat {
	  width: 300px;
	  float: left;
	  height: 478px;
	  background: #F2F5F8;
	  color: #333;
	  z-index:-1;
	}
	.people-list {
	  width: 150px;
	  float: left;
	}
	.people-list .list a {
		width:4ch;
		overflow: hidden;
		white-space: nowrap;
	}
	.smiley {
		width:70%;
		height:50px;
		float:right;
		font-size:24px;
		overflow:auto;
	}
	.input-data input{
		background-color:transparent;
	  height: 100%;
	  width: 80%;
	  border: none;
	  font-size: 17px;
	  border-bottom: 2px solid silver;
	}
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 80%;
	  bottom: 0px;
	}
	.chat .chat-history {
	  padding: 30px 30px 20px;
	  border-bottom: 2px solid white;
	  overflow-y: scroll;
	  height: 400px;
	}
	.list {
		height:450px !important;
	}
	.chat .chat-header {
	  padding: 5px;
	  border-bottom: 2px solid white;
	}
	.people-list ul {
	  padding: 20px;
	  height: 30px;
	  overflow: auto;
	}
}
.smiley a {
	text-decoration:none;
	transition:all 0.3s;
	transform:rotate(0deg);
}
.smiley a:hover {
	transform:rotate(360deg);
}

.mdc-button {
	font-size:24px;
	--mdc-theme-primary:#09F;
	--mdc-theme-secondary:#333;
	--mdc-theme-background:#09F;
	--mdc-theme-surface:#09F;
	text-transform: none;
}
.chat .chat-history {
	transition:all 0.5s;
}
hr {
	color: #FFF;
}
</style>
  
<script>
function getCookie(name) {
    var cookieArr = document.cookie.split(";");
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if(name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}
function setCookie(name, value, daysToLive) {
    var cookie = name + "=" + encodeURIComponent(value);
    if(typeof daysToLive === "number") {
        cookie += "; max-age=" + (daysToLive*24*60*60);
        document.cookie = cookie;
    }
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
  function send() {
	  var mesaj = document.getElementById('message-to-send').value;
	  var id = getUrlVars()["id"];
	  var id2 = getUrlVars()["id2"];
	  if (mesaj != "" && mesaj.includes("<script>") == false) {
		$.ajax
		  ({
			type: "POST",
			url: "send.php",
			data: { "id2": id2, "mesaj": mesaj, "fa": "send" }
		  });
		$('#historychat').load('chat.php?id2=' + getUrlVars()["id2"])
		document.getElementById('chatscroll').scrollTop = document.getElementById('chatscroll').scrollHeight;
		document.getElementById('message-to-send').value = "";
		mesaj("The message was sent.");
		//setCookie("send", "true", 1);
	  }
  }
  function video() {
	  var id = getUrlVars()["id"];
	  var id2 = getUrlVars()["id2"];
	  if (id2 != "" || id2 != "no") {
		  var meeting = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
		  var mesaj = "alexvideo" + meeting;
		  if (mesaj != "") {
			$.ajax
			  ({
				type: "POST",
				url: "send.php",
				data: { "id2": id2, "mesaj": mesaj}
			  });
			$('#historychat').load('chat.php?id2=' + getUrlVars()["id2"])
			document.getElementById('chatscroll').scrollTop = document.getElementById('chatscroll').scrollHeight;
		  }
	  }
  }
  function video2(id2) {
	  var id = getCookie("login");
	  if (id2 != "" && id2 != "no" && id2 != null) {
		  var meeting = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
		  var mesaj = "alexvideo" + meeting;
		  if (mesaj != "") {
			$.ajax
			  ({
				type: "POST",
				url: "send.php",
				data: { "id2": id2, "mesaj": mesaj}
			  });
		    location.assign("../video/?id=" + meeting);
		  }
	  }
  }
  function files() {
	  var id = getCookie("login");
	  var id2 = getUrlVars()["id2"];
	  var mesaj = "";
	  var i;
	  var files = document.getElementsByName('files');
	  for (i=0; i<files.length; i++) {
		  if (files[i].checked == true) {
			  if (files[i].value.includes("forms")) {
			  	mesaj = mesaj + "<a href='http://gnets.myds.me/work/?" + files[i].value + "'><img src='../logo/forms.png' width='40px'></a><br />";
			  }
			  if (files[i].value.includes("text")) {
			  	mesaj = mesaj + "<a href='http://gnets.myds.me/work/?" + files[i].value + "'><img src='../logo/text.png' width='40px'></a><br />";
			  }
			  if (files[i].value.includes("slides")) {
			  	mesaj = mesaj + "<a href='http://gnets.myds.me/work/?" + files[i].value + "'><img src='../logo/slides.png' width='40px'></a><br />";
			  }
		  }
	  }
	  var d = new Date();
	  if (d.getMinutes().toString().length == 1) {
		  if (d.getSeconds().toString().length == 1) {
			  var timp = d.getFullYear() + ":" + d.getMonth() + ":" + d.getDate() + ":" + d.getHours() + ":0" + d.getMinutes() + ":0" + d.getSeconds() + ":" + d.getMilliseconds();
			  var ora = d.getHours() + ":0"  + d.getMinutes();
		  }
		  else {
			  var timp = d.getFullYear() + ":" + d.getMonth() + ":" + d.getDate() + ":" + d.getHours() + ":0" + d.getMinutes() + ":" + d.getSeconds() + ":" + d.getMilliseconds();
			  var ora = d.getHours() + ":0"  + d.getMinutes();
		  }
	  }
	  else {
		  if (d.getSeconds().toString().length == 1) {
			  var timp = d.getFullYear() + ":" + d.getMonth() + ":" + d.getDate() + ":" + d.getHours() + ":" + d.getMinutes() + ":0" + d.getSeconds() + ":" + d.getMilliseconds();
			  var ora = d.getHours() + ":"  + d.getMinutes();
		  }
		  else {
			  var timp = d.getFullYear() + ":" + d.getMonth() + ":" + d.getDate() + ":" + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + ":" + d.getMilliseconds();
			  var ora = d.getHours() + ":"  + d.getMinutes();
		  }
	  }
	  if (mesaj != "") {
		$.ajax
		  ({
			type: "POST",
			url: "send.php",
			data: { "id2": id2, "mesaj": mesaj}
		  });
		$('#historychat').load('chat.php?id2=' + getUrlVars()["id2"])
		document.getElementById('chatscroll').scrollTop = document.getElementById('chatscroll').scrollHeight;
	  }
  }


function startLoad() {
	$('#historychat').load('chat.php?id2=' + getUrlVars()["id2"]);
	document.getElementById('chatscroll').scrollTop = document.getElementById('chatscroll').scrollHeight;
	enter();
	setInterval(function () {
		$('#historychat').load('chat.php?id2=' + getUrlVars()["id2"]);
		//document.getElementById('chatscroll').scrollTop = document.getElementById('chatscroll').scrollHeight;
	}, 5000);
}
function enter() {
	$('#chat').keypress(function(event) {
		if (event.which == 13) {
			send();
		} 
	});
}
function searchContacts() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("searchinput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("contacts");
    li = ul.getElementsByClassName('mycontact');
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("div")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}


$(document).ready(function() {
	$('#historychat').load('chat.php?id2=' + getUrlVars()["id2"])
	document.getElementById('chatscroll').scrollTop = document.getElementById('chatscroll').scrollHeight;
});
</script>

<body onload="startLoad()">
	<?php
		include "../nav.php";
	?>
  <div class="continer2 clearfix">
    <div class="people-list" id="people-list">
      <div class="search">
      	<h4>My contacts</h4>
        <input type="text" id="searchinput" required="required" onkeyup="searchContacts()" placeholder="Search ..."/>
      	<?php
			$b = 0;
			$mes=false;
			$id_not_friend = array();
			$citit = "SELECT * FROM chat WHERE (catre='" . $myId . "' or deLa='" . $myId . "') and citit='false'";
			$citi = $conn->query($citit);

			while ($cit = $citi->fetch()) {
				if ($mes==false and $cit['catre'] == $myId and $row['deLa'] != $myId) {
					$mes=true;
					echo "<div class='status'>
						<i class='fa fa-circle online'><font style='color:#F00;'> You have unreaded messages!</font></i>
					</div>";
				}
				
				if ($cit['catre'] == $myId and strpos(implode($id_not_friend), $cit['deLa']) === false) {
					$id_not_friend[$b] = $cit['deLa'];
					$b++;
				}
				/*if ($cit['deLa'] == $myId and strpos(implode($id_not_friend), $cit['catre']) === false) {
					$id_not_friend[$b] = $cit['catre'];
					$b++;				
				}*/
			}
		?>
        </div>
      <ul class="list" id="contacts">
          <?php
		    $sunt_contacte = false;
		    $pr = $_COOKIE['p'];
		    $id2 = $_GET['id2'];
			$sql = "SELECT * FROM conturi WHERE prieteni LIKE '%{$myId}%' or Id='" . $id2 . "' ";
			for ($i=0; $i<count($id_not_friend); $i++) {
				$sql .= "or Id='" . $id_not_friend[$i] . "'";
			}
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
		    	$sunt_contacte = true;
				if ($row['Id'] == $id2) {
					$culoareId2 = $row['culoare'];
					$numeId2 = $row['username'];
					echo "<div class='mycontact'><a href='?id=" . $_COOKIE['login'] . "&id2=" . $row['Id'] . "' style='color:#FFF; text-decoration:none;'><li class='clearfix'><img src='https://eu.ui-avatars.com/api/?background=" . $row['culoare'] . "&color=fff&name=" . $row['username'] . "&size=40&rounded=true' alt='avatar' /><div class='about'><div class='name contactSelected' style='color:#000; font-size:17px;'>" . $row['username'] . "</div></div></li></a></div>";
				}
				else {
					echo "<div class='mycontact'><a href='?id2=" . $row['Id'] . "' style='color:#FFF; text-decoration:none;'><div class='contact'><li class='clearfix'><img src='https://eu.ui-avatars.com/api/?background=" . $row['culoare'] . "&color=fff&name=" . $row['username'] . "&size=40&rounded=true' alt='avatar' /><div class='about'><div class='name' style='color:#000; font-size:17px;'>" . $row['username'] . "</div></div>";
					echo '<a href="javascript:video2(\'' . $row['Id'] . '\')" class="butt"><i class="fas fa-video"></i></a>';
					echo "</li></div></a></div>";
				}
			}
			if ($sunt_contacte == false) {
				echo "<div style='text-align:center;'>
						<i class='fas fa-users' style='font-size:50px;'></i>
						<h2>Hopa</h2>
						<p>You don't have any friends to chat</p>
						<p>Invite them using <a href='https://alexs.gq/i#" . $_COOKIE['login'] . "'>this link</a></p>
					  </div>";
			}
			echo "<hr />";
			$sql = "SELECT * FROM grup WHERE participanti LIKE '%{$myId}%' or Creator='" . $myId . "' ";
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
				echo "<div class='mycontact'><a href='?g=" . $row['id'] . "' style='color:#FFF; text-decoration:none;'><div class='contact'><li class='clearfix'><img src='https://eu.ui-avatars.com/api/?background=" . $row['culoare'] . "&color=fff&name=" . $row['nume'] . "&size=40&rounded=true' alt='avatar' /><div class='about'><div class='name' style='color:#000; font-size:17px;'>" . $row['username'] . "</div></div>";
				echo '<a href="javascript:video2(\'' . $row['id'] . '\')" class="butt"><i class="fas fa-video"></i></a>';
				echo "</li></div></a></div>";
			}
			?>
			<button class="mdc-button" data-toggle='modal' data-target='#newGroup'>
				<span class="mdc-button__ripple"></span>
				<span class="mdc-button__label"><i class='fas fa-users'></i> New Group</span>
		 	</button>
      </ul>
    </div>

    <div class="chat" id="chat">
      <div class="chat-header clearfix">
        <div class="chat-about img">
          <?php
		  	if ($id2 == "no") {
				echo "<img src='https://eu.ui-avatars.com/api/?background=09F&color=fff&name=&size=40&rounded=true' />";
			}
			else {
				echo "<img src='https://eu.ui-avatars.com/api/?background=" . $culoareId2 . "&color=fff&name=" . $numeId2 . "&size=40&rounded=true' /><div class='chat-about chat-with' style='color:#000;'>" . $numeId2 . "</div>";
			}
			?>
        </div>
        <a href="javascript:video()" class="but"><i class="fas fa-video"></i></a>
      </div>
      <div class="chat-history" id="chatscroll">
        <ul>
        	<div id="historychat"></div>
          </ul>
      </div>

      <div class="chat-message clearfix">
      	<?php
			if ($_GET['id2'] == "no" or $_GET['id2'] == "") {
      			echo "
					<div class='input-data'>
					<input type='text' id='message-to-send' required maxlength='99' autocomplete='off' disabled='disabled'>
					<div class='underline'></div>
					<label>Message ...</label>
					<button class='mdc-button' onclick='javascript:send()'  id='sendButton'>
					   <span class='mdc-button__ripple'></span>
					   <span class='mdc-button__label'><i class='far fa-paper-plane'></i></span>
					</button></div>";
				echo "<script>setTimeout(function(){document.getElementById('smiley').style.display='none';} , 1);</script>";
			} else {
      			echo "
					<div class='input-data'>
					<input type='text' id='message-to-send' required maxlength='99' autocomplete='off' onkeydown='enter()'>
					<div class='underline'></div>
					<label>Message ...</label>
					<button class='mdc-button' onclick='javascript:send()'  id='sendButton'>
					   <span class='mdc-button__ripple'></span>
					   <span class='mdc-button__label'><i class='far fa-paper-plane'></i></span>
					</button></div>";
				echo "<script>setTimeout(function(){document.getElementById('smiley').style.display='block';} , 1);</script>";
			}
		?>
        <button class="mdc-button" data-toggle='modal' data-target='#file'>
           <span class="mdc-button__ripple"></span>
           <span class="mdc-button__label"><i class='fas fa-upload'></i></span>
        </button>
        <div class="smiley" id="smiley">
            <?php
                for ($i=128512; $i<128580; $i=$i+4) {
                    $r = $i+1;
                    $s = $i+2;
                    $t = $i+3;
                    echo "<a href='?smiley=" . $i . "'>&#" . $i . ";</a>";
                    echo "<a href='?smiley=" . $r . "'>&#" . $r . ";</a>";
                    echo "<a href='?smiley=" . $s . "'>&#" . $s . ";</a>";
                    echo "<a href='?smiley=" . $t . "'>&#" . $t . ";</a>";
                }
                for ($i=129296; $i<129301; $i=$i+4) {
                    $r = $i+1;
                    $s = $i+2;
                    $t = $i+3;
                    echo "<a href='?smiley=" . $i . "'>&#" . $i . ";</a>";
                    echo "<a href='?smiley=" . $r . "'>&#" . $r . ";</a>";
                    echo "<a href='?smiley=" . $s . "'>&#" . $s . ";</a>";
                    echo "<a href='?smiley=" . $t . "'>&#" . $t . ";</a>";
                }
                for ($i=129312; $i<129327; $i=$i+4) {
                    $r = $i+1;
                    $s = $i+2;
                    $t = $i+3;
                    echo "<a href='?smiley=" . $i . "'>&#" . $i . ";</a>";
                    echo "<a href='?smiley=" . $r . "'>&#" . $r . ";</a>";
                    echo "<a href='?smiley=" . $s . "'>&#" . $s . ";</a>";
                    echo "<a href='?smiley=" . $t . "'>&#" . $t . ";</a>";
                }
                echo "<a href='?smiley=129488'>&#129488;</a>";
            ?>
        </div>
      </div>
    </div> 
  </div>
  
  <p style="bottom:5px; display: flex ;justify-content: center; align-items: center;">&copy; Alex Sofonea - 2020 - AlexChat</p>
  
  <div id="file" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose a file to send</h4>
      </div>
      <div class="modal-body">
			<?php
				$sunt_files = false;
				$a=0;
                $hostname = 'localhost:3307';
                include "../db.php";
                try {
                    $conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
				$sql = "SELECT * FROM forms WHERE TestCreator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$sunt_files = true;
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="forms=' . $row['Id'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><img src="../logo/forms.png" width="20px"> ' . $row['Titlu'] . '</label>
					</div><br />';
				}
				
                $hostname = 'localhost:3307';
                include "../db.php";
                try {
                    $conn = new PDO("mysql:host=$hostname;dbname=alextext", $username, $password);
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
				$sql = "SELECT * FROM documente WHERE Creator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$sunt_files = true;
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="text=' . $row['Id'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><img src="../logo/text.png" width="20px"> ' . $row['Titlu'] . '</label>
					</div><br />';
				}
				
                $hostname = 'localhost:3307';
                include "../db.php";
                try {
                    $conn = new PDO("mysql:host=$hostname;dbname=alexslides", $username, $password);
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
				$sql = "SELECT * FROM prezentari WHERE Creator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$sunt_files = true;
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="slides=' . $row['Id'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><img src="../logo/slides.png" width="20px"> ' . $row['Titlu'] . '</label>
					</div><br />';
				}
				if ($sunt_files == false) {
					echo "<div style='text-align:center;'>
							<i class='far fa-folder-open' style='font-size:50px;'></i>
							<h2>Hopa</h2>
							<p>You don't have any files to send!</p>
							<p>Go to Alex Forms, Alex Text or Alex Slides to create and share them</p>
						  </div>";
				} else {
					echo "<a class='mdc-button' href='javascript:files()' style='float:right; text-decoration:none;'>
						  <span class='mdc-button__ripple'></span>
						  <span class='mdc-button__label'>Send</span>
						</a>";
				}
			?>
            <br /><br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  
  <div id="newGroup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New group</h4>
      </div>
      <div class="modal-body">
		<div class='input-data'>
		<input type='text' id='message-to-send' required maxlength='99' autocomplete='off' onkeydown='enter()'>
		<div class='underline'></div>
		<label>Name</label>
		<button class='mdc-button' onclick='javascript:newGroup()'  id='sendButton'>
			<span class='mdc-button__ripple'></span>
			<span class='mdc-button__label'><i class='far fa-plus'></i></span>
		</button></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>
