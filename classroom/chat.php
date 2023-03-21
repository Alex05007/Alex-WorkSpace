<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alex Classroom</title>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link rel="icon" href="../logo/class.png" />
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header("Location: http://gnets.myds.me/work");
		die();
	}
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$myId = $_COOKIE['login'];
	if ($_GET['mesaj'] != "") {
		$sql = "INSERT INTO chat (classid, Id, un, mesaj, data, ora) VALUES ('" . $_GET['classid'] . "', '" . $myId . "', '" . $_COOKIE['un'] . "', '" . openssl_encrypt($_GET['mesaj'],"AES-128-ECB",$_GET['classid']) . "', '" . $_GET['data'] . "', '" . $_GET['ora'] . "')";
		$stmt = $conn->query($sql);
		header("Location: chat.php?classid=" . $_GET['classid']);
		die();
	}
	if ($_GET['fa'] == "leave") {
		echo "<script>
		setTimeout(funtion() {
			var r = confirm('Are you sure that you want to leave the class?');
			if (r == false) {
				location.assign('chat.php?classid=" . $_GET['classid'] . "');
			}
		}, 1);
		</script>";
		$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			$st = str_replace($_COOKIE['login'] . "," . $_COOKIE['un'] . ";", "", $row['Students']);
			if ($row['Professor'] == $_COOKIE['login']) {
				$sql = "DELETE FROM `class` WHERE Id='" . $_GET['classid'] . "'";
				$stmt = $conn->query($sql);
				$sql = "DELETE FROM `chat` WHERE classid='" . $_GET['classid'] . "'";
				$stmt = $conn->query($sql);
				$sql = "DELETE FROM `assigments` WHERE classid='" . $_GET['classid'] . "'";
				$stmt = $conn->query($sql);
				$sql = "DELETE FROM `marks` WHERE classid='" . $_GET['classid'] . "'";
				$stmt = $conn->query($sql);
				$sql = "DELETE FROM `grades` WHERE classid='" . $_GET['classid'] . "'";
				$stmt = $conn->query($sql);
			}
			else {
				$sql = "UPDATE `class` SET Students='" . $st . "' WHERE Id='" . $_GET['classid'] . "'";
				$stmt = $conn->query($sql);
				$sql = "DELETE FROM `marks` WHERE classid='" . $_GET['classid'] . "' and studentid='" . openssl_encrypt($_COOKIE['un'],"AES-128-ECB", $_GET['classid']) . "'";
				$stmt = $conn->query($sql);
				$sql = "DELETE FROM `grades` WHERE classid='" . $_GET['classid'] . "' and student='" . openssl_encrypt($_COOKIE['un'],"AES-128-ECB", $_GET['classid']) . "'";
				$stmt = $conn->query($sql);
			}
			header("Location: ../indexLog.php");
			die();
		}
	}
	$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
	$stmt = $conn->query($sql);
	if ($row = $stmt->fetch()) {$students = $row['Students'] . ";" . $row['Professor'];}
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$sql = "SELECT * FROM conturi";
	$stmt = $conn->query($sql);
	$culori = array();
	while ($row = $stmt->fetch()) {
		$culori[$row['username']] = $row['culoare'];
	}
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
  height: 40px;
  width: 100%;
  position: relative;
}
.input-data input:focus ~ label,
.input-data input:valid ~ label{
  transform: translateY(-20px);
  font-size: 15px;
  color: #06F;
}
.input-data label{
  position: absolute;
  bottom: 10px;
  left: 0;
  color: grey;
  pointer-events: none;
  transition: all 0.3s ease;
}
.input-data .underline{
  position: absolute;
  height: 2px;
  width: 100%;
  bottom: 0px;
}
.input-data .underline:before{
  position:absolute;
  content: "";
  height: 100%;
  width: 100%;
  background: #06F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}
.title h1 {
	color:#FFF;
}
.title h4 {
	color:#CCC;
}
.title .links {
	text-align:center;
	margin-bottom:10px;
}
.title .links a {
	color:#FFF;
	text-decoration:none !important;
	font-size:18px;
	margin-top:80%;
	margin-right:20px;
}
.assigment date {
	font-size:16px;
	color:#CCC;
}
.assigment h4 {
	color:#000;
}
.marks date {
	font-size:16px;
	color:#CCC;
}
.marks h4 {
	color:#000;
}
.create {
	text-decoration:none !important;
	padding:10px 20px 10px 20px;
	background-color:#1a73e8;
	border-radius:25px;
	transition:all 0.3s;
	color:#FFF;
	font-size:15px;
	float:right;
}
.create i {
	padding-right:10px;
	font-size:20px;
}
.create:hover {
	background-color:#1a73e8;
	color:#FFF;
	box-shadow:1px 1px 30px #1a73e8;
}
.col1 {
	float:left;
	width:35%;
}
.col2 {
	float:right;
	width:65%;
}
.col2 .chat {
	height:400px;
	width:100%;
	overflow-y:scroll;
	overflow-x:hidden;
}
footer {
	float:left;
	width:100%;
}
footer p {
	margin: 0;
	position: absolute;
	left: 50%;
	-ms-transform: translateX(-50%);
	transform: translateX(-50%);
}
.comment {
	background-color:#FFF;
	width:540px;
	border-radius:16px;
	padding:10px 20px;
	border:1px solid #CCC;
}
.comment .me {
	line-height: 10%;
}
.comment .me img {
	margin-top:13px;
}
.comment .me svg {
	margin-top:15px;
	float:right;
	color:#000;
	transition:all 0.3s;
}
.comment .me svg:hover {
	background-color:rgba(0,0,0,0.1);
	color:#000;
	border-radius:100px;
}
.invite {
	background-color:transparent;
	font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New;
	border:1px solid #666;
	border-radius:16px;
	padding:10px;
}
.class .title a {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
	margin:10px;
}
.class .title a:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	margin:0px;
}
#inv {
	margin-left:15px;
}
#inv:hover {
	margin-left:5px;
}

