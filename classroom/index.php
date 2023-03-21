<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alex Classroom</title>
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link rel="icon" href="../logo/class.png" />
  
  <!--<script src="http://gnets.myds.me/work/button.js"></script>
  <link rel="stylesheet" href="http://gnets.myds.me/work/button.css" />-->
</head>

<?php
	$background = 8;
	$myId = $_COOKIE['login'];
	if (!isset($_COOKIE['login'])) {
		header("Location: http://gnets.myds.me/work");
		die();
	}
	if ($_GET['fa'] == "new") {
		$hostname = 'localhost:3307';
		include "../db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		$studentsid = str_replace("undefined", "", $_GET['students']);
		$students = str_replace("undefined", "", $_GET['students']);
		$st = explode(";", $students);
		$sql = "INSERT INTO class (Id, Titlu, Materie, Professor, Students, background) VALUES ('" . $_GET['id'] . "', '" . $_GET['title'] . "', '" . $_GET['subject'] . "', '" . $_GET['prof'] . "', '" . $_GET['students'] . "', '" . $_GET['bg'] . "')";
		$stmt = $conn->query($sql);
		/*for ($i=0; $i<count($st)-1; $i++) {
			$stu = explode(",", $st[$i]);
			$sql = "INSERT INTO marks (classid, studentid, mark1, mark2, mark3, mark4, mark5) VALUES ('" . $_GET['id'] . "', '" . openssl_encrypt($stu[1],"AES-128-ECB",$_GET['id']) . "', '', '', '', '', '')";
			$stmt = $conn->query($sql);
		}*/
		header("Location: chat.php?classid=" . $_GET['id']);
		die();
	}
?>

<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
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
  color: #09F;
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
  background: #09F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}

