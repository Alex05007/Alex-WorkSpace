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
  <link href="style.css" rel="stylesheet" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
	if ($_GET['fa'] == "delete") {
		$sql = "DELETE FROM raspunsuri WHERE test='" . $_GET['id'] . "' and nume='" . $_GET['nume'] . "' and id='" . $_GET['sId'] . "'";
		$stmt = $conn->query($sql);
	}
		
?>

<style>
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
h1 {
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
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
#formular p {
	float:right;
}
footer {
	width:100%;
	text-align:center;
}
</style>

<script>
$(window)
  .on("load resize ", function () {
    var scrollWidth =
      $(".tbl-content").width() - $(".tbl-content table").width();
    $(".tbl-header").css({ "padding-right": scrollWidth });
  })
  .resize();
</script>

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
</script>

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
			$raspuns = array();
			$qnr=0;
			
			$sql = "SELECT * FROM raspunsuri WHERE test = '" . $_GET['id'] . "'";
			$stmt = $conn->query($sql);
			while ($row = $stmt->fetch()) {
				$raspunsuri = 0;
				$r = $row['raspunsuri'];
				$rasp = explode(";", $r);
				for ($i=0; $i<count($rasp)-1; $i++) {
					$ra = explode(":", $rasp[$i]);
					$raspuns[] = $ra[1];
				}
				$raspunsuri++;
			}
			
			$sql = "SELECT * FROM forms WHERE Id = '" . $_GET['id'] . "' and TestCreator = '" . $_COOKIE['login'] . "'";
			$stmt = $conn->query($sql);
			if ($row = $stmt->fetch()) {
				//if ($row['charts'] == "true") {
					echo '<div class="wrapper" id="wr-chart">';
					$a = "SELECT * FROM question WHERE Testid = '" . $_GET['id'] . "'";
					$ab = $conn->query($a);
					while ($abc = $ab->fetch()) {
						if ($abc['Tip'] != "completare" and $abc['Tip'] != "info" and $abc['Tip'] != "img_r" and $abc['Tip'] != "img_c") {
							$intrebari = explode(";", $abc['Raspuns']);
							$raspu = array_count_values($raspuns);
							
							/*cho $raspuns[1];
							echo $raspu['positioned behind the camera,'];*/
							
							
							echo "<script>
								  google.charts.load('current', {'packages':['corechart']});
								  google.charts.setOnLoadCallback(drawChart);
								  function drawChart() {
									var data = new google.visualization.DataTable();
									data.addColumn('string', 'Topping');
									data.addColumn('number', 'Slices');
									data.addRows([";
							for ($i=0; $i<count($intrebari)-1; $i++) {
								if ($raspu[$intrebari[$i]] != 0) {
									echo "['" . $intrebari[$i] . "', " . $raspu[$intrebari[$i]] . "],";
								} else {
									if ($raspu[$intrebari[$i] . ","] != 0) {
										echo "['" . $intrebari[$i] . "', " . $raspu[$intrebari[$i] . ","] . "],";
									} else {
										echo "['" . $intrebari[$i] . "', 0],";
									}
								}
							}
							echo "]);
								var options = {'width':document.getElementById('wr-chart').offsetWidth,'height':300};
								var chart = new google.visualization.PieChart(document.getElementById('chart_div" . $qnr . "'));
								chart.draw(data, options);
							  }
							</script>";
							echo $abc['Intrebare'];
							echo "<div id='chart_div" . $qnr . "'></div>";
							$qnr++;
						}
					}
				echo "</div><br />";
				}
				echo "<div class='wrapper'>";
				$alg = $row['algoritm'];
				$sql = "SELECT * FROM raspunsuri WHERE test = '" . $_GET['id'] . "'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch()) {
						echo "<div id='formular'>";
							echo '<a href="http://gnets.myds.me/work/forms/answers.php?id=' . $row['test'] . '&sId=' . $row['id'] . '" class="mdc-button">
							   <span class="mdc-button__ripple"></span>
							   <span class="mdc-button__label" style="font-size:16px;">' . $row['nume'] . '</span>
							</a>';
							echo "<a href='admin.php?fa=delete&nume=" . $row['nume'] . "&id=" . $_GET['id'] . "&sId=" . $row['id'] . "' class='delete'><i class='far fa-trash-alt'></i></a>";
							echo "<p style='margin-right:100px;'><strong>Comment: </strong>" . $row['comentariu'] . "</p>";
							if ($alg == "true") {
								if (intval($row['parasiri']) == 0) {
									echo "<p>No cheeting atemts attempts.</p>";
								}
								else {
									$parasiri = intval($row['parasiri']);
									echo "<p>Cheeting atemts: " . $parasiri . "</p>";
								}
							}
						echo "</div><br />";
						$raspunsuri++;
				}
				
			//}
?>
</div>

<br />

<br />

<div class="wrapper">
<?php
	if ($raspunsuri != 0) {
		$raspunsuri = intval($raspunsuri) - 1;
	}
	echo "<h4>Answers: <font style='color:#09F'>" . $raspunsuri . "</font></h4>";
?>
</div>

<footer><br />
<p>&copy; Alex Sofonea 2021 - Alex Forms</p>
</footer>

</body>
</html>