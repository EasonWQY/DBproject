<?php include 'function.php'; ?>
<?php include 'connect.php';?>  
<?php
	$uid = $_SESSION['myid'];
	if (!$uid) {
		header("location:login.php");
	}
?>
<?php
	if(isset($_POST["Edit"]) && $_POST["Edit"] == "Edit") {
        $first = $_POST["first"];
        $last = $_POST['last'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $intro =$_POST['intro'];
        $file = $_FILES['figure']['name'];
        $file_type = $_FILES['figure']['type'];
        $file_tmp = $_FILES['figure']['tmp_name'];
        $visibility = $_POST['visibility'];
        echo $file_tmp;

        switch ($file_type) {
        	case 'image/jpeg': $ext = '.jpg'; break;
			case 'image/gif': $ext = '.gif'; break;
			case 'image/png': $ext = '.png'; break;
			case 'image/tiff': $ext = '.tif'; break;
			default: 		   $ext = ''; 	 break;
        }
        
        if ($ext) {
			$url = 'img/'.'profile_'.$uid.$ext;
			$root = getcwd();
			move_uploaded_file($file_tmp, $root.'/img/profile_'.$uid.$ext);
        }else{
        	$url = '';
        	echo "image upload failed due to wrong format";
        }

		if ($conn->connect_error) die($conn->connect_error);
		$query = "select u_id from profile where u_id = '$uid'";
		$result = $conn->query($query);
		$row = $result->num_rows;
		if ($row == 0) {
			$query1 = "insert into `profile`(`u_id`, `first_name`, `last_name`, `gender`, `age`, `email`, `address`, `introduction`, `figure`, `visibility`) VALUES ('$uid','$first','$last','$gender','$age','$email', '$address','$intro', '$url','$visibility')";
			$result1 = $conn->query($query1);
		} else {
			$query2 ="update `profile` set `first_name`='$first',`last_name`='$last',`gender`='$gender',`age`='$age',`email`='$email',`address`='$address',`introduction`='$intro',`last_edit_time`=now(),`visibility`='$visibility' WHERE u_id='$uid'";
			$result2 = $conn->query($query2);
			if($url){
				$query3 = "update `profile` set figure = '$url' where u_id='$uid'";
				$result3 = $conn->query($query3);
			}
			echo "<script>alert('Profile updated successfully!'); history.go(-1);</script>";
		}
	$result->close();
	$conn->close();
	}
	
	
?>
