@extends('Common.mobile')
@section('content')
    <div id="picPanel" class="pic-panel">
        <div id="picBox" class="pic-box">
            <ul id="picList" class="pic-list">
            </ul>
        </div>
    </div>
    <div class="page__title"><i class="fa fa-video-camera ico-size-25 ico-bg-color" aria-hidden="true"></i> 免費視頻</div>
    <div id="free">

    </div>
    <div class="page__title"><i class="fa fa-video-camera ico-size-25 ico-bg-color" aria-hidden="true"></i> VIP視頻</div>
    <div id="vip">
    </div>
@stop
@section('script')
    <script type="text/javascript" src="/mobile/js/photoSlider-1.21.js?v1"></script>
    <script type="text/javascript" src="/mobile/js/mobile-index.js?v1"></script>
@stop