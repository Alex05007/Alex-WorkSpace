<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../logo/forms.png" type="image/x-icon">
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
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  
  <link rel="stylesheet" href="../ripple.css" />
  <script src="../ripple.js"></script>
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
	if ($tit['algoritm'] == "true" or $tit['algoritm'] == "") {
	}
	else {
		setcookie("algoritm", "false", time() + 3600, "/");
	}
	//if ($row['TestCreator'] != $_COOKIE['login']) {
		if ($tit['deLa'] != 0 and $tit['panaLa'] != 0) {
			if (date("Gi") < $tit['deLa'] or $tit['panaLa'] < date("Gi")) {
				header("Location: http://gnets.myds.me/work/forms/timp.php?id=" . $_GET['id']);
				die();
			}
			setcookie("deLa", $row['deLa'], time() + 86400);
			setcookie("panaLa", $row['panaLa'], time() + 86400);
		}
		else {
			setcookie("timp", "false", time() + 86400);
		}
	//}
	echo "<title>Alex Forms - " . $tit['Titlu'] . "</title>";
	$ano = $tit['anonymus'];
	setcookie("ano", $ano, time() + 86400);
}

if ($_GET['r'] != "") {
	if ($tit['deLa'] != 0 and $tit['panaLa'] != 0) {
		if (date("Gi") < $tit['deLa'] or $tit['panaLa'] < date("Gi")) {
			header("Location: http://gnets.myds.me/work/forms/timp.php?id=" . $_GET['id']);
			die();
		} else {
			$sql = "INSERT INTO raspunsuri (id, nume, raspunsuri, test, parasiri, comentariu) VALUES ('" . $_GET['sId'] . "', '" . $_GET['nume'] . "', '" . $_GET['r'] . "', '" . $_GET['id'] . "', '" . $_GET['parasiri'] . "', '')";
			$stmt = $conn->query($sql);
			header("Location: http://gnets.myds.me/work/forms/rezolvat.php?id=" . $_GET['id']);
			die();
		}
	}
	else {
		$sql = "INSERT INTO raspunsuri (id, nume, raspunsuri, test, parasiri, comentariu) VALUES ('" . $_GET['sId'] . "', '" . $_GET['nume'] . "', '" . $_GET['r'] . "', '" . $_GET['id'] . "', '" . $_GET['parasiri'] . "', '')";
		$stmt = $conn->query($sql);
		header("Location: http://gnets.myds.me/work/forms/rezolvat.php?id=" . $_GET['id']);
		die();
	}
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
var h = false;
function help() {
	document.getElementById("helpBox").style.display = "block";
	var helpB = document.getElementById('helpBox');
	if (h == false) {
		helpB.classList.toggle("help");
		h = true; }
	else {
		helpB.classList.toggle("helpI");
		setTimeout(function(){ helpB.classList.toggle("helpN"); }, 1000);
		h = false; }
}
$(document).ready(function(){
  $("footer a[href='#aForms'], .cf2 a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().style
      }, 900, function(){
        window.location.hash = hash;
      });
    }
  });

//slideanim  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 900) {
          $(this).addClass("slide");
        }
    });
  });
});
//slideanim2
$(window).scroll(function() {
  $(".slideanim2").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide2");
    }
  });
});
//slideanim3
$(window).scroll(function() {
  $(".slideanim3").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide3");
    }
  });
});

var testId = getUrlVars()['id'];

function trisare() {
	var algoritm = getCookie("algoritm");
	if (algoritm == "true") {
		var trisare = getCookie(testId);
		trisare = Number(trisare) + 1;
		setCookie(testId, trisare, 1);
	}
}

