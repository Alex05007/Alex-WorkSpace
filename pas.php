<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alex workspace - Change password</title>
<link rel="icon" href="logo.png" type="image/x-icon">
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
	if ($_GET['pas'] != "") {
		$sql = "SELECT * FROM conturi WHERE Id = '" . $_COOKIE['login'] . "' and password = '" . openssl_encrypt($_GET['paso'],"AES-128-ECB",$_COOKIE['un'].$_GET['paso']) . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			$sql = "UPDATE conturi SET password = '" . openssl_encrypt($_GET['pas'],"AES-128-ECB",$_COOKIE['un'].$_GET['pas']) . "' WHERE Id = '" . $_COOKIE['login'] . "'";
			$stmt = $conn->query($sql);
			setcookie("login", $row['Id'], time() + (3600*12));
			setcookie("un", $row['username'], time() + (3600*12));
			header("Location: indexLog.php");
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
	function pas() {
		var ok = checkPass();
		if (ok == true) {
			setCookie("schimb", "true", 1);
			var ps = document.getElementById('pas').value;
			var psa = document.getElementById('pasa').value;
			var pso = document.getElementById('paso').value;
			if (ps == psa) {
				location.assign("http://gnets.myds.me/work/pas.php?pas=" + ps + "&paso=" + pso);
			}
		}
	}
	function checkPassword() {
		var pas = document.getElementById('pas');
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
	}	
	function checkPass() {
		var pas = document.getElementById('pas');
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
		
		if (ok1 == true & ok2 == true) {
			return(true);
		}
		else {
			return(false);
		}
	}
</script>

<body>
	<div class="login-box">
  <h2>Change Password</h2>
  <form>
    <div class="user-box">
      <input type="password" id="paso" required="required" onkeyup="checkPassword()">
      <label>Old password</label>
    </div>
    <div class="user-box">
      <input type="password" id="pas" required="required" onkeyup="checkPassword()">
      <label>Password</label>
    </div>
    <div class="user-box">
      <input type="password" id="pasa" required="required" onkeyup="checkPassword()">
      <label>Password again</label>
      <p id="8carac">min. 8 characters</p>
      <p id="cifre">use at least one capital letter</p>
    </div>
    <a href="javascript:pas()"><span></span><span></span><span></span><span></span>Change</a>
  </form>
</div>
</body>
</html>