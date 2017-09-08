@extends('Common.member')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="jumbotron">
            <h1>@{{ username }}<small style="margin-left: 10px;font-size: 18px;" class="text-danger" v-show="isvip">VIP</small></h1>
            <p>Welcome GodSky</p>
            <span class="pull-right text-muted" style="margin-left: 10px;">上次登录时间：@{{ logindate }}</span>
            <span class="pull-right text-muted" v-show="isvip">VIP到期时间：@{{ vipdate }}</span>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{asset('js/member-index.js')}}"></script>
@stop