@extends('Common.mobile')
@section('content')
    <div class="weui-form-preview margin-bottom-10 index-list-box" v-for="item in list">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label" style="min-width:2em;">
                <img src="" v-bind:src="imglink + item.img" width="34" height="34" alt="">
            </label>
            <em class="weui-form-preview__value color-gray list-box-title">@{{ subTextString(item.title) }}</em>
        </div>
        <div class="weui-form-preview__bd index-video-list">
            <a href="" v-bind:href="'/mobile/v?id='+item.vid">
                <img src="" v-bind:src="imglink + item.img" alt="" height="230" width="100%">
                <i class="fa fa-play-circle-o player-ico-fa" aria-hidden="true"></i>
            </a>
        </div>
        <div class="weui-form-preview__ft border-top-none line-height-36 font-size-14">
            <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:"><i class="fa fa-cloud-upload margin-right-3 font-size-25" aria-hidden="true"></i>@{{ item.addtime }}</a>
            <a class="weui-form-preview__btn weui-form-preview__btn_default border-left-none" href="javascript:"><i class="fa fa-play-circle margin-right-3 font-size-25" aria-hidden="true"></i>@{{ item.scan }}</a>
        </div>
    </div>
    <div class="weui-flex margin-top-20">
        <div class="weui-flex__item">
            <a href="javascript:;" v-bind:href="uppage" class="weui-btn weui-btn_default page-btn-line-height" :class="limit == 0 ? 'weui-btn_disabled' : ''" style="margin-left: 4px;">上一頁</a>
        </div>
        <div class="weui-flex__item"><div class="placeholder"></div></div>
        <div class="weui-flex__item">
            <div class="placeholder">
                <a href="javascript:;" v-bind:href="nextpage" class="weui-btn weui-btn_default page-btn-line-height" style="margin-right: 4px;" :class="limit == pagetotal ? 'weui-btn_disabled' : ''">下一頁</a>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="/mobile/js/list-vip.js"></script>
@stop