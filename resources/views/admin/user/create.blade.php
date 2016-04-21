@extends('admin.layout.main')

@section('content')
    <style>
        #roles input, #rows label {
            vertical-align: middle;
            cursor: pointer;
        }
    </style>

    <section class="content-header">
        <h1>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 用户管理</a></li>
            <li class="active">添加用户</li>
        </ol>
    </section>

    <!-- Main content -->
    <section id="user_create_container" class="content">
        @include('errors.list')

        {{ Form::open(['method' => 'POST', 'url' => '/user', 'class' => 'form-horizontal']) }}
            <div class="form-group">
                {{ Form::label('username', '帐号：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => '输入帐号']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('name', '姓名：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '输入真实姓名']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('avatar', '头像：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    <img class="img-circle" width="80" height="80" alt="User Image">
                    {{ Form::hidden('avatar') }}
                    <span class="btn btn-success file-hidden-cover">
                        <i class="fa fa-upload"></i> 上传(可选)
                        {{ Form::file('file', ['id' => 'avatar_file', 'class' => 'file-hidden']) }}
                    </span>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('cellphone', '手机：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('cellphone', null, ['class' => 'form-control', 'placeholder' => '输入手机号码(可选)']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('email', '邮箱：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '输入电子邮箱(可选)']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password', '密码：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '输入密码']) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 col-md-3">
                    {{ Form::button('<i class="fa fa-plus"></i> 添加', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                </div>
            </div>
        {{ Form::close() }}
    </section>
@stop