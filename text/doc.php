<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Alex Text</title>
  <link rel="icon" href="../logo/text.png" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/1ddfdd0161.js" crossorigin="anonymous"></script>
  
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<?php
  if(isset($_GET['id'])) {
		$hostname = 'localhost:3307';
		include "../db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alextext", $username, $password);
			}
		catch(PDOException $e)
			{
			echo $e->getMessage();
			}
		$sql = "SELECT * FROM documente WHERE Id='" . $_GET['id'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
      if ($_COOKIE['login'] != $row['Creator']) {
        $share = explode("|", $row['Share']);
        if ($share[0] == "link") {
          if ($share[1] == "edit") {
            $edit = true;
          } else {
            $edit = false;
          }
        } else {
          header("Location: error");
          die();
        }
      } else {
        $edit = true;
      }
		} else {
      header("Location: error");
      die();
    }
		$conn=null;

    setcookie("edit_text", "true", time() + 84000);
  } else {
    setcookie("edit_text", "false", time());
  }
?>
<?php if ($edit==true) { ?>
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
  function saving() {
    document.getElementById('saved').style.display = "none";
    document.getElementById('notsaved').style.display = "block";
    document.getElementById('notsaved').style.display = "inline-block";
  }
  function save() {
    document.getElementById('saved').style.display = "block";
    document.getElementById('saved').style.display = "inline-block";
    document.getElementById('notsaved').style.display = "none";

    var doc = document.getElementById('document').innerHTML;
    var titlu = document.getElementById('titlu').value;
    var share = document.getElementById('share_link_options').value + "|" + document.getElementById('share_link_privileges').value;
    if (doc.length > 0 && titlu.length > 0) {
      if (getCookie("edit_text") == "true") {
        $.ajax
          ({
          type: "POST",
          url: "save.php",
          data: { "titlu": titlu, "fa": "update", "document": doc, "thisId":getUrlVars()["id"], "share":share }
          });
      }
      else {
        $.ajax
          ({
          type: "POST",
          url: "save.php",
          data: { "titlu": titlu, "fa": "save", "document": doc, "share":share }
          });
          setCookie("edit_text", "true", 1);
        }
    }
  }
  </script>
<?php } ?>

<style>
body {
  background: #fff;
  font-family: "Noto Sans", sans-serif;
  color: #444;
  font-size: 14px;
}

footer {
  text-align: center;
  margin: 4em auto;
  width: 100%;
}
footer a {
  text-decoration: none;
  display: inline-block;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: transparent;
  border: 1px dashed #333;
  color: #333;
  margin: 5px;
}
footer a:hover {
  background: rgba(255, 255, 255, 0.1);
}
footer a .icons {
  margin-top: 12px;
  display: inline-block;
  font-size: 20px;
}
#document {
	width:750px;
	height:1333px;
	border:#CCC solid 1px;
	border-radius:5px;
	background-color:#FFF;
	padding:20px;
  margin-top: 200px;
}
#titlu {
	padding:10px;
	width:200px;
	height:30px;
	border:#CCC solid 1px;
	border-radius:5px;
	background-color:#FFF;
}
#document:focus{
    outline:0px;
}
#titlu:focus{
    outline:0px;
}
.center {
    display: flex;
    justify-content: center;
    align-items: center;
}
.add:hover {
	cursor:copy;
}
img {
	display:inline-block;
}

.mdc-button {
	--mdc-theme-primary:#1a73e8;
	--mdc-theme-secondary:#333;
	--mdc-theme-background:#1a73e8;
	--mdc-theme-surface:#1a73e8;
	text-transform: none;
	text-decoration:none !important;
	font-size:14px;
}
.mdc-button__ripple {
	animation-duration:1s;
}
.mdc-form-field {
	--mdc-theme-primary:#1a73e8;
	--mdc-theme-secondary:#1a73e8;
	--mdc-theme-background:#1a73e8;
	--mdc-theme-surface:#1a73e8;
}
</style>

<script>
	function chooseColor(){
      var mycolor = document.getElementById("myColor").value;
      document.execCommand('foreColor', false, mycolor);
      saving();
    }

    function changeFont(){
      var myFont = document.getElementById("input-font").value;
      document.execCommand('fontName', false, myFont);
      saving();
    }

    function changeSize(){
      var mysize = document.getElementById("fontSize").value;
      document.execCommand('fontSize', false, mysize);
      saving();
    }
	function add() {
		document.getElementById('document').style.height = document.getElementById('document').offsetHeight + 1000 + "px";
	}
