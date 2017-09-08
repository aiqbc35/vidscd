<!DOCTYPE html>
<html lang="zh-cmn-Hans"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GodSky在線視頻</title>
    <link href="https://cdn.bootcss.com/weui/1.1.2/style/weui.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/mobile/css/style.css" rel="stylesheet">
    @section('css')
    @show
</head>
<body ontouchstart="" class="body-bg">
<div id="vueapp">
<div class="container padding-bottom-75" id="container">
    <div class="page home js_show">
        <div class="page__hd">
            <div class="weui-tab">
                <div class="weui-navbar godsky-navbar-bg">
                    <div class="weui-navbar__item">
                        GodSky在線視頻
                    </div>
                </div>
            </div>
        </div>
        <div class="page__bd body-bg padding-top-49">
            @yield('content')
        </div>
    </div>
</div>
<div class="weui-tab tool-bar-bottom">
    <div class="weui-tabbar">
        <a href="/mobile/index" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/index' ? 'ico-bg-color' : ''}}">
            <i class="fa fa-home ico-size-25" aria-hidden="true"></i>
            <p class="weui-tabbar__label {{ Request::getPathInfo() == '/mobile/index' ? 'ico-bg-color' : ''}}">首頁</p>
        </a>
        <a href="/mobile/list" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/list' ? 'ico-bg-color' : ''}}">
            <i class="fa fa-video-camera ico-size-25" aria-hidden="true"></i>
            <p class="weui-tabbar__label {{ Request::getPathInfo() == '/mobile/list' ? 'ico-bg-color' : ''}}">免费</p>
        </a>
        <a href="/mobile/list/vip" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/list/vip' ? 'ico-bg-color' : ''}}">
            <i class="fa fa-credit-card ico-size-25" aria-hidden="true"></i>
            <p class="weui-tabbar__label {{ Request::getPathInfo() == '/mobile/list/vip' ? 'ico-bg-color' : ''}}">VIP</p>
        </a>
        <a href="/mobile/member" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/member' ? 'ico-bg-color' : ''}}">
            <i class="fa fa-user-circle ico-size-25" aria-hidden="true"></i>
            <p class="weui-tabbar__label {{ Request::getPathInfo() == '/mobile/member' ? 'ico-bg-color' : ''}}">我</p>
        </a>
    </div>
</div>
</div>
<script src="https://cdn.bootcss.com/zepto/1.2.0/zepto.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.4.2/vue.js"></script>
<script src="/mobile/js/js.js"></script>
@section('script')
@show
</body>
</html>