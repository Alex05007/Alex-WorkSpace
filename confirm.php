<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Workspace - Account confirmation</title>
<link rel="icon" href="logo.png" type="image/x-icon" />
<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->
    <link rel="stylesheet" href="os/letter.css" />
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
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
	if ($_GET['code'] != "") {
		if($_GET['id'] == "" or $_GET['mail'] == "") {
			header("Location: confirm.php?code=" . $_GET['code'] . "&id=" . $_COOKIE['myaccount'] . "&mail=" . $_COOKIE['mail']);
			die();
		}
		$sql = "UPDATE `conturi` SET accept='true' WHERE cod='" . $_GET['code'] . "' and Id='" . $_GET['id'] . "' and mail='" . $_GET['mail'] . "'";
		$stmt = $conn->query($sql);
		$sql = "SELECT * FROM `conturi` WHERE accept='true' and cod='" . $_GET['code'] . "' and Id='" . $_GET['id'] . "' and mail='" . $_GET['mail'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			if ($row['accept'] == "true") {
				setcookie("login", $row['Id'], time() + (3600*12));
				setcookie("un", $row['username'], time() + (3600*12));
				setcookie("accept", "true", time());
				header("Location: indexLog.php");
				die();
			}
		}
	}
	if ($_GET['send'] == "true") {
		if (!isset($_COOKIE['myaccount'])) {
			$myid = $_GET['id'];
		} else {
			$myid = $_COOKIE['myaccount'];
		}
		$sql = "SELECT * FROM `conturi` WHERE Id='" . $_GET['id'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			if ($row['mail'] != "" and $row['mail'] != "null"){
				require_once('PHPMailer/PHPMailerAutoload.php');
				$mail = new PHPMailer(true);
				try{
				$mail->isSendmail();
						
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';			
				$mail->Port = '587';
	
				$mail->Username = 'workspace.alexs@gmail.com';
				$mail->Password = 'alex[12qwaszx]workspace<$>';
	
				$mail->SetFrom('workspace.alexs@gmail.com', 'Alex Workspace');
				$mail->addAddress($row['mail'], $row['username']);
				$mail->addReplyTo('workspace.alexs@gmail.com', 'Alex Workspace'); // to set the reply to
		
				$mail->IsHTML(true);
				$mail->Subject = 'Confirm your Alex Workspace Account';
				//$mail->Body = 'A test email!';
				$cod = $row['cod'];
				$mail->Body='<div style="background-color:#FFF;"><h1 style="text-align:center;"><font style="color:#09F;">A</font><font style="color:#ea4335;">l</font><font style="color:#0C0;">e</font><font style="color:#FF0">x</font> <font style="color:#666;">Workspace</font></h1><br /><br /><br /><div style="padding:60px; text-align:center;"><h2>Hello, ' . $row['username'] . '</h2><h3> <br /><br /> You just signed up for a Alex Workspace account and we need just to confirm it! <br /> <a href="gnets.myds.me/work/confirm.php?code=' . $cod . '&id=' . $row['Id'] . '&mail=' . $row['mail'] . '" style="padding:10px; border-radius:10px; border:#09F 1px solid; color:#000;">Confirm my Alex Workspace account</a><br /><br /><br /><div style="font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New; padding:10px; border-radius:16px; background-color: #666; color: #FFF;">' . $cod . '</div></h3></div><br /><br /><br /><h4 style="text-align:center;">&copy; Alex Sofonea 2021 - Alex Workspace<h4></div>';
				if(!$mail->send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else{
					echo "Message has been sent!";
					setcookie("mail", $row['mail'], time() + (3600*12));
					header("Location: confirm.php");
					die();
				}
				} catch (Exception $e) {
					echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
				}
			}
			else {
				if ($_GET['mail'] != "null" and $_GET['mail'] != "") {
					$sql = "UPDATE `conturi` SET mail='" . $_GET['mail'] . "', cod='" . time() . "' WHERE Id='" . $_COOKIE['myaccount'] . "'";
					$stmt = $conn->query($sql);
					header("Location: confirm.php?send=true&id=" . $_COOKIE['myaccount']);
					die();
				} else {	
					setcookie("myaccount", $row['Id'], time() + 3600);
					setcookie("error", "accountmail", time() + 1);
					header("Location: confirm.php");
				}
			}
		}
	}
		
	$conn = $null;
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
	#login {
		display:none;
	}
}
.digit {
	border:#CCC 1px solid;
	padding:5px;
	font-size:24px;
	border-radius:5px;
	width:60%;
	text-align:center;
}
td {
	text-align:center;
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
function createCont() {
	var code = document.getElementsByName('digit');
	var cod = "";
	for (var i=0; i<code.length; i++) {
		cod = cod + code[i].value;
	}
	location.assign("http://gnets.myds.me/work/confirm.php?code=" + cod);
}
function loadStart() {
	if (getCookie("error") == "accountmail") {
		setCookie("error", "false", -1);
		var n = prompt("Plese write your mail here to continue using Alex Workspace");
		var id = getCookie("myaccount");
		location.assign("confirm.php?send=true&id=" + id + "&mail=" + n);
	}
}
</script>

<body onload="loadStart()">
  <div class="login-box">
      <div style="text-align:center; font-size:25px;"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span> <font style="color:rgba(0,0,0,0.7); font: normal bold 2rem 'Product Sans', sans-serif;">Workspace</font></div>
      <h2>We need just to confirm your email</h2>
      
      <table><tr>
          <td><input type="text" maxlength="1" class="digit" name="digit" autocomplete="off" onkeyup="document.getElementsByName('digit')[1].focus()" /></td>
          <td><input type="text" maxlength="1" class="digit" name="digit" autocomplete="off" onkeyup="document.getElementsByName('digit')[2].focus()" /></td>
          <td><input type="text" maxlength="1" class="digit" name="digit" autocomplete="off" onkeyup="document.getElementsByName('digit')[3].focus()" /></td>
          <td><input type="text" maxlength="1" class="digit" name="digit" autocomplete="off" onkeyup="document.getElementsByName('digit')[4].focus()" /></td>
          <td><input type="text" maxlength="1" class="digit" name="digit" autocomplete="off" onkeyup="document.getElementsByName('digit')[5].focus()" /></td>
          <td><input type="text" maxlength="1" class="digit" name="digit" autocomplete="off" onkeyup="document.getElementsByName('digit')[6].focus()" /></td>
      </tr></table>
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      <button class="mdc-button mdc-button--raised" style="float:right;" onclick="createCont()">
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label">Confirm mail</span>
      </button>
  </div>
</body>
</html>