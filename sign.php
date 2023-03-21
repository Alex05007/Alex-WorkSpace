<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Workspace - Sign Up</title>
<link rel="icon" href="logo.png" type="image/x-icon" />
<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->
    <link rel="stylesheet" href="os/letter.css" />
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>

<?php
	if (isset($_POST['mail']) and isset($_POST['un']) and isset($_POST['ps'])) {
		$hostname = 'localhost:3307';
		include "db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		$sql = "SELECT * FROM conturi WHERE username='" . $_POST['un'] . "' or mail='" . $_POST['mail'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			setcookie("c", "#F00", time() + 10);
			setcookie("l", "is used", time() + 10);
			header("Location: sign.php");
			die();
		}
		$id = uniqid();
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

		$mail->SetFrom('noreply.workspace@alexs.gq', 'Alex Workspace');
		$mail->addAddress($_POST['mail'], $_POST['un']);
		$mail->addReplyTo('workspace@alexs.gq', 'Alex Workspace'); // to set the reply to

		$mail->IsHTML(true);
		$mail->Subject = 'Confirm your Alex Workspace Account';
		//$mail->Body = 'A test email!';
		$cod = mt_rand(100000,999999);
		$mail->Body='<div style="background-color:#FFF;"><h1 style="text-align:center;"><font style="color:#09F;">A</font><font style="color:#ea4335;">l</font><font style="color:#0C0;">e</font><font style="color:#FF0">x</font> <font style="color:#666;">Workspace</font></h1><br /><br /><br /><div style="padding:60px; text-align:center;"><h2>Hello, ' . $_POST['un'] . '</h2><h3> <br /><br /> You just signed up for a Alex Workspace account and we need just to confirm it! <br> <a href="gnets.myds.me/work/confirm.php?code=' . $cod . '&id=' . $id . '&mail=' . $_POST['mail'] . '" style="padding:10px; border-radius:10px; border:#09F 1px solid; color:#000;">Confirm my Alex Workspace account</a><br /><br /><br /><div style="font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New; padding:10px; border-radius:16px; background-color: #666; color: #FFF;">' . $cod . '</div></h3></div><br /><br /><br /><h4 style="text-align:center;">&copy; Alex Sofonea 2021 - Alex Workspace<h4></div>';
		if(!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			echo "Message has been sent!";
		}
		} catch (Exception $e) {
			echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
		}
		
		$sql = "INSERT INTO conturi (Id, mail, username, password, prieteni, culoare, accept, cod) VALUES ('" . $id . "', '" . $_POST['mail'] . "', '" . $_POST['un'] . "' , '" . openssl_encrypt($_POST['ps'],"AES-128-ECB",$_POST['un'].$_POST['ps']) . "', '', '" . str_replace("#", "", sprintf('#%06X', mt_rand(0x000000, 0xFFFFFF))) . "', 'false', '" . $cod . "')";
		$stmt = $conn->query($sql);
		setcookie("mail", $_POST['mail'], time() + (3600*12));
		setcookie("myaccount", $id, time() + (3600*12));
		setcookie("account", $id, time() + (3600*12));
		setcookie("accept", "false", time() + (3600*12));
		header("Location: confirm.php");
		die();
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
function checkPas() {
	var pas = document.getElementById('pas');
	var username = document.getElementById('username').value;
	
	if (pas.value.length < 8) {
		document.getElementById('8carac').style.color = "red";
	}
	else {
		document.getElementById('8carac').style.color = "green";
	}
	
	if (pas.value.match(/[A-Z]/g)) {
		document.getElementById('cifre').style.color = "green";
	}
	else {
		document.getElementById('cifre').style.color = "red";
	}
	
	if (pas.value.includes(username) == true) {
		document.getElementById('nume').style.color = "red";
	}
	else {
		document.getElementById('nume').style.color = "green";
	}
}
</script>

<body onload="checkPas()">
  <div class="login-box">
  <div style="text-align:center; font-size:25px;"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span> <font style="color:rgba(0,0,0,0.7); font: normal bold 2rem 'Product Sans', sans-serif;">Workspace</font></div>
  <h2>Sign Up</h2>
  <form action="sign.php" method="post">
    <div class='input-data'>
    <input type='text' id='mail' required name="mail"/>
    <div class='underline'></div>
    <label>Mail <?php if(isset($_COOKIE['l'])) { echo $_COOKIE['l']; }; ?></label></div><br />

    <div class='input-data'>
    <input type='text' id='username' required name="un"/>
    <div class='underline'></div>
    <label>Username <?php if(isset($_COOKIE['l'])) { echo $_COOKIE['l']; }; ?></label></div><br />

    <div class='input-data'>
    <input type='password' id='pas' required onkeyup="checkPas()" name="ps"/>
    <div class='underline'></div>
    <label>Password</label></div>
    
      <p id="8carac">min. 8 characters</p>
      <p id="cifre">use at least one capital letter</p>
      <p id="nume">do not use your name in the password</p>
    
    <br />
	<!--<div class="g-recaptcha" data-sitekey="6Lf2lmUaAAAAAKLdBRjO4XXtjZekSR4HfZMJkBzb"></div>-->
    <a class="mdc-button" style="float:left;" href="log.php" id="login">
      <span class="mdc-button__ripple"></span>
      <span class="mdc-button__label">Already have an account?</span>
    </a>
    <button class="mdc-button mdc-button--raised" style="float:right;" type="submit">
      <span class="mdc-button__ripple"></span>
      <span class="mdc-button__label">Sign Up</span>
    </button>
  </form>
</div>
</body>
</html>