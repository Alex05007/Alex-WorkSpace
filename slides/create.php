<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alex Forms - New form</title>
  <link rel="icon" href="../logo/slides.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link href="style2.css" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header('Location: http://gnets.myds.me/work/');
		die();
	}
	if (!isset($_COOKIE['slide'])) {} else {
		setcookie("slide", "", time());
	}
	if (!isset($_COOKIE['slideNr'])) {} else {
		setcookie("slideNr", "", time());
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
if ($_GET['id'] != "" and $_GET['titlu'] != "") {
	$sql = "INSERT INTO prezentari (Id, Titlu, Creator, bg) VALUES ('" . $_GET['id'] . "','" . $_GET['titlu'] . "','" . $_COOKIE['login'] . "', '" . $_GET['bg'] . "')";
	$stmt = $conn->query($sql);
	header("Location: slide.php");
	die();
}
$conn=null;
	if (!isset($_COOKIE['prezentare'])) {} else {
		header('Location: http://gnets.myds.me/work/slides/rezCreate.php');
		die();
	}
?>

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

function save() {
	var titlu = document.getElementById('titlu').value;
	var myId = getCookie("login");
	var d = new Date();
	var id = d.getDay() + d.getMonth() + titlu.replace(/ /gi, "").substring(1,5) + d.getMilliseconds();
	setCookie("prezentare", id, 1);
	var bg = document.getElementById('culoare1').value.replace("#", "") + ";" + document.getElementById('culoare2').value.replace("#", "");
	location.assign("create.php?id=" + id + "&titlu=" + titlu + "&bg=" + bg); 
}
</script>

<style>
.buttonPlus {
  background-color: transparent; 
  color: black; 
  border: 2px solid #06F;
}

.buttonPlus:hover {
  background-color: #06F;
  color: white;
}

.buttonPlus i {
  transform:rotate(0deg);
  color:#0C0;
  font-size:24px;
  transition: all ease-in-out 0.5s; 
}

.buttonPlus:hover i {
  transform:rotate(180deg);
  color: white;
}
</style>

<body onload="getBg()">
	<?php
		include "../nav.php";
	?>
<h3 class="titlu">Alex Slides - New Presentation</h3>

<div class="wrapper">
    <div class="input-data">
    <input type="text" id="titlu" required maxlength="99">
    <div class="underline"></div>
    <label>Presentation title</label></div>
</div>
<br />
<div class="wrapper">
	<h4>Linera graident colors: pik two related colors:</h4>
    <input type="color" id="culoare1" value="#ffffff"/>
	<input type="color" id="culoare2"  value="#ffffff"/>
</div>

<br />
<br />
<br />

<button class="button button1" onclick="save()"><i class="fas fa-save"></i> Create slides!</button>

<br />
<hr />
<footer>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>
</body>
</html>
