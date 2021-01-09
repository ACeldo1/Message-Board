<?php
session_start();
	include('simple_header_Project.html'); //location will vary

	//validate threadID, GET method sends thread_id as string so we have to typecast back to int
	$thread_id = FALSE;
	if(isset($_GET['thread_id']) && intval($_GET['thread_id']) > 0){
		$thread_id = intval($_GET['thread_id']);
		$_SESSION['thread_id'] = $thread_id;
	}
	
	$query3 = "SELECT T.topic, P.message , P.datecreated, U.username FROM threads_ex T 
	LEFT JOIN posts_ex P USING (thread_id)
	INNER JOIN users_ex U ON P.user_id = U.user_id WHERE thread_id = ? 
	ORDER BY P.datecreated DESC";

	$stmt = $conn -> prepare($query3);
	$stmt -> bind_param('i', $thread_id);
	$stmt->execute();
	$result = $stmt ->get_result();

	//if no posts, then the thread is invalid
	if($result->num_rows ===0){
		$thread_id = FALSE;
	}

	if($thread_id){
		while($row = $result->fetch_assoc() ){
			$arr1[]=$row;
		}

		echo '<table border="1">';
		echo "<tr><td> topic </td><td> message </td><td> datecreated </td><td> username </td></tr>";
		
		foreach($arr1 as $row){
			foreach($row as $key=>$value){
				echo "<td>".$value."</td>";
			}echo "</tr>";
		}	
		echo '</table>';
	}else{

		echo "There are no messages in this thread!";
	}
	
	echo "<br><br>";
	//form for posting a message
	//location of process file may vary
	echo '<form action="post_process_Project.php" method = "POST"> <!-- action is where you wish to send the data and method is -->
			<fieldset align = "center">
					<legend> Type a response:</legend>
					<p>
						<label> Enter here <textarea type= "text" name ="message" size = "30">
						</textarea></label>
					</p>
				
					<p>
						<input type = "submit" name = "reply" value = "Post your reply">
					</p>
			</fieldset>
				
		</form>';

	include('footer_Project.html'); //location may vary
?>