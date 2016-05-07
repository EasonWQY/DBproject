<html>
<head>
	<title>Search</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	
	<div class='container'>
		
			<br /><br />
			<h3>Input to search : </h3>
			<br /> 
			<form method='get' >
			<select name="typesearch" >
			    <option value = "none"
                 <?php
                   	if(!isset($_GET['typesearch'])){
                        echo "selected = 'selected'";
				     }
                 ?> 
			    >none</option>
                <option value="activity" 
				<?

				if ($_GET['typesearch'] == 'activity'){
						?>
							selected="selected"
						<?
				}
				?>
                >activity</option>
                <option value="diary" 
                   <?
                        if($_GET['typesearch'] == 'diary'){
                        	?>
                              selected = "selected"
                        	<?
                        }
                   ?>
                   >diary</option>

                <option value="profile"
                <?
                if($_GET['typesearch'] == 'profile'){
                        ?>
                        selected = "selected"
                <?
                 }
                ?> 
                >profile</option>


                <option value="location"
				<?
					if ($_GET['typesearch'] == 'location'){
						?>
							selected="selected"
						<?
					}
				?>

                >location</option>

                <option value="comment"
            

                >comment</option>
			</select>
			<br />
			<br /> 

			<input type='text' name='input' value = ''/> 
			

			<span><input type='submit' name='submit' value='search' /></span>
			
            <br />
            <br />

		<?php
				// $type = $_POST['type'];

		$type = isset($_GET['typesearch']) ? $_GET['typesearch'] : false;
        $submit = isset($_GET['sumbit']) ? $_GET['submit'] : false;
        $input = isset($_GET['input']) ? $_GET['input']: false;

		if($type == 'diary'){	
		if($input == null){
        	echo 1;
        }		
            $query = "select u_id, title, publishtime ,text from post where text like '%$input%' order by publishtime desc;";
            $result = $conn->query($query);
            if($result){
           	     while($row =$result->fetch_row()){
	           	  	 $u_id = $row[0];
	           	  	 $title = $row[1];
	           	  	 $publishtime = $row[2];
	           	  	 $text = $row[3];    
	           	  	 ?>
	           	  	  <p><?php echo $u_id?><p><a href="locationinfo.php?title=<?php echo $title?>&p_id=<?php echo $u_id?>"><?php echo $title?></a><p><?php echo $publishtime?><p><?php echo $text?>
	           	  	 <?php
                 }
            }             
        }
        ?>


        
        <?php 
             if($type == 'location'){

             	$query = "select l_id, name from location where name like '%$input%' order by l_id asc ; ";
             	$result = $conn->query($query);
             	if($result){

             		while($row = $result->fetch_row()){
             			$l_id = $row[0];
             			$name = $row[1];
             		?>
             		<p>username: <?php echo $l_id;?><p><a href="locationinfo.php?name=<?php echo $name?>&lid=<?php echo $li_d?>">Location:<?php echo $name;?></a>

                   <?
             		}
             	}
            }
        ?>

  
             

               <?php 
             if($type == 'profile'){

             	$query = "select u_id, first_name, last_name, gender, age, email, address from profile where first_name like '%$input%' or last_name like '%$input%' order by last_name asc; ";
             	$result = $conn->query($query);
             	if($result){

             		while($row = $result->fetch_row()){
             			$u_id = $row[0];
             			$first_name = $row[1];
             			$last_name = $row[2];
             			$gender = $row[3];
             			$age = $row[4];
             			$email = $row[5];
             			$address = $row[6];
             		?>
             		<p>username: <?php echo $u_id;?><p> first_name:<?php echo $first_name;?> <p> last_name : <?php echo $last_name ;?> <p> gender: <?php echo $gender;?> <p> age: <?php echo $age;?> <p> email: <?php echo $email;?> <p> address:<?php echo $address;?>

                   <?
             		}
             	}
            }
        ?>

         <?php 
             if($type == 'comment'){

             	$query = "select u_id, content , publishtime from comment where content like '%$input%' order by publishtime desc ; ";
             	$result = $conn->query($query);
             	if($result){

             		while($row = $result->fetch_row()){
             			$u_id = $row[0];
             			$content = $row[1];
             			$publishtime = $row[2];
             		?>
             		<p>username: <?php echo $u_id;?><p> Location:<?php echo $content;?>
             		<p><?php echo $publishtime ; ?>

                   <?
             		}
             	}
            }
        ?>

           <?php 
             if($type == 'activity'){

             	$query = "select a_id, name from activity where name like '%$input%' order by a_id asc ; ";
             	$result = $conn->query($query);
             	if($result){

             		while($row = $result->fetch_row()){
             			$a_id = $row[0];
             			$name = $row[1];
             			
             		?>
             		<p>Username: <?php echo $a_id;?><p>Activity:<?php echo $name;?>
             		

                   <?
             		}
             	}
            }
        ?>



 


			<br /><br />
		</form>
	</div>
</body>
</html>