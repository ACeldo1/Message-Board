<?php
	session_start();
	include ("C:/Users/drtrt/xampp/dbconnect/dbconnect.inc.php"); //location of file may vary

	if( !empty($_POST)){

		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {
					
			if(empty($_POST['name'])) {
				$nameErr = "Username is required!";
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
			
			if(empty($_POST['email'])) {
				$emailErr = 'Email is required!';
			}
			else {
				$email = htmlspecialchars($_POST['email']);
				$email = trim($email);
			}
						
			$myquery2 = "SELECT *
			FROM users_ex
			WHERE username = ? AND email = ?"; //change tables using ex
			
			$stmt2 = $conn->prepare($myquery2);
			$stmt2->bind_param("ss", $username, $email);			
			$stmt2->execute();
			$result2 = $stmt2->get_result();
			
			echo $result2->num_rows;
			echo"<br>";
						
			while($rows2 = $result2->fetch_assoc()) {
				
				$users2[] = $rows2;
			
			}
			
			$found = 0;
			
			if($result2->num_rows != 0) {
				
				foreach($users2 as $x) {
				
					if($username == $x['username']) {
						
						include("register_form_Project.html"); //location may vary
						$found = 1;
						exit(header("Location: Sorry! That username is already taken."));
					}
					else if($email == $x['email']){
						
						include("register_form_Project.html"); //location may vary
						$found = 1;
						exit(header("Location: Sorry! That email is already in use!")) ;
					}
				}
			}
			
			$hashed_pwd  = password_hash($password, PASSWORD_DEFAULT);
			$hashed_email = password_hash($email, PASSWORD_DEFAULT);
			
			if($found == 0) {
				echo("<br><br><br>Thanks for registering!");		//change tables using ex
				$myquery2= "INSERT INTO users_ex (username, password, email)
				VALUES(?, ?, ?)";
				
				$stmt2 = $conn->prepare($myquery2);
				$stmt2->bind_param("sss", $username, $hashed_pwd, $hashed_email);//username isnt as important IMO			
				$stmt2->execute(); //so im not hashing it
				$result2 = $stmt2->get_result();
			
				$_SESSION['name'] = $username;
			
				$query2 = "SELECT user_id FROM users_ex WHERE username = ?"; 			
				$stmt = $conn->prepare($query2);
				$stmt->bind_param("s", $username);			
				$stmt->execute();
				$result2 = $stmt->get_result();	
			
				while($rows2 = $result2->fetch_assoc()) {
				
					$users2[] = $rows2;
			
				}
			
				$_SESSION['user_id'] = $users2[0]['user_id'];
			
			}
			
			if(isset($_SERVER['HTTP_REFERER'])){
				echo "<br><br><br>server with referer worked";
				header("Location: {$_SERVER["HTTP_REFERER"]}");
			}
			else{
				echo '<br><br><br>else worked';
				header('index_Project.php');
			  /* some fallback, maybe redirect to index.php */
			}
			
		}
	}
?>