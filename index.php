<!DOCTYPE html><head>
    <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
	<title>Alex Workspace</title>
    <link rel="icon" href="logo.png">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="os/letter.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php
	if ($_GET['forms'] != "") {
		header("Location: forms/raspunde.php?id=" . $_GET['forms']);
		die();
	}
	if ($_GET['text'] != "") {
		header("Location: text/doc.php?id=" . $_GET['text'] . "&fa=edit");
		die();
	}
	if ($_GET['slides'] != "") {
		header("Location: slides/slide.php?id=" . $_GET['slides'] . "&nr=1");
		die();
	}
	if ($_GET['classinvite'] != "") {
		header("Location: classroom/invitation.php?classid=" . $_GET['classinvite']);
		die();
	}
    if (isset($_COOKIE['login'])) {
        header('Location: http://gnets.myds.me/work/indexLog.php');
        die();
    }
?>


<style>
@font-face {
	font-family: SFPro;
	src: url('SFPro.ttf');
}
:root {
    --indigo: #622aff;
    --blue: #0e90db;
    --pink: #e94256;
    --green: #0b9e43;
    --azure: #027fff;
}
.mdc-button {
	--mdc-theme-primary:#09F;
	--mdc-theme-secondary:#333;
	--mdc-theme-background:#09F;
	--mdc-theme-surface:#09F;
	text-transform:inherit;
}
body {
	padding: 50px 200px 50px 200px;
	background-color:rgba(0,0,0,0.03);
}
.prez {
	font-family: SFPro;
	padding:50px;
	background-color:#FFF;
	box-shadow: 5px 5px 40px rgba(0,0,0,0.1), -5px -5px 40px rgba(0,0,0,0.05);
	border-radius:40px;
	margin:20px;
}
.navbar {
	width:100vh;
	position:fixed;
	top:0px;
	left:0px;
	background-color:rgba(255,255,255,0.5);
}
.prez1 {
	height:800px;
	width:60%;
	float:left;
}
.prez2 {
	height:620px;
	width:20%;
	float:right;
}
.prez3 {
	height:100px;
	width:20%;
	float:left;
	padding:25px 50px;
}
.prez4 {
	height:900px;
	width:25%;
	float:left;
}
.prez5 {
	height:500px;
	width:25%;
	float:left;
}
.prez6 {
	height:1200px;
	width:20%;
	float:right;
}
.prez7 {
	height:250px;
	width:25%;
	float:left;
	padding:50px;
}
.prez8 {
	height:200px;
	width:60%;
	float:left;
	padding:20px 50px;
}
.prez_init {
	height:400px;
	width:90%;
	float:left;
	padding:50px;
}

.prez_init img {
	width:50px;
	margin:25px;
	transition:all 0.2s;
}

.prez_init img:hover {
	-webkit-filter: drop-shadow(5px 5px 5px #CCC);
	filter: drop-shadow(5px 5px 5px #CCC);
}
#chat {
	display:block;
}
#chat_phone {
	display:none;
}

@media only screen and (max-width: 740px) {
	body {
		padding:10px;
		background-color:rgba(0,0,0,0.03);
	}
	.prez {
		padding:50px;
		font-family: sfPro;
		background-color:#FFF;
		box-shadow: 5px 5px 40px rgba(0,0,0,0.1), -5px -5px 40px rgba(0,0,0,0.05);
		border-radius:40px;
		margin:20px;
		height:inherit !important;
		width:60% !important;
		float:left !important;
	}
	#chat {
		display:none;
	}
	#chat_phone {
		display:block;
	}
}

