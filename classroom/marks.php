<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link rel="icon" href="../logo/class.png" />
  <title>Alex Classroom</title>
</head>

<?php
	if (!isset($_COOKIE['login'])) {
		header("Location: http://gnets.myds.me/work");
		die();
	}
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$myId = $_COOKIE['login'];
	if (isset($_GET['edit']) and isset($_GET['grades'])) {
		$sql = "UPDATE grades SET marks='" . $_GET['grades'] . "' WHERE classid='" . $_GET['classid'] . "' and student='" . openssl_encrypt($_GET['edit'],"AES-128-ECB", $_GET['classid']) . "'";
		$stmt = $conn->query($sql);
		header("Location: marks.php?classid=" . $_GET['classid']);
		die();
	}
	$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
	$stmt = $conn->query($sql);
	if ($row = $stmt->fetch()) {$students = $row['Students'] . ";" . $row['Professor'];}
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$sql = "SELECT * FROM conturi";
	$stmt = $conn->query($sql);
	$culori = array();
	$id_nume = array();
	while ($row = $stmt->fetch()) {
		if (strpos($students, $row['Id']) !== false) {
			$culori[$row['username']] = $row['culoare'];
			$id_nume[$row['Id']] = $row['username'];
		}
	}
	function grades_table($subjectt, $mark1, $mark2, $mark3, $mark4, $mark5) {
		echo '<tr>
			<td>' . $subjectt . '</td>
			<td>' . $mark1 . '</td>
			<td>' . $mark2 . '</td>
			<td>' . $mark3 . '</td>
			<td>' . $mark4 . '</td>
			<td>' . $mark5 . '</td>';
		if ($mark1 != "" && $mark2 == "" && $mark3 == "" && $mark4 == "" && $mark5 == "")
				echo '<td>' . $mark1 . '</td>';
		else {
			if ($mark1 != "" && $mark2 != "" && $mark3 == "" && $mark4 == "" && $mark5 == "")
					echo '<td>' . ((intval($mark1) + intval($mark2))/2) . '</td>';
			else {
				if ($mark1 != "" && $mark2 != "" && $mark3 != "" && $mark4 == "" && $mark5 == "")
						echo '<td>' . ((intval($mark1) + intval($mark2) + intval($mark3))/3) . '</td>';
				else {
					if ($mark1 != "" && $mark2 != "" && $mark3 != "" && $mark4 != "" && $mark5 == "")
						echo '<td>' . ((intval($mark1) + intval($mark2) + intval($mark3) + intval($mark4))/4) . '</td>';
					else {
						if ($mark1 != "" && $mark2 != "" && $mark3 != "" && $mark4 != "" && $mark5 != "")
							echo '<td>' . ((intval($mark1) + intval($mark2) + intval($mark3) + intval($mark4) + intval($mark5))/5) . '</td>';
						else
							echo '<td>No marks</td>';
					}
				}
			}
		}
		echo "</tr>";
	}
	function edit_mark($subjectt, $mark1, $mark2, $mark3, $mark4, $mark5) {
		$i++;
		echo '<tr>
			<td><input name="mark-edit" type="text" value="' . $subjectt . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark1 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark2 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark3 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark4 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark5 . '" style="width:100%;"/></td>';
		echo "</tr>";
	}
?>


