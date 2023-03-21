<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-LMF5101H4Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LMF5101H4Y');
</script>-->
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Shippori+Mincho:wght@400;600&display=swap" rel="stylesheet">
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <script src="../ripple.js"></script>
  <link rel="stylesheet" href="../ripple.css" />
</head>

<?php
  $actual_link = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  if(strpos("index.php", $actual_link) !== false) {
	  header("Location: " . str_replace("index.php", "", $actual_link));
	  die();
  }

  $hostname = 'localhost:3307';
  include "db.php";
  try {
	  $conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
  }
  catch(PDOException $e)
  {
	  echo $e->getMessage();
  }
  if ($_GET['prieteni'] != "") {
	  $sql = "UPDATE conturi SET prieteni = '" . $_GET['prieteni'] . "' WHERE Id = '" . $_COOKIE['login'] . "'";
	  $stmt = $conn->query($sql);
	  header('Location: index.php');
	  die();
  }
  if ($_GET['fa'] == "c") {
	  $sql = "UPDATE conturi SET culoare = '" . $_GET['culoare'] . "' WHERE Id = '" . $_COOKIE['login'] . "'";
	  $stmt = $conn->query($sql);
	  header('Location: index.php');
	  die();
  }
?>

<style>
body {
    background-position: center;
    background-repeat: no-repeat;
	background:fixed;
    background-size: cover;
	background-color:#FFF;
}
.navbar {
  z-index: 9998;
  font-size: 14px !important;
  border-radius: 0;
  box-shadow:5px 5px 20px rgba(0,0,0,0.2), 5px 5px 20px rgba(0,0,0,0.2);
  border-radius:30px;
  background-color: rgba(255,255,255,0.5);
  width: inherit;
  margin: 0;
  left: 50%;
  -ms-transform: translateX(-50%);
  transform: translateX(-50%);
  position:fixed;
  top:10px;
  padding:10px;
}
@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
  .navbar {
    -webkit-backdrop-filter: blur(100px);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.5);  
  }
  .menu {
    -webkit-backdrop-filter: blur(100px);
    backdrop-filter: blur(10px);
    background-color: rgba(0, 0, 0, 0.1);  
  }
}
.navbar .mdc-button, .menu .mdc-button, #open .mdc-button {
	--mdc-theme-primary:#09F !important;
	--mdc-theme-secondary:#333 !important;
	--mdc-theme-background:#09F !important;
	--mdc-theme-surface:#09F !important;
	text-transform: none !important;
	text-decoration:none !important;
	font-size:14px !important;
}
.navbar p {
	float:left;
}
.navbar a {
	font-family:SFPro;
	margin:5px;
	text-decoration:none;
	width:inherit;
	display:inline-block;
}

@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
  .navbar {
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.5);  
  }
  .menu {
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
    background-color: rgba(0, 0, 0, 0.1);  
  }
}

.menu {
	position:fixed;
	top:-150%;
	left:0px;
	width:100vw;
	height:100vh;
	z-index:100000;
}

.slide_down {
	animation:slide_down 0.5s ease-in-out;
	top:0px;
	left:0px;
}

@keyframes slide_down {
	from {top:-150%;}
	to {top:0px;}
}

.slide_up {
	animation:slide_up 0.5s ease-in-out;
	top:-150%;
	left:0px;
}

@keyframes slide_up {
	from {top:0px;}
	to {top:-150%;}
}

.menu .buttons {
	border-radius:25px;
	background-color:rgba(0,0,0,0.5);
	width:100px;
	height:100px;
	padding:10px;
}

.menu .buttons a {
	padding:10px;
	border-radius:50%;
	background-color:#FFF;
	color:#333;
	transition:all 0.3s;
	margin:1px;
	margin-bottom:3px;
}

.menu .buttons a:hover {
	background-color:#09F;
	color:#FFF;
}
.prieteni {
	height:200px;
	width:400px;
	padding:10px;
	border-radius:25px;
	background-color:rgba(0,0,0,0.5);
}
.prieteni .lista {
	height:180px;
	float:right;
	width:40%;
	overflow:auto;
}
.prieteni label {
	margin-left:10px;
	color:#FFF;
}

.prieteni ::-webkit-scrollbar-track {
	background-color:transparent;
}

.prieteni .informatie {
	float:left;
	width:60%;
}

