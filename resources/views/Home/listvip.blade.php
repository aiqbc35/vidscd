@extends('Common.home')
@section('content')
    <div class="jumbotron">
        <h1>VIP視頻</h1>
        <p>VIP體驗價低至18元,專享VIP專線，觀影更流暢；VIP視頻每天更新，讓您每天都能看到不同內容；同時VIP能優先體驗到最新服務！</p>
    </div>
    <div class="container">
        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
            <div class="row">
                <a class="col-sm-6 col-md-3" href="baidu.com" v-for="item in list" v-bind:href="'/v?id='+item.vid">
                    <div class="thumbnail">
                        <img alt="100%x200" style="height: 200px; width: 100%; display: block;" src="" v-bind:src="imglink + item.img">
                        <div class="caption clearfix">
                            <h3>@{{ subTextString(item.title) }}</h3>
                            <div class="pull-left move-info">时间：@{{ item.addtime }}</div>
                            <div class="pull-right move-info">观看：@{{ item.scan }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <nav aria-label="..." class="page-bottom">
            <ul class="pager">
                <li :class="limit == 0 ? 'disabled' : ''"><a href="{{url('list/vip')}}">首页</a></li>
                <li :class="limit == 0 ? 'disabled' : ''"><a href="#" v-bind:href="uppage" >上一頁</a></li>
                <li :class="limit == pagetotal ? 'disabled' : ''"><a href="#" v-bind:href="nextpage" >下一頁</a></li>
                <li :class="limit == pagetotal ? 'disabled' : ''"><a href="#" v-bind:href="[pagetotal == limit ? 'javascript:;' : '/list/vip?limit='+pagetotal]" >末页</a></li>
            </ul>
        </nav>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('js/listvip-vue.js') }}"></script>
@stop