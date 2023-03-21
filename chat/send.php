<?php
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

	$myId = $_COOKIE['login'];
	$sql = "INSERT INTO chat (deLa, catre, mesaj, data, ora, citit) VALUES ('" . $_COOKIE['login'] . "', '" . $_POST['id2'] . "' , '" . openssl_encrypt($_POST['mesaj'],"AES-128-ECB",$myId) . "', '" . date("Y:m:d:H:i:s:u") . "', '" . date("h:i") . "', '" . "false" . "')";
	$stmt = $conn->query($sql);
?>