.prieteni input {
	color:#999;
	background-color:transparent;
	width:30%;
	border:none;
}
@media only screen and (max-width: 750px) {
	.menu {
		padding:20px;
	}
	.open_menu {
		position:fixed;
		top:100px;
		right:20px;
		font-size:26px !important;
	}
	.apps {
		display:block;
	}
	.navbar a {
		display:none;
	}
	.navbar {
		width:300px;
	}
	.prieteni {
		height:200px;
		width:300px;
		padding:10px;
		border-radius:25px;
		background-color:rgba(0,0,0,0.5);
	}
	@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
	  .navbar {
		-webkit-backdrop-filter: blur(20px);
		backdrop-filter: blur(10px);
		background-color: rgba(255, 255, 255, 0.5);  
	  }
	  .menu {
		-webkit-backdrop-filter: blur(20px);
		backdrop-filter: blur(10px);
		background-color: rgba(0, 0, 0, 0.1);  
	  }
	}
	.recorder-container {
		display:none !important;
	}
	.assistant {
		display:none !important;
	}
	.navbar div img {
		width:25px;
	}
}
@media only screen and (min-width: 750px) {
	.navbar a {
		display:block;
	}
	.apps {
		display:none;
	}
	.menu {
		padding:100px;
	}
	.open_menu {
		position:fixed;
		top:30px;
		right:50px;
		font-size:26px !important;
	}
}

::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-track {
  background-color: transparent;
}
::-webkit-scrollbar-thumb {
  background: #888; 
  border-radius:10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #555;
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
.mdc-button__ripple {
	animation-duration:1s;
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
@sfPro {
	font-family: "SF Pro";
	src: url('SFPro.ttf');
}
xmp { 
	font-family: inherit; 
	font-size: 100%;
	margin:0;
}


.recorder-container {
  width: 150px;
  background-color: #e74c3c;
  display: block;
  margin: 50px;
  border-radius: 100%;
  box-shadow: 0px 0px 15px 2px rgba(0,0,0,1);
  cursor: default;
  transition: 0.3s all ease-in;
  position: relative;
}

.icon-microphone {
  color: #fff;
  font-size: 60px;
  line-height: 150px;
  display: block;
  text-align: center;
  transition: 0.1s all ease-in;
  position: relative;
}

.outer {
  width: 148px;
  height: 148px;
  -webkit-transform: scale(1);
  border-radius: 100%;
  position: absolute;
  background-color: transparent;
  border: 1px solid #7f8c8d;
  z-index: -1;
  transition: 1.5s all ease;
  /*-webkit-animation: woong 1.5s infinite;*/
}

.outer-2 {
  width: 150px;
  height: 150px;
  -webkit-transform: scale(1);
  border-radius: 100%;
  position: absolute;
  background-color: #bdc3c7;
  z-index: -1;
  transition: 1.5s all ease;
  /*-webkit-animation: woong-2 1.5s infinite;*/
  -webkit-animation-delay: 2.5s;
}

@-webkit-keyframes woong {
  0% {
    -webkit-trasform: scale(1.2);
  }
  50% {
    -webkit-transform: scale(1.8);
    opacity: 0.5;
  }
  100% {
    -webkit-transform: scale(2.4);
    opacity: 0;
  }
}
@-webkit-keyframes woong-2 {
  0% {
    -webkit-transform: scale(1.2);
    opacity: 0.6;
  }
  50% {
    -webkit-transform: scale(1.6);
    opacity: 0.5;
  }
  100% {
    -webkit-transform: scale(2);
    opacity: 0;
  }
}
@-webkit-keyframes spend {
  0% {
    -webkit-transform: scale(1.2);
    opacity: 0.6;
  }
  100% {
    -webkit-transform: scale(0);
    opacity: 0;
  }
}
.assistant {
	height:200px;
	width:400px;
	padding:10px;
	border-radius:25px;
	background-color:rgba(0,0,0,0.5);
	float:right;
}
.assistant .alex {
	color:#FFF;
	float:left;
}
.assistant .user {
	color:#FFF;
	float:right;
}
.assistant .alex img {
	margin:10px;
}
.assistant .user img {
	margin:10px;
}
#question {
	float:right;
	animation:newms 0.5s ease-in-out;
}
#alex {
	animation:newms 0.5s ease-in-out;
}
#question {
	color:#FFF;
}
#answer {
	color:#FFF;
}
@keyframes openas {
	0% {
		transform:scale(0,0);
	}
	50% {
		transform:scale(0.5,1);
	}
	100% {
		transform:scale(1,1);
	}
}
@keyframes newms {
	from {
		transform:translateY(70%);
		opacity:0;
	}
	to {
		transform:translateY(0%);
		opacity:1;
	}
}

.yn {
	text-align:center;
}
#yes {
	color:#0F0;
	font-size:30px;
	display:none;
}
#no {
	color:#F00;
	font-size:30px;
	display:none;
}
.button-ripple {
	display:inline-block;
	margin-right:20px;
	border-radius:5px;
	cursor:pointer;
}
.tr {
	background-color:transparent !important;
	border-radius:0px !important;
	color:#999;
	padding:10px;
	cursor:pointer;
}

