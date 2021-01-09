<?php

	session_start();
	include ("C:/Users/drtrt/xampp/dbconnect/dbconnect.inc.php"); //location of file may vary

	if( !empty($_POST)) {
	
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
			
			if(empty($_POST['name'])) {
				$nameErr = "Name is required!";
			}
			else {
				$username = htmlspecialchars($_POST['name']);
				$username = trim($username);
			}
			
			if(empty($_POST['password'])) {
				$passErr = 'Password is required!';
			}
			else {
				$password = htmlspecialchars($_POST['password']);
				$password = trim($password);
			}

			$myquery1 = "SELECT username, password 
			FROM users_ex
			WHERE username = ?";
			
			$stmt = $conn->prepare($myquery1);
			$stmt->bind_param("s", $username);			
			$stmt->execute();
			$result = $stmt->get_result();	
						
			echo $result->num_rows;
			echo"<br>";
						
			if($result->num_rows === 0) {
				$_SESSION['name'] = "incorrect";
				exit(header("Location: login_form_Project.php?loginfailed"));
			}
						
			while($rows = $result->fetch_assoc()) {
				
				$users[] = $rows;
			
			}
			
			$hashed_pwd = $users[0]['password'];
			
			if(password_verify($password, $hashed_pwd)) {
				
				$_SESSION['name'] = $username;
				
				//$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
				
				$query2 = "SELECT user_id FROM users_ex WHERE username = ?";
				
				$stmt = $conn->prepare($query2);
				$stmt->bind_param("s", $username);			
				$stmt->execute();
				$result2 = $stmt->get_result();	
				
				while($rows2 = $result2->fetch_assoc()) {
					
					$users2[] = $rows2;
				
				}
				
				$_SESSION['user_id'] = $users2[0]['user_id'];
				

				if(isset($_SERVER['HTTP_REFERER'])){
					echo "server with referer worked";
					header("Location: {$_SERVER["HTTP_REFERER"]}");
				}
				else{
					echo 'else worked';
					exit(header('Location: index_Project.php'));
				}
			
			}
			else{
				echo "<br><br><br><br> Pwd incorrect!";
			}
			
		}
	}

?>