@media only screen and (min-width: 761px) {
	.title {
		width:900px;
		padding:20px;
		background-position: right bottom;
	}
	.assigment {
		background-color:#FFF;
		width:300px;
		height:200px;
		border-radius:16px;
		padding:20px;
		border:1px solid #CCC;
		overflow:auto;
	}
	.comment {
		background-color:#FFF;
		width:540px;
		border-radius:16px;
		padding:10px 20px;
		border:1px solid #CCC;
	}
	.input-data input{
	  height: 100%;
	  width: 500px;
	  border: none;
	  font-size: 17px;
	  border-bottom: 2px solid silver;
	}
	.marks {
		background-color:#FFF;
		width:300px;
		height:100px;
		border-radius:16px;
		padding:20px;
		border:1px solid #CCC;
		overflow:hidden;
	}
	.class {
		padding:0px 100px;
	  margin: 0;
	  position: absolute;
	  left: 50%;
	  -ms-transform: translateX(-50%);
	  transform: translateX(-50%);
	}
	.col1 {
		float:left;
		width:35%;
	}
	.col2 {
		float:right;
		width:65%;
	}
}
/*mobile*/
@media only screen and (max-width: 761px) {
	.title {
		width:100%;
		padding:5px;
		margin-bottom:20px;
		background-position: right bottom;
	}
	.title h4 {
		color:#FFF !important;
	}
	.title h4 input {
		color:#FFF !important;
	}
	.title img {
		width:30px !important;
	}
	.assigment {
		background-color:#FFF;
		width:90%;
		height:200px;
		border-radius:16px;
		padding:5px;
		border:1px solid #CCC;
		overflow:auto;
	}
	.comment {
		background-color:#FFF;
		width:90%;
		border-radius:16px;
		padding:10px 20px;
		border:1px solid #CCC;
	}
	.comment svg {
		display:none;
	}
	.input-data input{
	  height: 100%;
	  width: 100%;
	  border: none;
	  font-size: 17px;
	  border-bottom: 2px solid silver;
	}
	.marks {
		background-color:#FFF;
		width:90%;
		height:100px;
		border-radius:16px;
		padding:5px;
		border:1px solid #CCC;
		overflow:hidden;
	}
	.class {
		padding:10px;
	}
	.col1 {
		float:left;
		width:45%;
	}
	.col2 {
		float:right;
		width:55%;
	}
}
.comment h4 {
	width:100%;
	overflow:auto;
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
	  var id = getCookie("login");
	  var classid = getUrlVars()['classid'];
	  var d = new Date();
	  if (d.getMinutes().toString().length == 1) {
	  	var timp = d.getFullYear() + ":" + d.getMonth() + ":" + d.getDate() + ":" + d.getHours() + ":0" + d.getMinutes() + ":" + d.getSeconds() + ":" + d.getMilliseconds();
	  	var ora = d.getHours() + ":0"  + d.getMinutes();
	  }
	  else {
	  	var timp = d.getFullYear() + ":" + d.getMonth() + ":" + d.getDate() + ":" + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + ":" + d.getMilliseconds();
	  	var ora = d.getHours() + ":"  + d.getMinutes();
	  }
	  if (mesaj != "") {
	  	location.assign("?classid=" + classid + "&id=" + id + "&mesaj=" + mesaj + "&data=" + timp + "&ora=" + ora);
		setCookie("send", "true", 1);
	  }
  }
function startLoad() {
	  getBg();
	  var r = getCookie("send");
	  if (r == "true") {
		  //location.assign("http://gnets.myds.me/work/chat/?id=" + id + "&id2=" + id2);
		  setCookie("send", "false", 1);
	  }
}
function enter() {
	$('#message').keypress(function(event) {
		if (event.which == 13) {
			send();
		} 
	});
}
function copy3() {
  var copyText = document.getElementById("invitelink1");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("The link was copyed!");
}