.mesaj-pop {
	border-radius:5px !important;
	height:40px;
	width:inherit;
	padding:10px;
	font-size:14px;
	position:fixed;
	left:100px;
	bottom:-50px;
	transition:all 0.1s ease-in-out;
	color:#FFF;
	box-shadow:5px 5px 10px rgba(0,0,0,0.1), -5px -5px 10px rgba(0,0,0,0.1);
	overflow:auto;
	z-index:900000;
}
@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
  .mesaj-pop {
	-webkit-backdrop-filter: blur(20px);
	backdrop-filter: blur(10px);
	background-color: rgba(0, 0, 0, 0.5);  
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
function bg() {
	var bg = document.getElementsByName("bg");
	var i;
	for (i=0; i<bg.length; i++) {
		if(bg[i].checked == true)
		{
			setCookie("bg", bg[i].value, 100);
			document.body.style.backgroundImage = "url('../bg/bg" + bg[i].value + ".jpeg')";
		}
	}
}

function menu_down() {
	document.getElementById('menu').classList.add('slide_down');
	document.getElementById('menu').classList.remove('slide_up');
	document.getElementById('close').style.display = "block";
	document.getElementById('open').style.display = "none";
}
function menu_up() {
	document.getElementById('menu').classList.add('slide_up');
	document.getElementById('menu').classList.remove('slide_down');
	document.getElementById('close').style.display = "none";
	document.getElementById('open').style.display = "block";
}

function loadOnStart() {
	//alert("ok");
	document.getElementById('close').style.display = "none";
	document.getElementById('open').style.display = "block";
	//mesaj("Wellcome");
}

/*$(document).ready(function(){

   function replace_content(content)
   {
   var exp_match = /(\b(https?|):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
   var element_content=content.replace(exp_match, "<a href='$1'>$1</a>");
   var new_exp_match =/(^|[^\/])(www\.[\S]+(\b|$))/gim;
   var new_content=element_content.replace(new_exp_match, '$1<a target="_blank" href="http://$2">$2</a>');
   return new_content;
   }
	var divs = document.getElementsByTagName('div');
	for (var i=0; i<divs.lenght; i++) {
		alert(document.getElementsByTagName('div')[i].innerHTML);
	   var content = $('div')[i].html();
	   $('div')[i].html(replace_content(content));
	}

});*/



function mesaj(m) {
	var mesaj = document.getElementById('mesaj-pop');
	mesaj.innerHTML = m;
	mesaj.style.bottom = "50px"
	setTimeout(function () { mesaj.style.bottom = "-50px"; }, 8000);
}
function mesaj_down() {
	var mesaj = document.getElementById('mesaj-pop');
	mesaj.style.bottom = "-50px";
}
	
</script>

<body onload="loadOnStart()">

<div class="navbar">
	<?php 
		//echo "<p><font style='font-size:18px;'>Wellcome, </font><font style='font-size:25px;'>" . $_COOKIE['un'] . "</font></p>"; 
	?>
    <div class="button-ripple" onmousedown="setTimeout(function() {location.assign('../chat')}, 500);" data-ripple-color="#CCC"><img src="../logo/chat.png" width="50px;"/></div>
    <div class="button-ripple" onmousedown="setTimeout(function() {location.assign('../classroom')}, 500);" data-ripple-color="#CCC"><img src="../logo/class.png" width="50px;"/></div>
    <div class="button-ripple" onmousedown="setTimeout(function() {location.assign('../video')}, 500);" data-ripple-color="#CCC"><img src="../logo/video.png" width="50px;"/></div>
    <div class="button-ripple" onmousedown="setTimeout(function() {location.assign('../forms')}, 500);" data-ripple-color="#CCC"><img src="../logo/forms.png" width="50px;"/></div>
    <div class="button-ripple" onmousedown="setTimeout(function() {location.assign('../text')}, 500);" data-ripple-color="#CCC"><img src="../logo/text.png" width="50px;"/></div>
    <div class="button-ripple" style="margin-right:0px;" onmousedown="setTimeout(function() {location.assign('../slides')}, 500);" data-ripple-color="#CCC"><img src="../logo/slides.png" width="50px;"/></div>
    <!--<a class="mdc-button" href="../slides"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Slides</span></a>
    <a class="mdc-button" href="../text"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Text</span></a>
    <a class="mdc-button" href="../classroom"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Classroom</span></a>
    <a class="mdc-button" href="../video"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Video</span></a>
    <a class="mdc-button" href="../forms"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Forms</span></a>
    <a class="mdc-button" href="../chat"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Chat</span></a>-->
</div>
    <div class="button-ripple tr open_menu" onmousedown="setTimeout(function() {menu_down();}, 200);" data-ripple-color="#CCC"><i class="fas fa-plus"></i></div>



<div class="menu" id="menu">
    <div class="button-ripple tr open_menu" onmousedown="setTimeout(function() {menu_up();}, 200);" data-ripple-color="#CCC"><i class="fas fa-times"></i></div>
    
    <!--<div class="apps">
        <a class="mdc-button" href="../chat"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Chat</span></a>
        <a class="mdc-button" href="../classroom"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Classroom</span></a>
        <a class="mdc-button" href="../video"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Video</span></a>
        <a class="mdc-button" href="../forms"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Forms</span></a>
        <a class="mdc-button" href="../text"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Text</span></a>
        <a class="mdc-button" href="../slides"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Slides</span></a>
    </div>-->
        
        <div class="buttons">
            <a href="../index.php" style="float:left;"><i class="fas fa-home"></i></a>
            <?php
            echo '<a href="../navIndex.php?fa=logout&s=http://gnets.myds.me/work/' . $_SERVER['PHP_SELF'] .'" style="float:right;"><i class="fas fa-sign-out-alt"></i></a><br /><br />';
            echo '<a href="../navIndex.php?fa=ca&s=http://gnets.myds.me/work/' . $_SERVER['PHP_SELF'] .'" style="float:left;"><i class="fas fa-user-alt-slash"></i></a>';
            ?>
            <a href="../pas.php" style="float:right;"><i class="fas fa-key"></i></a>
        </div>
        <br />
        <div class="prieteni">
            <div class="informatie">
                <h4 style="color:#FFF;">Manage friends:</h4>
                <?php echo "<a class='mdc-button' href='javascript:copy2()'><span class='mdc-button__ripple'></span><span class='mdc-button__label' style='color:#FFF;'>Invite friends: <input type='text' contenteditable='false' value='https://alexs.gq/i#" . $_COOKIE['login'] . "' id='invitelink'/></a>"; ?>
                <a class="mdc-button" href="javascript:prieteni()" style="margin-top:50px;"><span class="mdc-button__ripple"></span><span class="mdc-button__label" style="color:#FFF;">Save</span></a>
            </div>
            <div class="lista">
              <?php
                  $sunt_friends = false;
				  $myId = $_COOKIE['login'];
                  $sql = "SELECT * FROM conturi WHERE prieteni LIKE '%" . $myId . "%'";
                  $stmt = $conn->query($sql);
                  while ($row = $stmt->fetch()) {
                          $sunt_friends = true;
                          echo '
                          <div class="mdc-form-field">
                            <div class="mdc-checkbox">
                              <input type="checkbox"
                                     class="mdc-checkbox__native-control"
                                     name="prieteni" id="' . $row['Id'] . '" value="' . $row['Id'] . '" checked="checked"/>
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
                            <label for="' . $row['Id'] . '">' . $row['username'] . '</label>
                          </div><br />';
                  }
                  if ($sunt_friends == false) {
                      echo "<div style='text-align:center;'>
                              <i class='far fa-sad-tear' style='font-size:50px;'></i>
                              <h2>Hopa</h2>
                              <p>You don't have any friends to chat</p>
                              <p>Invite them using <a href='https://alexs.gq/i#" . $_COOKIE['login'] . "'>this link</a></p>
                            </div>";
                  }
                  echo "</div></div>";
                  
              ?>
        <br />
        <a class="mdc-button" href="../support" target="_blank"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Support</span></a>
    </div>

</div>
<br />
<br />
<br />

<div class="abuz"><i class="fas fa-info-circle"></i><div class="h"><a href="http://gnets.myds.me/work/forms/raspunde.php?id=abuse" target="_blank">Raport an abuse</a><strong> | </strong><a href="http://gnets.myds.me/work/forms/raspunde.php?id=bug" target="_blank">Raport a bug</a><strong> | </strong><a href="http://gnets.myds.me/work/support" target="_blank">Support</a></div></div>


<div class="mesaj-pop" id="mesaj-pop" onclick="mesaj_down()"></div>

</body>

</html>

<script>
	function prieteni() {
		var prieteni = document.getElementsByName('prieteni');
		var l = prieteni.length;
		var i;
		var priet = ""
		for (i = 0; i < l; i++) {
			if (prieteni[i].checked == true) {
				priet = priet + prieteni[i].value + "; ";
			}
		}
		var pr = "";
		for (i = 0; i < l; i++) {
			if (prieteni[i].checked == false) {
				pr = pr + prieteni[i].value + ";";
			}
		}
		location.assign("../navIndex.php?" + "prieteni=" + priet + "&pr=" + pr);
	}
	function copy2() {
	  var copyText = document.getElementById("invitelink");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999);
	  document.execCommand("copy");
	  mesaj("The link was copyed! Send it to your friends!");
	}
</script>