@extends('Admin.layout')
@section('content')
    <div class="col-md-12">
        @if (Session::has('success'))
            <div class="callout callout-info">
                <h4>提交成功</h4>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="callout callout-danger">
                <h4>提交失败:{{Session::get('error')}}</h4>
            </div>
    @endif
    <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="/admin/videoservice/serviceAdd" >
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">TITLE</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputtitle" placeholder="title" name="title" value="@if(!empty($data)){{ $data->title }}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputlink" placeholder="Link" name="link" value="@if(!empty($data)){{ $data->link }}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputtype" placeholder="Type" name="type" value="@if(!empty($data)){{ $data->type }}@endif">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="@if(!empty($data)){{ $data->id }}@endif">
                    <button type="Reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->

    </div>
@stop