<?php
$users = \App\User::all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>اتوماسیون توربافان</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/dist/css/bootstrap-theme.css')}}">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('/dist/css/rtl.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
@include('massage.msg')
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        @foreach($users as $user)
            @if($user->id == auth()->user()->id)
                @foreach($user->getRoleNames() as $role)
                    <b>کنترل پنل {{$role}}</b>
                @endforeach
            @endif
        @endforeach


    </div>
    <!-- User name -->
    <div class="lockscreen-name">{{auth()->user()->name}}</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            @if(!empty(auth()->user()->avatar))
                <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="User Image">
            @else
                <img src="{{asset('/icon/download.png')}}" class="img-circle" alt="User Image">

            @endif
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="post" action="{{route('admin.check.lock')}}">
            @csrf
            <div class="input-group">
                <input type="password" name="pass" class="form-control" placeholder="رمز عبور">

                <div class="input-group-btn">
                    <i class="fa fa-arrow-right text-muted"><input type="submit" class="btn" value="ورود"></i>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        برای ورود مجدد رمز عبور خود را وارد کنید
    </div>
    <div class="lockscreen-footer text-center">
        <b>تمام حقوق این سیستم برای <a>توربافان</a> محفوظ میباشد.</b>
    </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script>
    $(".alert").fadeTo(5000, 50).slideUp(1000);
</script>

</body>
</html>
