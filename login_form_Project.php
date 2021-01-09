<!--Use POST instead of GET because GET shows info in the URL -->
<?php
	session_start();
	$current_page = "login";
	$page_name = "Login";
	$_SESSION['current_page'] = $current_page;
	$_SESSION['page_name'] = $page_name;
		
	include("simple_header_Project.html"); //location of file may vary
		
	if(isset($_SESSION['name']) && $_SESSION['name'] != "incorrect") { //might not work yet
		echo ("<br><br><br>You are logged in!");
		//include('../index.php'); //location of file may vary
	}		
		
	if(!isset($_SESSION['name']) || $_SESSION['name'] == "incorrect") {
		
		if(isset($_SESSION['name']) == "incorrect")
			echo 'Incorrect login! Please try again<br><br>';
		
		//location of file may vary
		echo'<form action="login_Project.php" method = "POST"> <!-- action is where you wish to send the data and method is -->
			<fieldset align = "center">
					<legend> Enter your info in the form below:</legend>
					
					<p>
						<label> Username: <input type= "text" name ="name" id = "username" size = "30" maxlength = "40" required>
						</label>
					</p>
					<p>
						<label> Password: <input type= "password" name ="password" size = "31" maxlength = "20" id = "pwd" required>
						</label>
					</p>
					<p>
						<input type = "submit" name = "submit" value = "Submit Info">
					</p>
			</fieldset>
				
		</form>';
	}
		
	include("footer_Project.html"); //location of file may vary
		
?>