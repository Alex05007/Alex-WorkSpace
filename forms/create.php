<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Forms - New form</title>
  <link rel="icon" href="../logo/forms.png" type="image/x-icon" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<?php
if (!isset($_COOKIE['login'])) {
	header('Location: http://gnets.myds.me/work/');
	die();
}
	
if (($_GET['id'] != "" and $_GET['nume'] != "") or (isset($_COOKIE['error']) and isset($_GET['otherId']))) {
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
		}
	catch(PDOException $e)
		{
		echo $e->getMessage();
		}
	if (isset($_COOKIE['error'])) {
		$sql = "SELECT * FROM forms WHERE Id='" . $_GET['otherId'] . "'";
		$stmt = $conn->query($sql);
	} else {
		$sql = "SELECT * FROM forms WHERE Id='" . $_GET['id'] . "'";
		$stmt = $conn->query($sql);
	}
	if ($row = $stmt->fetch()) {
		if (!isset($_COOKIE['error'])) {
			setcookie("error", "1", time() + 86400);
			setcookie("nume", $_GET['nume'], time() + 86400);
			setcookie("algoritm", $_GET['algoritm'], time() + 86400);
			setcookie("deLa", $_GET['deLa'], time() + 86400);
			setcookie("panaLa", $_GET['panaLa'], time() + 86400);
			setcookie("files", $_GET['files'], time() + 86400);
		}
		header('Location: create.php?error=1');
		die();
	} else {
		if (isset($_COOKIE['error'])) {
			setcookie("error", "1", time());
			setcookie("nume", $_GET['nume'], time());
			setcookie("algoritm", $_GET['algoritm'], time());
			setcookie("deLa", $_GET['deLa'], time());
			setcookie("panaLa", $_GET['panaLa'], time());
			setcookie("files", $_GET['files'], time());
			setcookie("idTest", $_GET['otherId'], time() + 86400);
			$sql = "INSERT INTO forms (Id, Titlu, TestCreator, algoritm, deLa, panaLa, files, anonymus, charts, mail) VALUES ('" . $_GET['otherId'] . "','" . $_COOKIE['nume'] . "','" . $_COOKIE['login'] . "', '" . $_COOKIE['algoritm'] . "', '" . $_COOKIE['deLa'] . "', '" . $_COOKIE['panaLa'] . "', '" . $_COOKIE['files'] . "', '" . $_GET['ano'] . "', '" . $_GET['ch'] . "', '" . $_GET['mail'] . "')";
			$stmt = $conn->query($sql);
		} else {
			$sql = "INSERT INTO forms (Id, Titlu, TestCreator, algoritm, deLa, panaLa, files, anonymus, charts, mail) VALUES ('" . $_GET['id'] . "','" . $_GET['nume'] . "','" . $_COOKIE['login'] . "', '" . $_GET['algoritm'] . "', '" . $_GET['deLa'] . "', '" . $_GET['panaLa'] . "', '" . $_GET['files'] . "', '" . $_GET['ano'] . "', '" . $_GET['ch'] . "', '" . $_GET['mail'] . "')";
			$stmt = $conn->query($sql);
		}
		header('Location: intrebare.php');
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
	var myId = getCookie("login");
	var custom = document.getElementById('custom').value;
	if (custom == "") {
		var id = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
	} else {
		var id = custom;
	}
	var algoritm = document.getElementById('algoritm').checked;
	var timp = document.getElementById('timp').checked;
	if (timp == true) {
		var deLa = document.getElementById('deLa').value.replace(/:/gi, "");
		var panaLa = document.getElementById('panaLa').value.replace(/:/gi, "");
	}
	else {
		var deLa = 0;
		var panaLa = 0;
	}
	var filee = document.getElementById('AddFiles').checked;
	if (filee == true) {
		var file = files();
	}
	else {
		var file = "false";
	}
	var maill = document.getElementById('mail').checked;
	if (maill == true) {
		var mail = document.getElementById('maill').value;
	}
	else {
		var mail = "";
	}
	var ano = document.getElementById('ano').checked;
	var ch = document.getElementById('ch').checked;
	if (ano == true) {
		ano = false;
	} else {
		ano = true;
	}
	setCookie("ch", ch, 1);
	setCookie("idTest", id, 1);
	setCookie("intr", "0", 1);
	location.assign("create.php?id=" + id +  "&nume=" + titlu + "&pas=" + myId + "&algoritm=" + algoritm + "&deLa=" + deLa + "&panaLa=" + panaLa + "&files=" + file + "&ano=" + ano + "&ch=" + ch + "&mail=" + mail);
}
	
