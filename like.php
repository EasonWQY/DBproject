<?php  
	include 'connect.php';
	include 'function.php';

	$like =$_GET['like'];
	if(isset($_GET['pid']) && !empty($_GET['pid'])){
	    $pid = $_GET['pid'];
	}
	if(isset($_GET['lid']) && !empty($_GET['lid'])){        
		$lid = $_GET['lid'];
	}
	if(isset($_GET['cid']) && !empty($_GET['cid'])){
    	$cid = $_GET['cid'];
	}
    $myid =$_SESSION['myid'];

	if ($like == 'like_diary') {
	$conn->query("insert into like_for_post(p_id, u_id) values('$pid', '$myid')");
	}

	if ($like == 'dislike_diary') {
	$conn->query("delete from like_for_post where p_id='$pid' and u_id='$myid';");
	}

	if ($like == 'like_comment') {
	$conn->query("insert into like_for_comment(c_id, u_id) values('$cid', '$myid')");
	}

	if ($like == 'dislike_comment') {
	$conn->query("delete from like_for_comment where c_id='$cid' and u_id='$myid';");
	}

    if ($like == 'like_location') {
	$conn->query("insert into like_for_location(l_id, u_id) values('$lid', '$myid')");
	}
	if ($like == 'dislike_location') {
	$conn->query("delete from like_for_location where l_id='$lid' and u_id='$myid';");
	}

    echo "<script>alert('liked/disliked successfully!'); history.go(-1);</script>";
?>