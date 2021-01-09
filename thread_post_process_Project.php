<?php
	session_start();
	include ("C:/Users/drtrt/xampp/dbconnect/dbconnect.inc.php"); //location of file may vary

	if( !empty($_POST)) {
	
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['new_thread'])) {
			
			if(empty($_POST['thread_topic'])) {
				$threadErr = "Invalid topic input!";
			}
			else {
				$newThread = htmlspecialchars($_POST['thread_topic']);
				$newThread = trim($newThread);
			}
			
			$myquery4 = "INSERT INTO threads_ex (user_id, topic)
				VALUES (?, ?)";
			
			$user_id = $_SESSION['user_id'];
			
			$stmt = $conn->prepare($myquery4);
			$stmt->bind_param("is",$user_id, $newThread);			
			$stmt->execute();
			$result = $stmt->get_result();	
								
			if(isset($_SERVER['HTTP_REFERER'])){
				echo "server with referer worked";
				header("Location: {$_SERVER["HTTP_REFERER"]}");
			}
			else{
				echo 'else worked';
				header('viewMessages_Project.php?thread_id={$thread_id}' ); //location may vary
			}
			
		}
	}

?>