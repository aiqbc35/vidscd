@extends('Common.mobile')
@section('css')
    <link href="{{ asset('video-js/video-js.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item" id="createHtmlVideo">

        </div>
    </div>
    <h3 class="page__title title"></h3>
    <div class="page__title"><i class="fa fa-video-camera ico-size-25 ico-bg-color" aria-hidden="true"></i> 随机推荐</div>
    <div id="vip">
    </div>
@stop
@section('script')
    <script src="{{ asset('video-js/ie8/videojs-ie8.min.js') }}"></script>
    <script src="{{ asset('video-js/video.min.js') }}"></script>

<script src="/mobile/js/view.js"></script>

@stop