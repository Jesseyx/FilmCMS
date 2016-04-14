<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>哈哈后台登录界面</title>

    <!-- css -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ cssAsset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ cssAsset('css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ cssAsset('css/admin/login.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    {{--<script src="{{  jsAsset("js/admin/common.min.js") }}"></script>--}}
    <!--[if lt IE 9]>
    <!--<script src="{{ jsAsset('js/admin/shim.bundle.min.js') }}"></script>-->
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ imgAsset("img/admin/favicon.png") }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ imgAsset("img/admin/apple-touch-icon-144-precomposed.png") }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ imgAsset("img/admin/apple-touch-icon-114-precomposed.png") }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ imgAsset("img/admin/apple-touch-icon-72-precomposed.png") }}">
    <link rel="apple-touch-icon-precomposed" href="{{ imgAsset("img/admin/apple-touch-icon-57-precomposed.png") }}">

</head>
<body>
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>哈哈</strong> 后台登录</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>登录</h3>
                            <p>请输入你的帐号和密码：</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-key"></i>
                        </div>
                    </div>

                    <div class="form-bottom">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['method' => 'post', 'url' => '/auth/login', 'class' => 'login-form']) !!}
                        <div class="form-group">
                            {!! Form::label('username', '帐号', ['class' => 'sr-only']) !!}
                            {!! Form::text('username', old('username'), ['class' => 'form-username form-control', 'placeholder' => '账号...']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', '密码', ['class' => 'sr-only']) !!}
                            {!! Form::password('password', ['class' => 'form-password form-control', 'placeholder' => '密码...']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::checkbox('remember') !!}  记住我
                        </div>

                        <div class="form-group">
                            {!! Form::submit('登录', ['class' => 'btn']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>