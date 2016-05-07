
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
                $title = $_POST['title'];
                $text = $_POST['text'];
                $figure = $_FILES['userfile1']['name'];
                $figure_type = $_FILES['userfile1']['type'];
                $figure_temp = $_FILES['userfile1']['tmp_name'];


                $multi = $_FILES['userfile2']['name'];
                $multi_type = $_FILES['userfile2']['type'];
                $multi_temp = $_FILES['userfile2']['tmp_name'];

                $activity = $_POST['activity'];
                $visibility = $_POST['visibility'];

        		switch ($figure_type) {
			    	case 'image/jpeg': $ext = '.jpg'; break;
					case 'image/gif': $ext = '.gif'; break;
					case 'image/png': $ext = '.png'; break;
					case 'image/tiff': $ext = '.tif'; break;
					default: 		   $ext = ''; 	 break;
	        	}
	        	if($ext) {
	        		$url = 'img/img'.$activity.$title.$myid.$ext;
	        		$root = getcwd();
					move_uploaded_file($figure_temp,$root.'/img/img'.$activity.$title.$myid.$ext);	        		
	        	}else{
	        		$url ='';
	        	}

        		switch ($multi_type) {
			    	case 'video/mp4': $ext1 = '.mp4'; break;
					case 'audio/mp3': $ext1 = '.mp3'; break;
					case 'audio/wma': $ext1 = '.wma'; break;
					case 'video/avi': $ext1 = '.avi'; break;
					case 'video/mov': $ext1 = '.mov'; break;
					default: 		   $ext1 = ''; 	 break;
	        	}
	        	if($ext1) {
	        		$url1 = 'img/multimedia/multi'.$activity.$title.$myid.$ext1;
					$root = getcwd();
					 move_uploaded_file($multi_temp, $root.'/img/multimedia/multi'.$activity.$title.$myid.$ext1);	
				}else{
	        		$url1 ='';
	        	}

	        	if ($conn->connect_error) die($conn->connect_error);
	        	$query1 = "insert into post(visibility, u_id, activity, title, text, figure, multimedia) VALUES ('$visibility','$myid','$activity','$title','$text','$url','$url1')";
	        	$result = $conn->query($query1);
	        	if($result){
                    echo "<script>alert('successfully posted'); history.go(-1);</script>"; 
	        	}else{
	        		echo "<script>alert('system error, try again!'); history.go(-1);</script>";
	        	}

         	}
 	    ?>

