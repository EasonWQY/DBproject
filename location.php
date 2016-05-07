<!DOCTYPE html>
<html>
<head>
	<title>location</title>
	<style type="text/css">
      td a:link, a:hover{
      	background: lightyellow; color: black;
      }
      td {text-align: center;}
	</style>
  <script type="text/javascript" src="js/sidebox.js"></script>
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class="container">
	 <table border="1"><tr><th>id</th> <th>name</th> <th>stastic</th> </tr>
		<?php
		   if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);  
           $query = "select l_id,name,count(u_id) from location natural left  outer join like_for_location group by l_id,name;";
           $result = $conn->query($query);
           if($result){
           	  while($row = $result->fetch_row()){
           	  	 $l_id = $row[0];
           	  	 $name = $row[1];
           	  	 $count = $row[2];
        ?>
              <tr><td><?php echo $l_id?></td><td><a href="locationinfo.php?name=<?php echo $name?>&lid=<?php echo $l_id?>"><?php echo $name?></a></td><td><?php echo $count?> people likes this place</td></tr>  
        <?php   	  	 
           	  }
           }
		?>
    </table>
    <br/><br/>
    <h4><a href="create_location.php">or create your own location</a></h4>
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