$(document).ready(function(){

   function replace_content(content)
   {
   var exp_match = /(\b(https?|):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
   var element_content=content.replace(exp_match, "<a href='$1'>$1</a>");
   var new_exp_match =/(^|[^\/])(www\.[\S]+(\b|$))/gim;
   var new_content=element_content.replace(new_exp_match, '$1<a target="_blank" href="http://$2">$2</a>');
   return new_content;
   }

   var content = $('.comment').html();
   $('.comment').html(replace_content(content));

});
</script>

<body onload="startLoad()">
<?php
	include "../nav.php";
?>

<div class="class">
    <div class="title">
        <?php 
			$hostname = 'localhost:3307';
			include "../db.php";
			try {
				$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
				$professor = $row['Professor'];
				echo "<h1><xmp>" . $row['Titlu'] . "</xmp></h1>
				<h4><xmp>" . $row['Materie'] . "</xmp></h4>";
				if ($professor == $_COOKIE['login']) {
					echo '<h4>Invite link: <input class="invite" type="text" id="invitelink1" value="https://alexs.gq/c#' . $_GET['classid'] . '" contenteditable="false"><a id="inv" href="javascript:copy3()" style="color:#FFF;"><i class="far fa-copy"></i></a></h4>';
					echo '<style>
							.title {
								background-size:cover;
								height:250px;
								border-radius:16px;
							}
						</style>';
					echo "<br />";
				}
				else {
					echo '<style>
							.title {
								background-size:cover;
								height:150px;
								border-radius:16px;
							}
						</style>';
				}
				echo "<div class='links'>
				<a href='chat.php?classid=" . $row['Id'] . "'>Chat</a>
				<a href='assigments.php?classid=" . $row['Id'] . "'>Assigments</a>
				<a href='marks.php?classid=" . $row['Id'] . "'>Marks</a>
				<a href='people.php?classid=" . $row['Id'] . "'>People</a>
				<a href='../video/?id=" . $row['Id'] . "'>Meet in <img src='../logo/video.png' width='40px'></a></div>";
				echo "<style> .title { background-image:url(img/" . $row['background'] . ".jpg); } </style>";
			}
		?>
    </div>
    <br />
    <div class="col1">
        <div class="assigment">
			<?php
				$sunt=false;
                $sql = "SELECT * FROM assigments WHERE classid='" . $_GET['classid'] . "' ORDER BY due";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
					$sunt=true;
                    echo "
                    <date>Due <strong>" . $row['due'] . "</strong></date>
                    <h4><xmp>" . $row['title'] . "</xmp></h4><hr />";
                }
				if ($sunt==true) {
					echo "<a href='assigments.php?classid=" . $_GET['classid'] . "'>View more</a>";
				}
				if (!$row = $stmt->fetch() and $sunt==false)
				{
					echo "<p>No assigments yet!</p>";
				}
            ?>
        </div>
			<?php
				/***if ($professor != $_COOKIE['login']) {
					echo "<br />
					<div class='marks'>";
					$sunt=false;
					$sql = "SELECT * FROM marks WHERE classid='" . $_GET['classid'] . "' and studentid='" . openssl_encrypt($_COOKIE['un'],"AES-128-ECB",$_GET['classid']) . "'";
					$stmt = $conn->query($sql);
					while ($row = $stmt->fetch()) {
						$sunt=true;
						echo "<date>Your marks are:</date> <h4>" . $row['mark1'] . ", " . $row['mark2'] . ", " . $row['mark3'] . ", " . $row['mark4'] . ", " . $row['mark5'] . "</h4>";
					}
					if (!$row = $stmt->fetch() and $sunt==false)
					{
						echo "<p>You don't have any marks!</p>";
					}
					echo "</div>";
				}***/
            ?>
    </div>
    <div class="col2" id="message">
        <!--<a href="#" class="create"><i class="fas fa-plus"></i>Create</a>-->
        <div class="comment">
            <div class="input-data">
            <input type="text" id="message-to-send" required maxlength="99" autocomplete="off" onkeypress="enter()">
            <div class="underline"></div>
            <label>Announce something in the class</label></div><br />
            <a href="javascript:send()" class="create">Post</a><br /><br />
        </div>
        <br /><br />
			<?php
                $sql = "SELECT * FROM chat WHERE classid='" . $_GET['classid'] . "' ORDER BY data DESC";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<div class='comment'>
                        <div class='me'>
                            <svg focusable='false' width='24' height='24' viewBox='0 0 24 24' class=' NMm5M'><path d='M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z'></path></svg>
                            <table width='60%'><tr><td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$row['un']] . "&color=fff&name=" . $row['un'] . "&size=40&rounded=true' /></td>
                            <td><h3>" . $row['un'] . "</h3><p>" . $row['ora'] . "</p></td></tr></table>
                        </div>
                        <h4><xmp>" . openssl_decrypt($row['mesaj'],"AES-128-ECB",$_GET['classid']) . "</xmp></h4>
                    </div><br />";
                }
                $conn=null;
            ?>
    </div>

<footer>
<p>&copy; Alex Sofonea 2021 - Alex Classroom</p>
</footer>

</div>
</body>
</html>