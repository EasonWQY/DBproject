<!DOCTYPE html>
<html>
<head>
	<title>add location</title>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>
	<div class='container'>
        <?php
               $pid = $_GET['pid'];
        ?>
    <form method="post" action="post_location.php" >
        <label>choose a location</label>
        <select name="location" required>
          	<?php
                if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
                $query1 = "select * from location";
                $result = $conn->query($query1); 
                while($row = $result->fetch_assoc()){
                $name = $row['name'];
                $lid = $row['l_id'];
                $address = $row['address'];
                echo "<option value='$lid'>".$lid." ".$name." ".$address."</option>";
                }
          	?>
    	</select>

   		<a href="create_location.php">or create your own location</a><br/>
      <input type="text" name="pid" value="<?php echo $pid?>" hidden/> 
    	<input type="submit" name="submit" value="submit" />
    </form>
	</div>
</body>
</html>