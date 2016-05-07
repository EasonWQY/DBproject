<html>
<head>
	<title>Search</title>
	<link rel='stylesheet' href='style.css' />
	<script type="text/javascript" src="js/sidebox.js"></script>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>
	<?php 
       
	?>
	<div class='container'>
		<form method='post'>
			<br /><br />
			<h3>Send message to friend : </h3>
			<span>
				<select name='users'>
					<?php
						$myid = $_SESSION['myid'];	
						$query = "select u_id from friend where friendid ='$myid'";
						$result = $conn->query($query);
						while ($run = $result->fetch_array()) {
							$uid = $run['u_id'];
								echo "<option value='$uid'>$uid</option>";
						}
					?>
				</select>
			</span>
			<br /> 
			<input type='text' name='input' required /> 
			<span><input type='submit' name='send' value='send' /></span>
			<br></br>
			<?php
				if (isset($_POST['send']) && $_POST['send'] == 'send') {
					$user = $_POST['users'];
					$input= $_POST['input'];
		            $search = "insert into message(sent_id, receiver_id, text) values ('$myid', '$user', '$input')"; 
			            $result = $conn->query($search);  
			            if ($result) {
			         		header("location:message.php");
			            }
				    }
				 
			?>
			<br /><br />
		</form>
		<h3>Message sent to me:</h3>
		<?php
			$query = "select sent_id, text from message where receiver_id ='$myid'";
			$result = $conn->query($query);
			while ($run = $result->fetch_array()) {
				$username = $run['sent_id'];
				$message = $run['text'];
				echo "From ".$username.": ".$message.'<br /><br />';
			}
			$query1 = "delete from message where receiver_id = '$myid' and time <= (select DATE_SUB(current_timestamp,INTERVAL 7 DAY));";
			$conn->query($query1);
		?>
	</div>
	<div id="sidebox">
	    <h5 style="font-size: 15px">quick bar</h5>
		<a href="type_diary.php">Post a diary</a>
		<br/><br/>
		<a href="activity.php">Post an activ</a>
		<br/><br/>
		<a href="location.php">view position</a>
	</div>
</body>
</html>