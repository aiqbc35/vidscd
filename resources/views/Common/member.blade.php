<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GodSky在線視頻</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <link href="https://cdn.bootcss.com/layer/3.0.3/skin/default/layer.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">

        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href="/mobile/index";
        }
    </script>
</head>

<body>
<div id="vueapp">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">GodSky</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::getPathInfo() == '/' ? 'active' : ''}}"><a href="/">首頁</a></li>
                <li class="{{ Request::getPathInfo() == '/list' ? 'active' : ''}}"><a href="/list">免費視頻</a></li>
                <li class="{{ Request::getPathInfo() == '/list/vip' ? 'active' : ''}}"><a href="/list/vip">VIP視頻</a></li>
                <li class="{{ Request::getPathInfo() == '/member/' ? 'active' : ''}}"><a href="/member">會員中心</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Session::has('user_id'))
                    <li>
                        <a href="/member/">
                            <span class="glyphicon glyphicon-user" aria-hidden="true" style="margin-right: 10px;"></span>
                            會員中心
                        </a>
                    </li>
                    <li><a href="/member/logout" id="signin">退出</a></li>
                @else
                    <li><a href="javascript:;" id="signup">註冊</a></li>
                    <li><a href="javascript:;" id="signin">登陸</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="{{ Request::getPathInfo() == '/member' ? 'active' : ''}}"><a href="/member">會員中心 <span class="sr-only">(current)</span></a></li>
                <li class="{{ Request::getPathInfo() == '/member/userinfo' ? 'active' : ''}}"><a href="/member/userinfo">會員信息 <span class="sr-only">(current)</span></a></li>
                <li class="{{ Request::getPathInfo() == '/member/vip' ? 'active' : ''}}"><a href="/member/vip">升級VIP</a></li>
                <li><a href="#">退出</a></li>
            </ul>
        </div>
        @yield('content')
    </div>
</div>

@section('model')
@show
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="{{ asset('js/holder.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<script src="https://cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.4.2/vue.js"></script>
@yield('script')
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b6bb55e5c8cfeee093fc2a91a983142d";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>
</html>
