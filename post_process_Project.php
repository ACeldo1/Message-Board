<?php
	session_start();
	include ("C:/Users/drtrt/xampp/dbconnect/dbconnect.inc.php"); //location of file may vary

	if( !empty($_POST)) {
	
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reply'])) {
			
			if(empty($_POST['message'])) {
				$messageErr = "Message is required!";
			}
			else {
				$message = htmlspecialchars($_POST['message']);
				$message = trim($message);
			}
			
			date_default_timezone_set('America/New_York');
			$dateCreated = date("Y-m-d H:i:s");
			
			//change tables with ex
			$myquery3 = "INSERT INTO posts_ex (thread_id, user_id, message, datecreated)
				VALUES (?, ?, ?, ?)";
			
			$thread_id = $_SESSION['thread_id'];
			$user_id = $_SESSION['user_id'];
			
			$stmt = $conn->prepare($myquery3);
			$stmt->bind_param("iiss",$thread_id, $user_id, $message, $dateCreated);			
			$stmt->execute();
			$result = $stmt->get_result();	
								
			if(isset($_SERVER['HTTP_REFERER'])){
				echo "server with referer worked";
				header("Location: {$_SERVER["HTTP_REFERER"]}");
			}
			else{
				echo 'else worked';
				header('viewMessages_Project.php?thread_id={$thread_id}' ); //location could vary but be weary
			}
			
		}
	}

?>