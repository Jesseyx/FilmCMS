@extends('layout.index')

@section('content')
    <section class="content-header">
        <h1>
            <small></small>
            <a class="btn btn-default J-go-back" href="#">
                <i class="fa fa-arrow-left"></i> 返回
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user-md"></i> 权限分组管理</a></li>
            <li class="active">添加权限分组</li>
        </ol>
    </section>

    <!-- Main content -->
    <section id="" class="content">

        @include('errors.list')

        {{ Form::open(['method' => 'POST', 'url' => url('permission-group'), 'class' => 'form-horizontal']) }}

        <div class="form-group">
            {{ Form::label('name', '权限分组名称：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '请输入分组名称']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('status', '状态：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                <select id="status" class="form-control" name="status">
                    @foreach(config('admin.permissionGroup.status') as $status)
                        <option value={{ $status['value'] }}>
                            {{ $status['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('order', '排序：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('order', null, ['class' => 'form-control', 'placeholder' => '请输入排序值 (数值大的排在前面)']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::button('<i class="fa fa-save"></i> 添加', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            </div>
        </div>
        {{ Form::close() }}
                <!-- Your Page Content Here -->

    </section><!-- /.content -->
@stop
