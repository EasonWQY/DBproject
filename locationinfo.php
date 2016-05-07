<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Location info</title>
	  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
 
</head>
<body onload="init()">
     <?php include 'connect.php';?>
     <?php include 'function.php';?>
     <?php include 'header.php';?>

     <div class="container viewbox">
        <div id="view_box">
          <?php
             $lid = $_GET['lid'];
             $name = $_GET['name'];
             $myid = $_SESSION['myid'];
          ?>

          <?php  
            if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
            $query = "select * from location where l_id = '$lid'";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            $run = $result->fetch_assoc();
            $lat = floatval($run['latitude']);
            $lng = floatval($run['longitude']);
            $address = $run['address']; 
          ?>
          <h1 style="color: lightyellow; background: black;opacity: 0.5">The location is :</h1>
          <div id="map" style="width: 100%;height: 400px; color: black;margin: auto; opacity: 0.7"></div>
    
         <br/>
		<span  style="display:block; text-align: center;background: black; color:lightyellow;opacity:0.5 ">
			<?php
				$search = "select count(*) from like_for_location where l_id = '$lid'"; 
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
			<a href="like.php?like=like_location&lid=<?php echo $lid?>"><img src="img/like.jpg" style="width: 40px"></a>
		    <a href="like.php?like=dislike_location&lid=<?php echo $lid?>"><img src="img/dislike.jpg" style="width: 40px"></a><br/>
		</span>
		</div>
     </div>
<?php
  echo "<script type='text/javascript'>
        var lat =$lat; 
        var lng =$lng; 
        var name ='$name';
        var address = '$address';
        </script>";   
?>    
  <script type="text/javascript">
    function init()
    {  
      var latlng = new google.maps.LatLng(lat,lng); 	
      var mapProp = {      
         center:latlng,
         zoom:5,
         mapTypeId:google.maps.MapTypeId.ROADMAP
      };

      var map1 = new google.maps.Map(document.getElementById('map'),mapProp);
      var marker = new google.maps.Marker(
        {
          position:latlng,
          map:map1
        });
      // 设定标注窗口，附上注释文字
      var infowindow = new google.maps.InfoWindow(
        {
          content:"<b>name: </b>"+name+"<br/><b>address: </b>"+address+"<br/><b>position: </b>"+latlng
        });
      // 打开标注窗口
      infowindow.open(map1,marker);
    }
  </script>
</body>
</html>