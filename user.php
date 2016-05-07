<?php
    $myid = $_SESSION['myid'];
    if (!$myid) {
        header("location:login.php");
    }
?>


<?php // revise sql and while loop
  if($show ==false){
    echo "<h3 style='margin:0;'>all the posts of this user</h3>";
    echo "<span style='font-size:12px;'>(click to add location or delete it)</span><br/><br/>"
    ;
	if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
    $query = "select p_id,title,publishtime from post where u_id = '$myid' order by publishtime desc"; 
    $result = $conn->query($query);
    if(!$result) die ($conn->error);
    $row =mysqli_fetch_assoc($result);
    while ($row) {
    	$pid= $row['p_id'];
        $title = $row['title'];
    	$time = $row['publishtime'];
    	$row =mysqli_fetch_array($result);
?>
<div>
	<a href='viewphoto.php?p_id=<?php echo $pid?>&uid=<?php echo $uid?>'>
      <?php echo $title ?>
    </a><span style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;publishtime: <?php echo $time ?></span>
	<br /><br/>
</div>

<?php 
	}
  }  
?>