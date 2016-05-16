@extends('layout.index')

@section('header')
    <link rel="stylesheet" href={{ cssAsset('node_modules/jstree/dist/themes/default/style.css') }}>
@stop

@section('content')
    <section class="content-header">
        <h1>
            <small></small>
            <a class="btn btn-default J-go-back" href="#">
                <i class="fa fa-arrow-left"></i> 返回
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user-md"></i> 角色管理</a></li>
            <li class="active">修改角色</li>
        </ol>
    </section>

    <!-- Main content -->
    <section id="roleEditContainer" class="content">

        @include('errors.list')

        {{ Form::model($role, ['method' => 'PUT', 'url' => url('role', $role->id), 'id' => 'editForm', 'class' => 'form-horizontal']) }}

        <div class="form-group">
            {{ Form::label('name', '角色名称：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '请输入角色名称']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('permission', '拥有权限：', ['class' => 'col-sm-2 control-label']) }}

            <div class="col-sm-10 col-md-3">
                <div id="permissionTree"></div>
                {{ Form::hidden('perm_ids', null, ['id' => 'permIdsInput']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('status', '状态：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                <select class="form-control" name="status">
                    @foreach(config('admin.role.status') as $status)
                        <option value={{ $status['value'] }}{{ $role->status === $status['value'] ? ' selected="selected"' : '' }}>
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
            {{ Form::label('description', '描述：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => '请输入描述', 'rows' => null, 'cols' => null]) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::button('<i class="fa fa-save"></i> 保存', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            </div>
        </div>
        {{ Form::close() }}
                <!-- Your Page Content Here -->

    </section><!-- /.content -->
@stop

@section('footer')
    <script>
        var G_ROLE_PERMISSIONS = {!! $role->permissions !!};
    </script>
    <script src="{{ jsAsset('node_modules/jstree/dist/jstree.js') }}"></script>
    <script src="{{ jsAsset('dist/js/role_edit.bundle.js') }}"></script>
@stop