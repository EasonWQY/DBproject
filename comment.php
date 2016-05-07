 <?php
	session_start();
	$myid = $_SESSION['myid'];
	if (!$myid) {
		header("location:login.php");
	}
?>
 <?php 
 	$conn = new mysqli("127.0.0.1","root","", "project_music"); 

 	if (isset($_POST['comment']) && $_POST['comment']=='comment') {
 		$text = $_POST['input'];
 		$pid = $_POST['pid'];
 		if ($text == "") {
 			echo "<script>alert('Please enter some comment!'); history.go(-1);</script>";
 		} else {  
            $insert = "insert into comment(p_id,u_id,content) values('$pid', '$myid', '$text')";
            $result = $conn->query($insert);

            if ($result) {
                  echo "<script>alert('Successfully comment!'); history.go(-1);</script>";
            } else {
                  echo "<script>alert('System error, try again!'); history.go(-1);</script>";
            }
 		}
 	}



 	if (isset($_POST['reprint']) && $_POST['reprint'] == 'reprint') {
		$pid= $_POST['pid'];
        $uid= $_POST['uid'];
        $result = $conn->query("select activity,title,text,figure,multimedia from post where p_id = '$pid';");
        if($result){
        	$row = $result->fetch_assoc();
        	$title = $row['title']." (reprint from ".$uid.")";
        	$text = $row['text'];
        	$figure = $row['figure'];
            $act = $row['activity'];
        	$multimedia = $row['multimedia'];
        	$result2 = $conn->query("insert into post(visibility, u_id, activity,title, text, figure, multimedia) VALUES (1,'$myid','$act',$title','$text','$figure','$multimedia')");
        	if ($result2) {
			echo "<script>alert('Successfully reprint to your diary!'); history.go(-1);</script>";
		    } else {
			echo "<script>alert('Fail to repin!'); history.go(-1);</script>";
		    }
        }
	} 

 ?>
	