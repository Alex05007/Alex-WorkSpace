<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Alex Form - Edit Question</title>
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
$hostname = 'localhost:3307';
include "../db.php";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

if ($_GET['r'] != "" and $_GET['i'] != "") {
	$sql = "UPDATE `question` SET `Intrebare`='" . base64_decode($_GET['i']) . "', `Raspuns`='" . base64_decode($_GET['r']) . "', `Tip`='" . $_GET['tip'] . "' WHERE Id='" . $_GET['q'] . "' and Testid='" . $_GET['id'] . "' and Creator='" . $_COOKIE['login'] . "'";
	$stmt = $conn->query($sql);
	header("Location: edit.php?id=" . $_GET['testId']);
	die();
}
$conn=null;
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
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}


function save() {
	var testId = getUrlVars()["id"];
	var intr = document.getElementById('intr').value;
	var tip = document.getElementsByName('tipuri');
	for (var i=0; i<tip.length; i++) {
		if (tip[i].checked == true && tip[i].value == "radio") {
			var rasp = document.getElementsByName('raspuns');
			var raspuns = "";
			for (var y=0; y<rasp.length; y++) {
				if (rasp[y].value != "") 
					raspuns = raspuns + rasp[y].value.replace(";", "|||") + ";";
			}
			var iTip = tip[i].value;
		}
		if (tip[i].checked == true && tip[i].value == "checkbox") {
			var rasp = document.getElementsByName('raspuns2');
			var raspuns = "";
			for (var x=0; x<rasp.length; x++) {
				if (rasp[x].value != "") 
					raspuns = raspuns + rasp[x].value.replace(";", "|||") + ";";
			}
			var iTip = tip[i].value;
		}
		if (tip[i].checked == true && tip[i].value == "completare") {
			var raspuns = "";
			var iTip = tip[i].value;
		}
	}
	if (raspuns != "" || iTip != "") {
		location.assign("q_edit.php?id=" + testId + "&q=" + getUrlVars()["q"] +  "&i=" + btoa(intr) +"&r=" + btoa(raspuns) + "&tip=" + iTip + "&t=" + getUrlVars()["t"]);
	}
}
</script>

<style>
@media screen and (max-width: 768px) {
	body {
	  font: 400 16px "Varela Round", sans-serif;
	}
  .wrapper{
	width: 300px !important;
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
	$sql = "SELECT * FROM question WHERE Testid='" . $_GET['id'] . "' and Id='" . $_GET['q'] . "'";
	$stmt = $conn->query($sql);
	if($row = $stmt->fetch()){
?>
    <div class="wrapper">
        <div class="input-data">
        <input type="text" id="intr" required="required" maxlength="199" value="<?php echo $row['Intrebare']; ?>" />
        <div class="underline"></div>
        <label>Question <font style="color:#F00">*</font></label></div>
    </div>
   
   
<div class="mdc-form-field">
  <div class="mdc-radio">
    <input class="mdc-radio__native-control" type="radio" value="radio" id="radio" name="tipuri" <?php if($_GET['t'] == "r") { echo 'checked="checked"'; } ?> />
    <div class="mdc-radio__background">
      <div class="mdc-radio__outer-circle"></div>
      <div class="mdc-radio__inner-circle"></div>
    </div>
    <div class="mdc-radio__ripple"></div>
  </div>
  <label for="radio">
        </label><div id="alege">
            <br />
            <div class="wrapper">
            	<h2>Single choise</h2>
                <?php
					if ($_GET['t'] == "r") {
						$raspuns = $row['Raspuns'];
						$rasp = explode(";", $raspuns);
						for ($i=0; $i<count($rasp)-1; $i++) {
							echo '<div><div class="input-data">
							<input type="text" name="raspuns" required="required" maxlength="100" value="' . $rasp[$i] . '">
							<div class="underline"></div>
							<label>Answer</label></div><br /></div>';
						}
					}
					echo '<div id="raspuns1"><div class="input-data">
					<input type="text" name="raspuns" required="required" maxlength="100">
					<div class="underline"></div>
					<label>Answer</label></div><br /></div>';
				?>
                <br />
                <button class="mdc-button" onclick="clone1()" style="float:right;">
                   <span class="mdc-button__ripple"></span>
                   <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
                </button>
            </div>
            <br />
            <br />
            <br />
        </div>
   
</div> 
<div class="mdc-form-field">
  <div class="mdc-radio">
    <input class="mdc-radio__native-control" type="radio" value="checkbox" id="checkbox" name="tipuri" <?php if($_GET['t'] == "c") { echo 'checked="checked"'; } ?> />
    <div class="mdc-radio__background">
      <div class="mdc-radio__outer-circle"></div>
      <div class="mdc-radio__inner-circle"></div>
    </div>
    <div class="mdc-radio__ripple"></div>
  </div>
  <label for="checkbox">
        </label><div id="alege">
            <br />
            <div class="wrapper">
            	<h2>Multiple choise</h2>
                <?php
					if ($_GET['t'] == "c") {
						$raspuns = $row['Raspuns'];
						$rasp = explode(";", $raspuns);
						for ($i=0; $i<count($rasp)-1; $i++) {
							echo '<div id="raspuns2"><div class="input-data">
							<input type="text" name="raspuns" required="required" maxlength="100" value="' . $rasp[$i] . '">
							<div class="underline"></div>
							<label>Answer</label></div><br /></div>';
						} 
					}
					echo '<div id="raspuns2"><div class="input-data">
					<input type="text" name="raspuns" required="required" maxlength="100">
					<div class="underline"></div>
					<label>Answer</label></div><br /></div>';
				?>
                <button class="mdc-button" onclick="clone2()" style="float:right;">
                   <span class="mdc-button__ripple"></span>
                   <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
                </button>
                <br />
            </div>
            <br />
            <br />
            <br />
        </div>
   
</div> 
<div class="mdc-form-field">
  <div class="mdc-radio">
    <input class="mdc-radio__native-control" type="radio" value="completare" id="completare" name="tipuri" <?php if($_GET['t'] == "l") { echo 'checked="checked"'; } ?> />
    <div class="mdc-radio__background">
      <div class="mdc-radio__outer-circle"></div>
      <div class="mdc-radio__inner-circle"></div>
    </div>
    <div class="mdc-radio__ripple"></div>
  </div>
  <label for="completare">
    </label><div class="wrapper">
   		<h2>Write answer</h2>
        <div class="input-data">
        <input type="text" id="raspComplet" required="required" maxlength="0" />
        <div class="underline"></div>
        <label>...</label></div>
    </div>
   
</div> 
<br />

<?php } ?>
<button class="mdc-button" onclick="save()">
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
