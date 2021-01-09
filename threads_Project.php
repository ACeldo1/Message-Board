<?php
	//forum page which displays the threads of a forum
	session_start();
	//$page_title="Forum Page";
	//$title = "Forum";
	
	$current_page = "forum";
	$page_name = "The Forums";
	$_SESSION['current_page'] = $current_page;
	$_SESSION['page_name'] = $page_name;

	include("simple_header_Project.html"); //location may vary

	if(isset($_SESSION['name']) && $_SESSION['name'] != "incorrect") {
		
		include("threads_process_Project.php");
		
	}
	else {
		echo("You need to log in or register first!");
	}

	include("footer_Project.html"); //location may vary

?>

