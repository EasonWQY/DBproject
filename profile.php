<html>
<head>
	<title>User Profile</title>
	<link rel='stylesheet' href='style.css' />
	<script type="text/javascript" src="js/sidebox.js"></script>
	<style type="text/css">
      #div1{border-bottom:1px solid white; height: 300px; margin-top: 20px}
      .container a:link, a:visited{background: #374552; color: purple};
    </style>


</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<?php
			if (isset($_GET['uid']) && !empty($_GET['uid'])) {
				$uid = $_GET['uid'];
			} else {
				$uid = $_SESSION['myid'];
			}
			$myid = $_SESSION['myid'];
			$username = $uid;
		?>
		<h3>User: <?php echo $username;?></h3>
		<?php 
			$show = true;
			if ($uid == $myid) {
				$show = false;
				echo "<h3><a href='edit.php'>Edit Profile</a></h3>";
			} else {
				$check_friend = "select * from friend where u_id='$uid' and friendid='$myid'";
				$result = $conn->query($check_friend);
				$rows = $result->num_rows;
				if ($rows > 0) {
					echo "<a href='#' class='box'>Already Friends</a> | <a href='actions.php?action=unfriend&uid=$uid' class='box'>Unfriend $username</a>";
				} else {
					$from_query = $conn->query("select * from firend_request where sent_id='$uid' and receiver_id='$myid'");
					$to_query = $conn->query("select * from firend_request where sent_id='$myid' and receiver_id='$uid'");
					if ($from_query->num_rows > 0) {
						echo "<a href='actions.php?action=accept&uid=$uid' class='box'>Accept</a> | <a href='actions.php?action=ignore&uid=$uid' class='box'>Ignore</a>";
					} else if ($to_query->num_rows > 0) {
						echo "<a href='actions.php?action=cancel&uid=$uid' class='box'>Cancel Request</a>";
					} else {
						echo "<a href='actions.php?action=send&uid=$uid' class='box'>Send Friend Request</a>";
					}
				}

			}
			$result  = $conn->query("select show_relation('$myid','$uid')");
			$visibility = $result->fetch_row()[0];
			$pro_result = $conn->query("select * from profile where u_id='$uid' and visibility<='$visibility'");
			$pro_rows = $pro_result->num_rows;
			if($pro_rows>0){ 
				$info = $pro_result->fetch_assoc(); 
				if(!$info['figure']){
					$info['figure'] = "img/cannotshow.png";
					}?>
                <div  id="div1">
                	<img src="<?php echo $info['figure']; ?>" style = "width:25%;float:right"/><br/>
                	<span>Name: <?php echo $info['first_name']."  ".$info['last_name']; ?></span><br/>
                	<span>Age: <?php echo $info['age']?></span><br/>
                	<span>Gender: <?php echo $info['gender']?></span><br/>
                	<span>Email: <?php echo $info['email']?></span><br/>
                	<span>Address: <?php echo $info['address']?></span> <br/>
                	<p style="width:50%;">Intro: <?php echo $info['introduction']?></p><br/>
                </div>
			<?php }else{
				echo "<br/><br/>";
				echo "<p style='text-align:center;'>Sorry,the profile for this user is hidden from you</p>";
				echo "<img src='img/nothing.png' style='width:50%; display:block; margin:auto'>";
			}	
		?>
		<?php
			include 'user.php';
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