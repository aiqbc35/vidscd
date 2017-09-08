@extends('Admin.layout')
@section('title')
    {{$name}}
@stop
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-sm-12" style="margin-bottom: 10px;">
                <button type="button" class="btn btn-block btn-primary btn-flat" data-id="{{$id}}">新增CODE</button>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>status</th>
                    <th>addtime</th>
                    <th>update</th>
                    <th>upuser</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->code}}</td>
                        <td>
                            @if($value->status == 1)
                                已激活
                                @else
                                待激活
                            @endif
                        </td>
                        <td>{{date('Y-m-d H:i:s',$value->addtime)}}</td>
                        <td>
                            @if ($value->updatetime != '')
                            {{date('Y-m-d H:i:s',$value->updatetime)}}
                            @endif
                        </td>
                        <td>
                            @if(isset($value['adminuser']->username))
                                {{$value['adminuser']->username}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>status</th>
                    <th>addtime</th>
                    <th>update</th>
                    <th>upuser</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <script type="text/javascript">
        window.onload = function(){

            $(".btn-flat").click(function(event){
                var id = $(this).data('id');

                if (confirm('确定新增激活码？') == true) {
                   $.get("/admin/addcode", { id: id}, function(data){
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