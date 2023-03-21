<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alex Slides</title>
  <link rel="icon" href="../logo/slides.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header('Location: http://gnets.myds.me/work/');
		die();
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

if (!isset($_COOKIE['slide']) == false and $_GET['fa'] == "save") {
	$sql = "INSERT INTO slide (Id, Prezentare, Content) VALUES ('" . $_COOKIE['slideNr'] . "','" . $_COOKIE['prezentare'] . "','" .  $_COOKIE['slide'] . "')";
	$stmt = $conn->query($sql);
	setcookie("slide", "", time());
	header("Location: index.php");
	die();
}
if (!isset($_COOKIE['slide']) == false and $_GET['fa'] == "plus") {
	$sql = "INSERT INTO slide (Id, Prezentare, Content) VALUES ('" . $_COOKIE['slideNr'] . "','" . $_COOKIE['prezentare'] . "','" .  $_COOKIE['slide'] . "')";
	$stmt = $conn->query($sql);
	setcookie("slide", "", time());
	header("Location: slide.php");
	die();
}
?>

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
function saveC() {
	var slide = document.getElementById('slide').innerHTML;
	if (slide.length > 5) {
		var slideNr = getCookie("slideNr");
		slideNr++;
		setCookie("slideNr", slideNr, 1);
		setCookie("slide", slide, 1);
		location.assign("slide.php?fa=plus");
	}
}


function save() {
	var slide = document.getElementById('slide').innerHTML;
	if (slide.length > 5) {
		var slideNr = getCookie("slideNr");
		slideNr++;
		setCookie("slideNr", slideNr, 1);
		setCookie("slide", slide, 1);
		location.assign("slide.php?fa=save");
	}
}
</script>

<style>
body {
	overflow:hidden;
  background: #fff;
  font-family: "Noto Sans", sans-serif;
  color: #444;
  font-size: 14px;
}

aside.context {
  text-align: center;
  color: #333;
  line-height: 1.7;
}
aside.context a {
  text-decoration: none;
  color: #333;
  padding: 3px 0;
  border-bottom: 1px dashed;
}
aside.context a:hover {
  border-bottom: 1px solid;
}
aside.context .explanation {
  max-width: 700px;
  margin: 6em auto 0;
}

footer {
  text-align: center;
  margin: 4em auto;
  width: 100%;
}
footer a {
  text-decoration: none;
  display: inline-block;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: transparent;
  border: 1px dashed #333;
  color: #333;
  margin: 5px;
}
footer a:hover {
  background: rgba(255, 255, 255, 0.1);
}
footer a .icons {
  margin-top: 12px;
  display: inline-block;
  font-size: 20px;
}

.title {
  background: #B6472B;
  text-align: center;
  display: grid;
  place-content: center;
  color: #fff;
  padding:10px;
}

.menu-bar {
  display: grid;
  grid-template-columns: repeat(10, max-content);
  padding: 15px;
  grid-gap: 30px;
  background: #f3f2f1;
}
.menu-bar div:nth-child(1) span {
  display: inline-block;
  position: relative;
  border-bottom: 5px solid #B6472B;
  padding-bottom: 6px;
  font-weight: 700;
}
.menu-bar span {
	color:#000;
  font-weight: 300;
  transition:all 0.1s;
}
.menu-bar span:hover {
  display: inline-block;
  position: relative;
  border-bottom: 4px solid #B6472B;
  padding-bottom: 6px;
  font-weight: 700;
}
.input__sm-1, .input__sm-2, .input__sm-3 {
  text-align: center;
  padding: 6px;
  grid-row: 15;
  background: #fff;
}
.input__sm-1 {
  grid-column: 8;
}
.input__sm-2 {
  grid-column: 9;
}
.input__sm-3 {
  grid-column: 10;
}

.icon-bar {
  background: #f3f2f1;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
  position: relative;
  display: grid;
  padding: 0px 15px;
  grid-template-columns: repeat(6, max-content);
  grid-template-rows: auto 35px;
  grid-auto-flow: dense;
}
.icon-bar > div {
  display: grid;
  grid-template-rows: repeat(2, 30px) 30px;
  border-right: 1px solid #cdcdcd;
  grid-gap: 5px;
}
.icon-bar__name {
  font-size: 12px;
  text-align: center;
  align-self: end;
  margin-bottom: 3px;
}
.icon-bar .icon-desc {
  margin-top: 5px;
  line-height: 1.15;
  font-size: 13px;
}
.icon-bar .icon {
  background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/567707/spriteExcel.png);
}

.icon-bar__clipboard {
  grid-template-columns: 50px 30px;
  padding-right: 10px;
}
.icon-bar__clipboard .icon-bar__name {
  grid-column: 1 / span 2;
}
.icon-bar__clipboard .icon-paste {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  grid-row: 1 / span 2;
}
.icon-bar__clipboard .icon-paste .icon {
  background-position: -30px -60px;
  height: 45px;
  width: 100%;
}
.icon-bar__clipboard .icon-paste span {
  margin-top: 5px;
  display: block;
}
.icon-bar__clipboard .icon-cut {
  background-position: 0 0;
}
.icon-bar__clipboard .icon-copy {
  background-position: -30px 0;
}

