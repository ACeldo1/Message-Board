<?php

	session_start();
	include ("C:/Users/drtrt/xampp/dbconnect/dbconnect.inc.php"); //location of file may vary
	$username = $_SESSION['name'];


	if( !empty($_POST)) {
	
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['contact_submit'])) {
			
			if(empty($_POST['name'])) {
				$nameErr = 'A name is required!';
			}
			else {
				$name = htmlspecialchars($_POST['name']);
				$name = trim($name);
			}

			if(empty($_POST['content'])) {
				$contentErr = "Message content is required!";
			}
			else {
				$content = htmlspecialchars($_POST['content']);
				$content = trim($content);
			}
					
			$user_id = $_SESSION['user_id'];

			date_default_timezone_set('America/New_York');
			$dateCreated = date("Y-m-d H:i:s");
						
			//tables will change
			$myquery3 = "INSERT INTO contacts_ex (user_id, name, content, datecreated)
				VALUES (?, ?, ?, ?)";
			
			$stmt = $conn->prepare($myquery3);
			$stmt->bind_param("ssss",$user_id, $name, $content, $dateCreated);			
			$stmt->execute();
			$result = $stmt->get_result();
			
			$_SESSION['contact_submit'] = "true";
			
			if(isset($_SERVER['HTTP_REFERER'])){
				echo "server with referer worked";
				header("Location: {$_SERVER["HTTP_REFERER"]}");
			}
			else{
				echo 'else worked';
				header('contact_form_Project.php'); //location will vary
			}
			
		}
	}

?>