(function($){
	$.fn.myScroll = function(options,liRowHeight){
	//默认配置
	var defaults = {
		speed:40,  //滚动速度,值越大速度越慢
		rowHeight:liRowHeight //每行的高度
	};
	
	var opts = $.extend({}, defaults, options),intId = [];
	
	function marquee(obj, step){
	
		obj.find("ul").animate({
			marginTop: '-=1'
		},0,function(){
				var s = Math.abs(parseInt($(this).css("margin-top")));
				if(s >= step){
					$(this).find("li").slice(0, 1).appendTo($(this));
					$(this).css("margin-top", 0);
				}
			});
		}
		this.each(function(i){
			var sh = opts["rowHeight"],speed = opts["speed"],_this = $(this);
			intId[i] = setInterval(function(){
				if(_this.find("ul").height()<=_this.height()){
					clearInterval(intId[i]);
				}else{
					marquee(_this, sh);
				}
			}, speed);

		});

	}

})(jQuery);
$(document).ready(function () {
	
	//中奖列表
	var liRowHeight = parseInt($("div.winnerListBox li").css('height'));
	$("div.winnerListBox").myScroll({
		speed:40,
		rowHeight:liRowHeight
	},liRowHeight);
	
	//轮播图
	var  certifySwiper2 = new Swiper('.banner .swiper-container', {
    watchSlidesProgress: true,
    slidesPerView: 'auto',
    centeredSlides: true,
    loop: true,
    loopedSlides: 6,
    autoplay: true,
    autoplay: {
	    disableOnInteraction: false,
	  },
  })

	//选项卡
	$('.OP-left-box li').on('click',function(){
		$('.OP-central-box').eq($(this).index()).show().siblings().hide();
		$(this).addClass('active').siblings().removeClass('active')
	})
	
	//下拉插件调用
		$('.selectList').selectMania({
		    themes: ['green'], 
		    placeholder: 'Please select me!'
		});
		
})

	//弹出层
	
	//进度查询
$('.searchBtn').on('click', function(){
	layer.open({
		title: false,
    skin: 'TCClass',
		closeBtn:2,
	  type: 1,
	  shadeClose: true, //点击遮罩关闭
	  content: $('#popup'),
	  area: ['6.63rem'],
	});
});

//规则页面
function applyBtn2(id){
	
	
	$.ajax({
      url: '/index.php/index/ta2',
      dataType: 'json',
      type: 'POST',
      data: {
        //username: $('#username').val(),
        id: id,
        
      },
      success: function (result) {
		  
		alert(result.status);
		
		
		layer.open({
		type: 1,
		skin: 'ruleClass',
		content: $('#rulePage'),
		anim: 1,
		  area: ['7.5rem', '100%'],
		  zIndex:900,
		  title: false
		}); 
		
      }
    })
	
	
	
	
}

//申请弹窗
function applyBtn(obj){
		
				
		
	
		
	var cid = 	obj.id;
	var title = 	obj.title;
		
	
	$("#cate_id").val(cid);	
	
	
	
	if(cid == 65){
		
		$("#uli").show();
				
	}else{
		
		$("#uli").hide();
	}	
	
	 if(cid == 26){
		
		$("#uli2").show();
				
	}else{
		
		$("#uli2").hide();
	}		 
	
	
	
	$("#objtitle").html(title);
	
		
	var add = "index.php/index/ta?cid="+cid;
	$(function(){
		$.ajax({
			url: add,
			dataType: 'json',
			type: 'GET',
			data: cid,
			success: function (result) {
				
				
				var data = JSON.parse( result );
				
				var str="";
				for(i=0;i<data.length;i++){               			
				
                str+="<input type='text' id='"+data[i].name+"' name='"+data[i].name+"' placeholder='"+data[i].title+"'>";
    
                      
                }


               	

                $(".fields").html(str);
	
				layer.open({
					title: false,
				skin: 'applyPopup',
					closeBtn:2,
				  type: 1,
				  shadeClose: true, //点击遮罩关闭
				  area: ['6.63rem'],
				  content: $('#applyPopup')
				});
			}
		})
	});
			
	
}

//进度查询提交按钮
function cCAIPS(){
	
	console.log($('.select-mania-value').attr('data-value'))
}


function submit_apply(id) {
	var _username = $("#username1").val();		
	var _verify = $("#verify").val();
		
	if(_username == ""){
	alert("请输入用户名！");
	$("#username").focus();
	return false;
	}else if(_verify.length != 4){
	{
		alert("请输入4位验证码！");
		$("#verify").focus();
		return false;
	}
	}else{
	var postData = $("#myForm").serializeArray();
	var add = "index.php/game/add.html";
	$(function(){
		$.ajax({
			url: add,
			dataType: 'json',
			type: 'POST',
			data: postData,
			success: function (result) {
				alert(result.msg);
				apply_window.close();
				
				$("#applyPopup").hide();
				
				
			}
		})
	});
	}
}

function submit_query2() {
			
			
 if ($('#username').val() && $('#xiangmu').val()) {
    $.ajax({
      url: '/index.php/query/index',
      dataType: 'json',
      type: 'POST',
      data: {
        username: $('#username').val(),
        id: $('#xiangmu').val(),
      },
      success: function (result) {
		alert(result.msg);
      }
    })
  } else {
		alert('用户名或者查询项目不能为空，请检查')
  } 
  
}