</script>

<script>
import interact from 
'https://cdn.interactjs.io/v1.10.11/interactjs/index.js'
interact('img')
  .resizable({
    // resize from all edges and corners
    edges: { left: true, right: true, bottom: true, top: true },

    listeners: {
      move (event) {
        var target = event.target
        var x = (parseFloat(target.getAttribute('data-x')) || 0)
        var y = (parseFloat(target.getAttribute('data-y')) || 0)

        // update the element's style
        target.style.width = event.rect.width + 'px'
        target.style.height = event.rect.height + 'px'

        // translate when resizing from top or left edges
        x += event.deltaRect.left
        y += event.deltaRect.top

        target.style.transform = 'translate(' + x + 'px,' + y + 'px)'

        target.setAttribute('data-x', x)
        target.setAttribute('data-y', y)
        target.textContent = Math.round(event.rect.width) + '\u00D7' + Math.round(event.rect.height)
      }
    },
    modifiers: [
      // keep the edges inside the parent
      interact.modifiers.restrictEdges({
        outer: 'parent'
      }),

      // minimum size
      interact.modifiers.restrictSize({
        min: { width: 100, height: 50 }
      })
    ],

    inertia: true
  })
  .draggable({
    listeners: { move: window.dragMoveListener },
    inertia: true,
    modifiers: [
      interact.modifiers.restrictRect({
        restriction: 'parent',
        endOnly: true
      })
    ]
  })
</script>

<body>
	<?php
    if (isset($_COOKIE['login'])) {
		  include "../nav.php";
      echo "<style>.bar { padding-top: 100px;  } </style>";
    } else {
      echo "<style>.bar { padding-top: 0px; } </style>";
    }
		$hostname = 'localhost:3307';
		include "../db.php";
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alextext", $username, $password);
			}
		catch(PDOException $e)
			{
			echo $e->getMessage();
			}
		$sql = "SELECT * FROM documente WHERE Id='" . $_GET['id'] . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {}
		$conn=null;
	?>


<style>

.bar {
  height: fit-content;
  width: 100%;
  position: fixed;
  left: 0px;
  top: 0px;
  padding-left: 50px;
  padding-right: 50px;
  padding-top: 10px;
}
.col1 {
  float: left;
  width: 50%;
  vertical-align: center;
}
.col2 {
  float: right;
  width: 50%;
  text-align: right;
}
.top_title {
  border: none;
  border-radius: 10px;
  padding: 10px;
  font-size: 16px;
}
.top_title:hover {
  border: #CCC 1px solid;
}
.top_title:focus {
  border: #1a73e8 1px solid;
}
.edit_button {
  color: #666;
  padding: 5px;
  border-radius: 5px;
  background-color: transparent;
  border: none;
}
.edit_button:hover {
  background-color:rgba(0, 0, 0, 0.1);
  color: #666;
}
select, input[type="number"] {
  padding: 10px;
  border: #ccc 1px solid;
  border-radius: 10px;
}
input[type="number"] {
  width: 70px;
}
img {
  max-width: 100%;
}

@supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
  .bar {
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.5);  
  }
}

h4 {
  color: #666;
  font-size: 12px;
  display: inline-block;
}
</style>

<div class="bar">
    <div class="col1">
      <img src="../logo/text.png" width="50px" />
      <input class="top_title" id="titlu" value="<?php if ($_GET['id'] != "") { echo $row['Titlu']; } else {echo "My document"; } ?>" />
    </div>
    <div class="col2">
      <?php if ($edit==true) { ?><a class="mdc-button" href="javascript:save()"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Save</span></a><?php } ?>  
      <?php if ($row['Creator'] == $_COOKIE['login']) { ?><a class="mdc-button"  data-toggle="modal" data-target="#share"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Share <i class="fas fa-lock"></i></span></a><?php } ?>  
    </div>

    <br /><br />

    <hr />

    <button class="edit_button" onclick="document.execCommand( 'undo',false,null);"><i class="fas fa-undo"></i></button>
    <button class="edit_button" onclick="document.execCommand( 'redo',false,null);"><i class="fas fa-redo"></i></button>

    <font style="color: #CCC; font-size: 20px;"> | </font>

