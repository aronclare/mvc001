
$(document).ready(function () {
	var ios = navigator.userAgent.indexOf('iPhone');//判断是否为ios
	if(ios != -1){  
	    //ios下运行
	    var scroll = document.getElementById("scroll")//你需要滑动的dom元素
	    touchScroll(scroll);
	}
	 
 	var canScroll = true;
	function touchScroll(el) {
		canScroll = false;
	    //el需要滑动的元素
	    el.addEventListener('touchmove',function(e){
	        canScroll = true;
	    })
	    document.body.addEventListener('touchmove',function(e){
// 		    	alert(canScroll);
	        if(!canScroll){
	            e.preventDefault(); //阻止默认事件(上下滑动)
	        }else{
	            //需要滑动的区域
	            var top = el.scrollTop; //对象最顶端和窗口最顶端之间的距离 
	            var scrollH = el.scrollHeight; //含滚动内容的元素大小
	            var offsetH = el.offsetHeight; //网页可见区域高
	            var cScroll = top + offsetH; //当前滚动的距离
	 
	            //被滑动到最上方和最下方的时候
	            if(top == 0){
	                top = 1; //0～1之间的小数会被当成0
	            }else if(cScroll === scrollH){
	                  el.scrollTop = top - 0.1;
	            }
	        }
	    }, {passive: false}) //passive防止阻止默认事件不生效
	}
})