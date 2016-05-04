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
            <li><a href="#"><i class="fa fa-user-md"></i> 用户管理</a></li>
            <li class="active">编辑用户</li>
        </ol>
    </section>

    <!-- Main content -->
    <section id="userEditContainer" class="content">

        @include('errors.list')

        {{ Form::model($user, ['method' => 'PUT', 'url' => url('user', $user->id), 'class' => 'form-horizontal']) }}
            <div class="form-group">
                {{ Form::label('username', '帐号：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => '请输入帐号']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('name', '姓名：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '请输入姓名']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('name', '头像：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    <img class="img-circle" src="{{ imgAsset($user->avatar) }}" alt="User Image" width="80" height="80">
                    {{ Form::hidden('avatar', null) }}
                    <span class="btn btn-success file-hidden-cover" type="button">
                        <i class="fa fa-upload"></i> 上传(可选)
                        {{ Form::file('file', ['id' => 'JAvatarFile', 'class' => 'file-hidden']) }}
                    </span>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('cellphone', '角色：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    <select class="form-control" name="roles[]" multiple="multiple">
                        @foreach(\App\Role::enable()->get() as $key => $role)
                            <option value="{{ $role->id }}"{{ in_array($role->id, $roleIds) ? ' selected="selected"' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('cellphone', '手机：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('cellphone', null, ['class' => 'form-control', 'placeholder' => '请输入手机号']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('email', '邮箱：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '请输入电子邮箱']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password', '密码：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('password', '', ['class' => 'form-control', 'placeholder' => '请输入密码']) }}
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
    <script src="{{ jsAsset('node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ jsAsset('node_modules/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
    <script src="{{ jsAsset('dist/js/user_edit.bundle.js') }}"></script>
@stop