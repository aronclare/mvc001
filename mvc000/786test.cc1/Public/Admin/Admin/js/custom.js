/*
*/
$(document).ready(function(){
  $('#check_button').hover(function(){
   $(this).addClass('swing animated'); 
  },function(){
   $(this).removeClass('swing animated'); 
  }); 
});

function openIt(url,title){
  if($( window ).width()>800){
   layer.open({
   type: 2,
   title:title,
   shadeClose: true,
   shade: 0.8,
   area: ['70%', '70%'],
   content: url //iframe的url
     });
  }else{
  location.href=url;
  }
}
function kill_window(){
    if(top.location != location){  
      var index = parent.layer.getFrameIndex(window.name);
      parent.layer.close(index);
    }else{
    location.href="/index.php";
    }
}

function toggle_apply(){
    $('#apply').fadeIn();
    $('html,body').animate({scrollTop:0 })
}
function toggle_info(){
    $('#apply').fadeOut();
    $('html,body').animate({scrollTop:0 })
}
function tijiao(){
    // $("button").click(function(){
        $("#ssss").submit();
    // });
}
function open_query(url){

    if($( window ).width()>800){
        layer.open({
            type: 2,
            title:'审核进度查询',
            skin: 'layui-layer-rim', //加上边框
            shadeClose: true,
            shade: 0.8,
            area: ['400px', '300px'],
            content:url//iframe的url
        });
    }else{
        location.href=url;
    }
}