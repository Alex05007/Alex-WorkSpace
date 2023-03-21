<?php
	$target_dir = "../../cloud/";
	$n = explode(".", basename($_FILES["upload_file"]["name"]));
	$id = uniqid().uniqid();
	//$url = $id . "." . $n[1];
	//$target_file = $target_dir . $url;
	$target_file = $target_dir . $id . "/" . $_FILES["upload_file"]["name"];
	$uploadOk = 1;
	mkdir($target_dir . $id);
	/*$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["upload_file"]["tmp_name"]);
	if($check !== false) {
	  echo "File is an image - " . $check["mime"] . ".";
	  $uploadOk = 1;
	} else {
	  echo "File is not an image.";
	  $uploadOk = 0;
	}
	if ($_FILES["upload_file"]["size"] > 10000000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}*/
	if($n[1] != "php") {
	  $uploadOk = 1;
	} else {
	  echo "File denied";
	  $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	} else {
	  if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
	    $hostname = 'localhost:3307';
		$username = 'root';
		$password = 'gNetDB1qaz?1qaz';
		try {
			$conn = new PDO("mysql:host=$hostname;dbname=alexcloud", $username, $password);
			}
		catch(PDOException $e)
			{
			echo $e->getMessage();
			}
		$sql = "INSERT INTO `cloud`(`creator`, `org`, `name`, `size`) VALUES ('" . $_COOKIE['login'] . "','" . $_FILES["upload_file"]["name"] . "','" . $id . "','" . $_FILES["upload_file"]["size"] . "')";
		$stmt = $conn->query($sql);
		header("Location: ../indexLog.php");
		die();
	  } else {
		echo "Sorry, there was an error uploading your file.";
	  }
	}
?>