<style>@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
.input-data{
  height: 40px;
  width: 100%;
  position: relative;
}
.input-data input{
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
  color: #06F;
}
.input-data label{
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
  background: #06F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}
.title h1 {
	color:#FFF;
}
.title h4 {
	color:#CCC;
}
.title .links {
	text-align:center;
	margin-bottom:10px;
}
.title .links a {
	color:#FFF;
	text-decoration:none !important;
	font-size:18px;
	margin-top:80%;
	margin-right:20px;
}
.assigment {
	background-color:#FFF;
	width:300px;
	height:200px;
	border-radius:16px;
	padding:20px;
	border:1px solid #CCC;
	overflow:auto;
}
.assigment date {
	font-size:16px;
	color:#CCC;
}
.create {
	text-decoration:none !important;
	padding:10px;
	background-color:#1a73e8;
	border-radius:25px;
	transition:all 0.3s;
	color:#FFF;
	font-size:15px;
	float:right;
}
.create i {
	padding-right:10px;
	font-size:20px;
}
.create:hover {
	background-color:#1a73e8;
	color:#FFF;
	box-shadow:1px 1px 30px #1a73e8;
}
.col1 {
	float:left;
	width:35%;
}
.col2 {
	float:right;
	width:65%;
}
.col2 .chat {
	height:400px;
	width:100%;
	overflow-y:scroll;
	overflow-x:hidden;
}
footer {
	float:left;
	width:100%;
}
footer p {
	margin: 0;
	position: absolute;
	left: 50%;
	-ms-transform: translateX(-50%);
	transform: translateX(-50%);
}
.comment .me {
	line-height: 10%;
}
.comment .me img {
	margin-top:13px;
}
.comment .me svg {
	margin-top:15px;
	float:right;
	color:#000;
	transition:all 0.3s;
}
.comment .me svg:hover {
	background-color:rgba(0,0,0,0.1);
	color:#000;
	border-radius:100px;
}
.comment .me i {
	font-size:20px;
	margin-top:15px;
	float:right;
	color:#F00;
	opacity:0;
	transform:translateY(70%);
	transition:all 0.3s;
}
.comment:hover .me i {
	opacity:1;
	transform:translateY(0%);
}
	
	
.comment p {
	color:#666;
}
.files {
	border-radius:20px;
	border:1px solid #999;
	padding:7px;
	width:15%;
	margin-top:5px;
}
.termin {
	float:right;
	margin-top:20px;
}
.marks th, .marks td {
	border:1px #CCC solid;
	padding:5px;
}
.marks {
	width:100%;
}
.edit {
	font-size:16px;
	margin-left:10px;
	opacity:0;
	transform:translateX(-70%);
	transition:all 0.2s;
	color:#333 !important;
}
.hover:hover .edit {
	color:#09F;
	opacity:1;
	transform:translateX(0%);
}
input {
	width:95%;
}
.hover a {
	color:#666;
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
}
.hover a:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	border-radius:20px;
	margin-left:0px;
}
.class .title a {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
	margin:10px;
}
.class .title a:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	margin:0px;
}
.comment a {
	float:right;
}
.comment a:not(.mdc-button) {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
	color:#333;
	margin-top:20px;
	font-size:15px;
}
.comment a:hover:not(.mdc-button) {
	padding:10px;
	background-color: rgba(50,50,50,0.3);
	color:#333;
	margin-top:10px !important;
	margin-right:-10px !important;
}