.icon-bar__font {
  padding: 0 10px;
  grid-template-columns: repeat(2, 30px) 40px repeat(2, 40px);
  justify-content: space-around;
}
.icon-bar__font .icon-bar__name {
  grid-column: 1 / span 6;
}
.icon-bar__font select {
  height: 25px;
}
.icon-bar__font select:nth-child(1) {
  grid-column: 1 / span 4;
}
.icon-bar__font select:nth-child(1) option {
  font-family: var(--font);
}
.icon-bar__font select:nth-child(2) {
  margin-left: -6px;
  grid-column: 5 / span 2;
}
.icon-bar__font .icon-bold {
  background-position: -30px -150px;
}
.icon-bar__font .icon-italic {
  background-position: -60px -150px;
}
.icon-bar__font .icon-underline {
  background-position: -90px -150px;
}
.icon-bar__font .icon-s {
  background-position: -120px -150px;
}
.icon-bar__font .icon-point {
  background-position: -150px -150px;
  border-right: 1px solid #cdcdcd;
  margin-right: -2px;
}
.icon-bar__font .icon-color {
  background-position: -180px 0;
}

.icon-bar__alignment {
  padding: 0 10px;
  grid-template-columns: repeat(2, 30px) 30px;
}
.icon-bar__alignment .icon-bar__name {
  grid-column: 1 / span 3;
}
.icon-bar__alignment .icon-alignt {
  background-position: -150px 0;
}
.icon-bar__alignment .icon-alignm {
  background-position: -180px 0;
}
.icon-bar__alignment .icon-alignb {
  background-position: -210px 0;
}
.icon-bar__alignment .icon-orientation {
  background-position: -240px 0;
  border-left: 1px solid #cdcdcd;
}
.icon-bar__alignment .icon-alignl {
  background-position: 0 -30px;
  grid-column: 1;
}
.icon-bar__alignment .icon-alignc {
  background-position: -30px -30px;
}
.icon-bar__alignment .icon-alignr {
  background-position: -60px -30px;
}
.icon-bar__alignment .merge-center .icon {
  background-position: -150px -30px;
}
button { 
   cursor: pointer; 
   background-color: transparent;
   border:none;
	transform:scale(1.3,1.3);
   transition:all 0.2s;
}
button:hover {
	transform:scale(1.6,1.6);
}
#slide {
	width:1000px;
	height:563px;
	border:#CCC solid 1px;
	border-radius:16px;
	background-color:#FFF;
}
.center {
    display: flex;
    justify-content: center;
    align-items: center;
}
.next {
	position:fixed;
	bottom:60px;
	right:60px;
	font-size:50px;
	color:#000;
	transition:all 0.5s;
}
.next:hover {
	transform:translateX(50%);
	color:#B6472B;
}
.pre {
	position:fixed;
	bottom:60px;
	left:60px;
	font-size:50px;
	color:#000;
	transition:all 0.5s;
}
.pre:hover {
	transform:translateX(-50%);
	color:#B6472B;
}
.home {
	position:fixed;
	bottom:160px;
	right:60px;
	font-size:50px;
	color:#FFF;
	transform:rotate(0deg);
	transition:all 0.5s;
}
.home:hover {
	transform:rotate(360deg);
	color:#B6472B;
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
	function chooseColor(){
      var mycolor = document.getElementById("myColor").value;
      document.execCommand('foreColor', false, mycolor);
    }

    function changeFont(){
      var myFont = document.getElementById("input-font").value;
      document.execCommand('fontName', false, myFont);
    }

    function changeSize(){
      var mysize = document.getElementById("fontSize").value;
      document.execCommand('fontSize', false, mysize);
    }

    function checkDiv(){
      var editorText = document.getElementById("slide").innerHTML;
      if(editorText === ''){
        document.getElementById("slide").style.border = '5px solid red';
      }
    }
    function removeBorder(){
      document.getElementById("slide").style.border = '1px solid transparent';
    }
function next() {
	var presentId = getUrlVars()['id'];
	var nr = Number(getUrlVars()['nr']) + 1;
	location.assign("slide.php?id=" + presentId + "&nr=" + nr);
}
function pre() {
	var presentId = getUrlVars()['id'];
	var nr = Number(getUrlVars()['nr']) - 1;
	location.assign("slide.php?id=" + presentId + "&nr=" + nr);
}
</script>

<body onload="getBg()">
	<?php
		include "../nav.php";
	?>
<div class="main-content">
  <div class="title">Alex Slide</div>
  <div class="menu-bar">
    <div><span>File</span></div>
    <div><a href="index.php" style="text-decoration:none;"><span>Home</span></a></div>
    <div><a href="javascript:save()" style="text-decoration:none;"><span>End presentation</span></a></div>
    <div><a href="javascript:saveC()" style="text-decoration:none;"><span>Add new Slide</span></a></div>
  </div>
  <div class="icon-bar">
    <div class="icon-bar__clipboard">
      <div class="icon-paste">
        <div class="icon"></div><span>Paste</span>
      </div>
      <div class="icon icon-cut"></div>
      <div class="icon icon-copy"></div>
      <div class="icon-bar__name">Clipboard</div>
    </div>
    <div class="icon-bar__font">
      <select id="input-font" class="font-name"  onchange="changeFont (this);">
        <option value="Arial">Arial</option>
        <option value="Helvetica">Helvetica</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Sans serif">Sans serif</option>
        <option value="Courier New">Courier New</option>
        <option value="Verdana">Verdana</option>
        <option value="Georgia">Georgia</option>
        <option value="Palatino">Palatino</option>
        <option value="Garamond">Garamond</option>
        <option value="Comic Sans MS">Comic Sans MS</option>
        <option value="Arial Black">Arial Black</option>
        <option value="Tahoma">Tahoma</option>
        <option value="Comic Sans MS">Comic Sans MS</option>
      </select>
      <select class="font-size" id="fontSize" onclick="changeSize()">
        <option value="1">1</option>      
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
      </select>
      <div class="icon-italic"><button onclick="document.execCommand('italic',false,null);" title="Italic"><i class="fas fa-italic"></i></button></div>
      <div class="icon-bold"><button onclick="document.execCommand( 'bold',false,null);" title="Bold"><i class="fas fa-bold"></i></button></div>
      <div class="icon-underline"><button onclick="document.execCommand( 'underline',false,null);"><i class="fas fa-underline"></i></button></div>
      <div class="icon-s"><button class="fontStyle" onclick="document.execCommand( 'strikethrough',false,null);"><i class="fas fa-strikethrough"></i></button></div>
      <div class="icon-point"><button class="fontStyle" onclick="document.execCommand('insertUnorderedList',false, null)"><i class="fas fa-list"></i></button></div>
      <div class="icon-color"><input type="color" onchange="chooseColor()" id="myColor"></div>
      <div class="icon-bar__name">Font</div>
    </div>
    <div class="icon-bar__alignment">
      <br />
      <div class="icon-alignl"><button class="fontStyle" onclick="document.execCommand( 'justifyLeft',false,null);"><i class="fas fa-align-left"></i></button></div>
      <div class="icon-alignc"><button class="fontStyle" onclick="document.execCommand( 'justifyCenter',false,null);"><i class="fas fa-align-center"></i></button></div>
      <div class="icon-alignr"><button class="fontStyle" onclick="document.execCommand( 'justifyRight',false,null);"><i class="fas fa-align-right"></i></button></div>
      <div class="icon-bar__name">Alignment</div>
    </div>
    <div class="icon-bar__alignment">
      <br />
      <div class="icon-alignl"><button class="fontStyle" onclick="document.execCommand( 'redo',false,null);"><i class="fas fa-redo"></i></button></div>
      <div class="icon-alignc"><button class="fontStyle" onclick="document.execCommand( 'undo',false,null);"><i class="fas fa-undo"></i></button></div>
      <div class="icon-bar__name">Work</div>
    </div>
  </div>
</div>

<br />
  
<?php
$hostname = 'localhost:3307';
$username = 'root';
$password = 'gNetDB1qaz?1qaz';
try {
    $conn = new PDO("mysql:host=$hostname;dbname=alexslides", $username, $password);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
$sql = "SELECT * FROM prezentari WHERE Id='" . $_COOKIE['prezentare'] . "'";
$stmt = $conn->query($sql);
if($row = $stmt->fetch()){
	echo "<style>#slide {background-image:linear-gradient(#" . str_replace(";" , ", #" , $row['bg']) . ");}</style>";
}
if($_GET['id'] != "") {
	$sql = "SELECT * FROM slide WHERE Prezentare='" . $_GET['id'] . "' and Id='" . $_GET['nr'] . "'";
	$stmt = $conn->query($sql);
	if($row = $stmt->fetch()){
		echo "<div class='center'><div id='slide' contenteditable='false'>" . $row['Content'] . "</div></div>";
		echo "<a href='javascript:next()' class='next'><i class='far fa-arrow-alt-circle-right'></i></a><a href='javascript:pre()' class='pre'><i class='far fa-arrow-alt-circle-left'></i></a>";
	}
	else {
		echo "<script>location.assign('slide.php?id=" . $_GET['id'] . "&nr=1');</script>";
	}
}
else {
	echo "<div class='center'><div id='slide' contenteditable='true'></div></div>";
}
	
$conn=null;
?>
  
  
<footer>
<p>&copy; Alex Sofonea 2021 - Alex Slides</p>
</footer>
</body>
</html>
