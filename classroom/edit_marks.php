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
	$sql = "SELECT * FROM conturi";
	$stmt = $conn->query($sql);
	$culori = array();
	$id_nume = array();
	while ($row = $stmt->fetch()) {
		if (strpos($students, $row['Id']) !== false) {
			$culori[$row['username']] = $row['culoare'];
			$id_nume[$row['Id']] = $row['username'];
		}
	}
	function grades_table($subjectt, $mark1, $mark2, $mark3, $mark4, $mark5) {
		echo '<tr>
			<td>' . $subjectt . '</td>
			<td>' . $mark1 . '</td>
			<td>' . $mark2 . '</td>
			<td>' . $mark3 . '</td>
			<td>' . $mark4 . '</td>
			<td>' . $mark5 . '</td>';
		if ($mark1 != "" && $mark2 == "" && $mark3 == "" && $mark4 == "" && $mark5 == "")
				echo '<td>' . $mark1 . '</td>';
		else {
			if ($mark1 != "" && $mark2 != "" && $mark3 == "" && $mark4 == "" && $mark5 == "")
					echo '<td>' . ((intval($mark1) + intval($mark2))/2) . '</td>';
			else {
				if ($mark1 != "" && $mark2 != "" && $mark3 != "" && $mark4 == "" && $mark5 == "")
						echo '<td>' . ((intval($mark1) + intval($mark2) + intval($mark3))/3) . '</td>';
				else {
					if ($mark1 != "" && $mark2 != "" && $mark3 != "" && $mark4 != "" && $mark5 == "")
						echo '<td>' . ((intval($mark1) + intval($mark2) + intval($mark3) + intval($mark4))/4) . '</td>';
					else {
						if ($mark1 != "" && $mark2 != "" && $mark3 != "" && $mark4 != "" && $mark5 != "")
							echo '<td>' . ((intval($mark1) + intval($mark2) + intval($mark3) + intval($mark4) + intval($mark5))/5) . '</td>';
						else
							echo '<td>No marks</td>';
					}
				}
			}
		}
		echo "</tr>";
	}
	function edit_mark($subjectt, $mark1, $mark2, $mark3, $mark4, $mark5) {
		$i++;
		echo '<tr>
			<td><input name="mark-edit" type="text" value="' . $subjectt . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark1 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark2 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark3 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark4 . '" style="width:100%;"/></td>
			<td><input name="mark-edit" type="number" value="' . $mark5 . '" style="width:100%;"/></td>';
		echo "</tr>";
	}
	
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexclassroom", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$myId = $_COOKIE['login'];
	$sql = "SELECT * FROM class WHERE Id='" . $_GET['classid'] . "'";
	$stmt = $conn->query($sql);
	if ($row = $stmt->fetch()) {$students = $row['Students'] . ";" . $row['Professor'];}
	
	if ($row['Professor'] == $_COOKIE['login']) {
		$sql = "SELECT * FROM grades WHERE classid='" . $_GET['classid'] . "' and student='" . openssl_encrypt($_GET['edit'],"AES-128-ECB", $_GET['classid']) . "'";
		$stmt = $conn->query($sql);
		if ($row = $stmt->fetch()) {
			$student = openssl_decrypt($row['student'],"AES-128-ECB", $_GET['classid']);
			echo "
			<div class='hover'>
				<table>
					<tr>
						<td><img src='https://eu.ui-avatars.com/api/?background=" . $culori[$student] . "&color=fff&name=" . $student . "&size=40&rounded=true' style='margin-right:10px;'/></td>
						<td><h3>" . $student . "</h3><p>Student</p></td></tr></table>";
				echo '<table class="marks" name="grades">';
					$subjects = explode(";", $row['marks']);
					for ($i=0; $i<count($subjects)-1; $i++) {
						$marks = explode(",", $subjects[$i]);
						edit_mark($marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5]);
					}
					echo '<tr id="clonetr">
						<td><input name="mark-edit" type="text" value="' . $subjectt . '" style="width:100%;"/></td>
						<td><input name="mark-edit" type="number" value="' . $mark1 . '" style="width:100%;"/></td>
						<td><input name="mark-edit" type="number" value="' . $mark2 . '" style="width:100%;"/></td>
						<td><input name="mark-edit" type="number" value="' . $mark3 . '" style="width:100%;"/></td>
						<td><input name="mark-edit" type="number" value="' . $mark4 . '" style="width:100%;"/></td>
						<td><input name="mark-edit" type="number" value="' . $mark5 . '" style="width:100%;"/></td>';
					echo "</tr>";
			echo "</table></div><br />";
		}
		echo '<a class="mdc-button" href="javascript:savemark()" style="float:right"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Save</span></a>';
		echo '<a class="mdc-button" href="javascript:clone()" style="float:right"><span class="mdc-button__ripple"></span><span class="mdc-button__label">Add row</span></a>';
	}
?>