<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Form - Question</title>
  <link rel="icon" href="../logo/forms.png" type="image/x-icon" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link href="style2.css" rel="stylesheet" />
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header('Location: http://gnets.myds.me/work/');
		die();
	}
	/***if ($_COOKIE['raspuns'] == "gata") {
		header('Location: http://gnets.myds.me/work/forms/rezCreate.php');
		die();
	}
	if ($_COOKIE['raspuns'] == "true") {
		header('Location: http://gnets.myds.me/work/forms/intrebare.php');
		die();
	}***/
?>

<script>
var rasp = getCookie("rasp");
var nrIntr = getCookie("intr");
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
function incarcare() {
	q_option();
	if (getCookie("ch") == "true") {
		document.getElementById('raspComplet').disabled = true;
		document.getElementById('completare').disabled = true;
	}
}

function save(fa) {
	var testId = getCookie("idTest");
	var intr = document.getElementById('intr').value;
	var tip = document.getElementById('tip').value;
	if (tip == "radio") {
		var rasp = document.getElementsByName('raspuns');
		var raspuns = "";
		for (var i=0; i<rasp.length; i++) {
			raspuns = raspuns + rasp[i].value.replace(";", "|||") + ";";
		}
	}
	if (tip == "checkbox") {
		var rasp = document.getElementsByName('raspuns2');
		var raspuns = "";
		for (var i=0; i<rasp.length; i++) {
			raspuns = raspuns + rasp[i].value.replace(";", "|||") + ";";
		}
	}
	if (tip == "completare") {
		var raspuns = "";
	}
	if (tip == "img_r") {
		var rasp = document.getElementsByName('raspuns3');
		var raspuns = "";
		for (var i=0; i<rasp.length; i++) {
			raspuns = raspuns + rasp[i].value.replace(";", "|||") + ";";
		}
	}
	if (tip == "img_c") {
		var rasp = document.getElementsByName('raspuns4');
		var raspuns = "";
		for (var i=0; i<rasp.length; i++) {
			raspuns = raspuns +  rasp[i].value.replace(";", "|||") + ";";
		}
	}
	if (tip == "info") {
		var raspuns = "";
	}
	nrIntr++;
	var obligatoriu = document.getElementById('obligatoriu').checked;
	var punctaj = "";
	setCookie("intr", nrIntr, 1);
	if (raspuns != "" || tip != "") {
		$.ajax
		  ({
			type: "POST",
			url: "saveQ.php",
			data: { "testId": testId, "id": nrIntr, "intrebare": intr, "r": raspuns, "tip": tip, "o": obligatoriu }
		  });
		  if (fa == "new") {
			  location.assign("intrebare.php");
		  }
		  if (fa == "gata") {
			  location.assign("edit.php?id=" + testId);
		  }
		//location.assign("intrebare.php?fa=gata&testId=" + testId + "&id=" + nrIntr +  "&intrebare=" + btoa(intr) +"&r=" + btoa(raspuns) + "&tip=" + tip + "&p=" + punctaj);
	}
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
	width: 750px;
	background: #fff;
	padding: 30px;
	border:#CCC 1px solid;
	border-radius:10px;
  }
}
.buttonPlus {
  background-color: transparent; 
  color: black; 
  border: 2px solid #06F;
}

