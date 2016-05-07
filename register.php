<!DOCTYPE>
<html>
<head>
	<title>Register</title>
	<link rel='stylesheet' href='style.css' />
	<style type="text/css">
	   
	   label {width: 130px; display: inline-block; text-align: right; vertical-align: middle;}
	   input {text-align: left;}

	</style>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Reigister a new Account</h3>
			<?php  
			    if(isset($_POST["submit"]) && $_POST["submit"] == "submit")  
			    {  
			        $username = $_POST["username"];  
			        $password = $_POST["password"];  
			        $confirm = $_POST["confirm"];

			        $first = $_POST["first"];
                    $last = $_POST["last"];
			        $gender = $_POST["gender"];
			        $age = $_POST["age"];
			        $email = $_POST["email"];
			        $address = $_POST["address"];
			        // $intro =$_POST['intro'];
			        // $figure = $_POST['figure'];
			        $visibility = $_POST["visibility"];
			       // $location = $_POST["location"];
			        if ($password != $confirm) {
			            echo "<script>alert('Passwords are not equal!'); history.go(-1);</script>";
			        }
			        else {  
			            $conn = new mysqli("127.0.0.1","root","", "project_music");
			            if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
			            $query = "select u_id from user where u_id ='$_POST[username]'"; 
			            $result = $conn->query($query);  
			            if(!$result) die ($conn->error);  
			            $rows = $result->num_rows;
			            if ($rows > 0) {
			                echo "<script>alert('Username or email already exists!'); history.go(-1);</script>";
			            } else {
			            	$insert = "insert into user(u_id, password, signup_time) values ('$username', '$password', now())";
			            	$in_pro = "insert into profile(u_id, first_name, last_name, gender, age, email, address, visibility) VALUES ('$username','$first','$last','$gender','$age','$email','$address','$visibility')";
			                $reg_result = $conn->query($insert);
			                $in_result = $conn->query($in_pro);
			                if ($reg_result && $in_result) {
				                $_SESSION['myid']=$username;
			                    echo "<script>alert('Successfully registered! The next important step is to fill your profile after login');</script>";
			                    //header("location:login.php");
			                    echo '<script language="JavaScript">window.location.href="index.php";</script>';
			                } else {
			                    echo "<script>alert('System is busy now, Please try later!'); history.go(-1);</script>";
			                }
			            } 
			            $conn->close();
			            $result->close();
			        }  
			    }   
			  
			?>  
			<form method="post">
			<fieldset>
			<legend>Account Information</legend>
			<label for="user">Username:</label>  
        	<input type="text" name="username" id="user" REQUIRED/>*  
        	<br /> 
        	<label for="pass">Password: </label>
        	<input type="password" name="password" id="pass" required />*  
        	<br />  
        	<label for="confirm">Confirm Password: </label>
        	<input type="Password" name="confirm" id="confirm" required />*
        	<br />
            </fieldset>

            <fieldset>
            	<legend>Personal Information</legend>

            	<label for="fname">First Name: </label>
				<input type="text" name="first" id="fname" required />*<br />

				<label for="lname">Last Name: </label>
				<input type="text" name="last" id="lname" required />*<br />

				<label>Gender: </label>
			    <input type="radio" name="gender" value="male" required>Male</input>
                <input type="radio" name="gender" value="female" required>Female</input>
				<br />

			    <label>Age: </label>
			    <input type="number" name="age" min="0" max="100" step="1" required />*<br />


                <label for="email">Email: </label> 
	     		<input type="email" name="email" required />*<br />

		        <label for="address">Address: </label>
			    <input type="text" name="address" id="address" required>*</input><br />

<!-- 				<label for="intro">Introduction: </label>
			    <textarea name="intro" id="intro"></textarea><br />

                <label>Figure: </label>
                <input type="file" name="figure"></input><br/> -->

                <label>Visibility: </label>
                    <input type="radio" name="visibility" value="1" required />All
                    <input type="radio" name="visibility" value="2" required />FOF
                    <input type="radio" name="visibility" value="3" required />Friend
                    <input type="radio" name="visibility" value="4" required />Only Me
                <br/>
            </fieldset>

        	<input type="submit" name="submit" value="submit"  style = "width: 15% ; text-align: center"/> 
        	<a href="login.php">Already had account? Please login directly!</a>
		</form>
	</div>
</body>
</html>