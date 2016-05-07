<?php
	include 'function.php';
	include 'connect.php';
	$myid = $_SESSION['myid'];
	$query = "update user set last_login_time = now() where u_id ='$myid'";
	$conn->query($query);
    session_destroy();
    header("location:login.php");
?>