<!DOCTYPE html>
<html>
<head>
	<title>Photos View</title>
	<link rel='stylesheet' href='style.css' />
	<style type="text/css">
        #sidebox{width: 83px;height: 200px;background: url('img/bg3.jpg');position: absolute;left: 0;bottom: 0;}
        h5{
        	background:lightyellow; color:purple;width:50%;margin:0 auto;text-align:center;opacity: 0.7;
        }
    </style>
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
		<?php
			$pid = $_GET['p_id'];
			if (isset($_GET['uid']) && !empty($_GET['uid'])) {
				$uid = $_GET['uid'];
			} else {
				$uid = $_SESSION['myid'];
			}
			$myid = $_SESSION['myid'];
			$username = $uid;
		?>

		
		<?php
			if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
            $query = "select * from post where p_id = '$pid'"; 
            $result = $conn->query($query);
            if(!$result) die ($conn->error);
            $run = $result->fetch_assoc();
            $title = $run['title'];
            $pubtime = $run['publishtime'];
            $text = $run['text'];
            $figure = $run['figure'];
            $activity = $run['activity'];
            $multi = $run['multimedia'];  
        ?>
			<div id="view_box">
			    <h2 style='text-align: center;margin:0 auto;'>Title: <?php echo $title;?></h2>
			    <h4 style='text-align: center;margin:0 auto;'>Author: <?php echo $username;?></h4> 
			    <h4 style='text-align: center;margin:0 auto;'>time: <?php echo $pubtime?></h4>
			    <p style="width: 100%; word-wrap: break-word;word-break: normal; "><?php echo $text;?></p>
			    <?php 
				    if($figure){
					    echo "<img src='$figure' style='width:80%;display:block;margin:0 auto;'/>";
					}
					if($multi){
						echo "<div style='text-align:center'><video src='$multi' controls='controls'></video></div>";
					}
				?>
						<?php
			 $query = "select name,l_id from post_location natural join post where p_id = '$pid'"; 
            $result = $conn->query($query); 
            if($result){
                $run = $result->fetch_assoc();
                $location = $run['name'];
                $lid = $run['l_id'];
                if($location){
                   echo "<h4>The Location is: <a href='locationinfo.php?name=$location&lid=$lid'>$location</a>, you can click here for more details.</h4> ";
                }else{
                	echo "<h5 >There is no location information for this post.</h5>";
                	echo "<a href='addlocation.php?pid=$pid'><h5>click here to add a location</h5></a>";
                }
            }    
		?>
				<br/>
				<span style="display:block; text-align: center;background: black; color:lightyellow;opacity:0.5 ">
					<?php
						$search = "select count(*) from like_for_post where p_id = '$pid'"; 
            			$cresult = $conn->query($search);
            			if($cresult){  
            			  $count = $cresult->fetch_row()[0];
            			  $cresult->close();
            		    }else{
            		    	$count = 0;
            		    }
                        echo $count." people likes this post!";
					?>
					<br/>
					<a href="like.php?like=like_diary&pid=<?php echo $pid?>"><img src="img/like.jpg" style="width: 40px"></a>
				    <a href="like.php?like=dislike_diary&pid=<?php echo $pid?>"><img src="img/dislike.jpg" style="width: 40px"></a><br/>


				</span>


			<div style="background: black; color:lightyellow; opacity:0.5">
				<h3>All comments:</h3><hr/>
				<?php
					if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
			        $query = "select * from comment where p_id = '$pid' order by publishtime asc"; 
			        $result = $conn->query($query);  
			        if(!$result){
			        	echo "no one has comment this diary.";
			        }else{
				        while ($run = $result->fetch_assoc()) {	
				        	$uid = $run['u_id'];
				        	$cid = $run['c_id'];	    
				        	$content = $run['content'];
				        	$time = $run['publishtime'];
				?>        	
				            <div>
				            	<h4>&nbsp;&nbsp;comment from <?php echo $uid." "?></h4>
				            	<p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $content ?></p>
						    <?php
								$search = "select count(*) from like_for_comment where c_id ='$cid'"; 
								$cresult = $conn->query($search);
								if($cresult){  
								  $count = $cresult->fetch_row()[0];
								  $cresult->close();
								}else{
								  $count = 0;
								}
								echo "<p style='text-align:right;font-size:10px;'>".$count." people likes this post!";
						    ?>
                                <a href="like.php?like=like_comment&cid=<?php echo $cid?>"><img src="img/like.jpg" style="width: 20px"></a>
			    			    <a href="like.php?like=dislike_comment&cid=<?php echo $cid?>"><img src="img/dislike.jpg" style="width: 20px"></a></p>
			    			    <hr/>
				            </div>
				<?php	}
					}
				?>
			</div>
				<h3>Add a comment</h3>
				<form action="comment.php" method="post">
						<label for="input" style="vertical-align: top;">comment: </label>
						<textarea name="input" id="input" style="width: 80%; height: 100px;"></textarea><br />
						<input type="text" name="pid" value="<?php echo $pid?>" hidden/>
						<input type="submit" name="comment" value="comment" style="float: right;" />
						<div class="clear"></div>
		        </form> 
		</div>        
	</div>
	<div id="sidebox">
		<form action="comment.php" method="post">
		    <input type="text" name="pid" value="<?php echo $pid?>" hidden/>
		    <input type="text" name="uid" value="<?php echo $username?>" hidden/>
			<input type="submit" name="reprint" value="reprint" style="width: 90%; background: none; position: relative; top: 50%">
		</form>
	</div>
</body>
</html>