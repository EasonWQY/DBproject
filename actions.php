<?php 
	include 'connect.php';
	include 'function.php';

	$action = $_GET['action'];
	$uid = $_GET['uid'];

	$myid = $_SESSION['myid'];
	$bid = $_GET['bid'];


	if ($action == 'send') {
		$conn->query("insert into firend_request(sent_id, receiver_id) values('$myid', '$uid')");
	}

	if ($action == 'cancel') {
		$conn->query("delete from firend_request where sent_id='$myid' and receiver_id='$uid'");
	}

	if ($action == 'accept') {
		$conn->query("update firend_request set isAccept=true where sent_id ='$uid' and receiver_id='$myid'");
	}
	
	if ($action == 'ignore') {
		$conn->query("delete from firend_request where sent_id='$uid' and receiver_id='$myid' and isAccept=false");
	}

	if ($action == 'unfriend') {
		$conn->query("delete from firend_request where (sent_id='$uid' and receiver_id='$myid' and isAccept=true) or (sent_id='$myid' and receiver_id='$uid' and isAccept=true)");
	}


	// if ($action == 'follow') {
	// 	$conn->query("insert into follow(uid, bid, time) values('$myid', '$bid', now())");
	// } 
	// if ($action == 'unfollow') {
	// 	$conn->query("delete from follow where uid='$myid' and bid='$bid'");
	// }
	
	header('location: profile.php?uid='.$uid);
?>