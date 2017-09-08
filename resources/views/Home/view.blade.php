@extends('Common.home')
@section('css')
    <link href="{{ asset('video-js/video-js.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="container-fluid view-player">
        <div class="container" >
            <div class="row">
                <div class="col-md-12" id="createHtmlVideo"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="page-header">
            <h3>随机推荐 </h3>
        </div>
        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
            <div class="row">
                <a class="col-sm-6 col-md-3" href="baidu.com" v-for="item in list" v-bind:href="'/v?id='+item.vid">
                    <div class="thumbnail">
                        <img alt="100%x200" style="height: 200px; width: 100%; display: block;" src="" v-bind:src="imglink + item.img">
                        <div class="caption clearfix">
                            <h3>@{{ subTextString(item.title) }}</h3>
                            <div class="pull-left move-info">时间：@{{ item.addtime }}</div>
                            <div class="pull-right move-info">观看：@{{ item.scan }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@stop
@section('script')

<script type="text/javascript" src="/js/view-vue.js"></script>
<script src="{{ asset('video-js/ie8/videojs-ie8.min.js') }}"></script>
<script src="{{ asset('video-js/video.min.js') }}"></script>
@stop