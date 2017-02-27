<!DOCTYPE html>
<html>
<head>
    <title>密码找回</title>
    <meta name="keywords" content="梵火、梵火博客、文章" />
    <meta name="description" content="博客密码找回界面" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="./js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
    <link href="./css/login2.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>梵火博客用户界面</h1>

<div class="login" style="margin-top:50px;">

    <div class="header">
        <div class="switch" id="switch"><a class="switch_btn_focus" id="switch_qlogin" href="javascript:void(0);" tabindex="7">密码找回</a>
        </div>
    </div>

    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 335px;">
        <!--登录-->
        <div class="web_login" id="web_login">
            <div class="login-box">
                <div class="login_form">
                    <form name="form2" id="regUser" accept-charset="utf-8"  action="http://localhost/blog/public/find/update" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <ul class="reg_form" id="reg-ul">
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
                                    <input type="button" id="upd"  style="margin-top:10px;margin-left:85px;width: 150px;" class="button_blue" value="修改密码"/>
                                    <a href="{{url('/')}}" class="zcxy">去登陆</a>
                                </div>
                            </li><div class="cl"></div>
                        </ul>
                    </form>
                </div>

            </div>

        </div>
        <!--登录end-->
    </div>
</div>
<div class="jianyi">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>
</body>
<script>
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
            $.post("{{url('/sendmail')}}",{mail:m,title:'密码找回',_token:key});
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