<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link rel="icon" href="../logo/class.png" />
  <title>Alex Classroom</title>
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
	if ($_GET['fa'] == "leave") {
		echo "<script>
		setTimeout(funtion() {
			var r = confirm('Are you sure that you want to remove " . $_GET['st'] . " from the class?');
			if (r == false) {
				location.assign('people.php?classid=" . $_GET['classid'] . "');
			}
		}, 1);
		</script>";
		$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			$st = str_replace($_GET['st'], "", $row['Students']);
			$student = explode(",", $_GET['st']);
			$sql = "UPDATE `class` SET Students='" . $st . "' WHERE Id='" . $_GET['classid'] . "'";
			$stmt = $conn->query($sql);
			$sql = "DELETE FROM `marks` WHERE classid='" . $_GET['classid'] . "' and studentid='" . openssl_encrypt(str_replace(";", "", $student[1]),"AES-128-ECB", $_GET['classid']) . "'";
			$stmt = $conn->query($sql);
			$sql = "DELETE FROM `grades` WHERE classid='" . $_GET['classid'] . "' and student='" . openssl_encrypt(str_replace(";", "", $student[1]),"AES-128-ECB", $_GET['classid']) . "'";
			$stmt = $conn->query($sql);
			header("Location: people.php?classid=" . $_GET['classid']);
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
	$id_nume = array();
	while ($row = $stmt->fetch()) {
		if (strpos($students, $row['Id']) !== false) {
			$culori[$row['username']] = $row['culoare'];
			$id_nume[$row['Id']] = $row['username'];
		}
	}
?>


<style>@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
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
.input-data input{
  height: 100%;
  width: 100%;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
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
.assigment {
	background-color:#FFF;
	width:300px;
	height:200px;
	border-radius:16px;
	padding:20px;
	border:1px solid #CCC;
	overflow:auto;
}
.assigment date {
	font-size:16px;
	color:#CCC;
}
.create {
	text-decoration:none !important;
	padding:10px;
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
/*.comment a {
	float:right;
	color:#FFF;
	font-size:13px;
	padding-top:10px;
	padding-bottom:10px;
	padding-left:30px;
	padding-right:30px;
	border-radius:5px;
	background-color:#1a73e8;
	margin-bottom:5px;
	text-decoration:none !important;
}
.comment a:hover{
	color:#CCC;
}*/
.comment .me {
	line-height: 10%;
}
.comment .me img {
	margin-top:13px;
}
.comment .me .a:hover {
	color:#F00 !important;
}
.comment p {
	color:#666;
}
.files {
	border-radius:20px;
	border:1px solid #999;
	padding:7px;
	width:15%;
	margin-top:5px;
}
.termin {
	float:right;
	margin-top:20px;
}
.marks th, .marks td {
	border:1px #CCC solid;
	padding:5px;
}
.marks {
	width:100%;
}
.edit {
	border:none !important;
}
.edit a {
	opacity:0;
	transform:translateX(70%);
	transition:all 0.2s;
	color:#999;
}
tr:hover .edit a {
	opacity:1;
	transform:translateX(0%);
}
input {
	width:95%;
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
.comment a {
	float:right;
}
.comment a {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
	color:#333;
	margin-top:20px;
	font-size:15px;
	margin-right:10px;
}
.comment a:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	color:#333;
	margin-top:10px !important;
	margin-right:0 !important;
}

@media only screen and (min-width: 761px) {
	.title {
		width:900px;
		padding:20px;
		border-radius:16px;
		height:150px;
		background-size:cover;
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
		width:100%;
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
	.class {
		padding:0px 100px;
	  margin: 0;
	  position: absolute;
	  left: 50%;
	  -ms-transform: translateX(-50%);
	  transform: translateX(-50%);
	}
}
/*mobile*/
@media only screen and (max-width: 761px) {
	.title {
		width:100%;
		padding:5px;
		margin-bottom:20px;
		border-radius:16px;
		height:150px;
		background-size:cover;
		background-position: right bottom;
	}
	.title img {
		width:30px !important;
	}
	.comment {
		background-color:#FFF;
		width:100%;
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
	.class {
		padding:10px;
	}
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
</script>

<body>
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
			if ($row = $stmt->fetch()) {
				echo "<h1>" . $row['Titlu'] . "</h1>
				<h4>" . $row['Materie'] . "</h4>
				<div class='links'>
				<a href='chat.php?classid=" . $row['Id'] . "'>Chat</a>
				<a href='assigments.php?classid=" . $row['Id'] . "'>Assigments</a>
				<a href='marks.php?classid=" . $row['Id'] . "'>Marks</a>
				<a href='people.php?classid=" . $row['Id'] . "'>People</a>
				<a href='../video/?id=" . $row['Id'] . "'>Meet in <img src='../logo/video.png' width='40px'></a></div>";
				$profesor = $row['Professor'];
				if ($_COOKIE['login'] == $row['Professor']) {
					$prof = true;
				} else {
					$prof = false;
				}
				$students = $row['Students'];
				echo "<style> .title { background-image:url(img/" . $row['background'] . ".jpg); } </style>";
			}
		?>
    </div>
    <br />
    <br />
    <div class="comment">
        <?php
			if ($profesor == $_COOKIE['login']) {
				echo "<div class='me'>";
				echo "<a class='a' href='chat.php?fa=leave&classid=" . $_GET['classid'] . "'><i class='fas fa-user-minus'></i></a>";
				echo "<table><tr><td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$_COOKIE['un']] . "&color=fff&name=" . $_COOKIE['un'] . "&size=40&rounded=true' style='margin-right:10px;'/></td>
						<td><h3>" . $_COOKIE['un'] . "</h3><p><strong>You</strong></p></td></tr></table>
					</div>";
			}
			else {
				$nume_prof = $id_nume[$profesor];
				echo "<div class='me'>";
				echo "<a href='../chat/?id=" . $_COOKIE['login'] . "&id2=" . $profesor . "'><i class='fas fa-reply'></i></a>";
				echo "<table><tr><td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$nume_prof] . "&color=fff&name=" . $nume_prof . "&size=40&rounded=true' style='margin-right:10px;'/></td>
						<td><h3>" . $nume_prof . "</h3><p>Teacher</p></td></tr></table>
					</div>";
			}
		?>
    </div>
    <br />
    <div class="comment">
    	<h2>Students</h2>
        <?php
			$stu = explode(";", $students);
			for ($i = 0; $i < count($stu)-1; $i++) {
				$stud = explode(",", $stu[$i]);
				echo "<div class='me'>";
				if ($profesor == $_COOKIE['login']) {
					echo "<a class='a' href='people.php?fa=leave&st=" . $stud[0] . "," . $stud[1] . ";" . "&classid=" . $_GET['classid'] . "'><i class='fas fa-user-minus'></i></a>";
				}
				if ($stud[0] == $_COOKIE['login']) {
					echo "<a class='a' href='chat.php?fa=leave&classid=" . $_GET['classid'] . "'><i class='fas fa-user-minus'></i></a>";
					echo "<table><tr><td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$stud[1]] . "&color=fff&name=" . $stud[1] . "&size=40&rounded=true' style='margin-right:10px;'/></td>
							<td><h3>" . $stud[1] . "</h3><p><strong>You</strong></p></td></tr></table>
						</div>";
				}
				else {
					echo "<a href='../chat/?id=" . $_COOKIE['login'] . "&id2=" . $stud[0] . "'><i class='fas fa-reply'></i></a>";
					echo "<table><tr><td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$stud[1]] . "&color=fff&name=" . $stud[1] . "&size=40&rounded=true' style='margin-right:10px;'/></td>
							<td><h3>" . $stud[1] . "</h3><p>Student</p></td></tr></table>
						</div>";
				}
			}
		?>
    </div>
   
<footer>
<p>&copy; Alex Sofonea 2021 - Alex Classroom</p>
</footer>
</div>

</body>
</html>