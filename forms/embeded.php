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
  
  <link rel="stylesheet" href="../ripple.css" />
  <script src="../ripple.js"></script>
  
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet" />
</head>

<?php
if (isset($_GET['color'])) {
	$themecolor = "#" . $_GET['color'];
} else {
	$themecolor = "#09F";
}
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
	echo "<title>Alex Forms - " . $tit['Titlu'] . "</title>";
	$ano = $tit['anonymus'];
	$cre = $tit['TestCreator'];
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

var testId = getUrlVars()['id'];

function submitForms(intr_nr){
	var raspuns = "";
	var ok = true;
	for (var i=0; i<intr_nr; i++) {
		document.getElementById('w' + i).style.border="#CCC 1px solid";
		var rasp = document.getElementsByName('rasp' + i);
		var intr = document.getElementById('intr' + i).innerHTML;
		if (document.getElementById('intr' + i).getAttribute("data-obligatoriu") == "true") {
			intr = intr.replace(' <font style="color:#F00;">*</font>', "");
		}
		raspuns = raspuns + intr + ":";
		var prev = raspuns;
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
		if (prev == raspuns) {
			document.getElementById('w' + i).style.border="#F00 1px solid";
			ok = false;
		}
		raspuns = raspuns + "; ";
	}
	if (ok == true) {
		var parasiri = getCookie(testId);
		if (getCookie("ano") == "false") {
			var nume = document.getElementById('nume').value;
		} else {
			var nume = "";
		}
		var sId = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
		setCookie("sId", sId, 1);
		setCookie(testId + "r", "", -1);
		$.ajax
		  ({
			type: "POST",
			url: "save.php",
			data: { "id": testId, "nume": nume, "r": raspuns, "parasiri": parasiri, "sId": sId }
		  });
		  location.assign("raspunde.php?id=" + getUrlVars()["id"] + "&sent=true");
	}
}

