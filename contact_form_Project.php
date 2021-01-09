<?php
session_start();

$current_page ="contact";
$page_name = "Contact";
$_SESSION['current_page'] = $current_page; 
$_SESSION['page_name'] = $page_name;

if(!isset($_SESSION['contact_submit']) || $_SESSION['contact_submit'] == "false")
	$_SESSION['contact_submit'] = "false";

$contact_submit = $_SESSION['contact_submit'];
 
 include('simple_header_Project.html'); //location will vary
 if($contact_submit == "true"){
	echo"<h4>Thanks for the message! We will get back to you as soon as possible!</h4>";
	$_SESSION['contact_submit'] = "false";
 }
?>

<body>
    <div class="contact-title">
        <h2>Say Hello!</h2>
    </div>
    <div class="contact-form">
        <form id="contact-form" method="POST" action="contact_process_Project.php"> <!-- location will vary -->
            <fieldset>
			<input name="name" type="message" class="form-control" placeholder="Your Name" required><br>
                <textarea name="content" class="form-control" placeholder="Message" row="4" required></textarea><br>
                <input type="submit" class="form-control submit" name = "contact_submit" value="Send Message">
            </fieldset>
			</form>
        </div>
<?php
 include ('footer_Project.html'); //location will vary
?>