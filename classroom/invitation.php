<!DOCTYPE html>
<html>
<head>
<title>Alex Classroom Invitation</title>
<link rel="icon" href="../logo/class.png">
</head>
<?php
	$myId = $_COOKIE['login'];
	if (isset($_COOKIE['login']) and isset($_GET['classid'])) {
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
			if (strpos($row['Students'], $_COOKIE['login']) !== false) {
				header("Location: chat.php?classid=" . $_GET['classid']);
				die();
			}
			$st = $row['Students'] . $_COOKIE['login'] . "," . $_COOKIE['un'] . ";";
		}
		$sql = "UPDATE `class` SET `Students`='" . $st . "' WHERE Id='" . $_GET['classid'] . "'";
		$stmt = $conn->query($sql);
		$sql = "INSERT INTO marks (classid, studentid, mark1, mark2, mark3, mark4, mark5) VALUES ('" . $_GET['classid'] . "', '" . openssl_encrypt($_COOKIE['un'],"AES-128-ECB",$_GET['classid']) . "', '', '', '', '', '')";
		$stmt = $conn->query($sql);
		$sql = "INSERT INTO grades (classid, student, marks) VALUES ('" . $_GET['classid'] . "', '" . openssl_encrypt($_COOKIE['un'],"AES-128-ECB",$_GET['classid']) . "', '')";
		$stmt = $conn->query($sql);
		header("Location: chat.php?classid=" . $_GET['classid']);
		die();
	}
	else {
		header("Location: ../log.php?s=http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die();
	}
?>

<body>
</body>
</html>