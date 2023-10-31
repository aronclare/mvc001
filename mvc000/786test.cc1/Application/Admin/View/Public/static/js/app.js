function del(msg) { 
//    var msg = "您真的确定要删除吗？\n\n删除后将不能恢复!请确认！"; 
    if (confirm(msg)==true){ 
            return true; 
        }else{ 
            return false; 
    } 
} 