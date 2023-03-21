<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
      
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LMF5101H4Y"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-LMF5101H4Y');
    </script>
      
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="ripple.js"></script>
    <link rel="stylesheet" href="ripple.css" />
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
  width: 800px;
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
	float:right;
	font-family:SFPro;
	margin:5px;
	text-decoration:none;
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
}
@media only screen and (max-width: 1000px) {
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
	#open {
		display:none !important;
	}
	#close {
		display:none !important;
	}
	#open2 {
		display:block !important;
	}
	#close2 {
		display:block !important;
	}
}
@media only screen and (min-width: 1000px) {
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
		top:20px;
		right:50px;
		font-size:26px !important;
	}
}
#open {
	display:block !important;
}
#close {
	display:block !important;
}
#open2 {
	display:none !important;
}
#close2 {
	display:none !important;
}

::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1; 
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


.button {
  color: #09F;
  text-decoration:none !important;
  text-shadow:none !important;
}
.button:hover {
  color: #09F;
  background-color: rgba(0,153,255,0.1);
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
}
function menu_up() {
	document.getElementById('menu').classList.add('slide_up');
	document.getElementById('menu').classList.remove('slide_down');
}

function menu_down2() {
	document.getElementById('menu').classList.add('slide_down');
	document.getElementById('menu').classList.remove('slide_up');
	document.getElementById('close').style.display = "block";
	document.getElementById('open').style.display = "none";
}
function menu_up2() {
	document.getElementById('menu').classList.add('slide_up');
	document.getElementById('menu').classList.remove('slide_down');
	document.getElementById('close').style.display = "none";
	document.getElementById('open').style.display = "block";
}

function loadStart() {
	document.getElementById('close').style.display = "none";
	document.getElementById('open').style.display = "block";
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
</script>

<body onload="loadStart()">

<div class="navbar">
	<?php 
		echo "<p><font style='font-size:18px;'>Wellcome, </font><font style='font-size:25px;'>" . $_COOKIE['un'] . "</font></p>"; 
	?>
	<a class="button button-ripple" data-ripple-color="#CCC"  onclick="location.href='../slides'">Slides</a>
    <a class="button button-ripple" data-ripple-color="#CCC"  onclick="location.href='../slides'">Text</a>
    <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../classroom'">Classroom</a>
    <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../video'">Video</a>
    <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../forms'">Forms</a>
    <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../chat'">Chat</a>
</div>
  <button type="button" class="button button-ripple button-round open_menu" onclick="menu_down()" data-ripple-color="#CCC" id="open"><i class="fas fa-plus"></i></button> 
  <a class="mdc-button open_menu" href="javascript:menu_down2()" id="open2"><span class="mdc-button__ripple"></span><span class="mdc-button__label"><i class="fas fa-plus"></i></span></a>



<div class="menu" id="menu">
    <button type="button" class="button button-ripple button-round open_menu" onclick="menu_up()" data-ripple-color="#CCC" id="close"><i class="fas fa-times"></i></button> 
	<a class="mdc-button open_menu" href="javascript:menu_up2()" id="close2"><span class="mdc-button__ripple"></span><span class="mdc-button__label"><i class="fas fa-times"></i></span></a>
    
    <div class="apps">
        <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../chat'">Chat</a>
        <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../forms'">Forms</a>
        <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../video'">Video</a>
        <a class="button button-ripple" data-ripple-color="#CCC" onclick="location.href='../classroom'">Classroom</a>
        <a class="button button-ripple" data-ripple-color="#CCC"  onclick="location.href='../slides'">Text</a>
        <a class="button button-ripple" data-ripple-color="#CCC"  onclick="location.href='../slides'">Slides</a>
    </div>
    <br /><br /><br />
        
        <div class="buttons">
            <a href="index.php" style="float:left;"><i class="fas fa-home"></i></a>
            <?php
            echo '<a href="navIndex.php?fa=logout&s=http://gnets.myds.me/work/' . $_SERVER['PHP_SELF'] .'" style="float:right;"><i class="fas fa-sign-out-alt"></i></a><br /><br />';
            echo '<a href="navIndex.php?fa=ca&s=http://gnets.myds.me/work/' . $_SERVER['PHP_SELF'] .'" style="float:left;"><i class="fas fa-user-alt-slash"></i></a>';
            ?>
            <a href="pas.php" style="float:right;"><i class="fas fa-key"></i></a>
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
                  $sql = "SELECT * FROM conturi WHERE prieteni LIKE '%{$myId}%'";
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
	  alert("The link was copyed! Send it to your friends!");
	}
</script>