.buttonPlus:hover {
  background-color: #06F;
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
.switch {
  position: relative;
  width: 60px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  transform:scaleY(2);
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 3px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 68px;
}

.slider.round:before {
  border-radius: 50%;
}
select {
	border:#CCC 1px solid;
	box-shadow:none;
	border-radius:10px;
	padding:10px;
	color:#000;
}
</style>

<script>
function clone1() {
	var elem = document.querySelector("#raspuns1");
	var clone = elem.cloneNode(true);
	elem.after(clone);
}
function clone2() {
	var elem = document.querySelector("#raspuns2");
	var clone = elem.cloneNode(true);
	elem.after(clone);
}
function clone3() {
	var elem = document.querySelector("#raspuns3");
	var clone = elem.cloneNode(true);
	elem.after(clone);
}
function clone4() {
	var elem = document.querySelector("#raspuns4");
	var clone = elem.cloneNode(true);
	elem.after(clone);
}
function q_option() {
	var q = document.getElementsByName('q');
	for (var i=0; i<q.length; i++) {
		q[i].style.display = "none";
	}
	document.getElementById(document.getElementById('tip').value).style.display = "block";
}
</script>

<body onload="incarcare()">
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
    	<table width="100%"><tr>
            <td><div class="input-data">
            <input type="text" id="intr" required="required" maxlength="9999" style="float:left;" />
            <div class="underline"></div>
            <label>Question <font style="color:#F00">*</font></label></div><br /></td>

            <td width="20%"><select style="float:right;" onchange="q_option()" id="tip">
                <option value="radio" selected="selected">Singel choice</option>
                <option value="checkbox">Multiple choice</option>
                <option value="completare">Short answer</option>
                <option value="img_r">Singel choice image</option>
                <option value="img_c">Multiple choice image</option>
                <option value="info">Just text</option>
             </select></td>
         </tr></table>
            
            <div class="mdc-form-field">
              <div class="mdc-checkbox">
                <input type="checkbox"
                       class="mdc-checkbox__native-control"
                       id="obligatoriu"/>
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
              <label for="obligatoriu" style="font-weight:400;">Answer is required</label>
            </div>
    </div>
    <br />
    <div class="wrapper" id="radio" name="q">
        <h2>Single choice</h2>
        <div id="raspuns1"><div class="input-data">
        <input type="text" name="raspuns" required="required" />
        <div class="underline"></div>
        <label>Answer</label></div><br /></div>
        <button class="mdc-button" onclick="clone1()" style="float:right;">
           <span class="mdc-button__ripple"></span>
           <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
        </button>
        <br />
    </div>
    <div class="wrapper" id="checkbox" name="q" style="display:none;">
        <h2>Multiple choice</h2>
        <div id="raspuns2"><div class="input-data">
        <input type="text" name="raspuns2" required="required" <?php if($_COOKIE['brukforms'] == "true") { echo 'disabled'; } ?> />
        <div class="underline"></div>
        <label>Answer</label></div><br /></div>
        <button class="mdc-button" onclick="clone2()" style="float:right;" <?php if($_COOKIE['brukforms'] == "true") { echo 'disabled'; } ?>>
           <span class="mdc-button__ripple"></span>
           <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
        </button>
        <br />
    </div>
    <div class="wrapper" id="completare" name="q" style="display:none;">
        <h2>Write answer</h2>
        <div class="input-data">
        <input type="text" id="raspComplet" required="required" maxlength="0" />
        <div class="underline"></div>
        <label>...</label></div>
    </div>
    <div class="wrapper" id="img_r" name="q" style="display:none;">
        <h2>Single choice image</h2>
        <div id="raspuns3"><div class="input-data">
        <input type="text" name="raspuns3" required="required"/>
        <div class="underline"></div>
        <label>Link</label></div><br /></div>
        <button class="mdc-button" onclick="clone3()" style="float:right;">
           <span class="mdc-button__ripple"></span>
           <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
        </button>
        <br />
    </div>
    <div class="wrapper" id="img_c" name="q" style="display:none;">
        <h2>Multiple choice image</h2>
        <div id="raspuns4"><div class="input-data">
        <input type="text" name="raspuns4" required="required" <?php if($_COOKIE['brukforms'] == "true") { echo 'disabled'; } ?> />
        <div class="underline"></div>
        <label>Link</label></div><br /></div>
        <button class="mdc-button" onclick="clone4()" style="float:right;" <?php if($_COOKIE['brukforms'] == "true") { echo 'disabled'; } ?>>
           <span class="mdc-button__ripple"></span>
           <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
        </button>
        <br />
    </div>
<br />
<?php
	//if($_COOKIE['ch'] == "false") {
		echo '<button class="mdc-button" onclick="save(\'new\')">
		   <span class="mdc-button__ripple"></span>
		   <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
		</button>';
	//}
?>
<button class="mdc-button" onclick="save('gata')">
   <span class="mdc-button__ripple"></span>
   <span class="mdc-button__label"><i class="fa fa-thumbs-up"></i> Save</span>
</button>

<br />
<hr />
<footer>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>
</body>
</html>