function submitForms(intr_nr){
	var raspuns = "";
	for (var i=0; i<intr_nr; i++) {
		var rasp = document.getElementsByName('rasp' + i);
		var intr = document.getElementById('intr' + i).innerHTML;
		raspuns = raspuns + intr + ":";
		if (rasp[0].type == "radio") {
			for (var y=0; y<rasp.length; y++) {
				if (rasp[y].checked == true) {
					raspuns = raspuns + rasp[y].value;
				}
			}
		}
		if (rasp[0].type == "checkbox") {
			for (var y=0; y<rasp.length; y++) {
				if (rasp[y].checked == true) {
					raspuns = raspuns + rasp[y].value + ",";
				}
			}
		}
		if (rasp[0].type == "text") {
			raspuns = raspuns + rasp[0].value;
		}
		raspuns = raspuns + "; ";
	}
	var parasiri = getCookie(testId);
	if (getCookie("ano") == "false") {
		var nume = document.getElementById('nume').value;
	} else {
		var nume = "";
	}
	setCookie(testId, "", -1);
	var sId = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
	setCookie("sId", sId, 1);
	setCookie("r", raspuns, -1);
	location.assign("raspunde.php?id=" + testId + "&nume=" + nume + "&r=" + btoa(raspuns) + "&parasiri=" + parasiri + "&sId=" + sId);
}

function loadStart() {
	setCookie(testId, "0", 1);
}

function changeForm() {
	var nr_intr = document.getElementsByName('intr').length;
	var raspuns = "";
	for (var i=0; i<nr_intr; i++) {
		var rasp = document.getElementsByName('rasp' + i);
		var intr = document.getElementById('intr' + i).innerHTML;
		raspuns = raspuns + intr + ":";
		if (rasp[0].type == "radio") {
			for (var y=0; y<rasp.length; y++) {
				if (rasp[y].checked == true) {
					raspuns = raspuns + rasp[y].value;
				}
			}
		}
		if (rasp[0].type == "checkbox") {
			for (var y=0; y<rasp.length; y++) {
				if (rasp[y].checked == true) {
					raspuns = raspuns + rasp[y].value + ",";
				}
			}
		}
		if (rasp[0].type == "text") {
			raspuns = raspuns + rasp[0].value;
		}
		raspuns = raspuns + "; ";
	}
	setCookie("r", raspuns, 1);
}

/*setTimeout(function() {
	if (getCookie("timp") != "false") {
		var d = new Date();
		if (Number(getCookie("deLa")) > Number(String(d.getHours()) + String(d.getMinutes())) || Number(getCookie("panaLa")) < Number(String(d.getHours()) + String(d.getMinutes()))) {
			location.assign("timp.php?id=" + getUrlVars()["id"]);
		}
	}
}, 5000);*/
</script>

<style>
footer {
	text-align:center;
}
.button {
  padding: 16px 32px;
  
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
	  bottom:10px;
	  background: #09F;
	  transform: scaleX(0);
	  transform-origin: center;
	  transition: transform 0.5s ease-in-out;
	}
    form {
	  font: 400 16px "Varela Round", sans-serif;
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
	  #forphone {
		  display:block;
	  }
	  #forothers {
		  display:none;
	  }
  }
  @media screen and (min-width: 721px) {
	  #forphone {
		  display:none;
	  }
	  #forothers {
		  display:block;
	  }
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
	  font: 400 16px "Varela Round", sans-serif;
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
form {
	transform: scale(0.1, 0.1);
	position: fixed;
	top: -80vh;
	left: -35vh;
}
body {
	padding: 0px !important;
}
</style>

