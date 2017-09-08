@extends('Admin.layout')
@section('title')
    {{$name}}
@stop
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>LoginTime</th>
                    <th>AddTime</th>
                    <th>SetUp</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->username}}</td>
                    <td>
                        @if($value->logintime != '')
                            {{date('Y-m-d H:i:s',$value->logintime)}}
                        @endif
                    </td>
                    <td>{{date('Y-m-d',$value->addtime)}}</td>
                    <td>
                        @if ($value->type == 0)
                        <button type="button" class="btn btn-primary" data-id="{{$value->id}}">SET VIP</button>
                        @endif
                        <button type="button" class="btn btn-danger" data-id="{{$value->id}}">DELETE</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>LoginTime</th>
                    <th>AddTime</th>
                    <th>SetUp</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <script type="text/javascript">
        window.onload = function(){
            $(".btn-primary").click(function(event){
                id = $(this).data('id');
                if (id) {
                    $.get("/admin/setvip", { id: id}, function(data){
                            alert(data.msg);
                            if (data.status == 1) {
                                window.location.reload();
                            }
                        },'json');
                }
            });
            $(".btn-danger").click(function(event){
                id = $(this).data('id');
                if (id) {
                    $.get("/admin/deleteuser", { id: id}, function(data){
                        alert(data.msg);
                        if (data.status == 1) {
                            window.location.reload();
                        }
                    },'json');
                }
            });
        }
    </script>
@stop