function changeForm() {
	var nr_intr = document.getElementsByName('intr').length;
	var raspuns = "";
	for (var i=0; i<nr_intr; i++) {
		var rasp = document.getElementsByName('rasp' + i);
		var intr = document.getElementById('intr' + i).innerHTML;
		if (document.getElementById('intr' + i).getAttribute("data-obligatoriu") == "true") {
			intr = intr.replace(' <font style="color:#F00;">*</font>', "");
		}
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
	setCookie(testId + "r", raspuns, 1);
}
</script>

<style>
footer {
	text-align:center;
}
.button {
  padding: 15px 20px;
  background-color:#09F !important;
  
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
  transform: translateY(-14px);
  font-size: 12px;
  color: #09F;
}
.wrapper .input-data label{
  position: absolute;
  bottom: 5px;
  left: 0;
  color: grey;
  pointer-events: none;
  transition: all 0.3s ease;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
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
    body {
	  /*background: #e8ebf3;
	  background-image: url("bg.jpg");
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-size:cover;
	  background-position:right;*/
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
	#submit {
	  width: 100%;
	}
	.wrapper{
	  width: 90%;
	}
	.top{
	  width: 95%;
	  background: #fff;
	  padding: 10px;
	  padding-top:0px !important;
	  padding-bottom:0px !important;
	  border:#CCC 1px solid;
	  border-radius:10px;
	  border-top: #09F 10px solid;
	}
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 101%;
	  bottom: -10px;
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
	.input-data .underline{
	  position: absolute;
	  height: 2px;
	  width: 101%;
	  bottom: -4px;
	}
	#submit {
	  width: 790px;
	}
	.wrapper{
	  width: 750px;
	}
	.top{
	  width: 730px;
	  background: #fff;
	  padding: 0px 30px;
	  /*box-shadow: 10px 10px 100px rgba(0,0,0,0.1), -10px -10px 100px rgba(0,0,0,0.1);*/
	  border:#CCC 1px solid;
	  border-radius:10px;
	  border-top: #09F 10px solid;
	}
    body {
	  /*background: #e8ebf3;
	  background-image: url("bg.jpg");
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-size:cover;
	  background-position:right;*/
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
	text-transform:inherit;
	box-shadow:none;
}
.mdc-form-field {
	--mdc-theme-primary:#09F;
	--mdc-theme-secondary:#09F;
	--mdc-theme-background:#09F;
	--mdc-theme-surface:#09F;
}
.mdc-form-field label {
	font-size:13px !important;
}

label {
	font-weight: normal !important;
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
.wrapper h3 {
	font-size:16px;
	margin-top:-5px;
	font-weight:500;
}
.input-data {
	margin-top:10px;
}
body {
	font-family: 'Noto Sans KR', sans-serif !important;
}
#name-wr {
	padding-top:-10px;
}
.wrapper{
  background: #fff;
  padding: 20px;
  <?php if ($_GET['border'] != "false") { ?>
	  border:#CCC 1px solid;
	  border-radius:10px;
  <?php } ?>
}
p {
	font-size:9px;
	color:#000;
}
p a {
	color:#000;
}
</style>
<?php 
	if (!isset($_COOKIE['sent'])) {
?>
<body id="form">
<?php if ($_GET['banner'] != "false") { ?>
<div class="top">
	<?php
        echo "<h1>" . $tit['Titlu'] . "</h1>";
        //echo date("Gi") . " " . $tit['panaLa'];
        if ($tit['files'] != "false") {
            echo "<h4>Aditional resources:</h4>";
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
            if(strpos($tit['files'], "DESc") !== false) {
                $desc = str_replace("DESc: ", "", $tit['files']);
                echo '<h4 style="font-weight:inherit;">' . $desc . '</h4>';
            }
            echo "<br />";
        }
    ?>
</div>
<?php } ?>

<br />
<div class="wrapper" id="name-wr">
	<h3>Your Name <font style="color:#F00">*</font></h3>
	<div class="input-data">
	<?php
		$raspuns = $_COOKIE[$_GET['id'] . 'r'];
		$raspunsuri = explode(";", $raspuns);
		if ($ano == "false") {
			if (isset($_COOKIE['un']) and isset($_COOKIE['login'])) {
				echo "<input type='text' id='nume' maxlength='100' value='" . $_COOKIE['un'] . "' readonly='readonly'>";
			} else {
				echo "<input type='text' id='nume' required='required' maxlength='100'>";
			}
			echo '<div class="underline"></div><label>Answer</label></div>';
		} else {
			echo '<script>document.getElementById("name-wr").style.display="none";</script>';
		}
	?>
</div>
</div>
<br />

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
$intr_nr=0;
$sql = "SELECT * FROM question WHERE Testid='" . $_GET['id'] . "'";
$stmt = $conn->query($sql);
while($row = $stmt->fetch()){
	/*if ($row['Tip'] == "radio") {
		$rasp = explode(";", $row['Raspuns']);
		echo "<h3 class='text'>" . $row['Intrebare'] . "<font style='color:red'> *</font></h3>";
		echo "<div class='org-form' class='slideanmi'>";
		for ($i=0; $i<count($rasp)-1; $i++) {
			echo "<input type='radio' id='rr" . $i . "' name='intr" . $intr_nr . "'>"; 
			echo "<label for='rr" . $i . "'>" . $rasp[$i] . "</label>";
		}
		echo "</div><br />"; 
	}*/
	if ($row['Obligatoriu'] == "true") {
		$obl = " <font style='color:#F00;'>*</font>";
		$d = "data-obligatoriu='true'";
	} else {
		$obl = "";
		$d = "data-obligatoriu='false'";
	}
	
	$r = explode(":", $raspunsuri[$intr_nr]);
	if ($row['Tip'] == "radio") {
		echo '<div class="wrapper" name="intr" id="w' . $intr_nr . '">';
		echo "<h3 id='intr" . $intr_nr . "' " . $d . ">" . $row['Intrebare'] . $obl . "</h3>"; 
		$rasp = explode(";", $row['Raspuns']);
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
		echo '</div><br />';
	}
	if ($row['Tip'] == "checkbox") {
		echo '<div class="wrapper" name="intr" id="w' . $intr_nr . '">';
		echo "<h3 id='intr" . $intr_nr . "' " . $d . ">" . $row['Intrebare'] . $obl . "</h3>"; 
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
		echo '</div><br />';
	}
	if ($row['Tip'] == "completare") {
		echo '<div class="wrapper" name="intr" id="w' . $intr_nr . '">';
		echo "<h3 id='intr" . $intr_nr . "' " . $d . ">" . $row['Intrebare'] . $obl . "</h3>"; 
		echo '<div class="input-data">
			<input type="text" required="required" maxlength="200" name="rasp' . $intr_nr . '" value="' . $r[1] . '" onkeydown="changeForm()">
			<div class="underline"></div>
			<label>Answer</label></div>
			</div><br />';
	}
	if ($row['Tip'] == "img_r") {
		echo '<div class="wrapper" name="intr" id="w' . $intr_nr . '">';
		echo "<h3 id='intr" . $intr_nr . "' " . $d . ">" . $row['Intrebare'] . $obl . "</h3>"; 
		$rasp = explode(";", $row['Raspuns']);
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
			  <label for="rr' . $intr_nr . $i . '"><img src="' . str_replace("|||", ";", $rasp[$i]) . '" width="50%" /></label>
			</div><br />';
		}
		echo '</div><br />';
	}
	if ($row['Tip'] == "img_c") {
		echo '<div class="wrapper" name="intr" id="w' . $intr_nr . '">';
		echo "<h3 id='intr" . $intr_nr . "' " . $d . ">" . $row['Intrebare'] . $obl . "</h3>"; 
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
			  <label for="rr' . $intr_nr . $i . '"><img src="' . str_replace("|||", ";", $rasp[$i]) . '" width="50%" /></label>
			</div><br />';
		}
		echo '</div><br />';
	}
	if ($row['Tip'] == "info") {
		echo '<div class="wrapper">';
		echo "<h3>" . $row['Intrebare'] . "</h3></div><br />"; 
		$intr_nr = $intr_nr - 1;
	}
	$intr_nr++;
}