<body onload="loadStart()">
<form>
<div class="top">
    <?php
        echo "<h1>" . $tit['Titlu'] . "</h1>";
        //echo date("Gi") . " " . $tit['panaLa'];
		if ($tit['files'] != "false") {
			echo "<h4>Aditional files:</h4>";
			if(strpos($tit['files'], "slides") !== false) {
				echo '<a href="' . $tit['files'] . '" target="_blank"><img src="../logo/slides.png" /></a>';
			}
			if(strpos($tit['files'], "text") !== false) {
				echo '<a href="' . $tit['files'] . '" target="_blank"><img src="../logo/text.png" /></a>';
			}
			if(strpos($tit['files'], "forms") !== false) {
				echo '<a href="' . $tit['files'] . '" target="_blank"><img src="../logo/forms.png" /></a>';
			}
			if(strpos($tit['files'], "vIDEo") !== false) {
				echo '<link href="../../alex/video.css" rel="stylesheet" /><script src="../../alex/video.js"></script>';
				$videofiles = explode(";", str_replace("vIDEo: ", "", $tit['files']));
				for ($i=0; $i<count($videofiles); $i++) {
					echo '<a href="javascript:videosrc(\'' . $videofiles[$i] . '\')"><img src="../logo/video.png" style="margin:10px;"/></a>';
				}
				echo '<div id="player">
						<video width="100%" id="video" onClick="play()" src="' . $videofiles[0] . '"></video>
						<div class="player">
							<table>
								<tr>
									<td><a href="javascript:play()" id="play"><i class="fas fa-play"></i></a>
									<a href="javascript:pause()" id="pause" style="display:none;"><i class="fas fa-pause"></i></a></td>
									<td width="100%"><input type="range" class="slider" id="myRange" onChange="skip()"></td>
									<td><a href="javascript:fullScreen()" id="fs"><i class="fas fa-compress"></i></a></td>
								</tr>
							</table>
						</div>
					</div>';
			}
			if(strpos($tit['files'], "iMAGe") !== false) {
				$imgfile = str_replace("iMAGe: ", "", $tit['files']);
				echo '<img src="' . $imgfile . '" width="100%"/>';
			}
			echo "<br />";
		}
    ?>
</div>

<br />
<div class="wrapper" id="name-wr">
	<div class="input-data">
	<?php
		$raspuns = $_COOKIE['r'];
		$raspunsuri = explode(";", $raspuns);
		if ($ano == "false") {
			if (isset($_COOKIE['un']) and isset($_COOKIE['login'])) {
				echo "<input type='text' id='nume' maxlength='100' value='" . $_COOKIE['un'] . "' readonly='readonly'>";
			} else {
				echo "<input type='text' id='nume' required='required' maxlength='100'>";
			}
			echo '<div class="underline"></div><label>Name <font style="color:#F00">*</font></label></div>';
		} else {
			echo '<script>document.getElementById("name-wr").style.display="none";</script>';
		}
	?>
</div>
</div>
<br />

