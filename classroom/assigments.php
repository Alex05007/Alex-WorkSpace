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
	$myId = $_COOKIE['login'];
	if ($_GET['title'] != "") {
		$hostname = 'localhost:3307';
		include "../db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		$sql = "INSERT INTO assigments (classid, title, descriere, due, file) VALUES ('" . $_GET['classid'] . "', '" . $_GET['title'] . "', '" . $_GET['desc'] . "', '" . $_GET['due'] . "', '" . $_COOKIE['file'] . "')";
		$stmt = $conn->query($sql);
		header("Location: assigments.php?classid=" . $_GET['classid']);
		die();
	}
	if ($_GET['fa'] == "sterge") {
		$hostname = 'localhost:3307';
		include "../db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		$sql = "DELETE FROM `assigments` WHERE title='" . $_GET['titlu'] . "' and descriere='" . $_GET['desc'] . "' and classid='" . $_GET['classid'] . "'";
		$stmt = $conn->query($sql);
		header("Location: assigments.php?classid=" . $_GET['classid']);
		die();
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
	padding:10px !important;
	background-color:#1a73e8 !important;
	border-radius:25px !important;
	transition:all 0.3s !important;
	color:#FFF !important;
	font-size:15px !important;
	float:right !important;
	margin:0 !important;
}
.create i {
	padding-right:10px;
	font-size:20px;
}
.create:hover {
	background-color:#1a73e8;
	color:#FFF;
	box-shadow:1px 1px 30px #1a73e8;
	margin:0 !important;
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
.comment .me i {
	font-size:20px;
	float:right;
	color:#F00;
	transition:all 0.3s;
}
	
	
.comment p {
	color:#666;
	margin:10px;
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
.ass a {
	float:right;
}
.ass a {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
	color:#333;
	margin-top:20px;
	font-size:15px;
}
.ass a:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	color:#333;
	margin-top:10px !important;
	margin-right:-10px !important;
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
	  width: 100%;
	  border: none;
	  font-size: 17px;
	  border-bottom: 2px solid silver;
	}
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 100%;
	  bottom: 0px;
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
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 100%;
	  bottom: 0px;
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
function send() {
	var title = document.getElementById('title').value;
	var description = document.getElementById('description').value;
	setCookie("file", document.getElementById('file').value, 1);
	var due = document.getElementById('due').value;
	var classid = getUrlVars()['classid'];
	if (title != "") {
	  location.assign("?classid=" + classid + "&title=" + title + "&desc=" + description + "&due=" + due);
	}
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
			while ($row = $stmt->fetch()) {
				echo "<h1><xmp>" . $row['Titlu'] . "</xmp></h1>
				<h4><xmp>" . $row['Materie'] . "</xmp></h4>
				<div class='links'>
				<a href='chat.php?classid=" . $row['Id'] . "'>Chat</a>
				<a href='assigments.php?classid=" . $row['Id'] . "'>Assigments</a>
				<a href='marks.php?classid=" . $row['Id'] . "'>Marks</a>
				<a href='people.php?classid=" . $row['Id'] . "'>People</a>
				<a href='../video/?id=" . $row['Id'] . "'>Meet in <img src='../logo/video.png' width='40px'></a></div>";
				$profesor = $row['Professor'];
				echo "<style> .title { background-image:url(img/" . $row['background'] . ".jpg); } </style>";
			}
		?>
    </div>
    <br />
    <?php
		if ($_COOKIE['login'] == $profesor) {
			echo "<div class='comment'>
					<div class='input-data'>
					<input type='text' id='title' required maxlength='99' autocomplete='off' onkeypress='enter()'>
					<div class='underline'></div>
					<label>Assigment Title</label></div><br />
					<div class='input-data'>
					<input type='text' id='description' required maxlength='299' autocomplete='off' onkeypress='enter()'>
					<div class='underline'></div>
					<label>Assigment Description</label></div><br />
					<div class='input-data'>
					<input type='text' id='file' required maxlength='99' autocomplete='off' onkeypress='enter()'>
					<div class='underline'></div>
					<label>Assigment File</label></div><br />
					<input type='date' id='due' />
					<a href='javascript:send()' class='create'>Assign</a><br /><br />
			</div>";
		}
	?>
    <br />
        <?php
			$sunt=false;
			$sql = "SELECT * FROM assigments WHERE classid='" . $_GET['classid'] . "' ORDER BY due";
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
				$sunt=true;
				echo "<div class='comment ass'>
					<div class='me'>";
						if ($_COOKIE['login'] == $profesor) {
							echo "<a href='assigments.php?fa=sterge&titlu=" . $row['title'] . "&desc=" . $row['descriere'] . "&classid=" . $_GET['classid'] . "'><i class='far fa-trash-alt'></i></a>";
						}
						echo "<p class='termin'>Due <strong>" . $row['due'] . "</strong></p>
					</div>
					<h2><xmp>" . $row['title'] . "</xmp></h4>
					<h4><xmp>" . $row['descriere'] . "</xmp></h4>";
					if (strpos($row['file'], "forms")) {
						echo "<div class='files'><img src='../logo/forms.png' width='20px'/><a href='" . $row['file'] . "'>Alex Forms</a></div>";
					}
					if (strpos($row['file'], "text")) {
						echo "<div class='files'><img src='../logo/text.png' width='20px'/><a href='" . $row['file'] . "'>Alex Text</a></div>";
					}
					if (strpos($row['file'], "slides")) {
						echo "<div class='files'><img src='../logo/slides.png' width='20px'/><a href='" . $row['file'] . "'>Alex Slides</a></div>";
					}
				echo "</div><br />";
			}
			if(!$row = $stmt->fetch() and $sunt==false)
			{
				echo "<div class='comment'><h4>No assigments yet!</h4></div>";
			}
		?>

<footer>
<p>&copy; Alex Sofonea 2021 - Alex Classroom</p>
</footer>
</div>

</body>
</html>