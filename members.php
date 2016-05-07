<html>
<head>
	<title>Members</title>
	<link rel='stylesheet' href='style.css' />
	<script type="text/javascript" src="js/sidebox.js"></script>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Members: </h3>
		<?php 
			$myid = $_SESSION['myid'];
			$query = "select u_id from user";
			$result = $conn->query($query);
			while ($run = $result->fetch_array()) {
				$uid = $run['u_id'];
				if ($uid != $myid) {
					echo "<a href='profile.php?uid=$uid' class='box' style='display:block'>$uid</a>";
				}
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