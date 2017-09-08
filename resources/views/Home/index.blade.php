@extends('Common.home')
@section('content')
    <div class="container" id="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" v-bind:data-slide-to="index" class="" :class="[index == 0 ? 'active' : '']" v-for="(item,index) in banner"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <a class="item " v-bind:class="[index == 0 ? 'active' : '']" href="" v-for="(item,index) in banner" v-bind:href="'/v?id='+item.vid">
                            <img src="" v-bind:src="imglink + item.img" data-holder-rendered="true">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 vip-img">
                <img src="images/vip.jpg" alt="" class="img-responsive img-rounded">
            </div>
            <div class="col-md-3">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default" v-for="note in notice">
                        <div class="panel-heading" role="tab" id="headingOne" >
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  @{{ note.title }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                @{{ note.content }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 alert-info Notice">
                簡訊：Godsky在線視頻網址找回請發送任意內容至<mark>wwwgodskyorg@mail.ru</mark>或<mark>免費註冊</mark>本站會員即可自動獲取最新網址。
            </div>
        </div>
        <div class="page-header">
            <h3>免费视频 <small>免费观影</small></h3>
        </div>
        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
            <div class="row">
                <a class="col-sm-6 col-md-3" v-for="item in free" v-bind:href="'/v?id='+item.vid">
                    <div class="thumbnail">
                        <img alt="100%x200" style="height: 200px; width: 100%; display: block;" src="" v-bind:src="imglink + item.img">
                        <div class="caption clearfix">
                            <h3>@{{ subTextString(item.title) }}</h3>
                            <div class="pull-left move-info">时间：@{{ item.addtime }}</div>
                            <div class="pull-right move-info">观看：@{{ item.hit }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="page-header">
            <h3>VIP视频 <small>高清快速专线</small></h3>
        </div>
        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
            <div class="row">
                <a class="col-sm-6 col-md-3" v-for="item in vip" v-bind:href="'/v?id='+item.vid">
                    <div class="thumbnail">
                        <img alt="100%x200" style="height: 200px; width: 100%; display: block;" src="" v-bind:src="imglink + item.img">
                        <div class="caption clearfix">
                            <h3>@{{ subTextString(item.title) }}</h3>
                            <div class="pull-left move-info">时间：@{{ item.addtime }}</div>
                            <div class="pull-right move-info">观看：@{{ item.hit }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid links">
        <div class="row" style="font-size: 10px;">
            <a class="col-md-1" v-for="link in links">@{{ link.title }}</a>
        </div>
    </div>

@stop
@section('script')
<script type="text/javascript" src="{{asset('js/index-vue.js')}}"></script>
@stop