<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/font-awesome.min.css')}}">
    <script src="{{url('/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{url('/js/jquery.lazyload.min.js')}}"></script>
    <script src="{{url('/js/home.js')}}"></script>
    <!--[if gte IE 9]>
    <script src="{{url('/js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/js/html5shiv.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/js/respond.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/js/selectivizr-min.js')}}" type="text/javascript"></script>
    <![endif]-->
</head>
<body class="user-select">
<header class="header">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">
            <div class="header-topbar hidden-xs link-border">
                <ul class="site-nav topmenu">
                    <li><a href="#" >@yield('name')</a></li>
                    <li><a href="{{url('/logout')}}" >退出</a></li>
                    {{--<li><a href="{{url('/message')}}" >消息</a></li>--}}
                </ul>
            </div>
            <!-- logo部分 -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <h1 class="logo hvr-bounce-in"><a href="{{url('/index')}}">
                <img style="height: 52px" src="{{url('/images/timg.jpg')}}" alt="博客首页"></a></h1>
            </div>
            <div class="collapse navbar-collapse" id="header-navbar">
                <form class="navbar-form visible-xs" action="/Search" method="post">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" maxlength="20" autocomplete="off">
                        <span class="input-group-btn">
		<button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
		</span> </div>
                </form>
                <ul class="nav navbar-nav navbar-left">
                    <li><a title="首页" href="{{url('/index')}}">首页</a></li>
                    <li><a title="我的博文" href="{{url('/myblogs')}}">我的博文</a></li>
                    <li><a title="相册" href="{{url('/myphotos')}}">相册</a></li>
                    <li><a title="心情语录" href="{{url('/mymoots')}}">心情语录</a></li>
                    <li><a title="信息设置" href="{{url('/myinfo')}}">我的信息</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
@yield('content')
<footer class="footer">
    <div class="container">
        <p>Copyright &copy; 2016.Company fanhuo rights reserved.</p>
    </div>
    <div id="gotop"><a class="gotop"></a></div>
</footer>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/jquery.ias.js')}}"></script>
</body>
</html>