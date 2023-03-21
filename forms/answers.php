<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../logo/forms.png" type="image/x-icon" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LMF5101H4Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LMF5101H4Y');
</script>
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>

<?php
$hostname = 'localhost:3307';
include "../db.php";
try {
    $conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

$titlu = "SELECT * FROM forms WHERE Id='" . $_GET['id'] . "'";
$titlu2 = $conn->query($titlu);
if($tit = $titlu2->fetch()){
	echo "<title>Alex Forms - Answers - " . $tit['Titlu'] . "</title>";
}
if (isset($_GET['com'])) {
	$sql = "UPDATE `raspunsuri` SET `comentariu`='" . $_GET['com'] . "' WHERE id='" . $_GET['sId'] . "' and test='" . $_GET['id'] . "'";
	$smtp = $conn->query($sql);
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
function comment() {
	var comment = document.getElementById('comment').value;
	if (comment != "") {
		location.assign("answers.php?com=" + comment + "&id=" + getUrlVars()["id"] + "&sId=" + getUrlVars()["sId"]);
	}
}
</script>

<style>
footer {
	text-align:center;
}

.org-form label {
  cursor: pointer;
}
.org-form input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  position: relative;
  height: var(--radio-size);
  width: var(--radio-size);
  outline: none;
  margin: 0;
  cursor: pointer;
  border: 2px solid var(--radio);
  background: transparent;
  border-radius: 50%;
  display: grid;
  justify-self: end;
  justify-items: center;
  -webkit-box-align: center;
          align-items: center;
  overflow: hidden;
  -webkit-transition: border 0.5s ease;
  transition: border 0.5s ease;
}
.org-form input[type="radio"]::before, .org-form input[type="radio"]::after {
  content: "";
  display: -webkit-box;
  display: flex;
  justify-self: center;
  border-radius: 50%;
}
.org-form input[type="radio"]::before {
  position: absolute;
  width: 100%;
  height: 100%;
  background: var(--background);
  z-index: 1;
  opacity: var(--opacity, 1);
}
.org-form input[type="radio"]::after {
  position: relative;
  width: calc(100% / 2);
  height: calc(100% / 2);
  background: var(--radio-checked);
  top: var(--y, 100%);
  -webkit-transition: top 0.5s cubic-bezier(0.48, 1.97, 0.5, 0.63);
  transition: top 0.5s cubic-bezier(0.48, 1.97, 0.5, 0.63);
}
.org-form input[type="radio"]:checked {
  --radio: var(--radio-checked);
}
.org-form input[type="radio"]:checked::after {
  --y: 0%;
  -webkit-animation: stretch-animate 0.3s ease-out 0.17s;
          animation: stretch-animate 0.3s ease-out 0.17s;
}
.org-form input[type="radio"]:checked::before {
  --opacity: 0;
}
.org-form input[type="radio"]:checked ~ input[type="radio"]::after {
  --y: -100%;
}
.org-form input[type="radio"]:not(:checked)::before {
  --opacity: 1;
  -webkit-transition: opacity 0s linear 0.5s;
  transition: opacity 0s linear 0.5s;
}
.org-form label {
	width:300px;
}

@-webkit-keyframes stretch-animate {
  0% {
    -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
  }
  28% {
    -webkit-transform: scale(1.15, 0.85);
            transform: scale(1.15, 0.85);
  }
  50% {
    -webkit-transform: scale(0.9, 1.1);
            transform: scale(0.9, 1.1);
  }
  100% {
    -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
  }
}

@keyframes stretch-animate {
  0% {
    -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
  }
  28% {
    -webkit-transform: scale(1.15, 0.85);
            transform: scale(1.15, 0.85);
  }
  50% {
    -webkit-transform: scale(0.9, 1.1);
            transform: scale(0.9, 1.1);
  }
  100% {
    -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
  }
}

body .socials {
  position: fixed;
  display: block;
  left: 20px;
  bottom: 20px;
}
body .socials > a {
  display: block;
  width: 30px;
  opacity: 0.2;
  -webkit-transform: scale(var(--scale, 0.8));
          transform: scale(var(--scale, 0.8));
  -webkit-transition: -webkit-transform 0.3s cubic-bezier(0.38, -0.12, 0.24, 1.91);
  transition: -webkit-transform 0.3s cubic-bezier(0.38, -0.12, 0.24, 1.91);
  transition: transform 0.3s cubic-bezier(0.38, -0.12, 0.24, 1.91);
  transition: transform 0.3s cubic-bezier(0.38, -0.12, 0.24, 1.91), -webkit-transform 0.3s cubic-bezier(0.38, -0.12, 0.24, 1.91);
}
body .socials > a:hover {
  --scale: 1;
}
.button {
  border: none;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.5s;
  cursor: pointer;
  border-radius:16px;
  
}

.text:hover {
	border-bottom: 2px solid #09F;
	padding:10px;
	font-size:25px;
	color:#000;
}
.titlu {
	background-color:transparent;
	border: 1px solid #09F;
	border-radius:10px;
	padding:5px;
	color:#333;
	font-size:30px;
	transition:all 0.5s;
}
.titlu:hover {
	border: 2px solid #09F;
	padding:10px;
	border-radius:20px;
	font-size:35px;
	color:#000;
}

.button1 {
  background-color: transparent; 
  color: black; 
  border: 2px solid #09F;
}

.button1:hover {
  background-color: #09F;
  color: white;
}

.button1 i {
  color:#0C0;
  font-size:24px;
  transition: color 0.5s; 
}

.button1:hover i {
  color: white;
}

.button2 {
  background-color: transparent; 
  color: black; 
  border: 2px solid #09F;
}

.button2:hover {
  background-color: #09F;
  color: white;
}

.button2 i {
  color:#09F;
  font-size:24px;
  transition: color 0.5s; 
}

.button2:hover i {
  color: white;
}

@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
.wrapper .input-data{
  height: inherit;
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
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}



.slideanim {visibility:hidden;}
  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  .slideanim2 {visibility:hidden;}
  .slide2 {
    animation-name: slide2;
    -webkit-animation-name: slide2;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  .slideanim3 {visibility:hidden;}
  .slide3 {
    animation-name: slide3;
    -webkit-animation-name: slide3;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  .logoanim {
	  animation: logoanim infinite;
	  animation-duration: 3s;
	  animation-direction:alternate;
	  animation-delay:0.5s;
	  visibility: visible;
  }
  
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @keyframes slide2 {
    0% {
      opacity: 0;
      transform: translateX(-70%);
    } 
    100% {
      opacity: 1;
      transform: translateX(0%);
    }
  }
  @-webkit-keyframes slide2 {
    0% {
      opacity: 0;
      -webkit-transform: translateX(-70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateX(0%);
    }
  }
  @keyframes slide3 {
    0% {
      opacity: 0;
      transform: translateX(70%);
    } 
    100% {
      opacity: 1;
      transform: translateX(0%);
    }
  }
  @-webkit-keyframes slide3 {
    0% {
      opacity: 0;
      -webkit-transform: translateX(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateX(0%);
    }
  }
  @media screen and (max-width: 721px) {
	.input-data .underline:before{
	  position:absolute;
	  content: "";
	  height: 100%;
	  width: 100%;
	  bottom:9px;
	  background: #09F;
	  transform: scaleX(0);
	  transform-origin: center;
	  transition: transform 0.5s ease-in-out;
	}
    body {
	  /*background: #e8ebf3;
	  background-image: url("bg.jpg");
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-size:cover;
	  background-position:right;*/
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
	.text {
		background-color:transparent;
		/*border-radius:10px;*/
		text-align:center;
		padding:5px;
		color:#000;
		font-size:20px;
		transition:all 0.5s;
	}
	.org-form{
	  --background: #ffffff;
	  --text: #414856;
	  --radio: #7c96b2;
	  --radio-checked: #09F;
	  --radio-size: 20px;
	  --width: 300px;
	  --height: inherit;
	  --border-radius: 10px;
	  background: var(--background);
	  width: var(--width);
	  height: var(--height);
	  border-radius: var(--border-radius);
	  color: var(--text);
	  position: relative; 
 	  box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);
	  padding: 30px 20px;
	  display: grid;
	  grid-template-columns: auto var(--radio-size);
	}
	.wrapper{
	  width: 80%;
	  background: #fff;
	  padding: 30px;
	  /*box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);*/
	  border:#CCC 1px solid;
	  border-radius:10px;
	}
	.top{
	  width: 80%;
	  background: #fff;
	  padding: 30px;
	  /*box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);*/
	  border:#CCC 1px solid;
	  border-radius:10px;
	  border-top: #09F 30px solid;
	}
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 101%;
	  bottom: -10px;
	}
	.mark {
		position:fixed;
		bottom:50px;
		right:10px;
	}
  }
  @media screen and (min-width: 721px) {
	.input-data .underline:before{
	  position:absolute;
	  content: "";
	  height: 100%;
	  width: 100%;
	  bottom:4px;
	  background: #09F;
	  transform: scaleX(0);
	  transform-origin: center;
	  transition: transform 0.5s ease-in-out;
	}
	.mark {
		float:right !important;
		transform:translateX(105%);
	}
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 101%;
	  bottom: -4px;
	}
	.wrapper{
	  width: 750px;
	  background: #fff;
	  padding: 30px;
	  /*box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);*/
	  border:#CCC 1px solid;
	  border-radius:10px;
	}
	.top{
	  width: 750px;
	  background: #fff;
	  padding: 0px 30px;
	  /*box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);*/
	  border:#CCC 1px solid;
	  border-radius:10px;
	  border-top: #09F 20px solid;
	}
    body {
	  /*background: #e8ebf3;
	  background-image: url("bg.jpg");
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-size:cover;
	  background-position:right;*/
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
	.text {
		background-color:transparent;
		border-bottom: 1px solid #09F;
		/*border-radius:10px;*/
		padding:5px;
		color:#333;
		font-size:20px;
		transition:all 0.5s;
	}
	.org-form{
	  --background: #ffffff;
	  --text: #414856;
	  --radio: #7c96b2;
	  --radio-checked: #09F;
	  --radio-size: 20px;
	  --width: 100px;
	  --height: inherit;
	  --border-radius: 10px;
	  background: var(--background);
	  width: var(--width);
	  height: var(--height);
	  border-radius: var(--border-radius);
	  color: var(--text);
	  position: relative;
  	  box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);
	  padding: 30px 205px;
	  display: grid;
	  grid-template-columns: auto var(--radio-size);
	}
  }
  
  @keyframes inOut {
    0% {
      transform: translateX(500%);
    } 
    100% {
      transform: translateX(0%);
    }
  }
  @keyframes outIn {
    0% {
      transform: translateX(-230%);
    } 
    100% {
      transform: translateX(0%);
    }
  }
  .slidecontainer {
  width: 100%;
  }

.mdc-button {
	--mdc-theme-primary:#09F;
	--mdc-theme-secondary:#333;
	--mdc-theme-background:#09F;
	--mdc-theme-surface:#09F;
}
.mdc-form-field {
	--mdc-theme-primary:#09F;
	--mdc-theme-secondary:#09F;
	--mdc-theme-background:#09F;
	--mdc-theme-surface:#09F;
}


.abuz {
	font-size:24px;
	position:fixed;
	color:#09F;
	left:30px;
	bottom:30px;
	border-radius:20px;
	padding:0px;
	background-color:transparent;
    transition:all 0.3s ease-in-out;
}
.abuz:hover {
	left:20px;
	bottom:20px;
	color:#09F;
	padding:10px;
	padding-right:300px;
	background-color:#CCC;
}
.abuz .h a {
	text-decoration:none;
	color:#FFF;
	margin:2px;
	font-size:12px;
}
.abuz .h {
	position:fixed;
	bottom:30px;
	left:-260px;
	transition:all 0.3s;
	z-index:-1;
}
.abuz:hover .h {
  left:60px;
}
.abuz strong {
	color:#FFF;
}
.abuz:hover strong {
	color:#999;
}
</style>

<body onload="loadStart()">
<div class="top">
    <?php
		$sql = "SELECT * FROM raspunsuri WHERE test='" . $_GET['id'] . "' and id='" . $_GET['sId'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()){
			$raspuns = $row['raspunsuri'];
			$nume = $row['nume'];
		}
		$raspunsuri = explode(";", $raspuns);
		//echo $raspuns;
        echo "<h1>" . $tit['Titlu'] . " - " . $nume . "</h1>";
		echo '<a href="http://gnets.myds.me/work/forms/admin.php?id=' . $_GET['id'] . '" class="mdc-button mdc-button--raised" style="position:fixed; top:10px; left:10px;">
		   <span class="mdc-button__ripple"></span>
		   <span class="mdc-button__label" style="font-size:16px;">Back to all answers</span>
		</a>';
    ?>
</div>
<br />

<?php
$intrebari_tip = array();
$intr_nr=0;
$sql = "SELECT * FROM question WHERE Testid='" . $_GET['id'] . "'";
$stmt = $conn->query($sql);
while($row = $stmt->fetch()){
	$r = explode(":", $raspunsuri[$intr_nr]);
	if ($row['Tip'] == "radio") {
		echo '<div class="wrapper">';
		echo "<h3 id='intr" . $intr_nr . "'>" . $row['Intrebare'] . "</h3>"; 
		$rasp = explode(";", $row['Raspuns']);
		for ($i=0; $i<count($rasp)-1; $i++) {
			echo '<div class="mdc-form-field">
			  <div class="mdc-radio">
				<input class="mdc-radio__native-control" type="radio" id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" ';
				if ($rasp[$i] == $r[1]) {
					echo 'checked="checked"';
				}
				echo ' disabled="disabled">
				<div class="mdc-radio__background">
				  <div class="mdc-radio__outer-circle"></div>
				  <div class="mdc-radio__inner-circle"></div>
				</div>
				<div class="mdc-radio__ripple"></div>
			  </div>
			  <label for="rr' . $intr_nr . $i . '">' . $rasp[$i] . '</label>
			</div><br />';
		}
		echo '</div><br /><br />';
	}
	if ($row['Tip'] == "checkbox") {
		echo '<div class="wrapper">';
		echo "<h3 id='intr" . $intr_nr . "'>" . $row['Intrebare'] . "</h3>"; 
		$rasp = explode(";", $row['Raspuns']);
		for ($i=0; $i<count($rasp)-1; $i++) {
			echo '<div class="mdc-form-field">
			  <div class="mdc-checkbox">
				<input type="checkbox"
					   class="mdc-checkbox__native-control"
					   id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" ';
				if (strpos($r[1], $rasp[$i]) !== false) {
					echo 'checked="checked"';
				}
				echo ' disabled="disabled">
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
			  <label for="rr' . $intr_nr . $i . '">' . $rasp[$i] . '</label>
			</div><br />';
		}
		echo '</div><br /><br />';
	}
	if ($row['Tip'] == "completare") {
		echo '<div class="wrapper">';
		echo "<h3 id='intr" . $intr_nr . "'>" . $row['Intrebare'] . "</h3>"; 
		echo '<div class="input-data">
			<input type="text" required="required" name="rasp' . $intr_nr . '" value="' . $r[1] . '" readonly="readonly">
			<div class="underline"></div>
			<label>Answer <font style="color:#F00">*</font></label></div>
			</div><br />';
	}
	if ($row['Tip'] == "img_r") {
		echo '<div class="wrapper">';
		echo "<h3 id='intr" . $intr_nr . "'>" . $row['Intrebare'] . "</h3>"; 
		$rasp = explode(";", $row['Raspuns']);
		for ($i=0; $i<count($rasp)-1; $i++) {
			echo '<div class="mdc-form-field">
			  <div class="mdc-radio">
				<input class="mdc-radio__native-control" type="radio" id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" ';
				if ($rasp[$i] == $r[1]) {
					echo 'checked="checked"';
				}
				echo ' disabled="disabled">
				<div class="mdc-radio__background">
				  <div class="mdc-radio__outer-circle"></div>
				  <div class="mdc-radio__inner-circle"></div>
				</div>
				<div class="mdc-radio__ripple"></div>
			  </div>
			  <label for="rr' . $intr_nr . $i . '"><img src="' . str_replace("|||", ";", $rasp[$i]) . '" width="50%" /></label>
			</div><br />';
		}
		echo '</div><br /><br />';
	}
	if ($row['Tip'] == "img_c") {
		echo '<div class="wrapper">';
		echo "<h3 id='intr" . $intr_nr . "'>" . $row['Intrebare'] . "</h3>"; 
		$rasp = explode(";", $row['Raspuns']);
		for ($i=0; $i<count($rasp)-1; $i++) {
			echo '<div class="mdc-form-field">
			  <div class="mdc-checkbox">
				<input type="checkbox"
					   class="mdc-checkbox__native-control"
					   id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" ';
				if (strpos($r[1], $rasp[$i]) !== false) {
					echo 'checked="checked"';
				}
				echo ' disabled="disabled">
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
			  <label for="rr' . $intr_nr . $i . '"><img src="' . str_replace("|||", ";", $rasp[$i]) . '" width="50%" /></label>
			</div><br />';
		}
		echo '</div><br /><br />';
	}
	if ($row['Tip'] == "info") {
		echo '<div class="wrapper">';
		echo "<h3 id='intr" . $intr_nr . "'>" . $row['Intrebare'] . "</h3></div><br />"; 
		$intr_nr = $intr_nr - 1;
	}
	$intr_nr++;
}
?>

<br />
<div class="mark">
    <div class="wrapper" style=" width:200px;">
    <div class="input-data">
    <input type="text" required="required" id="comment" maxlength="1000" />
    <div class="underline"></div>
    <label>Add a comment</label></div>
    </div><br />
    <button class="mdc-button mdc-button--raised" style="float:right;" onclick="comment()">
      <span class="mdc-button__ripple"></span>
      <span class="mdc-button__label">Submit!</span>
    </button>
</div>
<br />

<div class="abuz"><i class="fas fa-info-circle"></i><div class="h"><a href="http://gnets.myds.me/work/forms/raspunde.php?id=abuse" target="_blank">Raport an abuse</a><strong> | </strong><a href="http://gnets.myds.me/work/forms/raspunde.php?id=bug" target="_blank">Raport a bug</a><strong> | </strong><a href="http://gnets.myds.me/work/support" target="_blank">Support</a></div></div>

<footer>
<?php
	if ($_GET['id'] != "abuse" and $_GET['id'] != "bug") {
		echo "<p><strong>Never</strong> submit passwords through Alex Forms and <strong>never</strong> submit personal information through an unknow Alex Forms form.</p> 
		<p>This content is neither created or endorsed by <strong>Alex Workspace</strong>.</p>";
	} else {
		echo "<p>This content is created and endorsed by <strong>Alex Workspace</strong>.</p>";
	}
?>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>

<!--<button class="button button2" onclick="help()" style="position:fixed; right:60px; top:60px;"><i class="fa fa-info"></i></button>
<div id="helpBox">Deruleaza in jos pentru a vedea tot formularul pana la butonul "Submit!"<br /><br /><br /><a onclick="javascript:help()">&times;</a></div>-->
</body>
</html>
