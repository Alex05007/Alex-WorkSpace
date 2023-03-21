<!DOCTYPE html><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../logo/class.png" />
  <title>Alex Classroom</title>
  <link rel="stylesheet" href="style.css" />
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
function clone() {
	var elem = document.querySelector("#clonetr");
	var clone = elem.cloneNode(true);
	elem.after(clone);
}
function savemark() {
	document.getElementById('em').style.bottom = "-" + document.getElementById('em').style.height;
	var grade = "";
	var grades = document.getElementsByName('mark-edit');
	for (var i=0; i<grades.length; i=i+6) {
		if (grades[i].value != "") {
			grade = grade + grades[i].value + "," + grades[i+1].value + "," + grades[i+2].value + "," + grades[i+3].value + "," + grades[i+4].value + "," + grades[i+5].value + ";";
		}
	}
	var classid = getUrlVars()["classid"];
	var edit = getUrlVars()["edit"].replace("#edit", "");
	$.ajax
	  ({
		type: "POST",
		url: "saveMarks.php",
		data: { "classid": classid, "grades": grade, "edit": edit }
	  });
}
function editMarks(student) {
	$("#em").load("https://gnets.myds.me/work/classroom/edit_marks.php?classid=" + getUrlVars()["classid"] + "&edit=" + student);
	document.getElementById('em').style.transition = "none";
	document.getElementById('em').style.bottom = "-" + document.getElementById('em').style.height;
	document.getElementById('em').style.transition = "all 0.5s";
	document.getElementById('em').style.bottom = "10px";
}
</script>


<style>
#em {
	position:fixed;
	bottom:-100px;
	transition:all 0.5s ease-in-out;
	margin: 0;
	left: 50%;
	-ms-transform: translatex(-50%);
	transform: translatex(-50%);
	overflow:auto;
	width:inherit;
}
@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
  #em {
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.5);  
  }
}
</style>

<body>
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
    
    
    
    
    
    <div class="comment" id="marks">
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
							echo '<a href="javascript:editMarks(\'' . $student . '\')" class="edit"><i class="fa fa-pen"></i></a>'; 
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
		/*if ($profesor == $_COOKIE['login'] and isset($_GET['edit'])) {
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
		}*/
    ?>
<br />
</div>
    <?php if ($profesor == $_COOKIE['login']) { ?>
    	<div class="comment" id="em"></div>
    <?php } ?>

    
   
<!--<footer>
<p>&copy; Alex Sofonea 2021 - Alex Classroom</p>
</footer>-->

</div></body>
</html>