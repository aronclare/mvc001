/*
 */
jconfirm.defaults = {
  title: '提示',
  titleClass: '',
  type: 'default',
  useBootstrap: false,
  boxWidth: '400px',
  bgOpacity: '.7',
  animateFromElement: false,
  animation: 'top',
  closeAnimation: 'bottom',
  theme: 'se7en',
  backgroundDismiss: true,
}
$(document).ready(function () {
  new WOW().init();
  $('#board .slider ul').bxSlider({
    // mode:'vertical',
    auto: true,
  })
  $(document).on('click', 'dl.select dt', function () {
    $(this).parent().toggleClass('show')
  })
  $(document).on('click', 'dl.select dd a', function () {
    $(this).parent().parent().removeClass('show')
    $(this).parent().parent().find('dt span').html($(this).html())
    $(this).parent().parent().find('dt input').val($(this).attr('rel_value'))
  })
});

function show_game(url,name,id) {
  game_window = $.alert({
    boxWidth: '1100px',
    closeIcon: true,
    content: function () {
      var self = this;
      return $.ajax({
        url: url,
        dataType: 'html',
        method: 'get'
      }).done(function (response) {
        self.setContent(response);
      }).fail(function () {
        game_window.close()
        v_alert('网络连接失败，请稍后再试');
      });
    }
  })
}

function kill_window() {
  game_window.close()
}

function kill_query_window() {
  query_window.close()
}

function apply_game(url) {
    apply_window = $.alert({
        closeIcon: true,
        content: 'URL:'+url,
        boxWidth: '460px',
        onContentReady: function (data, status, xhr) {
            laydate.render({
                elem: '#datetime' //指定元素
            });
        }
    })
}




function submit_apply(id) {
    var _username = $("#username").val();
    var _verify = $("#verify").val();
    if(_username == ""){
        v_alert("请输入用户名！");
        $("#username").focus();
        return false;
    }else if(_verify.length != 4){
        {
            v_alert("请输入4位验证码！");
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
                    v_alert(result.msg);
                    apply_window.close()
                }
            })
        });
    }
}

function open_query(url) {
  // console.log(url)
  query_window = $.alert({
    boxWidth: '460px',
    closeIcon: true,
    content: function () {
      var self = this;
      return $.ajax({
        url: url,
        dataType: 'html',
        method: 'get'
      }).done(function (response) {
        self.setContent(response);
      }).fail(function () {
        query_window.close()
        v_alert('网络连接失败，请稍后再试')
      });
    }
  })
}

function submit_query(id) {
  if ($('#username').val() && $('#id').val()) {
    $.ajax({
      url: '/index.php/query/index',
      dataType: 'json',
      type: 'POST',
      data: {
        username: $('#username').val(),
        id: $('#id').val(),
      },
      success: function (result) {
        v_alert(result.msg);
      }
    })
  } else {
    v_alert('用户名或者查询项目不能为空，请检查')
  }
}

function v_alert(content) {
  $.alert({
    content: content,
    autoClose: 'ok|4000',
    closeIcon: true,
    boxWidth: '360px',
  })
}