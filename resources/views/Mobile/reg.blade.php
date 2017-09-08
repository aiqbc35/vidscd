@extends('Common.mobile')
@section('content')
    <h2 class="weui-msg__title Login-title">注册</h2>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">郵箱：</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" v-model="email" placeholder="请输入郵箱" type="email">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密碼：</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input"  placeholder="请输入密碼" type="password" v-model="passwd">
            </div>
        </div>
    </div>
    <div class="weui-cells__tips">請填寫正確的郵箱，當有最新網址時我們將會發送至您註冊的郵箱。</div>
    <p class="weui-btn-area">
        <a href="javascript:;" class="weui-btn weui-btn_primary color-bg-zhuti" @click="createUser">提交</a>
    </p>
    <div class="weui-cells__tips" style="text-align: center;"><a href="/mobile/login" class="color-zhuti line-height-36">已有账号，前往登陆</a></div>
@stop
@section('script')
<script type="text/javascript" src="/mobile/js/reg-vue.js"></script>
@stop