function change() {
	var check = document.getElementById('timp').checked;
	if (check == true) {
		document.getElementById('deLa').disabled=false;
		document.getElementById('panaLa').disabled=false;
	}
	else {
		document.getElementById('deLa').disabled=true;
		document.getElementById('panaLa').disabled=true;
	}
}
	
function change2() {
	var check = document.getElementById('AddFiles').checked;
	if (check == true) {
		document.getElementById('algoritm').disabled=true;
		document.getElementById('algoritm').checked=false;
		document.getElementById('af').disabled=false;
	}
	else {
		document.getElementById('algoritm').checked=false;
		document.getElementById('af').disabled=true;
		document.getElementById('algoritm').disabled=false;
	}
}
	
function change3() {
	var check = document.getElementById('customm').checked;
	if (check == true) {
		document.getElementById('custom').disabled=false;
	}
	else {
		document.getElementById('custom').disabled=true;
	}
}
	
function change4() {
	var check = document.getElementById('mail').checked;
	if (check == true) {
		document.getElementById('maill').disabled=false;
	}
	else {
		document.getElementById('maill').disabled=true;
	}
}
	
function change5() {
	var check = document.getElementById('ano').checked;
	if (check == false) {
		document.getElementById('ch').disabled=false;
	}
	else {
		document.getElementById('ch').disabled=true;
	}
}
function loadStart() {
	if (getUrlVars()["brukform"] == "true") {
		setCookie("brukforms", "true", 1);
	} else {
		setCookie("brukforms", "false", -1);
	}
	if (getUrlVars()["error"] == "1") {
		var otherId = prompt("The id was taken. Plese choose an other one.");
		location.assign("create.php?otherId=" + otherId);
	}
	change();
	change2();
	change3();
	change5();
	formlimk();
}

  function files() {
	  var id = getCookie("login");
	  var files = "";
	  var i;
	  var files = document.getElementsByName('files');
	  for (i=0; i<files.length; i++) {
		  if (files[i].checked == true && files[i].id != "videof" && files[i].id != "imgf" && files[i].id != "descf") {
			  files = "http://gnets.myds.me/work/?" + files[i].value;
		  }
		  if (files[i].checked == true && files[i].id == "videof") {
			  files = "vIDEo: " + document.getElementById('vidl').value;
		  }
		  if (files[i].checked == true && files[i].id == "imgf") {
			  files = "iMAGe: " + document.getElementById('imgl').value;
		  }
		  if (files[i].checked == true && files[i].id == "descf") {
			  files = "DESc: " + document.getElementById('desc').value;
		  }
	  }
	  return files;
  }
  
  function formlimk() {
	  if (document.getElementById('custom').value != "") {
	  	document.getElementById('formLink').innerHTML = document.getElementById('custom').value;
	  }
	  else {
		var id = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
		setCookie("idTest", id, 1);
		document.getElementById('formLink').innerHTML = id;
		document.getElementById('custom').value = "";
	  }
  }
</script>

