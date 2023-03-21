<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alex Slides</title>
  <link rel="icon" href="../logo/slides.png" type="image/x-icon">
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
	body {
	  font: 400 16px "Varela Round", sans-serif;
	}
  .wrapper{
	width: 300px !important;
	background: #fff;
	padding: 30px;
	box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
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
	box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
	border-radius:10px;
  }
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
.delete {
	float:right;
	font-size:24px;
	transform:translateY(70%);
	opacity:0;
	transition:all 0.4s;
	color:#F00;
	margin-left:30px;
}
#formular:hover .delete {
	transform:translateY(0%);
	opacity:1;
	color:#F00;
}
.linkinput {
	border:#CCC 1px solid;
	border-radius:20px;
	width:auto;
	padding:5px;
}
.delete {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
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
</style>

<body onload="getBg()">
	<?php
		include "../nav.php";
	?>
    
<br />
<br />
<br />
<h3 class="titlu">Alex Slides</h3>

<br />

<div class="wrapper">
    <a href="create.php" class="mdc-button">
       <span class="mdc-button__ripple"></span>
       <span class="mdc-button__label"><i class="fas fa-plus"></i></span>
    </a>
</div>

<br />
		    <?php
			$sunt_files = false;
			$hostname = 'localhost:3307';
			include "../db.php";
			try {
				$conn = new PDO("mysql:host=$hostname;dbname=alexslides", $username, $password);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			if ($_GET['fa'] == "sterge") {
				$sql = "DELETE FROM `prezentari` WHERE Titlu='" . $_GET['titlu'] . "' and Id='" . $_GET['test'] . "'";
			    $stmt = $conn->query($sql);
				$sql = "DELETE FROM `slide` WHERE Test='" . $_GET['test'] . "'";
			    $stmt = $conn->query($sql);
			}
			$sql = "SELECT * FROM prezentari WHERE Creator = '" . $_COOKIE['login'] . "'";
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
					$sunt_files = true;
					echo "<div class='wrapper' id='formular'>";
						echo '<a href="http://gnets.myds.me/work/slides/slide.php?id=' . $row['Id'] . '&fa=edit" class="mdc-button">
						   <span class="mdc-button__ripple"></span>
						   <span class="mdc-button__label">' . $row['Titlu'] . '</span>
						</a><br />';
						echo '<input class="linkinput" type="text" id="' . $row['Id'] . '" value="alexs.gq/s#' . $row['Id'] . '" readonly="readonly">';
						echo "<a href='index.php?fa=sterge&test=" . $row['Id'] . "&titlu=" . $row['Titlu'] . "' class='delete'><i class='far fa-trash-alt'></i></a>";
						echo '<a href="javascript:linkCopy(\'' . $row['Id'] . '\')" class="delete"><i class="far fa-copy" style="color:#CCC;"></i></a>';
					echo "</div><br />";
			}
			if ($sunt_files == false) {
				echo "<div class='wrapper' style='text-align:center;'>
						<i class='far fa-folder-open' style='font-size:50px;'></i>
						<h2>Hopa</h2>
						<p>You don't have any presentations!</p>
						<p>Create one from the new presentation button.</p>
					  </div>";
			}
?>
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
