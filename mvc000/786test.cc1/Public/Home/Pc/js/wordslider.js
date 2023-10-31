function autoScroll(obj){ 
    var scheight="-32px";
    $(obj).find(".list").animate({ 
        marginTop :scheight 
    },500,function(){ 
        $(this).css({marginTop : "0px"}).find("li:first").appendTo(this); 
    }) 
} 
$(function(){ 
    setInterval('autoScroll(".winner_list")',2000) 
}) 