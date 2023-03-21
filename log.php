<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex workspace - LogIn</title>
<link rel="icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="os/letter.css" />
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
</head>

<?php
	$hostname = 'localhost:3307';
	include "db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	if (isset($_GET['invitation']) and isset($_COOKIE['login'])) {
		$sql = "SELECT * FROM conturi WHERE Id='" . $_GET['invitation'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			$priet = $row['prieteni'] . " " . $_COOKIE['login'] . ";";
		}
		if(!strpos($row['prieteni'], $_COOKIE['login']) !== false) { 
			$sql = "UPDATE `conturi` SET `prieteni`='" . $priet . "' WHERE Id='" . $_GET['invitation'] . "'";
			$stmt = $conn->query($sql);
		}
		$sql = "SELECT * FROM conturi WHERE Id='" . $_COOKIE['login'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			$priet = $row['prieteni'] . " " . $_GET['invitation'] . ";";
		}
		if(!strpos($row['prieteni'], $_GET['invitation']) !== false) { 
			$sql = "UPDATE `conturi` SET `prieteni`='" . $priet . "' WHERE Id='" . $_COOKIE['login'] . "'";
			$stmt = $conn->query($sql);
		}
		header("Location: indexLog.php");
		die();
	}
	if (isset($_GET['invitation']) and !isset($_COOKIE['login'])) {
		header("Location: log.php?s=http://gnets.myds.me/work/log.php?invitation=" . $_GET['invitation']);
		die();
	}
	if(isset($_COOKIE['login'])) {
		header("Location: indexLog.php");
		die();
	}
	if(isset($_GET['un']) and isset($_GET['ps'])) {
		$sql = "SELECT * FROM conturi WHERE username = '" . $_GET['un'] . "' and password = '" . openssl_encrypt($_GET['ps'],"AES-128-ECB",$_GET['un'].$_GET['ps']) . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			if ($row['accept'] == "true") {
				setcookie("login", $row['Id'], time() + (3600*12));
				setcookie("un", $row['username'], time() + (3600*12));
				setcookie("p", base64_encode($row['prieteni']), time() + (3600*12));
				setcookie("color", $row['culoare'], time() + (3600*12));
				if ($_GET['s'] == "undefined") {
					header("Location: indexLog.php");
					die();
				} else {
					header("Location: " . $_GET['s']);
					die();
				}
			}
			else {
				setcookie("myaccount", $row['Id'], time() + 3600);
				header("Location: confirm.php?id=" . $row['Id'] . "&send=true");
				die();
			}
		}
		else {
			setcookie("c", "#F00", time() + 1);
			setcookie("l", "is wrong", time() + 1);
			header("Location: log.php");
			die();
		}
		$conn = $null;
	}
?>

<style>
html {
  height: 100%;
}
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
  color: <?php if(isset($_COOKIE['c'])) { echo $_COOKIE['c']; } else { echo "#09F"; }; ?>;
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
  width: 101%;
  bottom: -4px;
}
.input-data .underline:before{
  position:absolute;
  content: "";
  height: 100%;
  width: 100%;
  background: <?php if(isset($_COOKIE['c'])) { echo $_COOKIE['c']; } else { echo "#09F"; }; ?>;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: #FFF;
  box-sizing: border-box;
  border:#CCC solid 1px;
  border-radius: 10px;
  height:500px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #000;
  text-align: center;
  font: normal bold 2rem 'Product Sans', sans-serif;
  font-size:16px;
}

.mdc-button {
	--mdc-theme-primary:#09F;
	--mdc-theme-secondary:#333;
	--mdc-theme-background:#09F;
	--mdc-theme-surface:#09F;
	text-transform: none;
	text-decoration:none !important;
	font-size:14px;
}
@keyframes error {
	from {transform:translateY(-100%); opacity:0;}
	to {transform:translateY(0%); opacity:1;}
}

@media only screen and (max-width: 750px) {
	.login-box {
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  width: 100%;
	  padding: 40px;
	  transform: translate(-50%, -50%);
	  background: #FFF;
	  box-sizing: border-box;
	  border:none;
	  border-radius: 10px;
	  height:500px;
	}
}
</style>

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
function logIn() {
	var d = new Date();
	var un = document.getElementById('username').value;
	var ps = document.getElementById('pas').value;
	if (un != "" && ps != "") {
		location.assign("log.php?un=" + un + "&ps=" + ps + "&s=" + getUrlVars()["s"]);
	}
}
function onLoad() {
	document.getElementById('s').value = getUrlVars()["s"];
}
</script>

<body onload="onLoad()">
  <div class="login-box">
  <div style="text-align:center; font-size:25px;"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span> <font style="color:rgba(0,0,0,0.7); font: normal bold 2rem 'Product Sans', sans-serif;">Workspace</font></div>
  <h2>Log in</h2>
  <form action="log.php" method="get">
    <div class='input-data'>
    <input type='text' id='username' required name="un" />
    <div class='underline'></div>
    <label>Username <?php if(isset($_COOKIE['l'])) { echo $_COOKIE['l']; }; ?></label></div><br />
    
    <div class='input-data'>
    <input type='password' id='pas' required name="ps" />
    <div class='underline'></div>
    <label>Password <?php if(isset($_COOKIE['l'])) { echo $_COOKIE['l']; }; ?></label></div><br />
    
    <div class='input-data' style="display:none;">
    <input type='text' id='s' required name="s" />
    <div class='underline'></div>
    <label>href</label></div>
    
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<!--<div class="g-recaptcha" data-sitekey="6Lf2lmUaAAAAAKLdBRjO4XXtjZekSR4HfZMJkBzb"></div>-->
    <a class="mdc-button" style="float:left;" href="forgot.php">
      <span class="mdc-button__ripple"></span>
      <span class="mdc-button__label">Forgot my password</span>
    </a>
    <button class="mdc-button mdc-button--raised" style="float:right;" type="submit">
      <span class="mdc-button__ripple"></span>
      <span class="mdc-button__label">Log In</span>
    </button>
  </form>
</div>
</body>
</html>