<select id="input-font" onchange="changeFont()">
    <?php
      $fonturi = array("Arial", "Helvetica", "Times New Roman", "Sans serif", "Verdana", "Georgia", "Palatino", "Garamond", "Comic Sans MS", "Arial Black", "Tahoma", "Courier New");
      for ($i=0; $i<count($fonturi); $i++) {
        echo '<option value="' . $fonturi[$i] . '" style="font:' . $fonturi[$i] . '">' . $fonturi[$i] . '</option>';
      }
    ?>
    <option value="Arial">Arial</option>
    <option value="Helvetica">Helvetica</option>
    <option value="Times New Roman">Times New Roman</option>
    <option value="Sans serif">Sans serif</option>
    <option value="Verdana">Verdana</option>
    <option value="Georgia">Georgia</option>
    <option value="Palatino">Palatino</option>
    <option value="Garamond">Garamond</option>
    <option value="Comic Sans MS">Comic Sans MS</option>
    <option value="Arial Black">Arial Black</option>
    <option value="Tahoma">Tahoma</option>
    <option value="Courier New">Courier New</option>
</select>

<select id="fontSize" onchange="changeSize()">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
</select>

    <font style="color: #CCC; font-size: 20px;"> | </font>

    <button class="edit_button" onclick="document.execCommand( 'bold',false,null);"><i class="fas fa-bold"></i></button>
    <button class="edit_button" onclick="document.execCommand('italic',false,null);"><i class="fas fa-italic"></i></button>
    <button class="edit_button" onclick="document.execCommand( 'underline',false,null);"><i class="fas fa-underline"></i></button>
    <button class="edit_button" onclick="document.execCommand( 'strikethrough',false,null);"><i class="fas fa-strikethrough"></i></button>
    <button class="edit_button"><i class="fas fa-superscript"></i></button>
    <button class="edit_button"><i class="fas fa-subscript"></i></button>
    
    <font style="color: #CCC; font-size: 20px;"> | </font>

    <button class="edit_button" onclick="document.execCommand( 'justifyLeft',false,null);"><i class="fas fa-align-left"></i></button>
    <button class="edit_button" onclick="document.execCommand( 'justifyCenter',false,null);"><i class="fas fa-align-center"></i></button>
    <button class="edit_button" onclick="document.execCommand( 'justifyRight',false,null);"><i class="fas fa-align-right"></i></button>
    <!--<button class="edit_button" onclick="document.execCommand( 'justify',false,null);"><i class="fas fa-align-justify"></i></button>-->
    
    <font style="color: #CCC; font-size: 20px;"> | </font>

    <button class="edit_button" onclick="document.execCommand('insertUnorderedList',false, null)"><i class="fas fa-list-ul"></i></button>
    
    <font style="color: #CCC; font-size: 20px;"> | </font>

    <button class="edit_button"><i class="fas fa-print"></i></button>

    <font style="color: #CCC; font-size: 20px;"> | </font>

    <h4 id="saved"><i class="fas fa-cloud"></i> All changes saved in Alex Cloud</h4>
    <h4 id="notsaved" style="display: none;"><i class="fas fa-cloud-upload-alt"></i> Changes aren't saved in Alex Cloud</h4>
</div>

<br />
	<?php
		if (isset($_GET['id'])) {
			if ($edit == true) {
			  echo "<div class='center'><div id='document' contenteditable='true' onkeyup='saving()'>" . $row['Content'] . "</div></div>";
			}
			else {
			  echo "<div class='center'><div id='document' contenteditable='false' onkeyup='saving()'>" . $row['Content'] . "</div></div>";
			  echo "<script>setTimeout(function(){document.getElementById('save').style.display='none';}, 1);</script>";
			}
		}
		else {
			  echo "<div class='center'><div id='document' contenteditable='true'></div></div>";
		}
		$conn=null;
	?>

<?php if ($row['Creator'] == $_COOKIE['login']) { ?>
  <div id="share" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Share</h4>
        </div>
        <div class="modal-body">
            <?php echo $share[0]; ?>
            <select id="share_link_options">
              <option value="private" <?php if($share[0] == "private") { echo "selected"; } ?>>Private</option>
              <option value="link" <?php if($share[0] == "link") { echo "selected"; } ?>>Anyone with the link</option>
            </select>
            <select id="share_link_privileges">
              <option value="view" <?php if($share[1] == "view") { echo "selected"; } ?>>Viewing</option>
              <option value="edit" <?php if($share[1] == "edi") { echo "selected"; } ?>>Editing</option>
            </select>
        </div>
      </div>

    </div>
  </div>
<?php } ?>

<footer>
<p>&copy; Alex Sofonea 2021 - Alex Text</p>
</footer>
</body>
</html>
