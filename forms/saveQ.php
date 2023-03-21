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
		
	$sql = "INSERT INTO question (Id, Testid, Creator, Intrebare, Raspuns, Tip, Obligatoriu) VALUES ('" . $_POST['id'] . "','" . $_POST['testId'] . "','" . $_COOKIE['login'] . "','" . $_POST['intrebare'] . "','" . $_POST['r'] . "','" . $_POST['tip'] . "','" . $_POST['o'] . "')";
	$stmt = $conn->query($sql);
	$conn=null;
?>