<?php
$intr_nr=0;
$sql = "SELECT * FROM question WHERE Testid='" . $_GET['id'] . "'";
$stmt = $conn->query($sql);
while($row = $stmt->fetch()){
	/*if ($row['Tip'] == "radio") {
		$rasp = explode(";", base64_decode($row['Raspuns']));
		echo "<h3 class='text'>" . base64_decode($row['Intrebare']) . "<font style='color:red'> *</font></h3>";
		echo "<div class='org-form' class='slideanmi'>";
		for ($i=0; $i<count($rasp)-1; $i++) {
			echo "<input type='radio' id='rr" . $i . "' name='intr" . $intr_nr . "'>"; 
			echo "<label for='rr" . $i . "'>" . $rasp[$i] . "</label>";
		}
		echo "</div><br />"; 
	}*/
	if (!isset($_COOKIE['r'])) {
		if ($row['Tip'] == "radio") {
			echo '<div class="wrapper" name="intr">';
			echo "<h3 id='intr" . $intr_nr . "'>" . base64_decode($row['Intrebare']) . "</h3>"; 
			$rasp = explode(";", base64_decode($row['Raspuns']));
			for ($i=0; $i<count($rasp)-1; $i++) {
				echo '<div class="mdc-form-field">
				  <div class="mdc-radio">
					<input class="mdc-radio__native-control" type="radio" id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" onchange="changeForm()">
					<div class="mdc-radio__background">
					  <div class="mdc-radio__outer-circle"></div>
					  <div class="mdc-radio__inner-circle"></div>
					</div>
					<div class="mdc-radio__ripple"></div>
				  </div>
				  <label for="rr' . $intr_nr . $i . '">' . str_replace("|||", ";", $rasp[$i]) . '</label>
				</div><br />';
			}
			echo '</div><br /><br />';
		}
		if ($row['Tip'] == "checkbox") {
			echo '<div class="wrapper" name="intr">';
			echo "<h3 id='intr" . $intr_nr . "'>" . base64_decode($row['Intrebare']) . "</h3>"; 
			$rasp = explode(";", base64_decode($row['Raspuns']));
			for ($i=0; $i<count($rasp)-1; $i++) {
				echo '<div class="mdc-form-field">
				  <div class="mdc-checkbox">
					<input type="checkbox"
						   class="mdc-checkbox__native-control"
						   id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" onchange="changeForm()"/>
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
				  <label for="rr' . $intr_nr . $i . '">' . str_replace("|||", ";", $rasp[$i]) . '</label>
				</div><br />';
			}
			echo '</div><br /><br />';
		}
		if ($row['Tip'] == "completare") {
			echo '<div class="wrapper" name="intr">';
			echo "<h3 id='intr" . $intr_nr . "'>" . base64_decode($row['Intrebare']) . "</h3>"; 
			echo '<div class="input-data">
				<input type="text" required="required" maxlength="200" name="rasp' . $intr_nr . '" onkeydown="changeForm()">
				<div class="underline"></div>
				<label>Answer <font style="color:#F00">*</font></label></div>
				</div><br />';
		}
		$intr_nr++;
	} else {
		$r = explode(":", $raspunsuri[$intr_nr]);
		if ($row['Tip'] == "radio") {
			echo '<div class="wrapper" name="intr">';
			echo "<h3 id='intr" . $intr_nr . "'>" . base64_decode($row['Intrebare']) . "</h3>"; 
			$rasp = explode(";", base64_decode($row['Raspuns']));
			for ($i=0; $i<count($rasp)-1; $i++) {
				echo '<div class="mdc-form-field">
				  <div class="mdc-radio">
					<input class="mdc-radio__native-control" type="radio" id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" ';
					if ($rasp[$i] == $r[1]) {
						echo 'checked="checked"';
					}
					echo ' onchange="changeForm()">
					<div class="mdc-radio__background">
					  <div class="mdc-radio__outer-circle"></div>
					  <div class="mdc-radio__inner-circle"></div>
					</div>
					<div class="mdc-radio__ripple"></div>
				  </div>
				  <label for="rr' . $intr_nr . $i . '">' . str_replace("|||", ";", $rasp[$i]) . '</label>
				</div><br />';
			}
			echo '</div><br /><br />';
		}
		if ($row['Tip'] == "checkbox") {
			echo '<div class="wrapper" name="intr">';
			echo "<h3 id='intr" . $intr_nr . "'>" . base64_decode($row['Intrebare']) . "</h3>"; 
			$rasp = explode(";", base64_decode($row['Raspuns']));
			for ($i=0; $i<count($rasp)-1; $i++) {
				echo '<div class="mdc-form-field">
				  <div class="mdc-checkbox">
					<input type="checkbox"
						   class="mdc-checkbox__native-control"
						   id="rr' . $intr_nr . $i . '" name="rasp' . $intr_nr . '" value="' . $rasp[$i] . '" ';
					if (strpos($r[1], $rasp[$i]) !== false) {
						echo 'checked="checked"';
					}
					echo ' onchange="changeForm()">
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
				  <label for="rr' . $intr_nr . $i . '">' . str_replace("|||", ";", $rasp[$i]) . '</label>
				</div><br />';
			}
			echo '</div><br /><br />';
		}
		if ($row['Tip'] == "completare") {
			echo '<div class="wrapper" name="intr">';
			echo "<h3 id='intr" . $intr_nr . "'>" . base64_decode($row['Intrebare']) . "</h3>"; 
			echo '<div class="input-data">
				<input type="text" required="required" maxlength="200" name="rasp' . $intr_nr . '" value="' . $r[1] . '" onkeydown="changeForm()">
				<div class="underline"></div>
				<label>Answer <font style="color:#F00">*</font></label></div>
				</div><br />';
		}
		$intr_nr++;
	}
}



?>
<br />
</form>
</body>
</html>
