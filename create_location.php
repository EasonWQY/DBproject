<!DOCTYPE html>
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<style type="text/css">
	label{
		display: inline-block;width: 250px;text-align: right;
	}
</style>
    <script type="text/javascript"    
        src="http://maps.google.com/maps/api/js?sensor=false&language=en"></script>    
    <script type="text/javascript">    
        var geocoder;    
        var map;   

        function initialize() {    
            geocoder = new google.maps.Geocoder();    
            var myOptions = {    
                zoom : 17,//缩放比例    
                //地图类型 •MapTypeId.ROADMAP •MapTypeId.SATELLITE     
                //•MapTypeId.HYBRID •MapTypeId.TERRAIN     
                mapTypeId : google.maps.MapTypeId.ROADMAP    
            }    
            map = new google.maps.Map(document.getElementById("map_canvas"),    
                    myOptions);    
            codeAddress();


        }    
        function codeAddress() {    
            var address = document.getElementById("address").value;
            var lat = document.getElementById('lat');
            var long = document.getElementById('long'); 
            var add =document.getElementById('add');  
            //地址解析    
            geocoder.geocode({    
                'address' : address    
            }, function(results, status) {    
                if (status == google.maps.GeocoderStatus.OK) {    
                    //依据解析的经度纬度设置坐标居中    
                    map.setCenter(results[0].geometry.location);    
                    var marker = new google.maps.Marker({    
                        map : map,    
                        position : results[0].geometry.location,    
                        title : address,    
                        //坐标动画效果    
                        animation : google.maps.Animation.DROP    
                    });  
                    var display = "<b>address: </b>" + results[0].formatted_address; 
                    var position =  results[0].geometry.location;
                    var infowindow = new google.maps.InfoWindow({    
                        content : "<span style='font-size:11px'><b>name: </b>"    
                                + address + "<br>" + display + "<br/><b>location:</b>"+position+"</span>",    
                        //坐标偏移量，一般不用修改    
                        leftpixelOffset : 0,    
                        position : results[0].geometry.location     
        
                    });    
                    //默认打开信息窗口,点击做伴弹出信息窗口    
                    infowindow.open(map, marker);    
                    google.maps.event.addListener(marker, 'click', function() {    
                        infowindow.open(map, marker);    
                    });
                    lat.value = position.lat();
                    long.value = position.lng();
                    add.value = address;
                } else {    
                    alert("Geocode was not successful for the following reason: " + status);    
                }    
            });    
        }
        function latlng(){
  
        }    
    </script>    
</head>  
  
 
<body onload="initialize()"> 
   <?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?> 

	<?php
       if(isset($_POST['submit']) && $_POST['submit']=='submit'){
       	  $lat = $_POST['lat'];
       	  $long = $_POST['long'];
       	  $name =$_POST['name'];
       	  $add = $_POST['add'];
          if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
          $query1 = "insert into  location(longitude,latitude,name,address) values('$long','$lat','$name','$add')";
          $result = $conn->query($query1); 
          if($result){
          		echo "<script>alert('successfully created'); history.go(-1);</script>";  
    		}else{
        		echo "<script>alert('system error, try again!'); history.go(-1);</script>";
          }
       }
	?>
	<div class="container">
        <div id="map_canvas" style="width: 400px; height: 300px; color: black;margin: 0 100px;"></div>  
        <div style="width: 400px; margin: 0 100px;">  
        	<input id="address" type="textbox" value="new york" style="width: 70%">  
    		<input type="button" value="Encode" onclick="codeAddress()">  
  		</div>
  		<div>
           <form method ="post" >
              <label>latitude: </label>
              <input type="text" name="lat" id="lat" /><br>
              <label>longitude: </label>
              <input type="text" name="long" id="long"/><br/>
              <label>address: </label>
              <input type="text" name="add" id="add" /><br/>
              <label>give your own name: </label>
              <input type="text" name="name"/><br/>
              <input type="submit" name="submit" value="submit" />
           </form>
  	   </div>	   
</body>  
</html>