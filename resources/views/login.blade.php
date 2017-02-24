<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>用户登录</title>
<meta name="keywords" content="梵火、梵火博客、文章" />
<meta name="description" content="博客登录注册界面" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="./js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="./js/login.js"></script>
<link href="./css/login2.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>梵火博客用户界面</h1>

<div class="login" style="margin-top:50px;">
    
    <div class="header">
        <div class="switch" id="switch"><a class="switch_btn_focus" id="switch_qlogin" href="javascript:void(0);" tabindex="7">快速登录</a>
			<a class="switch_btn" id="switch_login" href="javascript:void(0);" tabindex="8">快速注册</a><div class="switch_bottom" id="switch_bottom" style="position: absolute; width: 64px; left: 0px;"></div>
        </div>
    </div>    

    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 335px;">
            <!--登录-->
            <div class="web_login" id="web_login">
               <div class="login-box">
			<div class="login_form">
				<form action="http://localhost/blog/public/login" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="uinArea" id="uinArea">
                <label class="input-tips" for="u">帐号：</label>
                <div class="inputOuter" id="uArea">
                    <input type="text" id="u" name="username" class="inputstyle"/>
                </div>
                </div>
                <div class="pwdArea" id="pwdArea">
                    <label class="input-tips" for="p">密码：</label>
                    <div class="inputOuter" id="pArea">
                        <input type="password" id="p" name="p" class="inputstyle"/>
                    </div>
                </div>
                    <div class="yzmArea" id="yzmArea">
                        <label class="input-tips" for="p"></label>
                        <div class="inputOuter" id="yArea">
                            <input type="text" id="y" name="y" class="two1" placeholder="验证码"/>
                            <img src="http://localhost/blog/public/index/captcha/1"  alt="验证码" title="刷新图片" width="100" height="40" id="imgyzm" class="two2" border="0">
                        </div>
                    </div>
                <div style="padding-left:50px;margin-top:20px;"><input type="submit" value="登 录" style="width:150px;" class="button_blue"/></div>
                    <a href="{{url('/find')}}" class="zcxy" target="_blank">忘记密码</a>
              </form>
           </div>
           
            	</div>
               
            </div>
            <!--登录end-->
  </div>

  <!--注册-->
    <div class="qlogin" id="qlogin" style="display: none; ">
   
    <div class="web_login">
        <form name="form2" id="regUser" accept-charset="utf-8"  action="http://localhost/blog/public/register" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        <ul class="reg_form" id="reg-ul">
                <li>
                    <label for="user"  class="input-tips2">用户名：</label>
                    <div class="inputOuter2">
                        <input type="text" id="user" name="user" maxlength="16" class="inputstyle2"/>
                    </div>
                </li>
                <li>
                    <label for="mail" class="input-tips2">邮箱：</label>
                    <div class="inputOuter2">
                        <input type="email" id="mail"  name="mail" maxlength="33" class="inputstyle2"/>
                    </div>
                </li>
                <li>
                    <label for="mail_yzm" class="input-tips2"></label>
                    <div class="inputOuter2">
                        <input type="text" id="mail_yzm" class="two1"  name="mail_yzm" placeholder="校验码" maxlength="6"/>
                        <button type="button" class="two2 button_blue" id="btn_time" style="width: 100px;font-size: 14px">获取校验码</button>
                    </div>
                </li>
                <li>
                <label for="passwd" class="input-tips2">密码：</label>
                    <div class="inputOuter2">
                        <input type="password" id="passwd"  name="passwd" maxlength="16" class="inputstyle2"/>
                    </div>
                </li>
                <li>
                <label for="passwd2" class="input-tips2">确认密码：</label>
                    <div class="inputOuter2">
                        <input type="password" id="passwd2" name="" maxlength="16" class="inputstyle2" />
                    </div>
                </li>
                <li>
                    <div class="inputArea">
                        <input type="button" id="reg"  style="margin-top:10px;margin-left:85px;" class="button_blue" value="同意协议并注册"/>
                        <a href="#" class="zcxy" target="_blank">注册协议</a>
                    </div>
                    
                </li><div class="cl"></div>
            </ul>
        </form>
    </div>
    </div>
    <!--注册end-->
</div>
<div class="jianyi">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>
</body>
<script>
    $("#imgyzm").click(function(){
        $url = "http://localhost/blog/public/index/captcha";
        $url = $url + "/" + Math.random();
        document.getElementById('imgyzm').src=$url;
    })
    $("#hd").click(function () {
        var y = $('#yz').val();
        $.get('http://localhost/blog/public/hd/'+y,{},function (msg) {
            alert(msg);
        })
    })
    //倒计时按钮
    function btn_time(btn) {
        var count = 30;
        var countdown = setInterval(CountDown, 1000);
        function CountDown() {
            $(btn).attr("disabled", true);
            $(btn).val(count + "秒后重新获取");
            if (count == 0) {
                $(btn).val("获取验证码").removeAttr("disabled");
                clearInterval(countdown);
            }
            count--;
        }
    }
    $('#btn_time').click(function () {
        var m = $("#mail").val();
        var ru = /^([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
        var rzt= m.match(ru);
        var key = "{{csrf_token()}}";
        if (rzt){
            btn_time($('#btn_time'));
            $.post("{{url('/sendmail')}}",{mail:m,title:'账号注册',_token:key});
        }else {
            alert('请输入正确邮箱');
            $('#mail').focus();
        }
    });
    <?php
        $a = Session::get('info');
        if(!empty($a)){
            echo "alert('$a');";
        }
    ?>
</script>
</html>