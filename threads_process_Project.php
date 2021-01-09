<?php
	//forum page which displays the threads of a forum
	include ("C:/Users/drtrt/xampp/dbconnect/dbconnect.inc.php"); //location of file may vary

	//$page_title="Forum Page";
	//$title = "Forum";
	//query for retrieving threads from DB
	//if(!empty($_SESSION['name'])) {
	
	
		//change tables with ex
		$query1 = "SELECT T.thread_id, T.topic, T.user_id, U.username FROM threads_ex T JOIN users_ex U ON T.user_id = U.user_id"; // a change made here users
		$stmt = $conn-> prepare($query1);
		$stmt->execute();
		$result = $stmt->get_result();

			if($result->num_rows === 0){
				 echo("<h3>There are currently no interesting conversations :^[<h3>");
			}
			else{
				echo '<table border="1"><tr><td>THREAD_ID</td><td>TOPIC</td><td>username</td></tr>';
				while($row = $result->fetch_assoc()){
					echo '<tr>
					<td><a href="viewMessages_Project.php?thread_id=' .$row['thread_id']. '" >'.$row['thread_id'].'</a></td>
							<td>'.$row['topic'].'</td>
					<td>'.$row['username'].'</td> 
					</tr>'; 
				}
				
			}
			echo'</table>';
			echo"<br><br>";
			
			
			//file location may vary
			echo '<form action="thread_post_process_Project.php" method = "POST"> <!-- action is where you wish to send the data and method is -->
			<fieldset align = "center">
					<legend> Create a new thread:</legend>
					<p>
						<label> Enter topic <input type= "text" name ="thread_topic" size = "30" maxlength = "40">
						</label>
					</p>
				
					<p>
						<input type = "submit" name = "new_thread" value = "Start thread">
					</p>
			</fieldset>
				
		</form>';
?>