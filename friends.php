<html>
<head>
	<title>My Friends</title>
	<link rel='stylesheet' href='style.css' />
	<script type="text/javascript" src="js/sidebox.js"></script>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Friend lists : </h3>
		<?php
			$myid = $_SESSION['myid'];
			$query = $conn->query("select friendid from friend where u_id='$myid'");
			while ($run = $query->fetch_array()) {
				$friendid = $run['friendid'];
				echo "<a href='profile.php?uid=$friendid' class='box' style='display:block'>$friendid</a>";
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