@extends('layout.index')

@section('header')
    <style>
        .user-profile {
            padding-top: 40px;
        }

        .user-profile .row {
            margin-bottom: 10px;
        }

        .user-profile .row label {
            text-align: right;
        }

        .user-profile .row .label {
            display: inline-block;
            margin-bottom: 5px;
        }
    </style>
@stop

@section('content')
    <section class="content-header">
        <h1>
            <small></small>
            <a class="btn btn-default" href="/user/edit">
                <i class="fa fa-edit"></i> 编辑
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user-md"></i> 用户中心</a></li>
            <li class="active">个人信息</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content user-profile">

        <div class="container-fluid">
            <div class="row">
                <label class="col-xs-4 col-sm-2">姓名：</label>
                <div class="col-xs-8 col-sm-10"><p>{{ $_user->name }}</p></div>
            </div>

            <div class="row">
                <label class="col-xs-4 col-sm-2">头像：</label>
                <div class="col-xs-8 col-sm-10">
                    <img class="img-circle" src="{{ imgAsset($_user->avatar) }}" alt="User Image" style="width: 80px; height: 80px;">
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 col-sm-2">角色：</label>
                <div class="col-xs-8 col-sm-10">
                    <p>
                        @if(in_array($_user->username, config('admin.backend.authority.supers')))
                            <small class="label bg-green"> 超级管理员</small>
                        @else
                            @foreach($_user->roles as $role)
                                <small class="label bg-green">{{ $role->name }}</small> {{ ' ' }}
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 col-sm-2">权限：</label>
                <div class="col-xs-8 col-sm-10">
                    <p>
                        @if(in_array($_user->username, config('admin.backend.authority.supers')))
                            <small class="label bg-yellow"> 所有权限</small>
                        @else
                            @foreach(config('admin.backend.authority.ignores') as $ignore)
                                <small class="label bg-yellow">{{ $ignore['name'] }}</small>
                                {{ ' ' }}
                            @endforeach
                            @foreach($_user->permissions() as $permission)
                                <small class="label bg-yellow">{{ $permission->name }}</small>
                                {{ ' ' }}
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 col-sm-2">手机：</label>
                <div class="col-xs-8 col-sm-10">
                    <p>
                        {{ $_user->cellphone ? $_user->cellphone : '未填写' }}
                    </p>
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 col-sm-2">邮箱：</label>
                <div class="col-xs-8 col-sm-10">
                    <p>
                        {{ $_user->email ? $_user->email : '未填写' }}
                    </p>
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 col-sm-2">创建时间：</label>

                <div class="col-xs-8 col-sm-10"><p>{{ $_user->created_at }}</p></div>
            </div>
        </div>
        <!-- Your Page Content Here -->

    </section><!-- /.content -->
@stop