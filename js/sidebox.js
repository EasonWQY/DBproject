
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