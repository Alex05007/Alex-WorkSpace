<?php
	echo "<script>setTimeout(function(){alert('ok');}, 1);</script>";
    $hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$sql = "UPDATE grades SET marks='" . $_POST['grades'] . "' WHERE classid='" . $_POST['classid'] . "' and student='" . openssl_encrypt($_POST['edit'],"AES-128-ECB", $_POST['classid']) . "'";
	$stmt = $conn->query($sql);
?>