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

$titlu = "SELECT * FROM forms WHERE Id='" . $_POST['id'] . "'";
$titlu2 = $conn->query($titlu);
if($tit = $titlu2->fetch()){}
if ($_POST['r'] != "") {
	setcookie("r", "", time());
	setcookie($_POST['id'], "", time());
	setcookie("sId", "", time());
	setcookie("timp", "", time());
	setcookie("algoritm", "", time());
	setcookie("ano", "", time());
	if ($tit['mail'] != "") {
		require_once('../PHPMailer/PHPMailerAutoload.php');
		$mail = new PHPMailer(true);
		try{
		$mail->isSendmail();
				
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';			
		$mail->Port = '587';

		$mail->Username = 'workspace.alexs@gmail.com';
		$mail->Password = 'alexworkspace12qwaszx?12qwaszx';

		$mail->SetFrom('noreply.forms@alexs.gq', 'Alex Workspace');
		$mail->addAddress($tit['mail'], $_GET['un']);
		$mail->addReplyTo('forms@alexs.gq', 'Alex Workspace'); // to set the reply to

		$mail->IsHTML(true);
		$mail->Subject = $tit['Titlu'] . ' - Alex Forms Response';
		$rasp = explode("; ", $_POST['r']);
		$raspuns = '<div style="background-color:#FFF;"><h1 style="text-align:center;"><font style="color:#09F;">A</font><font style="color:#ea4335;">l</font><font style="color:#0C0;">e</font><font style="color:#FF0">x</font> <font style="color:#666;">Forms</font></h1><div style="padding:60px; text-align:center;"><h2>Hello,</h2><h3>Someone completed the form ' . $tit['Titlu'] . '<br/ ><a href="gnets.myds.me/work/forms/answers.php?id=' . $_POST['id'] . '&sId=' . $_POST['sId'] . '" style="text-decoration:underline; color:#000;">See the response</a><div style="width:80%; border-radius:16px; border:#CCC 1px solid; padding: 10 px; border-top: #09F 30px solid;"><h1>' . $tit['Titlu'] . '</h1></div><br />';
		for ($i=0; $i<count($rasp); $i++) {
			$r = explode(":", $rasp[$i]);
			$raspuns = $raspuns . '<div style="width:80%; border-radius:16px; border:#CCC 1px solid; padding:20px; text-align:left;"><h2 style="font-weight:normal;">' . $r[0] . '</h2><h4 style="font-weight:normal;">' . $r[1] . '</h4></div><br />';
		}
		$mail->Body= $raspuns . '<h4 style="text-align:center;">&copy; Alex Sofonea 2021 - Alex Workspace<h4></div>';
		if(!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			echo "Message has been sent!";
		}
		} catch (Exception $e) {
			echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	if ($tit['deLa'] != 0 and $tit['panaLa'] != 0) {
		if (date("Gi") < $tit['deLa'] or $tit['panaLa'] < date("Gi")) {
			header("Location: http://gnets.myds.me/work/forms/raspunde.php?time=true&id=" . $_POST['id']);
			die();
		} else {
			$sql = "INSERT INTO raspunsuri (id, nume, raspunsuri, test, parasiri, comentariu) VALUES ('" . $_POST['sId'] . "', '" . $_POST['nume'] . "', '" . $_POST['r'] . "', '" . $_POST['id'] . "', '" . $_POST['parasiri'] . "', '')";
			$stmt = $conn->query($sql);
			header("Location: http://gnets.myds.me/work/forms/raspunde.php?sent=true&id=" . $_POST['id']);
			die();
		}
	}
	else {
		$sql = "INSERT INTO raspunsuri (id, nume, raspunsuri, test, parasiri, comentariu) VALUES ('" . $_POST['sId'] . "', '" . $_POST['nume'] . "', '" . $_POST['r'] . "', '" . $_POST['id'] . "', '" . $_POST['parasiri'] . "', '')";
		$stmt = $conn->query($sql);
		header("Location: http://gnets.myds.me/work/forms/raspunde.php?sent=true&id=" . $_POST['id']);
		die();
	}
}
?>