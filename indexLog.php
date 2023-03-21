<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Alex Workspace</title>
  <link rel="icon" href="logo.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  <link href="os/letter.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
</head>

<?php
if (!isset($_COOKIE['login'])) {
	header("Location: http://gnets.myds.me/work");
	die();
}
/***$hostname = 'localhost:3307';
$username = 'root';
$password = 'gNetDB1qaz?1qaz';
try {
    $conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
$sql = "SELECT * FROM conturi WHERE Id = '" . $_GET['id'] . "'";
$stmt = $conn->query($sql);

if ($_GET['fa'] == "assign") {
	$sql = "INSERT INTO note (Creator, Content, Stare) VALUES ('" . $_COOKIE['login'] . "', '" . $_GET['content'] . "', '" . $_GET['stare'] . "')";
	$stmt = $conn->query($sql);
	header("Location: http://gnets.myds.me/work/task/index.php");
	die();
}***/
?>

<style>
.app {
	box-shadow:1px 1px 5px rgba(0,0,0,0.1), -1px -1px 5px rgba(0,0,0,0.1);
	text-align:center;
	width:150px !important;
	height:200px;
	margin-left:50px;
	margin-bottom:50px;
	background-color:#FFF;
	padding:20px;
	transition:all 0.3s;
	cursor:pointer;
}
.file {
	border:#CCC 1px solid;
	width:250px !important;
	height:50px;
	margin-left:50px;
	margin-bottom:50px;
	background-color:#FFF;
	padding:2px;
	transition:all 0.3s;
	cursor:pointer;
	border-radius:5px !important;
}
.file img {
	float:left;
	margin-top:-5px;
	width:25%;
}
.file i {
	float:left;
	margin-top:10px;
	font-size:20px;
	width:25%;
	color:#CCC;
}
.file h4 {
	margin-top:14px;
	float:right;
	width:75%;
	height:20px;
	overflow:auto !important;
}
.col-sm-4 (not: .file):hover {
	box-shadow:2px 2px 20px rgba(0,0,0,0.1), -2px -2px 20px rgba(0,0,0,0.1);
	transform:scale(1.1,1.1);
}
/*.col-sm-4:hover img {
  animation: ring 3s ease-in-out infinite;
  transform-origin: 50% 4px;
}*/
@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
  .col-sm-4 {
    -webkit-backdrop-filter: blur(100px);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.5);  
  }
}
.col-sm-4 h4 {
	color:#999;
	transition:all 0.2s;
}
.col-sm-4 (not: .file):hover h4 {
	color:#000;
}
.col-sm-4 img {
	padding:10px;
	border-radius:16px;
	margin-bottom:-50px;
}
.container-fluid {
	padding:100px;
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
@keyframes ring {
  0% { transform: rotate(0); }
  2% { transform: rotate(20deg); }
  4% { transform: rotate(-18deg); }
  6% { transform: rotate(24deg); }
  8% { transform: rotate(-22deg); }
  10% { transform: rotate(20deg); }
  12% { transform: rotate(-18deg); }
  15% { transform: rotate(16deg); }
  17% { transform: rotate(-14deg); }
  21% { transform: rotate(12deg); }
  24% { transform: rotate(-10deg); }
  27% { transform: rotate(8deg); }
  30% { transform: rotate(-6deg); }
  33% { transform: rotate(4deg); }
  36% { transform: rotate(-2deg); }

  43% { transform: rotate(0); }
  100% { transform: rotate(0); }
}
@media only screen and (max-width: 900px) {
	.logo_lateral1 {
		display:none;
	}
	.logo_lateral2 {
		display:none;
	}
	body {
		padding: 10px;
	}
}
@media only screen and (min-width: 901px) {
	.logo_lateral1 {
		position:fixed;
		top:100px;
		left:-100px;
		transform:rotate(150deg) scale(6,6);
		width:10%;
		z-index:-1;
	}
	.logo_lateral2 {
		position:fixed;
		right:0px;
		bottom:100px;
		transform:rotate(-135deg) scale(5,5);
		width:10%;
		z-index:-1;
	}	
	body {
		overflow-x:hidden;
	}
}
.center {
  margin: 0;
  position: absolute;
  left: 50%;
  -ms-transform: translateX(-50%);
  transform: translateX(-50%);
}
.tr {
	background-color:transparent !important;
	border-radius:0px !important;
	color:#118ab2;
}
.button-ripple {
	border-radius:20px !important;
}
h4 {
	color:#666;
}
iframe {
	border:none;
}

h4 ::-webkit-scrollbar {
  width: 5px;
}s
</style>



<script>
$(window).scroll(function(){
	$('navBarNou').toggleClass('scrolled', $(this).scrollTop() > 50);
});
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
function loadBg() {
	var bg = getCookie("bg");
	document.body.style.backgroundImage = "url('bg/bg" + bg + ".jpeg')";
}
function loadStart() {
	loadBg()
	var nume = getCookie("un");
	var num = nume.replace("+", " ");
	document.getElementById('usern').innerHTML = num;
}
</script>

<body onload="loadStart()">
<?php
	include "navIndex.php";
?>

<div class="container-fluid center">
    <div class="row">
        <div class="col-sm-4 app button-ripple" onMouseDown="setTimeout(function() {location.assign('chat')}, 500);" data-ripple-color="#CCC">
              <img src="logo/chat.png" width="100px"/>
              <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Chat</h4></div> 
        </div>
        <div class="col-sm-4 app button-ripple" onMouseDown="setTimeout(function() {location.assign('classroom')}, 500);" data-ripple-color="#CCC">
              <img src="logo/class.png" width="90px"/>
              <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Classroom</h4></div> 
        </div>
        <div class="col-sm-4 app button-ripple" onMouseDown="setTimeout(function() {location.assign('video')}, 500);" data-ripple-color="#CCC">
              <img src="logo/video.png" width="100px"/>
              <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Video</h4></div> 
        </div>
        <div class="col-sm-4 app button-ripple" onMouseDown="setTimeout(function() {location.assign('forms')}, 500);" data-ripple-color="#CCC">
              <img src="logo/forms.png" width="100px"/>
              <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Forms</h4></div> 
        </div>
        <div class="col-sm-4 app button-ripple" onMouseDown="setTimeout(function() {location.assign('text')}, 500);" data-ripple-color="#CCC">
              <img src="logo/text.png" width="100px"/>
              <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Text</h4></div> 
        </div>
        <div class="col-sm-4 app button-ripple" onMouseDown="setTimeout(function() {location.assign('slides')}, 500);" data-ripple-color="#CCC">
              <img src="logo/slides.png" width="100px"/>
              <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Slides</h4></div> 
        </div>
        <!--<a href="tab/">
            <div class="col-sm-4 slide">
                  <img src="logo/Tab.png" width="70px"/>
                  <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Tab</h4></div> 
            </div>
        </a>
        <a href="whiteboard/">
            <div class="col-sm-4 slide">
                  <img src="logo/whiteboard.png" width="70px"/>
                  <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> Whiteboard</h4></div> 
            </div>
        </a>
        <a href="os/">
            <div class="col-sm-4 slide">
                  <img src="logo/os.png" width="60px"/>
                  <div class="bounce2"><span class="letter2">A</span><span class="letter2">l</span><span class="letter2">e</span><span class="letter2">x</span><h4> OS</h4></div> 
            </div>
        </a>-->
	</div>
    <hr />
    <h4>Files</h4>
	<?php
        $sunt_files = false;
        $a=0;
        $hostname = 'localhost:3307';
        include "db.php";
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=alexforms", $username, $password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        $sql = "SELECT * FROM forms WHERE TestCreator='" . $_COOKIE['login'] . "'";
        $stmt = $conn->query($sql);
        while ($row = $stmt->fetch()) {
            $sunt_files = true;
            $a++;
            echo '<div class="col-sm-4 file button-ripple" onmousedown="setTimeout(function() {location.assign(\'forms/edit.php?id=' . $row['Id'] . '\')}, 500);" data-ripple-color="#CCC">
			          <img src="logo/forms.png" width="25%">
					  <h4>' . $row['Titlu'] . '</h4> 
				  </div>';
        }
        
        $hostname = 'localhost:3307';
        include "db.php";
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=alextext", $username, $password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        $sql = "SELECT * FROM documente WHERE Creator='" . $_COOKIE['login'] . "'";
        $stmt = $conn->query($sql);
        while ($row = $stmt->fetch()) {
            $sunt_files = true;
            $a++;
            echo '<div class="col-sm-4 file button-ripple" onmousedown="setTimeout(function() {location.assign(\'index.php?text=' . $row['Id'] . '\')}, 500);" data-ripple-color="#CCC">
			          <img src="logo/text.png" width="25%">
					  <h4>' . $row['Titlu'] . '</h4> 
				  </div>';
        }
        
        $hostname = 'localhost:3307';
        include "db.php";
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=alexslides", $username, $password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        $sql = "SELECT * FROM prezentari WHERE Creator='" . $_COOKIE['login'] . "'";
        $stmt = $conn->query($sql);
        while ($row = $stmt->fetch()) {
            $sunt_files = true;
            $a++;
            echo '<div class="col-sm-4 file button-ripple" onmousedown="setTimeout(function() {location.assign(\'index.php?slides=' . $row['Id'] . '\')}, 500);" data-ripple-color="#CCC">
			          <img src="logo/slides.png" width="25%">
					  <h4>' . $row['Titlu'] . '</h4> 
				  </div>';
        }
        $hostname = 'localhost:3307';
        include "db.php";
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=alexcloud", $username, $password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        $sql = "SELECT * FROM cloud WHERE creator='" . $_COOKIE['login'] . "'";
        $stmt = $conn->query($sql);
		$size = 0;
        while ($row = $stmt->fetch()) {
            $sunt_files = true;
            $a++;
            echo '<div class="col-sm-4 file button-ripple" onmousedown="setTimeout(function() {window.open(\'https://gnets.myds.me/cloud/' . $row['name'] . '/' . $row['org'] . '\', \'_blank\');}, 500);" data-ripple-color="#CCC">
    	  			  <i class="fas fa-file"></i>
					  <h4>' . $row['org'] . '</h4> 
				  </div>';
		    $size = $size + intval($row['size']);
        }
		
    ?>
      <?php if (round($size/1000000, 2) < 2000) {
			  echo ' <div class="col-sm-4 file button-ripple" id="upload" onMouseDown="setTimeout(function() { document.getElementById(\'upload_file\').click();}, 500);" data-ripple-color="#CCC">
						  <i class="fas fa-upload"></i>
						  <h4>Upload</h4>
					  </div>
					  <form action="cloud/upload.php" method="post" id="upload_form" enctype="multipart/form-data">
						  <input type="file" id="upload_file" name="upload_file" style="display:none;" onChange="document.getElementById(\'upload_form\').submit();"/>
					  </form>';
		  } else {
			  echo '<div class="col-sm-4 file button-ripple" id="upload" data-ripple-color="#CCC">
			  <i class="fas fa-upload"></i>
			  <h4>You reached the limit</h4></div>';
		 }
	  ?>
	<progress id="file" value="<?php echo round($size/1000000, 2); ?>" max="2000"></progress><!-- 2gb = 2000000 -->
</div>
    
    <img src="logo/VideoM.png" class="logo_lateral2" />
    <img src="logo/ChatM.png" class="logo_lateral1" />
</body>

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
</script>

</html>