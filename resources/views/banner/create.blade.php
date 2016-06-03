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
            <li><a href="#"><i class="fa fa-user-md"></i> 轮播图管理</a></li>
            <li class="active">添加轮播图</li>
        </ol>
    </section>

    <!-- Main content -->
    <section id="" class="content">

        @include('errors.list')

        {{ Form::open(['method' => 'POST', 'url' => url('banner'), 'class' => 'form-horizontal']) }}

        <div class="form-group">
            {{ Form::label('JBannerImgFile', '图片：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                <img alt="Banner Image" width="216" height="90">
                {{ Form::hidden('img_url', null, ['id' => 'bannerImgInput']) }}
                <span class="btn btn-success file-hidden-cover" type="button">
                    <i class="fa fa-upload"></i> 上传
                    {{ Form::file('file', ['id' => 'JBannerImgFile', 'class' => 'file-hidden']) }}
                </span>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('resource_type', '资源类型：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                <select id="resource_type" class="form-control" name="resource_type">
                    @foreach(config('admin.banner.resource_types') as $type)
                        <option value={{ $type['value'] }}>
                            {{ $type['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('source_id', 'id：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('source_id', null, ['class' => 'form-control', 'placeholder' => '请输入电影或游戏的id']) }}
                <button id="btnGetSourceId" class="btn btn-default" type="button" style="margin-top: 5px;">
                    确定
                </button>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('title', '标题：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => '请输入标题']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('sub_title', '副标题：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('sub_title', null, ['class' => 'form-control', 'placeholder' => '请输入副标题']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('platform', '平台：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                <select id="platform" class="form-control" name="platform">
                    @foreach(config('admin.backend.platforms') as $platform)
                        <option value={{ $platform['value'] }}>
                            {{ $platform['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('status', '状态：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                <select id="status" class="form-control" name="status">
                    @foreach(config('admin.banner.status') as $status)
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
                {{ Form::text('order', null, ['class' => 'form-control', 'placeholder' => '请输入排序值，数值越大，越靠前']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('is_ad', '是否广告：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3" style="margin-top: 8px;">
                {{ Form::checkbox('is_ad') }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('link_path', '跳转 URL：', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 col-md-3">
                {{ Form::text('link_path', null, ['class' => 'form-control', 'placeholder' => '请输入要跳转的 URL']) }}
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
                {{ Form::button('<i class="fa fa-save"></i> 添加', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            </div>
        </div>
        {{ Form::close() }}
                <!-- Your Page Content Here -->

    </section><!-- /.content -->
@stop
