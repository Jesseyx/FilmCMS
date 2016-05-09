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
            <li class="active">个人信息</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('errors.list')

        {{ Form::model($_user, ['url' => '/user/edit', 'class' => 'form-horizontal']) }}
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
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::button('<i class="fa fa-save"></i> 保存', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                </div>
            </div>
        {{ Form::close() }}
        <!-- Your Page Content Here -->

    </section><!-- /.content -->
@stop