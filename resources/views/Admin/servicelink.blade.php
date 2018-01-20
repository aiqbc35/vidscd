@extends('Admin.layout')
@section('title')
    {{$name}}
@stop
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <a type="button" class="btn btn-primary btn-lg" href="/admin/servicelinkview">
                Add Service Link
            </a>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>Link</th>
                    <th>Type</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->link }}</td>
                            <td>{{ $value->type }}</td>
                            <td>
                                <a class="btn btn-info" href="{{url('/admin/servicelinkview?id='.$value->id)}}">EDIT</a>
                                <a type="button" class="btn btn-danger" href="{{ url('/admin/serviceLinkDelete?id=' . $value->id) }}">DELETE</a>
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>Link</th>
                    <th>Type</th>
                    <th>Edit</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop

