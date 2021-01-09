<?php
session_start();
//Here is the homepage where we can include navigation
//The header + footer files will be used for repeated elements of our website
$current_page = "convos";
$page_name = "My Conversations";
$_SESSION['current_page'] = $current_page;
$_SESSION['page_name'] = $page_name;
//$title = "My Conversations";

        include('simple_header_Project.html'); //location will vary

	$user_id = $_SESSION['user_id'];
	var_dump($_SESSION['user_id']);
	var_dump($user_id);

	//change tables here with ex
	$query1 = "SELECT T.thread_id, T.topic, P.message, P.datecreated FROM posts_ex P 
	INNER JOIN threads_ex T ON T.thread_id = P.thread_id
	WHERE P.user_id = ? ORDER BY P.datecreated DESC";
	
	$stmt = $conn-> prepare($query1);
	$stmt -> bind_param('i', $user_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows === 0){ //im not sure if ViewMessages location will affect you or not
					 exit("You aren't in any conversations! :^[");
			}else{
					echo '<table border="1"><tr><td>THREAD_ID</td><td>TOPIC</td><td>MESSAGE</td><td>Date Created</td></tr>';
					while($row = $result->fetch_assoc()){
							echo '<tr>
							<td><a href="viewMessages_Project.php?thread_id=' .$row['thread_id']. '" >'.$row['thread_id'].'</a></td>
							<td>'.$row['topic'].'</td>
							<td>'.$row['message'].'</td>
							<td>'.$row['datecreated'].'</td>
							</tr>';
					}
			}echo'</table>';


	include ('footer_Project.html'); //location will vary
?>