@extends('Common.mobile')
@section('css')
    <link href="{{ asset('video-js/video-js.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item" id="createHtmlVideo">
            @if(isset($video['imglink']))
            <video id="example_video_1" class="video-js vjs-16-9 vjs-big-play-centered fod-vjs-default-skin vjs-paused vjs-fluid vjs-controls-enabled vjs-workinghover vjs-mux fod-vjs-embed videoPlayer-25c17d6eb2-dimensions vjs-user-inactive" controls preload="none" width="840" height="264" poster="{{ $video['imglink'] }}{{ $video['video']->image }}" data-setup="{}" >
                <source src="{{ $video['videolink'] }}{{ $video['video']->link }}" type="video/mp4">
                <track kind="captions" src="/video-js/examples/shared/example-captions.vtt" srclang="en" label="English" default></track>
                <p class="vjs-no-js">您的瀏覽器不支持HTML5，請使用別的瀏覽器嘗試，建議使用：Chrome、火狐、360</p>
            </video>
            @endif
        </div>
    </div>
    <h3 class="page__title title" style="margin-bottom: 0px;">线路选择</h3>
    <h3 class="page__title title" style="margin-top: 0px;">
        @foreach( $link as $value)
        <a href="javascript:;" class="weui-btn weui-btn_mini @if($value['type'] == 'free') weui-btn_primary @else weui-btn_warn @endif" data-id="{{ $value['line'] }}">{{ $value['title'] }}</a>
        @endforeach
    </h3>
    <div class="page__title"><i class="fa fa-video-camera ico-size-25 ico-bg-color" aria-hidden="true"></i> 随机推荐</div>
    <div id="vip">
    </div>
@stop
@section('script')
    <script src="{{ asset('video-js/ie8/videojs-ie8.min.js') }}"></script>
    <script src="{{ asset('video-js/video.min.js') }}"></script>
    <script src="/mobile/js/view.js?v1.3"></script>
    <script>
        $(function(){
            var myPlayer = videojs("example_video_1");
            myPlayer.load();
        });
    </script>
@stop