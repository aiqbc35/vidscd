<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GodSky在線視頻</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/layer/3.0.3/skin/default/layer.min.css" rel="stylesheet">
    @yield('css')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="vueapp">
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
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
@yield('content')
<div class="footer clearfix">
    <div class="pull-left">GodSky © 2017 All Rights Reserved Terms of Use and Privacy Policy</div>
    <div class="pull-right">Powered by GodSky v1.0</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" v-model="email" placeholder="Email">
                            <p class="help-block bg-warning">請填寫正確的郵箱，當有最新網址時我們將會發送至您註冊的郵箱。</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" v-model="passwd" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" data-mode="reg" id="putBtnUser" @click="createUser">提交</button>
            </div>
        </div>
    </div>
</div>

</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="https://cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.4.2/vue.js"></script>
@yield('script')
<script src="{{asset('js/js.js')}}"></script>
</body>
</html>