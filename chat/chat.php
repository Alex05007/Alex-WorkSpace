<!DOCTYPE html>

<?php
	$myId = $_COOKIE['login'];
	$id2 = $_GET['id2'];
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexchat", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$sunt=false;
	$sql = "SELECT * FROM chat WHERE (catre = '" . $_COOKIE['login'] . "' and deLa = '" . $id2 . "' and mesaj <> '') or (catre = '" . $id2 . "' and deLa = '" . $_COOKIE['login'] . "' and mesaj <> '')";
	$stmt = $conn->query($sql);
	while ($row = $stmt->fetch()) {
		$sunt=true;
		if (strpos(openssl_decrypt($row['mesaj'],"AES-128-ECB",$myId), "alexvideo") !== false or strpos(openssl_decrypt($row['mesaj'],"AES-128-ECB",$id2), "alexvideo") !== false) {
			if ($row['catre'] == $_COOKIE['login']) {
				echo "<div class='message-data align-left'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message my-message' style='width: 50%;'>" . str_replace("alexvideo", "<a href='../video/?id=", openssl_decrypt($row['mesaj'],"AES-128-ECB",$id2)) . "' target='_blank'>Alex Video Meeting Invitation</a></div>";}
			if ($row['deLa'] == $_COOKIE['login']) {
				echo "<div class='message-data align-right'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message other-message float-right'>" . str_replace("alexvideo", "<a href='../video/?id=", openssl_decrypt($row['mesaj'],"AES-128-ECB",$myId)) . "' target='_blank'>Alex Video Meeting Invitation</a><a href='index.php?fa=delete&mesajdelete=" . $row['mesaj'] . "&id2=" . $id2 . "'><i class='far fa-trash-alt'></i></a></div><br />";}
		}
		else {
			if (strpos($row['mesaj'], "smiley:") !== false) {
				if ($row['catre'] == $_COOKIE['login']) {
					echo "<div class='message-data align-left'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message my-message'>" . str_replace("smiley:", "&#", $row['mesaj']) . "</div>";}
				if ($row['deLa'] == $_COOKIE['login']) {
					echo "<div class='message-data align-right'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message other-message float-right'>" . str_replace("smiley:", "&#", $row['mesaj']) . "<a href='index.php?fa=delete&mesajdelete=" . $row['mesaj'] . "&id2=" . $id2 . "'><i class='far fa-trash-alt'></i></a></div><br />"; }
			}
			else {
				if ($row['catre'] == $_COOKIE['login']) {
					if (strpos(openssl_decrypt($row['mesaj'],"AES-128-ECB",$id2), "<a href='http://gnets.myds.me/work/") !== false) {
						echo "<div class='message-data align-left'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message my-message'>" . openssl_decrypt($row['mesaj'],"AES-128-ECB",$id2) . "</div>";} else { echo "<div class='message-data align-left'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message my-message'><xmp>" . openssl_decrypt($row['mesaj'],"AES-128-ECB",$id2) . "</xmp></div>";}
				}
				if ($row['deLa'] == $_COOKIE['login']) {
					if (strpos(openssl_decrypt($row['mesaj'],"AES-128-ECB",$myId), "<a href='http://gnets.myds.me/work/") !== false) {echo "<div class='message-data align-right'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message other-message float-right'>" . openssl_decrypt($row['mesaj'],"AES-128-ECB",$myId) . "<a href='index.php?fa=delete&mesajdelete=" . str_replace("+", "()", $row['mesaj']) . "&id2=" . $id2 . "&id=" . $myId . "'><i class='far fa-trash-alt'></i></a></div><br />"; } else {echo "<div class='message-data align-right'><span class='message-data-time'>" . $row['ora'] . "</span></div><div class='message other-message float-right'><xmp>" . openssl_decrypt($row['mesaj'],"AES-128-ECB",$myId) . "</xmp><a href='index.php?fa=delete&mesajdelete=" . str_replace("+", "()", $row['mesaj']) . "&id2=" . $id2 . "&id=" . $myId . "'><i class='far fa-trash-alt'></i></a></div><br />"; }
				}
			}
		}
	}
	if (!$row = $stmt->fetch() and $sunt==false)
	{
		if ($id2 == "no" or $id2 == "") {
			echo "<p>You can't chat with no contact selected!</p>";
		} else {
			echo "<p>You don't have messages with this contact.</p>";
		}
	}
?>

<body>
</body>
</html>