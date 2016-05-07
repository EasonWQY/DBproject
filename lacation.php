<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCBlsLNqzGLwP95JkGYIor7i15g7pfDvkc&sensor=TRUE"></script> -->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCBlsLNqzGLwP95JkGYIor7i15g7pfDvkc&sensor=TRUE"></script>   
<script type="text/javascript"> 
var map;  
var marker;  
var infowindow;  
var geocoder;  
var markersArray = [];  
var content = document.getElementById("content");  
var loca = document.getElementById("loca")  
var addr = document.getElementById("addr")  
function initialize() {  
    geocoder = new google.maps.Geocoder();   
    var latlng = new google.maps.LatLng(28.212651557421317,112.94564378840637);  
    var myOptions = {  
        zoom: 9,  
        center: latlng,  
        navigationControl: true,  
        scaleControl: true,  
        streetViewControl: true,        
        mapTypeId: google.maps.MapTypeId.ROADMAP  
    };  
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);  
      
    google.maps.event.addListener(map, 'click', function(event) {  
        placeMarker(event.latLng);  
    });  
  }  
function placeMarker(location) {  
    clearOverlays(infowindow);  
    marker = new google.maps.Marker({  
        position: location,   
        map: map  
    });  
    markersArray.push(marker);  
      
    var _cs = [];  
    _cs[_cs.length] = "坐标为：";  
    _cs[_cs.length] = location.lat();  
    _cs[_cs.length] = ",";  
    _cs[_cs.length] = location.lng();  
      
    loca.innerHTML = _cs.join("");  
      
    if (geocoder) {  
      geocoder.geocode({'location': location}, function(results, status) {  
        if (status == google.maps.GeocoderStatus.OK) {  
          if (results[0]) {  
            addr.innerHTML = " 地址为：" + results[0].formatted_address;  
          }   
        } else {  
            alert("Geocoder failed due to: " + status);  
        }  
      });  
    }  
      
    content.style.display = "";  
   
    infowindow = new google.maps.InfoWindow({     
        content: content,  
        //size: new google.maps.Size(50,50),  
        position: location  
    });  
    infowindow.open(map);  
 }  
   
  // Deletes all markers in the array by removing references to them  
function clearOverlays(infowindow) {  
    if (markersArray) {  
        for (i in markersArray) {  
            markersArray[i].setMap(null);  
        }  
        markersArray.length = 0;  
    }  
    if(infowindow){  
        infowindow.close();  
    }  
}  
</script>  
</head>
<body>
 <body onload="initialize()">  
<div id="map_canvas"></div>  
<div id="content" style="display:none;" mce_style="display:none;" ><span id="loca"></span><br />  
  <span id="addr"></span></div> 
</body>
</html>