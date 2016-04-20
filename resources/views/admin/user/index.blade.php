@extends('admin.layout.main')

@section('content')

    <section class="content-header">
        <h1>
            <small></small>
            <a class="btn btn-default" href="/user/create" target="_blank">
                <i class="fa fa-plus"></i> 添加
            </a>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 用户管理</a></li>
            <li class="active">用户列表</li>
        </ol>
    </section>

    <section class="content">
        <div id="admin_list_box">

        </div>
    </section>

    <script src="{{ jsAsset('js/admin/user_index.bundle.min.js') }}"></script>
@stop