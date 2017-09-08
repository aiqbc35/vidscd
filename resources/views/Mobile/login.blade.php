@extends('Common.mobile')
@section('content')
    <h2 class="weui-msg__title Login-title">登陆</h2>
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
                <input class="weui-input" v-model="passwd" placeholder="请输入密碼" type="password">
            </div>
        </div>
    </div>
    <p class="weui-btn-area">
        <a href="javascript:;" class="weui-btn weui-btn_primary color-bg-zhuti" @click="loginUser">提交</a>
    </p>
    <div class="weui-cells__tips" style="text-align: center;"><a href="/mobile/reg" class="color-zhuti line-height-36">没有账号，前往注册</a></div>
@stop
@section('script')
<script type="text/javascript" src="/mobile/js/login-vue.js"></script>
@stop