<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MY-Admin Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    {{--<link rel="stylesheet" href={{ cssAsset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}>--}}
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href={{ cssAsset('build/css/font-awesome.min.css') }}>--}}
    <!-- Ionicons -->
    {{--<link rel="stylesheet" href={{ cssAsset('build/css/ionicons.min.css') }}>--}}
    <!-- Theme style -->
    {{--<link rel="stylesheet" href={{ cssAsset('node_modules/admin-lte/dist/css/AdminLTE.min.css') }}>--}}

    <link rel="stylesheet" href={{ cssAsset('/css/vendor.css') }}>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src={{ jsAsset('/js/ieShim.bundle.js') }}></script>
    <![endif]-->

    <script src={{ jsAsset('/js/vendor.js') }}></script>
    <script src={{ jsAsset('/js/login.bundle.js') }}></script>
    <style>
        .icheckbox_square-blue {
            margin-top: -3px !important;
            margin-right: 5px;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>MY</b>Admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">请输入你的账号和密码</p>

        @include('errors.list')

        {{ Form::open(['url' => '/auth/login']) }}
            <div class="form-group has-feedback">
                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => '帐号...']) }}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '密码...']) }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            {{ Form::checkbox('remember') }}  记住我
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    {{ Form::button('登录', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']) }}
                </div>
                <!-- /.col -->
            </div>
        {{ Form::close() }}


        <!-- <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <!-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
