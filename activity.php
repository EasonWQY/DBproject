<!DOCTYPE html>
<html>
<head>
	<title>post activity</title>
  <style type="text/css">
      
  </style>
</head>
<body>
  <?php include 'connect.php'; ?>
  <?php include 'function.php'; ?>	
  <?php include 'header.php';?>
  <div class='container'>
  <?php
	$myid = $_SESSION['myid'];
	if (!$myid) {
		header("location:login.php");
	}
  ?>
  <?php
    if(isset($_POST['create'])&& $_POST['create'] =='create'){
   		$name = $_POST['name'];
   		if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
        $query = "insert into activity(name) values ('$name');";
    	$result = $conn->query($query);
    	if($result){
        	echo "<script>alert('Successfully create!'); history.go(-1);</script>";
    	} else {
        	echo "<script>alert('System error, try again!'); history.go(-1);</script>";
   		}
    	$result->close();
    	$conn->close();
    }
  ?>
   <h2>We already have this activities:</h2>
   <table border="1"><tr><th>id</th><th>name</th><th>stastic</th></tr>
   <?php
       if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
       $query1 = "select * from activity";
        $result = $conn->query($query1); 
        while($row = $result->fetch_assoc()){
        	$name = $row['name'];
        	$id = $row['a_id'];
        	$query2 = "select count(p_id) from post where activity = '$id';";
        	$result2 =  $conn->query($query2);
        	if($result2){
        	$num = $result2->fetch_row()[0];
        	echo "<tr><td>id ".$id."</td><td> <span class='name'>".$name."</span></td><td>".$num." diaries have been posted on this acticity"."</td></div>";
           }
        }	
   ?> 
   </table><br/><br/>
    
  <form method="post">
    <label for="name">please type an activity name:</label>
  	<input type="text" id="name" name="name" required=""></input>
  	<input type="submit" name="create" value="create"></input>
  </form>
  </div>  
</body>
</html>