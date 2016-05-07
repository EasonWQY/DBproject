<html>
<head>
	<title>Friend System</title>
	<link rel='stylesheet' href='style.css' />
	<script type="text/javascript" src="js/sidebox.js"></script>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Request : </h3>
		<?php
			$myid = $_SESSION['myid'];
			$query = $conn->query("select sent_id from firend_request where receiver_id='$myid' and isAccept=false");
			while ($run = $query->fetch_assoc()) {
				$sent_id = $run['sent_id'];
				echo "<a href='profile.php?uid=$sent_id' class='box' style='display:block'>$sent_id</a>";
			}
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