.class {
	padding:100px 100px;
}
.newclass {
	background-color:#FFF;
	width:100%;
	padding:10px;
	border-radius:16px;
	padding:20px;
	border:#CCC 1px solid;
}
.title h1 {
	color:#FFF;
}
.title h4 {
	color:#CCC;
}
.title .links {
	margin-top:30px;
	text-align:center;
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
	padding:20px;
	background-color:#09F;
	border-radius:25px;
	transition:all 0.3s;
	color:#FFF;
	font-size:15px;
}
.create i {
	padding-right:10px;
	font-size:20px;
}
.create:hover {
	background-color:#09F;
	color:#FFF;
	box-shadow:1px 1px 30px #09F;
}
.col1 {
	float:left;
	width:40%;
}
.col2 {
	float:right;
	width:60%;
}
.comment {
	background-color:#FFF;
	width:540px;
	border-radius:16px;
	padding:10px 20px;
	border:1px solid #CCC;
}
.comment a {
	float:right;
	color:#FFF;
	font-size:13px;
	padding-top:10px;
	padding-bottom:10px;
	padding-left:30px;
	padding-right:30px;
	border-radius:5px;
	background-color:#09F;
	margin-bottom:5px;
	text-decoration:none !important;
}
.comment a:hover{
	color:#CCC;
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
.students {
	width:200px;
	height:300px;
	overflow:auto;
	border:solid 1px #CCC;
	border-radius:20px;
	padding:10px;
}
.check {
	margin:20px;
}

@media only screen and (min-width: 761px) {
	.newclass img {
		width:350px;
	}
	.title {
		background-size: cover;
		width:300px;
		height:250px;
		border-radius:16px;
		padding:20px;
		background-position:right bottom;
		margin-left: 10px;
	}

	.class {
		padding:100px 100px;
	}
}
/*mobile*/
@media only screen and (max-width: 761px) {
	.newclass img {
		width:200px;
	}
	.title {
		background-size: cover;
		width:90%;
		height:250px;
		border-radius:16px;
		padding:20px;
		background-position:right bottom;
		margin: 10px;
	}
	.class {
		padding:10px 10px;
	}
}
.title {
		display:inline-block;
}
.links .mdc-button {
	font-size:16px !important;
	--mdc-theme-primary:#FFF !important;
	--mdc-theme-secondary:#333;
	--mdc-theme-background:#FFF !important;
	--mdc-theme-surface:#FFF !important;
	text-transform: none;
}
.links .mdc-form-field {
	--mdc-theme-primary:#FFF;
	--mdc-theme-secondary:#FFF;
	--mdc-theme-background:#FFF;
	--mdc-theme-surface:#FFF;
}
.title .links a {
	padding:0px;
	background-color:transparent;
	border-radius:20px;
	transition:all 0.5s;
	text-decoration:none;
	color:#FFF;
	margin-right:10px;
	font-size:16px;
}
.title .links a:hover {
	padding:10px;
	background-color: rgba(50,50,50,0.2);
	border-radius:20px;
	text-decoration:none;
	color:#FFF;
	margin-right:0px;
	margin-left:-10px;
}
.title .links a:active {
	padding:10px;
	background-color: rgba(50,50,50,0.4);
	border-radius:20px;
	text-decoration:none;
	color:#FFF;
	margin-right:0px;
	margin-left:-10px;
}
.class_link {
	display:inline-block;
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
  function newclass() {
	  var title = document.getElementById('title').value;
	  var subject = document.getElementById('subject').value;
	  //var st = document.getElementsByName("students");
	  var id = getCookie("login");
	  var students = "";
	  var stnames = "";
	  /*for(var i = 0; i<st.length; i++) {
		  if(st[i].checked == true) {
			  students = students + st[i].value + ";";
		  }
	  }*/
	  var bg = document.getElementsByName('bg');
	  for(var y = 0; y<bg.length; y++) {
		  if (bg[y].checked == true) {
			  var background = bg[y].value;
		  }
	  }
	  var classid = String.fromCharCode(65 + Math.floor(Math.random() * 26)) + Date.now();
	  //var classid = title.replace(" ", "").substring(1, 2) + subject.replace(" ", "").substring(1, 4);
	  if (title != "") {
	  	location.assign("?id=" + classid + "&prof=" + id + "&title=" + title + "&subject=" + subject + "&students=" + students + "&stid=" + stnames + "&bg=" + background + "&fa=new");
	  }
  }
function startLoad() {
	getBg();
}
</script>

<body onload="startLoad()">
<?php
	include "../nav.php";
?>
<div class="class">
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
            $sql = "SELECT * FROM class WHERE Students LIKE '%" . $_COOKIE['login'] . "%' or Professor='" . $_COOKIE['login'] . "'";
            $stmt = $conn->query($sql);
            while ($row = $stmt->fetch()) {
				echo "
				<a href='chat.php?classid=" . $row['Id'] . "' style='text-decoration:none;' class='class_link'>
					  <div class='title' style='background-image:url(img/" . $row['background'] . ".jpg)'>
						  <h1>" . $row['Titlu'] . "</h1>
						  <h4>" . $row['Materie'] . "</h4><br /><br /><br />
						  <div class='links'>";
						  echo '<a href="chat.php?classid=' . $row['Id'] . '">Chat</a>';
						  echo '<a href="assigments.php?classid=' . $row['Id'] . '">Assigments</a>';
						  echo '<a href="marks.php?classid=' . $row['Id'] . '">Marks</a>';
						  echo '<a href="../video/?id=' . $row['Id'] . '">Meet</a>';
						  echo "</div>
					  </div>
				</a>";
           }
        ?>
    <br />
    <br />
    
    <div class="newclass">
        <div class="input-data">
        <input type="text" id="title" required maxlength="99" autocomplete="off">
        <div class="underline"></div>
        <label>Class title</label></div><br />
        <div class="input-data">
        <input type="text" id="subject" required maxlength="299" autocomplete="off">
        <div class="underline"></div>
        <label>Class subject</label></div><br />
        <h4>Background</h4>
        <?php
			for ($i = 0+1; $i < $background+1; $i++) {
				echo '<div class="mdc-form-field">
				  <div class="mdc-radio">
					<input class="mdc-radio__native-control" type="radio" name="bg" id="bg' . $i . '" value="' . $i . '">
					<div class="mdc-radio__background">
					  <div class="mdc-radio__outer-circle"></div>
					  <div class="mdc-radio__inner-circle"></div>
					</div>
					<div class="mdc-radio__ripple"></div>
				  </div>
				  <label for="bg' . $i . '"><img style="border-radius:10px;" src="img/' . $i . '.jpg"/></label></label>
				</div>';
			}
		?>
        <br />
        <br />
        <br />
        <a href="javascript:newclass()" class="mdc-button mdc-button--raised">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">New class</span>
        </a>
     </div>
</div>

<footer style="margin: 0; position: absolute; left: 50%; -ms-transform: translateX(-50%); transform: translateX(-50%);">
<p>&copy; Alex Sofonea 2021 - Alex Classroom</p>
</footer>

</body>
</html>