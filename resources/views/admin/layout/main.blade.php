<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>哈哈后台登录界面</title>

    <!-- Start css -->
    <!-- Bootstrap 3.3.5 -->
    {{--<link rel="stylesheet" href="{{ cssAsset('css/admin/bootstrap.min.css') }}">--}}
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href="{{ cssAsset('css/admin/font-awesome.min.css') }}">--}}
    <!-- Ionicons -->
    {{--<link rel="stylesheet" href="{{ cssAsset('css/admin/ionicons.min.css') }}">--}}
    <!-- Theme style -->
    {{--<link rel="stylesheet" href="{{ cssAsset('css/admin/AdminLTE.css') }}">--}}
    <link rel="stylesheet" href="{{ cssAsset('css/admin/common.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    {{--<link rel="stylesheet" href="{{ cssAsset('css/admin/skins/skin-blue.min.css') }}">--}}
    <!-- End css -->


    <script src="{{ jsAsset("js/admin/common.bundle.min.js") }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{--<script src="{{ jsAsset('js/vendor/html5shiv/html5shiv.min.js') }}"></script>--}}
    {{--<script src="{{ jsAsset('js/vendor/respond/respond.min.js') }}"></script>--}}
    <script src="{{ jsAsset('js/admin/shim.bundle.min.js') }}"></script>
    <![endif]-->

    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style');
            msViewportStyle.appendChild(
                document.createTextNode(
                        '@-ms-viewport { width: auto !important; }'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle);
        }
    </script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
    <header class="main-header">
        <a class="logo">
            <span class="logo-mini"><b>哈</b>哈</span>
            <span class="logo-lg"><b>哈哈</b>后台管理</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img class="user-image" src="{{ imgAsset($user->avatar) }}" alt="User Image">
                            <span class="hidden-xs">{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img class="img-circle" src="{{ imgAsset($user->avatar) }}" alt="User Image">

                                <p>
                                    {{ $user->name }} - {{ in_array($user->username, config('admin.backend.authority.supers')) ? '超级管理员': $user->roles()->first()->name }}
                                    <small>创建时间  {{ $user->created_at }}</small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a class="btn btn-default btn-flat" href="/user/profile">个人中心</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="/auth/logout">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img class="img-circle"  src="{{ imgAsset($user->avatar) }}" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>  {{ $user->name }}</p>

                    <a style="display: inline-block; max-width: 140px; text-overflow: ellipsis; overflow: hidden"><i class="fa fa-circle text-success"></i>{{ in_array($user->username, config('admin.backend.authority.supers')) ? '超级管理员' : $roleNames }}</a>
                </div>
            </div>

            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="搜索模块...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>

            <ul class="sidebar-menu">
                <li class="header">所有模块</li>

                @include('admin.menu')
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Anything you want
        </div>
        <strong>Copyright &copy; 2016 <a href="#" target="_blank">哈哈看看</a>.</strong> All rights reserved.
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
        <div class="control-sidebar-bg"></div>
    </aside>
</div>

<script src="{{ jsAsset("js/admin/base.bundle.min.js") }}"></script>
</body>
</html>