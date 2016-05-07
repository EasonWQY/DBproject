<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel='stylesheet' href='style.css' />
		<title></title>

	</head>
	<body>
	<div id='title_bar'>
		<ul>
			<li><a href='index.php'>Home</a>&nbsp;&nbsp;</li>
			<?php
				if (loggedin()) {
			?>
			<li><a href='profile.php'>Profile</a>&nbsp;&nbsp;</li>
			<li><a href='message.php'>Messages</a>&nbsp;&nbsp;</li>
			<li><a href='request.php'>Requests</a>&nbsp;&nbsp;</li>
			<li><a href='location.php'>Locations</a></li>
			<li><a href='friends.php'>Friends</a>&nbsp;&nbsp;</li>
			<li><a href='members.php'>Members</a>&nbsp;&nbsp;</li>
			<li><a href='Search.php'>Search</a>&nbsp;&nbsp;</li>
			<li><a href='logout.php'>Logout</a>&nbsp;&nbsp;</li>
			<?php
				} else {
			?>
			<li><a href='login.php'>Login</a>&nbsp;&nbsp;</li>
			<li><a href='register.php'>Register</a></li>
			<?php
				}
			?>
			<div class='clear'></div>
		</ul>
	</div>

		
	</body>
</html>