@media only screen and (min-width: 761px) {
	.title {
		width:900px;
		padding:20px;
		border-radius:16px;
		height:150px;
		background-size:cover;
		background-position: right bottom;
	}
	.comment {
		background-color:#FFF;
		width:100%;
		border-radius:16px;
		padding:20px;
		border:1px solid #CCC;
	}
	.input-data input{
	  height: 100%;
	  width: 500px;
	  border: none;
	  font-size: 17px;
	  border-bottom: 2px solid silver;
	}
	.class {
	  padding:0px 100px;
	  margin: 0;
	  position: absolute;
	  left: 50%;
	  -ms-transform: translateX(-50%);
	  transform: translateX(-50%);
	  margin-bottom:20px !important;
	}
}
/*mobile*/
@media only screen and (max-width: 761px) {
	.title {
		width:100%;
		padding:5px;
		margin-bottom:20px;
		border-radius:16px;
		height:150px;
		background-size:cover;
		background-position: right bottom;
	}
	.title img {
		width:30px !important;
	}
	.comment {
		background-color:#FFF;
		width:100%;
		border-radius:16px;
		padding:7px;
		border:1px solid #CCC;
	}
	.comment svg {
		display:none;
	}
	.comment table {
		width: 100%;
	}
	.input-data input{
	  height: 100%;
	  width: 100%;
	  border: none;
	  font-size: 17px;
	  border-bottom: 2px solid silver;
	}
	.class {
		padding:10px;
		margin-bottom:20px !important;
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
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function savemark() {
	var grade = "";
	var grades = document.getElementsByName('mark-edit');
	for (var i=0; i<grades.length; i=i+6) {
		if (grades[i].value != "") {
			grade = grade + grades[i].value + "," + grades[i+1].value + "," + grades[i+2].value + "," + grades[i+3].value + "," + grades[i+4].value + "," + grades[i+5].value + ";";
		}
	}
	var classid = getUrlVars()["classid"];
	var edit = getUrlVars()["edit"];
	location.assign("marks.php?classid=" + classid + "&grades=" + grade + "&edit=" + edit);
}
function clone() {
	var elem = document.querySelector("#clonetr");
	var clone = elem.cloneNode(true);
	elem.after(clone);
}
</script>

<body onload="lload()">
<?php
	include "../nav.php";
?>
<div class="class">
    <div class="title">
        <?php 
			$hostname = 'localhost:3307';
			include "../db.php";
			try {
				$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
			$stmt = $conn->query($sql);
			if ($row = $stmt->fetch()) {
				echo "<h1>" . $row['Titlu'] . "</h1>
				<h4>" . $row['Materie'] . "</h4>
				<div class='links'>
				<a href='chat.php?classid=" . $row['Id'] . "'>Chat</a>
				<a href='assigments.php?classid=" . $row['Id'] . "'>Assigments</a>
				<a href='marks.php?classid=" . $row['Id'] . "'>Marks</a>
				<a href='people.php?classid=" . $row['Id'] . "'>People</a>
				<a href='../video/?id=" . $row['Id'] . "'>Meet in <img src='../logo/video.png' width='40px'></a></div>";
				$profesor = $row['Professor'];
				if ($_COOKIE['login'] == $row['Professor']) {
					$prof = true;
				} else {
					$prof = false;
				}
				$students = $row['Students'];
				echo "<style> .title { background-image:url(img/" . $row['background'] . ".jpg); } </style>";
			}
		?>
    </div>
    <br />
    <br />
    
    
    
    
    
    <div class="comment">
	<?php
		if ($profesor == $_COOKIE['login']) {
			$sql = "SELECT * FROM grades WHERE classid='" . $_GET['classid'] . "'";
			$stmt = $conn->query($sql);
		} else {
			$sql = "SELECT * FROM grades WHERE classid='" . $_GET['classid'] . "' and student='" . openssl_encrypt($_COOKIE['un'],"AES-128-ECB", $_GET['classid']) . "'";
			$stmt = $conn->query($sql);
		}
		while ($row = $stmt->fetch()) {
            $student = openssl_decrypt($row['student'],"AES-128-ECB", $_GET['classid']);
			echo "
			<div class='hover'>
				<table>
					<tr>
						<td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$student] . "&color=fff&name=" . $student . "&size=40&rounded=true' style='margin-right:10px;'/></td>
						<td><h3>" . $student; 
						if ($profesor == $_COOKIE['login']) {
							echo "<a href='marks.php?classid=" . $_GET['classid'] . "&edit=" . $student . "#edit' class='edit'><i class='fa fa-pen'></i></a>"; 
						}
						echo "</h3><p>Student</p></td></tr></table>";
				echo '<table class="marks" name="grades">';
				if ($row['marks'] != "") {
					$subjects = explode(";", $row['marks']);
					for ($i=0; $i<count($subjects)-1; $i++) {
						$marks = explode(",", $subjects[$i]);
						grades_table($marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5]);
					}
				}
				else {
					echo '<tr>
						<td><font style="color:#999;">Subject</font></td>
						<td><font style="color:#999;">Grade</font></td>
						<td><font style="color:#999;">Grade</font></td>
						<td><font style="color:#999;">Grade</font></td>
						<td><font style="color:#999;">Grade</font></td>
						<td><font style="color:#999;">Grade</font></td>';
					echo "</tr>";
				}
			echo "</table></div><br />";
		}
		echo "</div>";
		if ($profesor == $_COOKIE['login'] and isset($_GET['edit'])) {
			echo "<br /><div class='comment' id='edit'>";
			$sql = "SELECT * FROM grades WHERE classid='" . $_GET['classid'] . "' and student='" . openssl_encrypt($_GET['edit'],"AES-128-ECB", $_GET['classid']) . "'";
			$stmt = $conn->query($sql);
			if ($row = $stmt->fetch()) {
				$student = openssl_decrypt($row['student'],"AES-128-ECB", $_GET['classid']);
				echo "
				<div class='hover'>
					<table>
						<tr>
							<td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$student] . "&color=fff&name=" . $student . "&size=40&rounded=true' style='margin-right:10px;'/></td>
							<td><h3>" . $student . "</h3><p>Student</p></td></tr></table>";
					echo '<table class="marks" name="grades">';
						$subjects = explode(";", $row['marks']);
						for ($i=0; $i<count($subjects)-1; $i++) {
							$marks = explode(",", $subjects[$i]);
							edit_mark($marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5]);
						}
						echo '<tr id="clonetr">
							<td><input name="mark-edit" type="text" value="' . $subjectt . '" style="width:100%;"/></td>
							<td><input name="mark-edit" type="number" value="' . $mark1 . '" style="width:100%;"/></td>
							<td><input name="mark-edit" type="number" value="' . $mark2 . '" style="width:100%;"/></td>
							<td><input name="mark-edit" type="number" value="' . $mark3 . '" style="width:100%;"/></td>
							<td><input name="mark-edit" type="number" value="' . $mark4 . '" style="width:100%;"/></td>
							<td><input name="mark-edit" type="number" value="' . $mark5 . '" style="width:100%;"/></td>';
						echo "</tr>";
				echo "</table></div><br />";
			}
			echo '<a class="mdc-button" href="javascript:savemark()" style="float:right"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Save</span></a>';
			echo '<a class="mdc-button" href="javascript:clone()" style="float:right"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Add row</span></a>';
			echo "<br /><br /></div>";
		}
    ?>
</div><br />
</div>

    
   
<!--<footer>
<p>&copy; Alex Sofonea 2021 - Alex Classroom</p>
</footer>-->

</body>
</html>