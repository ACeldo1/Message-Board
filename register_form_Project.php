<?php
	session_start();
	$current_page = "register";
	$page_name = "Register";
	$_SESSION['current_page'] = $current_page;
	$_SESSION['page_name'] = $page_name;
	
	$destination = $_SERVER['REQUEST_URI'];
		
	include("simple_header_Project.html"); //location of file may vary
		
	if(isset($_SESSION['name']) && $_SESSION['name'] != "incorrect") { 
		echo ("<br><br><br>You registered, and are logged in!");
	}
		
	if(!isset($_SESSION['name']) || $_SESSION['name'] == "incorrect") {
		echo '<form action="register_Project.php" method = "POST"> <!-- action is where you wish to send the data and method is -->
			<fieldset align = "center">
				<legend> Enter your info in the form below:</legend>
					<p>
						<label for = "email"> Email:
						<input type = "email"name = "email" size = "30" maxlength = "40"required></label>
					</p>
					<p>
						<label for = "name">Username:
						<input type= "text" name = "name" size = "30" maxlength = "40" required></label>
					</p>
					<p>
						<label for = "password"> Password:
						<input type= "password" name ="password" size = "31" maxlength = "20" required ></label>
					</p>
					<p>
					<input type = "submit" name = "register" value = "Register">
					</p>
			</fieldset>
		</form>';
	}
		
	include("footer_Project.html"); //location of file may vary
		
?>