<style>
@media screen and (max-width: 768px) {
	body {
	  font: 400 16px "Varela Round", sans-serif;
	}
  .wrapper{
	width: 100% !important;
	background: #fff;
	padding: 30px;
	border:#CCC 1px solid;
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
	border:#CCC 1px solid;
	border-radius:10px;
  }
}
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
.wrapper .input-data{
  height: 40px;
  width: 100%;
  position: relative;
}
.wrapper .input-data input{
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
  color: #09F;
}
.wrapper .input-data label{
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
  background: #09F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}
</style>

<body onload="loadStart()">
	<?php
		include "../nav.php";
	?>
<br />
    <link rel="stylesheet" href="../letter.css" />
    <div class="bounce2">
        <span class="letter2">A</span>
        <span class="letter2">l</span>
        <span class="letter2">e</span>
        <span class="letter2">x</span>
        <h4> Forms</h4>
        <img src="../logo/forms.png" width="30px" style="margin-left:10px;"/>
    </div>
<br />
<br />
<br />

<div class="wrapper">
    <div class="input-data">
    <input type="text" id="titlu" required maxlength="999" />
    <div class="underline"></div>
    <label>Form title</label></div>
    
<br />
<hr />

<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="algoritm" value="true"/>
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
  <label for="algoritm"> <font style="color:#FFF; background-color:#FC0; border-radius:5px;">BETA</font> Algorithm that detects if someone search the responses on the web.</label>
</div>

<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="timp" value="true" onchange="change()"/>
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
  <label for="timp"> Limited time: from:<input type="time" id="deLa" /> -> to:<input type="time" id="panaLa"/></label>
</div>

<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="AddFiles" onchange="change2()"/>
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
  <label for="AddFiles">
  	 <button id="af" class="mdc-button" data-toggle='modal' data-target='#file'>
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label" style="font-size:14px;">Ad aditional files</span>
     </button>
  </label>
</div>
<br />
<hr />
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
  		Assign custom id (for url shortner): 
        </label><div class="input-data">
        <input type="text" id="custom" required maxlength="10" onkeyup="formlimk()" />
        <div class="underline"></div>
        <label>Custom id</label></div>
  
</div>
<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="mail" onchange="change4()"/>
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
  <label for="mail">
  		Email me the answers.
        </label><div class="input-data">
        <input type="text" id="maill" required maxlength="100" />
        <div class="underline"></div>
        <label>Your E-Mail</label></div>
  
</div>
<br />
<?php 
	if (!isset($_GET['brukform'])) {
		echo '<h4>Your Link is: <br /> https://alexs.gq/f#<strong><c id="formLink"></c></strong></h4>';
	} else {
		echo '<h4>Your Link is: <br /> https://alexs.gq/b#<strong><c id="formLink"></c></strong></h4>';
	}
?>
<hr />
<h4>Just for <i>Pool</i> or <i>BrukForm</i></h4>
<?php
	if ($_GET['fa'] == "form") {
		echo '<div class="mdc-form-field">
		  <div class="mdc-checkbox">
			<input type="checkbox"
				   class="mdc-checkbox__native-control"
				   id="ano" onchange="change5()"/>
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
		  <label for="ano">
				Collect names
		  </label>
		</div>
		<br />
		<div class="mdc-form-field">
		  <div class="mdc-checkbox">
			<input type="checkbox"
				   class="mdc-checkbox__native-control"
				   id="ch"/>
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
		  <label for="ch">
				Create char stats (you can\'t add text fields) -> <i>for pool</i>
		  </label>
		</div>';
	}
	if ($_GET['fa'] == "pool") {
		echo '<div class="mdc-form-field">
		  <div class="mdc-checkbox">
			<input type="checkbox"
				   class="mdc-checkbox__native-control"
				   id="ano" onchange="change5()" checked="checked"/>
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
		  <label for="ano">
				Anonymus responses
		  </label>
		</div>
		<br />
		<div class="mdc-form-field">
		  <div class="mdc-checkbox">
			<input type="checkbox"
				   class="mdc-checkbox__native-control"
				   id="ch" checked="checked"/>
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
		  <label for="ch">
				Create char stats (you can\'t add text fields) -> <i>for pool</i>
		  </label>
		</div>';
	}
?>

<br />
<br />

</div>

<br />
<br />
<br />
        

<button class="mdc-button mdc-button--raised" onclick="save()">
  <span class="mdc-button__ripple"></span>
  <span class="mdc-button__label">Write the questins!</span>
</button>

<br />
<hr />
<footer>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>
  
  <div id="file" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose a file to send</h4>
      </div>
      <div class="modal-body">
			<?php
				$a=0;
                $hostname = 'localhost:3307';
                include "../db.php";
                try {
                    $conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
				$sql = "SELECT * FROM forms WHERE TestCreator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="forms=' . $row['Id'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><img src="../logo/forms.png" width="20px"> ' . $row['Titlu'] . '</label>
					</div><br />';
				}
				
                $hostname = 'localhost:3307';
                include "../db.php";
                try {
                    $conn = new PDO("mysql:host=$hostname;dbname=alextext", $username, $password);
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
				$sql = "SELECT * FROM documente WHERE Creator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="text=' . $row['Id'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><img src="../logo/text.png" width="20px"> ' . $row['Titlu'] . '</label>
					</div><br />';
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
				$sql = "SELECT * FROM prezentari WHERE Creator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="slides=' . $row['Id'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><img src="../logo/slides.png" width="20px"> ' . $row['Titlu'] . '</label>
					</div><br />';
				}
				
                /*$hostname = 'localhost:3307';
                include "../db.php";
                try {
                    $conn = new PDO("mysql:host=$hostname;dbname=alexcloud", $username, $password);
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
				$sql = "SELECT * FROM cloud WHERE creator='" . $_COOKIE['login'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
					$a++;
					echo '<div class="mdc-form-field">
					  <div class="mdc-radio">
						<input class="mdc-radio__native-control" type="radio" id="file-' . $a . '" name="files" value="file=' . $row['name'] . '">
						<div class="mdc-radio__background">
						  <div class="mdc-radio__outer-circle"></div>
						  <div class="mdc-radio__inner-circle"></div>
						</div>
						<div class="mdc-radio__ripple"></div>
					  </div>
					  <label for="file-' . $a . '" id="lb-' . $a . '"><i class="far fa-file" style="font-size:20px; color:#666;"></i> ' . $row['org'] . '</label>
					</div><br />';
				}*/
				$a++;
			?>
            <div class="mdc-form-field">
              <div class="mdc-radio">
                <input class="mdc-radio__native-control" type="radio" id="videof" name="files" />
                <div class="mdc-radio__background">
                  <div class="mdc-radio__outer-circle"></div>
                  <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
              </div>
              <label for="videos">
                    <!--<div class="input-data">-->
                        <input type="text" id="vidl" required placeholder="Add links from videos" width="100%"/>
                        <!--<div class="underline"></div>
                        <label>Add links from videos</label>
                    </div>-->
              </label>
            </div><br />
            <div class="mdc-form-field">
              <div class="mdc-radio">
                <input class="mdc-radio__native-control" type="radio" id="imgf" name="files" />
                <div class="mdc-radio__background">
                  <div class="mdc-radio__outer-circle"></div>
                  <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
              </div>
              <label for="imgf">
                    <!--<div class="input-data">-->
                        <input type="text" id="imgl" required placeholder="Add links from fotos" width="100%"/>
                        <!--<div class="underline"></div>
                        <label>Add links from videos</label>
                    </div>-->
              </label>
            </div><br />
            <div class="mdc-form-field">
              <div class="mdc-radio">
                <input class="mdc-radio__native-control" type="radio" id="descf" name="files" />
                <div class="mdc-radio__background">
                  <div class="mdc-radio__outer-circle"></div>
                  <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
              </div>
              <label for="descf">
                    <!--<div class="input-data">-->
                        <input type="text" id="desc" required placeholder="Add a description" width="100%"/>
                        <!--<div class="underline"></div>
                        <label>Add links from videos</label>
                    </div>-->
              </label>
            </div><br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>
