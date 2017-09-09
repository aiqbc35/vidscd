@extends('Common.mobile')
@section('content')
    <div class="weui-cells weui-cells_form margin-top-0">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">邮箱</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" placeholder="请输入邮箱" type="email" v-model="email">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">新密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" placeholder="如果不修改密码请勿填写" type="password" v-model="newpwd">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" placeholder="请原始密码进行确认" type="password" v-model="passwd">
            </div>
        </div>
    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary color-bg-zhuti" href="javascript:" id="showTooltips" @click="putUpdate">确定</a>
    </div>
@stop
@section('script')
<script src="/mobile/js/up-userinfo.js?v1"></script>
@stop