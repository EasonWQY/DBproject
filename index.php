<!DOCTYPE html>
<html>
<head>
	<title>Friend System</title>
	<link rel='stylesheet' href='style.css' />
	
    <script type="text/javascript" src="js/sidebox.js"></script>
	<script type="text/javascript">
	 window.onload = function(){
		window.onscroll = function () {
            var oDiv = document.getElementById('sidebox');
            var DivScroll = document.documentElement.scrollTop|| document.body.scrollTop;;     
            move(parseInt((document.documentElement.clientHeight - oDiv.offsetHeight) / 2 + DivScroll)); 
        };
        var timer = null; 
        function move(end) {
                    clearInterval(timer);       
            timer = setInterval(function () {       
                var oDiv = document.getElementById('sidebox');
                var speed = (end - oDiv.offsetTop) / 5;    
                speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed);       
                if (oDiv.offsetTop == end) {        
                    clearInterval(timer);
                }
                else {
                    oDiv.style.top = oDiv.offsetTop + speed + 'px';  
                }
            }, 30);
        }
      }  
	</script>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<div class='background'>
		     <?php  
               if(!loggedin()){ ?>
                  <h1 style="text-align: center;">Welcome to our Music Fan's society</h1>
                  <p><br/><br/>It's a happy world of our music fans</p>
                  <p>You can share everything about music with us in our zone</p>
                  <p>Your favourite stars ...</p>
                  <p>The upcoming concert...</p>
                  <p>Adorable songs...</p>
                  <p>Come on! Stop waitting  and join us right now!</p>

              <?php }
             else{ ?>
			<br/>
			<h2> Your missed news!</h2>
			<?php // revise sql and while loop
				$myid = $_SESSION['myid'];
			    $query1 = "call show_diary('$myid');"; 
			    $query2 = "select * from temp_diary natural join activity where publishtime >= (select last_login_time from user where u_id='$myid') order by activity asc,publishtime desc; " ; 
			    $conn->query($query1);
			    $result = $conn->query($query2);
			    if(!$result) die ($conn->error);
			    $row =mysqli_fetch_assoc($result);
			    echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;Activity: ".$row['name']."</h4>";
			    echo "<div style='width:60%; margin:10px auto; background: white; opacity:0.6;color: black;'>";
			    
			    while ($row) {
			    	$pid = $row['p_id'];
			    	$uid = $row['u_id'];
			    	$title = $row['title'];
			        $figure = $row['figure'];
			        $text = $row['text'];
			    	$multimedia =$row['multimedia'];
			    	$pubtime = $row['publishtime'];
			    	$activity = $row['activity'];			    	
			?>


			<div id="view_box" style="width:100%">
				<a style ="color: black" href='viewphoto.php?p_id=<?php echo $pid?>&uid=<?php echo $uid?>'>
				<p style="text-align: center; margin: 2px auto"><?php echo $title ?></p></a>
				<p style="text-align: center; font-size: 7px; margin: 2px auto ">From: <?php echo $uid?></p>
				<p style="text-align: center; font-size: 7px; margin: 2px auto ">Time: <?php echo $pubtime?></p>
				<?php 
                   if($text){
                   	 echo "<p style='font-size: 10px; overflow: hidden;white-space: nowrap;text-overflow: ellipsis;'>&nbsp;&nbsp;&nbsp;&nbsp;$text<p>";
                   }
                   if($figure){
                   	 echo "<img src='$figure' style='width:50%; display:block; margin:auto;' >";
                   }
				?>
				<!-- <span><a href='unfollow.php?action=unfollow&bid=<?php echo $bid1;?>' class='box' style='display:block'>unfollow</a></span>-->
			</div> 

			<?php 
			     $row =mysqli_fetch_assoc($result);
			     if($row['activity'] != $activity){
			     	echo "</div>";
			     	if($row['activity']){
			     	echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;Activity: ". $row['name']."</h4>";
			        echo "<div style='width:60%; margin:10px auto; background: white; opacity:0.7;color: black;'>";
			        }
			     }
				}
			 }
			?>
	 	</div>	
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