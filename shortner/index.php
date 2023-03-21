<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alex Shortner</title>
  <link rel="icon" href="../work/logo/forms.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link href="style2.css" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<?php
if (isset($_GET['forwarurl'])) {
	$hostname = 'localhost:3307';
	include "../work/db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexshortner", $username, $password);
		}
	catch(PDOException $e)
		{
		echo $e->getMessage();
		}
	$sql = "SELECT * FROM url WHERE Id='" . $_GET['forwarurl'] . "'";
	$stmt = $conn->query($sql);
	if ($row = $stmt->fetch()) {
		if (strpos($row['Url'], "http") !== false) {
			header("Location: " . $row['Url']);
			die();
		} else {
			header("Location: http://" . $row['Url']);
			die();
		}
	}
	
}
if (!isset($_COOKIE['login'])) {
	header('Location: http://gnets.myds.me/work/log.php?s=http://gnets.myds.me/work/shortner');
	die();
}
	
if (($_GET['id'] != "" and $_GET['url'] != "") or (isset($_COOKIE['error']) and isset($_GET['otherId']))) {
	$hostname = 'localhost:3307';
	include "../work/db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexshortner", $username, $password);
		}
	catch(PDOException $e)
		{
		echo $e->getMessage();
		}
	if (isset($_COOKIE['error'])) {
		$sql = "SELECT * FROM url WHERE Id='" . $_GET['otherId'] . "'";
		$stmt = $conn->query($sql);
	} else {
		$sql = "SELECT * FROM url WHERE Id='" . $_GET['id'] . "'";
		$stmt = $conn->query($sql);
	}
	if ($row = $stmt->fetch()) {
		if (!isset($_COOKIE['error'])) {
			setcookie("error", "1", time() + 86400);
			setcookie("nume", $_GET['nume'], time() + 86400);
			setcookie("url", $_GET['url'], time() + 86400);
		}
		header('Location: index.php?error=1');
		die();
	} else {
		if (isset($_COOKIE['error'])) {
			setcookie("error", "1", time());
			setcookie("nume", $_GET['nume'], time());
			setcookie("url", $_GET['url'], time());
			$sql = "INSERT INTO url (Id, Creator, Name, Url) VALUES ('" . $_GET['otherId'] . "','" . $_COOKIE['login'] . "','" . $_COOKIE['nume'] . "', '" . $_COOKIE['url'] . "')";
			$stmt = $conn->query($sql);
		} else {
			$sql = "INSERT INTO url (Id, Creator, Name, Url) VALUES ('" . $_GET['id'] . "','" . $_COOKIE['login'] . "', '" . $_GET['nume'] . "', '" . $_GET['url'] . "')";
			$stmt = $conn->query($sql);
		}
		header('Location: index.php');
		die();
	}
	$conn=null;
}

?>

<script>
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
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
	var custom = document.getElementById('custom').value;
	if (custom == "") {
		var id = Math.random().toString(36).substring(7);

	} else {
		var id = custom;
	}
	var url = document.getElementById('url').value;
	location.assign("index.php?id=" + id +  "&nume=" + titlu + "&url=" + url);
}
	
function change() {
		document.getElementById('custom').value = "";
}
	
function change3() {
	change();
	var check = document.getElementById('customm').checked;
	if (check == true) {
		document.getElementById('custom').disabled=false;
	}
	else {
		document.getElementById('custom').disabled=true;
	}
}
function loadStart() {
	if (getUrlVars()["error"] == "1") {
		//var otherId = prompt("The id was taken. Plese choose an other one!");
		var otherId = Math.random().toString(36).substring(7);
		location.assign("index.php?otherId=" + otherId);
	}
	change3();
	formlimk();
}

  
  function formlimk() {
	  if (document.getElementById('custom').value != "") {
	  	document.getElementById('formLink').innerHTML = document.getElementById('custom').value;
	  }
	  else {
		var id = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
		document.getElementById('formLink').innerHTML = id;
	  }
  }
	

function linkCopy(id) {
  var copyText = document.getElementById(id);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("The Link was copyed!");
}
</script>

