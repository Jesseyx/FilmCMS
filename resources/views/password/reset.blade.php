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
            <li><a href="#"><i class="fa fa-user-md"></i> 用户中心</a></li>
            <li class="active">修改密码</li>
        </ol>
    </section>

    <section  class="content password-reset">
        @include('errors.list')

        {{ Form::open(['url' => '/password/reset', 'class' => 'form-horizontal']) }}
            <div class="form-group">
                {{ Form::label('old_password', '原密码：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::password('old_password', ['class' => 'form-control', 'placeholder' => '请输入原密码']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password', '新密码：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '请输入新密码']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password_confirmation', '确认新密码：', ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-10 col-md-3">
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '请确认新密码']) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::button('<i class="fa fa-save"></i> 修改', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                </div>
            </div>
        {{ Form::close() }}
    </section>
@stop