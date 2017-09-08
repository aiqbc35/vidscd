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
                    <th>TITLE</th>
                    <th>VALUE</th>
                    <th>addTime</th>
                    <th>SetUp</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->title}}</td>
                        <td>{{$value->content}}</td>
                        <td>{{$value->addtime}}</td>
                        <td>
                            <a class="btn btn-info" href="{{url('admin/noticeedit/'.$value->id)}}" >EDIT</a>
                            <button type="button" class="btn btn-danger" data-id="{{$value->id}}">DELETE</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>VALUE</th>
                    <th>addTime</th>
                    <th>SetUp</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <script type="text/javascript">
        window.onload = function(){

            $(".btn-danger").click(function(event){
                id = $(this).data('id');
                if (id) {
                    $.get("/admin/notice/delete", { id: id}, function(data){
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