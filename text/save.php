<?php
    $hostname = 'localhost:3307';
    include "../db.php";
    try {
        $conn = new PDO("mysql:host=$hostname;dbname=alextext", $username, $password);
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
        }

    if ($_POST['fa'] == "save") {
        $sql = "INSERT INTO documente (Id, Share, Creator, Titlu, Content) VALUES ('" . uniqid() . "', '" . $_POST['share'] . "', '" . $_COOKIE['login'] . "', '" . $_POST['titlu'] . "', '" .  $_POST['document'] . "')";
        $stmt = $conn->query($sql);
    }
    if ($_POST['fa'] == "update") {
        $sql = "UPDATE documente SET Share='". $_POST['share'] . "', Titlu='" . $_POST['titlu'] . "', Content='" . $_POST['document'] . "' WHERE Id = '" . $_POST['thisId'] . "' and Creator = '" . $_COOKIE['login'] . "'";
        $stmt = $conn->query($sql);
    }
?>