?>
<?php echo '<div style="text-align:left !important;" id="submit"><button class="mdc-button mdc-button--raised" onclick="submitForms(\'' . $intr_nr . '\')" >
  <span class="mdc-button__ripple"></span>
  <span class="mdc-button__label">Submit</span>
</button></div>'; 
?>
<br />
<?php if(!isset($_COOKIE['login']) and $_GET['id'] != "abuse" and $_GET['id'] != "bug" and $cre != "lexS6952010le" and $cre != "abis9002110gg") { ?>
<div class="abuz"><i class="fas fa-flag"></i><div class="h"><a href="http://gnets.myds.me/work/forms/raspunde.php?id=abuse" target="_blank">Raport an abuse</a><strong> | </strong><a href="http://gnets.myds.me/work/forms/raspunde.php?id=bug" target="_blank">Raport a bug</a><strong> | </strong><a href="http://gnets.myds.me/work/support" target="_blank">Support</a></div></div>
<?php } ?>
<footer>
<?php
	if ($_GET['id'] != "abuse" and $_GET['id'] != "bug" and $cre != "lexS6952010le" and $cre != "abis9002110gg") {
		echo "<p style='color: rgba(0, 0, 0, 0.66);'>This content is neither created or endorsed by Alex Workspace. <a href='http://gnets.myds.me/work/forms/raspunde.php?id=abuse' target='_blank' style='text-decoration:underline; color: rgba(0, 0, 0, 0.66);'>Raport an abuse</a></p>";
		echo '<div class="abuz"><i class="fas fa-flag"></i><div class="h"><a href="http://gnets.myds.me/work/forms/raspunde.php?id=abuse" target="_blank">Raport an abuse</a><strong> | </strong><a href="http://gnets.myds.me/work/forms/raspunde.php?id=bug" target="_blank">Raport a bug</a><strong> | </strong><a href="http://gnets.myds.me/work/support" target="_blank">Support</a></div></div>';
	}
	if ($_GET['credit'] == "false") {
		if ($cre != "lexS6952010le" and $cre != "abis9002110gg") {
			echo "<p>&copy; Alex Sofonea 2021 - Alex Forms - <strong>Powered</strong> by <a href='gnets.myds.me/work/forms/'>Alex Forms</a></p>";
		}
	} else {
		echo "<p>&copy; Alex Sofonea 2021 - Alex Forms - <strong>Powered</strong> by <a href='gnets.myds.me/work/forms/'>Alex Forms</a></p>";
	}
?>

</footer>
</body>

<?php } else {?>
        <body onload="loadStart()" id="sent">
        <div class="top">
            <?php
                echo "<h1>" . $tit['Titlu'] . "</h1>";
                //echo date("Gi") . " " . $tit['panaLa'];
                if ($tit['files'] != "false") {
                    echo "<h4>Aditional resources:</h4>";
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
                    if(strpos($tit['files'], "DESc") !== false) {
                        $desc = str_replace("DESc: ", "", $tit['files']);
                        echo '<h4 style="font-weight:inherit;">' . $desc . '</h4>';
                    }
                    echo "<br />";
                }
            ?>
            <h4 style="font-weight:inherit;">Answer was sent succesfull!</h4>
            <br />
        </div>
        <br /><br /><br />
        <?php if($_GET['id'] != "abuse" and $_GET['id'] != "bug" and $cre != "lexS6952010le" and $cre != "abis9002110gg") { ?>
        <a class="mdc-button" href="create.php">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">Create your own form</span>
        </a>
        <?php } ?>
        </body>
    
    

<?php } ?>
</html>
