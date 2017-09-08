@extends('Common.mobile')
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item member-top-img color-gray">
            <i class="fa fa-user-circle font-size-60 color-zhuti" aria-hidden="true"></i>
            <span class="weui-badge" style="margin-left: 5px;" v-show="isvip">VIP</span>
            <p>@{{ username }}</p>
        </div>
    </div>
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="/mobile/member/userinfo">
            <div class="weui-cell__bd">
                <p><i class="fa fa-address-card margin-right-10 font-size-25 color-zhuti" aria-hidden="true"></i>檔案修改</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
        <a class="weui-cell weui-cell_access" href="/mobile/member/upvip">
            <div class="weui-cell__bd">
                <p><i class="fa fa-credit-card margin-right-10 font-size-25 color-zhuti" aria-hidden="true"></i>VIP升級</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
        <a class="weui-cell weui-cell_access" href="/member/logout">
            <div class="weui-cell__bd">
                <p><i class="fa fa-circle-o-notch margin-right-10 font-size-25 color-zhuti" aria-hidden="true"></i>退出登陆</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
    </div>
@stop
@section('script')
<script type="text/javascript">
    new Vue({
        el : '#vueapp',
        data:{
            username:"",
            isvip:false
        },
        created:function(){
            var _self = this;
            $.getJSON('/api/getUserInfo',function (data) {
                _self.username = data.data.username;
                _self.isvip = data.data.vip;
            })
        }
    });
</script>
@stop