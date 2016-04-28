@extends('layout.index')

@section('content')
    <section class="content-header">
        <h1>
            <small></small>
            <a class="btn btn-default" href="/user/create">
                <i class="fa fa-edit"></i> 添加
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user-md"></i> 用户管理</a></li>
            <li class="active">用户列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div id="JAdminListBox">

        </div>

        <!-- Your Page Content Here -->

    </section><!-- /.content -->
@stop

@section('footer')
    <script src="{{ jsAsset('dist/user_index.bundle.js') }}"></script>
@stop