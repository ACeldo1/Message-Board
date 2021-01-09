<?php # Script 17.3 - index.php
		// This is the main page for the site.
	session_start();
	
	//if(!isset($_SESSION['name']))
		//$_SESSION['name'] = "none";
	//if(!isset($_SESSION['user_id']))
		//$_SESSION['user_id'] = "-1";
	
	$current_page = "home";
	$page_name = "Home";
	$_SESSION['current_page'] = $current_page;
	$_SESSION['page_name'] = $page_name;

		// Include the HTML header:
	include ('simple_header_Project.html'); //location of file may vary

	if(isset($_SESSION['name']) && $_SESSION['name'] != "incorrect"){
		echo '<h3>Welcome: ' .$_SESSION['name']. '<h3>';
	}
	else
		echo '<h3> Welcome to Our Forum!';
		// Include the HTML footer file:
	include ('footer_Project.html'); //location of file may vary
	
?>