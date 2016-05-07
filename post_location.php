
<?php include 'connect.php'; ?>
<?php include 'function.php'; ?>	
<?php
	$myid = $_SESSION['myid'];
	if (!$myid) {
		header("location:login.php");
	}
?>

<?php
    if(isset($_POST['submit']) && $_POST['submit'] == 'submit'){
        $pid = $_POST['pid'];
        $lid = $_POST['location'];
        $query1 = "select name from location where l_id = '$lid'";
        $result = $conn->query($query1); 
        if($result){
        	$name = $result->fetch_assoc()['name'];
        	$query2 = "insert into post_location(p_id,l_id,name) values('$pid','$lid','$name');";
        	$result2 = $conn->query($query2);
        	if($result2){
        		 echo "<script>alert('successfully posted'); history.go(-1);</script>";
			     header("location:profile.php");  
	        }else{
	        	 echo "<script>alert('system error, try again!'); history.go(-1);</script>";
	       	}
        }else{
        	echo "<script>alert('something wrong '); history.go(-1);</script>";
        }  
    }
?>