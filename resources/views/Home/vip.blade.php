@extends('Common.member')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading">
                <h3 class="panel-title">激活会员</h3>
            </div>
            <div class="panel-body">
                <form class="form-inline">
                    <div class="form-group form-group-lg">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                            <div class="input-group-addon">Code</div>
                            <input type="text" class="form-control" id="exampleInputAmount" v-model="code" placeholder="请输入激活码">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-lg" @click="actionCode">激活VIP会员</button>
                </form>
            </div>
        </div>
        <div class="panel panel-default" >
            <div class="panel-heading">
                <h3 class="panel-title">购买激活码</h3>
            </div>
            <div class="panel-body">
                <label class="radio-inline text-primary">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" v-model="codetype" value="18"> 1天/18元
                </label>
                <label class="radio-inline text-primary">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" v-model="codetype" value="28"> 1月/28元
                </label>
                <label class="radio-inline text-primary">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" v-model="codetype" value="58"> 1季/58元
                </label>
                <label class="radio-inline text-primary">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" v-model="codetype" value="70"> 1年/70元(活动中)
                </label>
                <button type="button" class="btn btn-primary" style="margin-left: 50px;" @click="shopCode">购买</button>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                VIP會員權益
            </div>
            <div class="panel-body">
                <p>
                    1、享受會員專享高速服務器，看片更清晰更流暢！
                </p>
                <p>2、優質片源每天新增！</p>
                <p>3、不定期發送1080P高清片源至會員郵箱！</p>
                <p>4、優先體驗公司最新服務！</p>
                <p>5、勁爆體驗價1天：18元或2美金，1個月：28元或5美金，一季度：58元或9美金，全年98元或15美金。暑期活動價：10美金或70元人民幣/年（截止：2017-09-15）！</p>

            </div>
        </div>
    </div>
@stop
@section('script')
<script type="text/javascript" src="{{ asset('js/member-vip.js') }}"></script>
@stop