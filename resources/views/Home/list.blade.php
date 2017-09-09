@extends('Common.home')
@section('content')
    <div class="jumbotron">
        <h1>免費視頻</h1>
        <p>免費觀影，如需觀看更多高清流暢的視頻請前往VIP視頻，VIP體驗價低至18元。</p>
    </div>
    <div class="container">
        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
            <div class="row">
                <a class="col-sm-6 col-md-3" href="baidu.com" v-for="item in list" v-bind:href="'/v?id='+item.vid">
                    <div class="thumbnail">
                        <img alt="100%x200" style="height: 200px; width: 100%; display: block;" src="" v-bind:src="imglink + item.img">
                        <div class="caption clearfix">
                            <h4>@{{ subTextString(item.title) }}</h4>
                            <div class="pull-left move-info">时间：@{{ item.addtime }}</div>
                            <div class="pull-right move-info">观看：@{{ item.scan }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <nav aria-label="..." class="page-bottom">
            <ul class="pager">
                <li :class="limit == 0 ? 'disabled' : ''"><a href="{{url('list')}}">首页</a></li>
                <li :class="limit == 0 ? 'disabled' : ''"><a href="#" v-bind:href="uppage" >上一頁</a></li>
                <li :class="limit == pagetotal ? 'disabled' : ''"><a href="#" v-bind:href="nextpage" >下一頁</a></li>
                <li :class="limit == pagetotal ? 'disabled' : ''"><a href="#" v-bind:href="[pagetotal == limit ? 'javascript:;' : '/list?limit='+pagetotal]" >末页</a></li>
            </ul>
        </nav>
    </div>
@stop
@section('script')
<script type="text/javascript" src="/js/list-vue.js?v1"></script>
@stop