<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Workspace - Forgot Password</title>
<link rel="icon" href="logo.png" type="image/x-icon" />
<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->
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
	if ($_GET['code'] != "" and $_GET['un'] != "" and $_GET['mail'] != "" and isset($_GET['ps'])) {
		$sql = "UPDATE `conturi` SET password='" . openssl_encrypt($_GET['ps'],"AES-128-ECB",$_GET['un'].$_GET['ps']) . "' WHERE cod='" . $_GET['code'] . "' and username='" . $_GET['un'] . "' and mail='" . $_GET['mail'] . "'";
		$stmt = $conn->query($sql);
		$sql = "SELECT * FROM `conturi` WHERE accept='true' and cod='" . $_GET['code'] . "' and username='" . $_GET['un'] . "' and mail='" . $_GET['mail'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			setcookie("login", $row['Id'], time() + (3600*12));
			setcookie("un", $row['username'], time() + (3600*12));
			header("Location: indexLog.php");
			die();
		}
	}
	if ($_GET['mailconf'] == "false" and isset($_GET['mail'])) {
		$sql = "SELECT * FROM `conturi` WHERE mail='" . $_GET['mail'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			if ($row['mail'] != "" and $row['mail'] != "null" and $row['mail'] == $_GET['mail']){
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
				$mail->Subject = 'Reset your Alex Workspace Password';
				//$mail->Body = 'A test email!';
				$cod = $row['cod'];
				$mail->Body='<div style="background-color:#FFF;"><h1 style="text-align:center;"><font style="color:#09F;">A</font><font style="color:#ea4335;">l</font><font style="color:#0C0;">e</font><font style="color:#FF0">x</font> <font style="color:#666;">Workspace</font></h1><br /><br /><br /><div style="padding:60px; text-align:center;"><h2>Hello, ' . $row['username'] . '</h2><h3> <br /><br /> You just aplied for a  password reset. If not, plese delete this mail. <br /> <a href="gnets.myds.me/work/forgot.php?code=' . $cod . '&mail=' . $row['mail'] . '&un=' . $row['username'] . '&mailconf=true" style="padding:10px; border-radius:10px; border:#09F 1px solid; color:#000;">Reset my Alex Workspace password</a><br /><br /><br /><br /><h4 style="text-align:center;">&copy; Alex Sofonea 2021 - Alex Workspace<h4></div>';
				if(!$mail->send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else{
					echo "Message has been sent!";
					header("Location: forgot.php?fa=ok");
					die();
				}
				} catch (Exception $e) {
					echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
				}
			}
			else {
				header("Location: http://gnets.myds.me/work");
				die();
			}
		}
		else {
			header("Location: http://gnets.myds.me/work");
			die();
		}
	}
		
	$conn = $null;
?>

<style>
html {
  height: 100%;
}
body {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background: linear-gradient(#FFF, #CCC);
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(250, 250, 250, 0.7);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
  border-radius: 10px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #999;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #333;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #666;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top: 0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #333;
  pointer-events: none;
  transition: 0.5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #09F;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color:#666;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: 0.5s;
  margin-top: 40px;
  letter-spacing: 4px;
}

.login-box a:hover {
  background: #09F;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #09F, 0 0 25px #09F, 0 0 50px #09F,
    0 0 100px #09F;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #09F);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,
  100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #09F);
  animation: btn-anim2 1s linear infinite;
  animation-delay: 0.25s;
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,
  100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #09F);
  animation: btn-anim3 1s linear infinite;
  animation-delay: 0.5s;
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,
  100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #09F);
  animation: btn-anim4 1s linear infinite;
  animation-delay: 0.75s;
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,
  100% {
    bottom: 100%;
  }
}
.error {
	margin: 0;
	position: absolute;
	left: 50%;
	-ms-transform: translateX(-50%);
	transform: translateX(-50%);
	height:120px;
	width:400px;
	border-radius:10px;
	background-color:#FFF;
	padding:30px;
	color:#000;
	margin-top:30px;
	box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
	/*animation:error 0.3s normal;*/
}
@keyframes error {
	from {transform:translateY(-100%); opacity:0;}
	to {transform:translateY(0%); opacity:1;}
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
	function createCont() {
		if (getUrlVars()["mailconf"] == "true") {
			var pas = checkPass();
			if (pas == true) {
				var p1 = document.getElementById('p1').value;
				var p2 = document.getElementById('p2').value;
				if (p1 == p2) {
					location.assign("http://gnets.myds.me/work/forgot.php?ps=" + p1 + "&mailconf=true&un=" + getUrlVars()["un"] + "&mail=" + getUrlVars()["mail"] + "&code=" + getUrlVars()["code"]);
				}
			}
		}
		else {
			var mail = document.getElementById('mail').value;
			location.assign("http://gnets.myds.me/work/forgot.php?mail=" + mail + "&mailconf=false");
		}
	}
	function loadStart() {
		checkPas();
		if (getUrlVars()['fa'] == "ok") {
			document.getElementById('ok').style.display = "block";
		}
		else {
			document.getElementById('ok').style.display = "none";
		}
	}
	function checkPas() {
		var pas = document.getElementById('p1');
		var username = getUrlVars()["un"];
		
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
	function checkPass() {
		var pas = document.getElementById('p1');
		var username = getUrlVars()["un"];
		if (pas.value.length < 8) {
			document.getElementById('8carac').style.color = "red";
			var ok1 = false;
		}
		else {
			document.getElementById('8carac').style.color = "green";
			var ok1 = true;
		}
		
		if (pas.value.match(/[A-Z]/g)) {
			document.getElementById('cifre').style.color = "green";
			var ok2 = true;
		}
		else {
			document.getElementById('cifre').style.color = "red";
			var ok2 = false;
		}
		
		if (pas.value.includes(username) == true) {
			document.getElementById('nume').style.color = "red";
			var ok3 = false;
		}
		else {
			document.getElementById('nume').style.color = "green";
			var ok3 = true;
		}
		
		if (ok1 == true & ok2 == true & ok3 == true) {
			return(true);
		}
		else {
			return(false);
		}
	}	
</script>

<body onload="loadStart()">
	<div class="error" id="ok">
    	<h4>We send you a mail to reset your password</h4>
    </div>
  <div class="login-box">
  <h2>Forgot password</h2>
  <form>
  	<?php
		if ($_GET['mailconf'] != "true") {
			echo '<div class="user-box">
			  <input type="text" id="mail">
			  <label>Mail</label>
			</div>';
		}
		else {
			echo '<div class="user-box">
			  <input type="text" id="p1" onkeyup="checkPas()">
			  <label>New password</label>
			</div>';
			echo '<div class="user-box">
			  <input type="text" id="p2">
			  <label>New password</label>
			</div>';
			echo '<p id="8carac">min. 8 characters</p>
			<p id="cifre">use at least one capital letter</p>
			<p id="nume">do not use your name in the password</p>';
		}
	?>
    <a href="javascript:createCont()"><span></span><span></span><span></span><span></span>Sign Up</a>
    <!--<button class="g-recaptcha" 
        data-sitekey="6LdlDQkaAAAAAPblZo7sb5PH76gblR3s5Yx2ZoNo" 
        data-callback='onSubmit' 
        data-action='submit'>Submit</button>
  </form>-->
</div>
</form></body>
</html>