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
                    <th>title</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Click</th>
                    <th>Sort</th>
                    <th>Service</th>
                    <th>type</th>
                    <th>AddTime</th>
                    <th>SetUp</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td><img src="{{$image . $value->image}}" alt="" width="50"></td>
                        <td>{{$value->link}}</td>
                        <td>{{$value->hit}}</td>
                        <td>{{$value['Sort']->name}}</td>
                        <td>{{$value->service}}</td>
                        <td>{{$value->type}}</td>
                        <td>{{date('Y-m-d',$value->addtime)}}</td>
                        <td>
                            @if ($value->status == 0)
                            <button type="button" class="btn btn-success" data-id="{{$value->id}}">SETOK</button>
                            @endif
                            @if ($value->type == 0)
                                <button type="button" class="btn btn-primary" data-id="{{$value->id}}">SET VIP</button>
                            @endif

                            <a class="btn btn-info" href="{{url('admin/videoadd?id='.$value->id)}}">EDIT</a>
                            <button type="button" class="btn btn-danger" data-id="{{$value->id}}">DELETE</button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Click</th>
                    <th>Sort</th>
                    <th>Service</th>
                    <th>type</th>
                    <th>AddTime</th>
                    <th>SetUp</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop
@section('script')
    <script type="text/javascript">

            $(".btn-primary").click(function(event){
                id = $(this).data('id');
                if (id) {
                    $.get("/admin/video/setvip", { id: id}, function(data){
                        alert(data.msg);
                    },'json');
                }
            });
            $(".btn-danger").click(function(event){
                id = $(this).data('id');
                if (id) {
                    $.get("/admin/video/delete", { id: id}, function(data){
                        alert(data.msg);
                        if (data.status == 1) {
                            window.location.reload();
                        }
                    },'json');
                }
            });
            $(".btn-success").click(function(event){
                id = $(this).data('id');
                if (id) {
                    $.get("/admin/video/setok", { id: id}, function(data){
                        alert(data.msg);

                    },'json');
                }
            });

    </script>
@stop