.slideanim {visibility:hidden;}
.slide {
  animation-name: slide;
  -webkit-animation-name: slide;
  animation-duration: 1s;
  -webkit-animation-duration: 1s;
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

.slideanim2 {visibility:hidden;}
.slide2 {
  animation-name: slide2;
  -webkit-animation-name: slide2;
  animation-duration: 1s;
  -webkit-animation-duration: 1s;
  visibility: visible;
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

.slideanim3 {visibility:hidden;}
.slide3 {
  animation-name: slide3;
  -webkit-animation-name: slide3;
  animation-duration: 1s;
  -webkit-animation-duration: 1s;
  visibility: visible;
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
::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-track {
  background: rgba(0,0,0,0.03); 
}
::-webkit-scrollbar-thumb {
  background: #888; 
  border-radius:10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #555;
}	
</style>

<body>

<div class="prez prez_init">
       <div style="text-align:center; font-size:35px;"><span class="letter">A</span><span class="letter">l</span><span class="letter">e</span><span class="letter">x</span> <font style="color:rgba(0,0,0,0.7); font: normal bold 6rem 'Product Sans', sans-serif;">Workspace</font><br/><font style="color:#09F;">Free</font>, <font style="color:#ea4335;">Online</font>, <font style="color:#0C0;">simple t</font><font style="color:#FFF315">o use</font> application kit.</div>
    <table style="display: flex ;justify-content: center; align-items: center;"><tr>
    	<td><img class="logo" src="logo/chat.png"></td>
    	<td><img class="logo" src="logo/forms.png"></td>
    	<td><img class="logo" src="logo/video.png"></td>
    	<td><img class="logo" src="logo/class.png"></td>
    	<td><img class="logo" src="logo/text.png"></td>
    	<td><img class="logo" src="logo/slides.png"></td>
    </tr></table>
    <div style="text-align:center">
    	<a class="mdc-button mdc-button--raised" href="sign.php"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Sign up</span></a>
        <a class="mdc-button mdc-button--raised" href="log.php"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Log in</span></a>
    </div>
    <p style="text-align:center;">&copy; Alex Sofonea 2021 - Alex Workspace</p>
</div>



<div class="prez prez1 slide2">
	<h1 style="color:var(--blue);">Alex Chat</h1>
    <h2>Chat with your colegues directly into the workspace!</h2>
    <table id="chat">
    	<tr>
            <td><img src="videos/1.gif" width="600px"></td>
            <td><h2>Now You can also send files! You created a text document or a presentation, you can discuss it directley through Alex Chat</h2></td>
        </tr>
    </table>
    <div id="chat_phone">
        <img src="videos/1.gif" width="100%">
        <h2>Now You can also send files! You created a text document or a presentation, you can discuss it directley through Alex Chat</h2>
    </div>
    
</div>

<div class="prez prez2 slide3">
	<h1 style="color:var(--pink);">Alex Video</h1>
    <h2>Start meetings directley from Alex Chat</h2>
    <h4>Just click a button</h4>
    <img src="videos/2.gif" width="100%">
    <h4>If needed, also invite others</h4>
    <img src="videos/3.gif" width="100%">
</div>

<div class="prez prez3 slideanim">
	<h1 style="color:var(--green);">Need support?</h1>
    <h4>Go to the <a class="mdc-button" href="support" target="_blank"><span class="mdc-button__ripple"></span><span class="mdc-button__label">support page</span></a>!</h4>
</div>

<div class="prez prez4 slideanim2">
	<h1 style="color:var(--azure);">Alex Classroom</h1>
    <h2>Alex Classroom isn't just for school! You can use it also for work and chat and create with your colegues!</h2>
    <img src="videos/4.gif" width="100%">
    <h4>You can add assigments to your students, but also to the people who work around you!</h4>
    <img src="videos/5.png" width="100%">
    <h4>Also marks are no problem</h4>
    <img src="videos/6.gif" width="100%">
</div>

<div class="prez prez5 slideanim">
	<h1 style="color:var(--indigo);">Alex Text & Alex Slides</h1>
    <h2>Documents and presentations are ofcourse available!</h2>
    <img src="videos/11.gif" width="100%">
    <img src="videos/12.gif" width="100%">
</div>

<div class="prez prez6 slideanim3">
	<h1 style="color:var(--blue);">Alex Forms</h1>
    <h4>Siply create online quizes and find out all the cheeting with a new and more improved algortihm for that.</h4>
    <img src="videos/7.gif" width="100%">
    <h4>Also forms and get the charts!</h4>
    <img src="videos/8.gif" width="100%">
    <h4>Submitting goes realy easy!</h4>
    <img src="videos/9.gif" width="100%">
    <h4>Then see the answers!</h4>
    <img src="videos/10.gif" width="100%">
</div>

<div class="prez prez7 slideanim">
	<h1 style="color:var(--green);">Any problems or abuses?</h1>
    <h4>Just report them!</h4>
    <img src="videos/13.gif" width="100%">
</div>

<div class="prez prez8 slideanim2">
	<h1 style="color:var(--pink);">About</h1>
    <h2>The platform Alex Workspace and all the apis that can be embedet in other websites is created by  <a class="mdc-button" href="https://gnets.myds.me/alex" style="font-size:18px;"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Alex Sofonea</span></a>.</h2>
</div>

<script>
	$(window).scroll(function() {
	  $(".slideanim").each(function(){
		var pos = $(this).offset().top;
	
		var winTop = $(window).scrollTop();
		if (pos < winTop + 600) {
		  $(this).addClass("slide");
		}
	  });
	});
	$(window).scroll(function() {
	  $(".slideanim2").each(function(){
		var pos = $(this).offset().top;
	
		var winTop = $(window).scrollTop();
		if (pos < winTop + 900) {
		  $(this).addClass("slide2");
		}
	  });
	});
	$(window).scroll(function() {
	  $(".slideanim3").each(function(){
		var pos = $(this).offset().top;
	
		var winTop = $(window).scrollTop();
		if (pos < winTop + 600) {
		  $(this).addClass("slide3");
		}
	  });
	});
</script>



</body>
</html>
