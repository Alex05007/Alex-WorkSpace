<script>
function setCookie(name, value, daysToLive) {
    var cookie = name + "=" + encodeURIComponent(value);
    if(typeof daysToLive === "number") {
        cookie += "; max-age=" + (daysToLive*24*60*60);
        document.cookie = cookie;
    }
}
setCookie("alexananalyticsbrowser", navigator.product, 1);
setCookie("alexananalyticsrez", window.innerWidth + "X" + window.innerHeight, 1);
</script>

<?php
$info_str = str_replace("{", "", str_replace("}", "", str_replace("(", "", str_replace(")", "", str_replace('"', "", file_get_contents("http://api.wipmania.com/jsonp"))))));
$info = explode(",", $info_str);
$loc = str_replace("country:", "", $info[6]);


$hostname = 'localhost:3307';
include "../db.php";
try {
	$conn = new PDO("mysql:host=$hostname;dbname=alexanalytics", $username, $password);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
$sql = "INSERT INTO `analytics`(`id`, `timp`, `browser`, `rezolutie`, `location`) VALUES ('" . $_GET['id'] . "', '" . date("Y:m:d") . "', '" . $_COOKIE['browser'] . "', '" . $_COOKIE['rez'] . "', '" . $loc . "')";
$stmt = $conn->query($sql);

setcookie("alexananalyticsbrowser", "", -1);
setcookie("alexananalyticsrez", "", -1);
?>