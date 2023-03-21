<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Forms - Admin</title>
  <link rel="icon" href="../logo/forms.png" type="image/x-icon" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="excel/dist/jquery.table2excel.js"></script>
  <link href="style2.css" rel="stylesheet" />
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header('Location: http://gnets.myds.me/work/');
		die();
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
</script>


<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
.wrapper .input-data{
  height: 40px;
  width: 30%;
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
.mdc-button {
	font-size:24px !important;
}

@media screen and (max-width: 768px) {
  .wrapper{
	width: 80% !important;
	background: #fff;
	padding: 30px;
	border:#CCC 1px solid;
	border-radius:10px;
  }
}
@media screen and (min-width: 768px) {
  .wrapper{
	width: 750px;
	background: #fff;
	padding: 30px;
	border:#CCC 1px solid;
	border-radius:10px;
  }
}
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
.buttonPlus {
  background-color: transparent; 
  color: black; 
  border: 2px solid #09F;
}

.buttonPlus:hover {
  background-color: #09F;
  color: white;
}

.buttonPlus i {
  transform:rotate(0deg);
  color:#0C0;
  font-size:24px;
  transition: all ease-in-out 0.5s; 
}

.buttonPlus:hover i {
  transform:rotate(180deg);
  color: white;
}
.linkinput {
	border:#CCC 1px solid;
	border-radius:20px;
	padding:5px 0px;
	opacity:0;
	width:0px;
	float:right;
	transition:all 0.4s;
}
#formular:hover .linkinput {
	opacity:1;
	width:150px;
	padding:5px 5px;
}
#answers {
	opacity:0;
	transform:translateX(170%);
	transition:all 0.4s;
}
#formular:hover #answers {
	opacity:1;
	transform:translateX(0%);
}
.delete {
	float:right;
	font-size:24px;
	transform:translateX(170%);
	opacity:0;
	transition:all 0.4s;
	color:#F00;
	margin-left:30px;
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
}
#formular:hover .delete {
	transform:translateX(0%);
	opacity:1;
	color:#F00;
}
.delete:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	border-radius:20px;
	text-decoration:none;
	color:#FFF;
	margin-top:-10px;
	margin-right:-10px;
}
.copy {
	float:right;
	font-size:24px;
	transform:translateX(170%);
	opacity:0;
	transition:all 0.4s;
	color:#F00;
	margin-left:30px;
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
}
#formular:hover .copy {
	transform:translateX(0%);
	opacity:1;
	color:#F00;
}
.copy:hover {
	text-decoration:none;
	color:#FFF;
}

.mdc-button {
	--mdc-theme-primary:#000 !important;
	--mdc-theme-secondary:#333 !important;
	--mdc-theme-background:#09F !important;
	--mdc-theme-surface:#09F !important;
	text-transform: none !important;
	text-decoration:none !important;
}

.mdc-button2 {
	--mdc-theme-primary:#09F !important;
	--mdc-theme-secondary:#333 !important;
	--mdc-theme-background:#09F !important;
	--mdc-theme-surface:#09F !important;
	text-transform: none !important;
	text-decoration:none !important;
}

.mdc-button3 {
	--mdc-theme-primary:#e07828 !important;
	--mdc-theme-secondary:#333 !important;
	--mdc-theme-background:#0e078289F !important;
	--mdc-theme-surface:#e07828 !important;
	text-transform: none !important;
	text-decoration:none !important;
}
#add {
	display:inline;
}
</style>

<script>
function startLoad() {
	document.getElementById('add').innerHTML = getUrlVars()["id"];
}
function updateCode() {
	var code = getUrlVars()["id"];
	if (document.getElementById('banner').checked) {
		code = code + "&banner=false";
	}
	if (document.getElementById('border').checked) {
		code = code + "&border=false";
	}
	if (document.getElementById('color').value != "") {
		code = code + "&color=" + document.getElementById('color').value.replace("#", "");
	}
	document.getElementById('add').innerHTML = code;
}
</script>
<body onload="startLoad()">
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

<br />

<br />
<div class="wrapper">

<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="banner" onchange="updateCode()"/>
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
  <label for="banner">Remove banner</label>
</div>
<br />
<div class="mdc-form-field">
  <div class="mdc-checkbox">
    <input type="checkbox"
           class="mdc-checkbox__native-control"
           id="border" onchange="updateCode()"/>
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
  <label for="border">Remove border</label>
</div>

    <div class="input-data">
    <input type="text" id="color" onkeyup="updateCode()" required maxlength="6" />
    <div class="underline"></div>
    <label>Custom color</label></div>
</div>
<br />
<div class="wrapper">
	<xmp><iframe src="https://gnets.myds.me/forms/embeded.php?id=</xmp><div id="add"></div><xmp>" width="100%"></iframe></xmp>
</div>

<footer>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>

</body>
</html>
