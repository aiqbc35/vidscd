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
            <form class="form-horizontal" method="post" action="/admin/message/addHalt" >
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" name="title" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Content</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" name="content" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="Reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->

    </div>
@stop