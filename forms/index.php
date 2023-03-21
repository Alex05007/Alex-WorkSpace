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
function adauga() {
	var pas = document.getElementById('addPas').value;
	location.assign("index.php?form=" + pas);
}
/*function onLoad() {
	var myId = getCookie("login");
	var formPas = getUrlVars()['pass']
	if (myId != "" || */
	

function linkCopy(id) {
  var copyText = document.getElementById(id);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("The Link was copyed!");
}
</script>


<style>
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
</style>

<body onload="getBg()">
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

<div class="wrapper">
    <a href="create.php?fa=form" class="mdc-button mdc-button2">
       <span class="mdc-button__ripple"></span>
       <span class="mdc-button__label"><i class="fas fa-plus"></i> Form</span>
    </a>
    <!--<a href="create.php?fa=pool" class="mdc-button mdc-button2">
       <span class="mdc-button__ripple"></span>
       <span class="mdc-button__label"><i class="fas fa-plus"></i> Pool</span>
    </a>-->
</div>

<br />
<div class="wrapper">
		    <?php
			$sunt_files = false;
			$hostname = 'localhost:3307';
			include "../db.php";
			try {
				$conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			if ($_GET['fa'] == "sterge") {
				$sql = "DELETE FROM `forms` WHERE Titlu='" . $_GET['titlu'] . "' and Id='" . $_GET['test'] . "'";
			    $stmt = $conn->query($sql);
				$sql = "DELETE FROM `question` WHERE Testid='" . $_GET['test'] . "'";
			    $stmt = $conn->query($sql);
				$sql = "DELETE FROM `raspunsuri` WHERE test='" . $_GET['test'] . "'";
			    $stmt = $conn->query($sql);
			}
			$sql = "SELECT * FROM forms WHERE TestCreator = '" . $_COOKIE['login'] . "'";
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
					$sunt_files = true;
					echo "<div id='formular'>";
						echo '<a href="http://gnets.myds.me/work/?forms=' . $row['Id'] . '" class="mdc-button">
						   <span class="mdc-button__ripple"></span>
						   <span class="mdc-button__label" style="font-size:16px;">' . $row['Titlu'] . '</span>
						</a>';
						echo '<a href="http://gnets.myds.me/work/forms/admin.php?id=' . $row['Id'] . '" class="mdc-button" id="answers">
						   <span class="mdc-button__ripple"></span>
						   <span class="mdc-button__label" style="font-size:14px;">Answers</span>
						</a>';
						echo "<a href='index.php?fa=sterge&test=" . $row['Id'] . "&titlu=" . $row['Titlu'] . "' class='delete'><i class='far fa-trash-alt'></i></a>";
						echo '<a href="javascript:linkCopy(\'' . $row['Id'] . '\')" class="copy"><i class="far fa-copy" style="color:#CCC; margin-right:20px; margin-left:-20px;"></i></a>';
						echo '<input class="linkinput" type="text" id="' . $row['Id'] . '" value="https://gnets.myds.me/work/?forms=' . $row['Id'] . '" readonly="readonly">';
						echo '<a href="code.php?id=' . $row['Id'] . '" class="copy"><i class="fas fa-code" style="color:#CCC; margin-right:20px; margin-left:-20px;"></i></a>';
						echo '<a href="http://gnets.myds.me/work/forms/edit.php?id=' . $row['Id'] . '" class="delete" style="margin-right:20px; margin-left:-20px;"><i class="fas fa-pen" style="color:#CCC;"></i></a>';
					echo "</div><br />";
			}
			if ($sunt_files == false) {
				echo "<div style='text-align:center;'>
						<i class='far fa-folder-open' style='font-size:50px;'></i>
						<h2>Hopa</h2>
						<p>You don't have any forms!</p>
						<p>Create one from the new form button.</p>
					  </div>";
			}
?>
</div>
<br />

<!--<div class="wrapper">
<h4>If you created a form befor <em>01.12.2020</em>, than put it's password below!</h4>
<br />
	<div class="input-data">
	<input type="text" id="addPas" required="required" maxlength="19">
	<div class="underline"></div>
	<label>Password <font style="color:#F00">*</font></label></div><br />
    <a href="javascript:adauga()">Add older form.</a>
</div>-->

<footer>
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>

</body>
</html>
