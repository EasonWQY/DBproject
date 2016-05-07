<html>
<head>
	<title>Personal Profile</title>
	<link rel='stylesheet' href='style.css' />
	<style type="text/css">
       label{ width: 200px; vertical-align: top; text-align: right; display:inline-block; }
        textarea{width: 300px; height: 200px;}
	</style>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Personal Profile</h3>
				<?php include 'connect.php';?>  
				<?php
					$uid = $_SESSION['myid'];
					if ($conn->connect_error) die($conn->connect_error);
					$query = "select * from profile where u_id = '$uid'";
					$result = $conn->query($query);
					$info = $result->fetch_assoc();
					// echo 'Username: '.$result->fetch_assoc()['user_name']. '<br />';
					// $result = $conn->query($query);
					// echo 'Email: '.$result->fetch_assoc()['email']. '<br />';
					// $result = $conn->query($query);
					// echo 'Description: '.$result->fetch_assoc()['description']. '<br />';
					// $result = $conn->query($query);
					// echo 'Location: '.$result->fetch_assoc()['location']. '<br />';
                ?>
                    <h3 style="background-color: #374552;">Edit Profile</h3>
				    <form action="editfile.php" method="post" enctype='multipart/form-data'>
				    <fieldset>
				    <label for="fname">First Name: </label>
				    <input type="text" name="first" id="fname" value="<?php echo $info['first_name']?>"></input><br />

				    <label for="lname">Last Name: </label>
				    <input type="text" name="last" id="lname" value="<?php echo $info['last_name']?>"></input><br />

				    <label>Gender: </label>
				    <input type="radio" name="gender" value="male" required>Male</input>
                    <input type="radio" name="gender" value="female" required>Female</input>
				    <br />

				    <label>Age: </label>
				    <input type="number" name="age" min="0" max="1000" step="1" value="<?php echo $info['age']?>"></input><br />


                    <label for="email">Email: </label> 
					<input type="email" name="email" value="<?php echo $info['email']?>" />
		        	<br />

		        	<label for="address">Address: </label>
				    <input type="text" name="address" id="address" value="<?php echo $info['address']?>"></input><br />

				    <label for="intro">Introduction: </label>
				    <textarea name="intro" id="intro"><?php echo $info['introduction']?></textarea><br />

                    <label>Figure: </label>
                    <input type="file" name="figure"/><br/>

                    <label>Visibility: </label>
                    <input type="radio" name="visibility" value="1" required />All
                    <input type="radio" name="visibility" value="2" required />FOF
                    <input type="radio" name="visibility" value="3" required />Friend
                    <input type="radio" name="visibility" value="4" required />Only Me
                    <br/>
<!-- 		        	Location: <input type="text" name="location" />
		        	<br />
		        	Password:<input type="password" name="password" />  
		        	<br />  
		        	New Password:<input type="password" name="newpass" />  
		        	<br /> -->
					<input type="submit" name="Edit" value="Edit" /> 
					</fieldset>
				</form>
				<?php
					$result->close();
					$conn->close();
				?>
				
	</div>
</body>
</html>