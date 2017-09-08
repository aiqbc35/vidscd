@extends('Common.mobile')
@section('content')
    <div class="weui-cells__title">激活会员</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">激活码</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" placeholder="请输入激活码" type="text" v-model="code">
            </div>
            <div class="weui-cell__ft">
                <button class="weui-vcode-btn" @click="upvip">升级会员</button>
            </div>
        </div>
    </div>
    <div class="weui-cells__title">购买激活码</div>
    <div class="weui-cells weui-cells_radio">
        <label class="weui-cell weui-check__label" for="x18">
            <div class="weui-cell__bd">
                <p>18元/天</p>
            </div>
            <div class="weui-cell__ft">
                <input class="weui-check" name="radio1" id="x18" value="http://t.cn/RNhLPCE" type="radio" v-model="codetype">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x28">

            <div class="weui-cell__bd">
                <p>28元/月</p>
            </div>
            <div class="weui-cell__ft">
                <input name="radio1" class="weui-check" id="x28" value="http://t.cn/RNhLh4Z"  type="radio" v-model="codetype">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x58">

            <div class="weui-cell__bd">
                <p>58元/季</p>
            </div>
            <div class="weui-cell__ft">
                <input name="radio1" class="weui-check" id="x58" value="http://t.cn/RNh2d8t"  type="radio" v-model="codetype">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x70">

            <div class="weui-cell__bd">
                <p>70元/年<span class="weui-badge" style="margin-left: 5px;">优惠</span></p>
            </div>
            <div class="weui-cell__ft">
                <input name="radio1" class="weui-check" id="x70" checked="checked" type="radio" value="http://t.cn/RC8dIB4" v-model="codetype">
                <span class="weui-icon-checked" ></span>
            </div>
        </label>
    </div>
    <a href="javascript:;" class="weui-btn weui-btn_primary margin-top-20 color-bg-zhuti" style="width: 90%;" @click="shopcode">购买</a>
    <div class="weui-cells__title">会员权益</div>
    <article class="weui-article color-gray">
        <p>
            1、享受會員專享高速服務器，看片更清晰更流暢！
        </p>
        <p>2、優質片源每天新增！</p>
        <p>3、不定期發送1080P高清片源至會員郵箱！</p>
        <p>4、優先體驗公司最新服務！</p>
        <p>5、勁爆體驗價1天：18元或2美金，1個月：28元或5美金，一季度：58元或9美金，全年98元或15美金。暑期活動價：10美金或70元人民幣/年（截止：2017-09-15）！</p>
    </article>

@stop
@section('script')
<script type="text/javascript" src="/mobile/js/up-vip.js"></script>
@stop