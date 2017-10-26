@extends('Common.home')
@section('css')
    <link href="{{ asset('video-js/video-js.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="container-fluid view-player">
        <div class="container" >
            <div class="row">
                <div class="col-md-12" id="createHtmlVideo">
                    @if(isset($video['imglink']))
                    <video id="example_video_1" class="video-js vjs-16-9 vjs-big-play-centered fod-vjs-default-skin vjs-paused vjs-fluid vjs-controls-enabled vjs-workinghover vjs-mux fod-vjs-embed videoPlayer-25c17d6eb2-dimensions vjs-user-inactive" controls preload="none" width="840" height="264" poster="{{ $video['imglink'] }}{{ $video['video']->image }}" data-setup="{}" >
                     <source src="{{ $video['videolink'] }}{{ $video['video']->link }}" type="video/mp4">
                     <track kind="captions" src="/video-js/examples/shared/example-captions.vtt" srclang="en" label="English" default></track>
                     <p class="vjs-no-js">您的瀏覽器不支持HTML5，請使用別的瀏覽器嘗試，建議使用：Chrome、火狐、360</p>
                    </video>
                    @endif
                </div>
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

<script type="text/javascript" src="/js/view-vue.js?v1.1"></script>
<script src="/video-js/ie8/videojs-ie8.min.js?v2"></script>
<script src="/video-js/video.min.js?v1"></script>
    <script>
        $(function(){
            var myPlayer = videojs("example_video_1");
            myPlayer.load();
        });
    </script>
@stop