<style>
@media screen and (max-width: 768px) {
	body {
	  font: 400 16px "Varela Round", sans-serif;
	}
  .wrapper{
	width: 300px !important;
	background: #fff;
	padding: 30px;
	box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
	border-radius:10px;
  }
}
@media screen and (min-width: 768px) {
	body {
	  font: 400 16px "Varela Round", sans-serif;
	  display: -webkit-box;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
			  flex-direction: column;
	  -webkit-box-pack: center;
			  justify-content: center;
	  -webkit-box-align: center;
			  align-items: center;
	  
	}
  .wrapper{
	width: 450px;
	background: #fff;
	padding: 30px;
	box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
	border-radius:10px;
  }
}
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
.delete {
	float:right;
	font-size:24px;
	transform:translateY(70%);
	opacity:0;
	transition:all 0.4s;
	color:#F00;
	margin-left:30px;
}
#formular:hover .delete {
	transform:translateY(0%);
	opacity:1;
	color:#F00;
}
.linkinput {
	border:#CCC 1px solid;
	border-radius:20px;
	width:auto;
	padding:5px;
}
.delete {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
}
.delete:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	border-radius:20px;
	text-decoration:none;
	color:#FFF;
	margin-top:-10px;
	margin-right:-10px;
}
</style>

<body onload="loadStart()">
<h3 class="titlu">Alex Shortner</h3>

<div class="wrapper">
    <div class="input-data">
    <input type="text" id="titlu" required maxlength="499">
    <div class="underline"></div>
    <label>Url Title</label></div><br />
    <div class="input-data">
    <input type="text" id="url" required maxlength="1999">
    <div class="underline"></div>
    <label>Url</label></div><br />
<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="customm" onchange="change3()"/>
    <div class="mdc-checkbox__background">
      <svg class="mdc-checkbox__checkmark"
           viewBox="0 0 24 24">
        <path class="mdc-checkbox__checkmark-path"
              fill="none"
              d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
      </svg>
      <div class="mdc-checkbox__mixedmark"></div>
    </div>
    <div class="mdc-checkbox__ripple"></div>
  </div>
  <label for="customm">
  		Assign custom id: 
        <div class="input-data">
        <input type="text" id="custom" required maxlength="99" onkeyup="formlimk()">
        <div class="underline"></div>
        <label>Custom id</label></div>
  </label>
</div>

<br />
<br />

<h4>Your Link is: <br /> alxs.gq#<strong><c id="formLink"></c></strong></h4>

</div>

<br />
<br />
<br />
        

<button class="mdc-button mdc-button--raised" onclick="save()">
  <span class="mdc-button__ripple"></span>
  <span class="mdc-button__label">Shorten url</span>
</button>

<br />
<br />
<br />

<h3>Other urls</h3>
	<?php
		$hostname = 'localhost:3307';
		include "../work/db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alexshortner", $username, $password);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		if ($_GET['fa'] == "sterge") {
			$sql = "DELETE FROM `url` WHERE Id='" . $_GET['id'] . "'";
			$stmt = $conn->query($sql);
		}
		$sql = "SELECT * FROM url WHERE Creator='" . $_COOKIE['login'] . "'";
		$stmt = $conn->query($sql);
		while ($row = $stmt->fetch()) {
				echo "<div class='wrapper' id='formular'>";
					echo '<a href="http://alexs.gq/u#' . $row['Id'] . '" class="mdc-button">
					   <span class="mdc-button__ripple"></span>
					   <span class="mdc-button__label"><font size="+2">' . $row['Name'] . '</font></span>
					</a><br />';
					echo '<input class="linkinput" type="text" id="' . $row['Id'] . '" value="alexs.gq/u#' . $row['Id'] . '" readonly="readonly">';
					echo "<a href='index.php?fa=sterge&id=" . $row['Id'] . "' class='delete'><i class='far fa-trash-alt'></i></a>";
					echo '<a href="javascript:linkCopy(\'' . $row['Id'] . '\')" class="delete"><i class="far fa-copy" style="color:#CCC;"></i></a>';
				echo "</div><br />";
		}
    ?>

<br />
<hr />
<footer>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer></body>
</html>
