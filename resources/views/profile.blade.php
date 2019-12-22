@extends('layouts.master')
@section('content')
    <?php
    $users = \App\User::all();
    ?>
    @include('massage.msg')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(!empty(auth()->user()->avatar))
                        <img class="profile-user-img img-responsive img-circle"
                             src="{{url(auth()->user()->avatar)}}" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive img-circle"
                             src="{{asset('/icon/download.png')}}" alt="User profile picture">
                    @endif


                    <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
                    @foreach($users as $user)
                        @if($user->id == auth()->user()->id)
                            @foreach($user->getRoleNames() as $role)
                                <p class="text-muted text-center">{{$role}}</p>
                            @endforeach
                        @endif
                    @endforeach

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>گفتگو ها</b> <a class="pull-left">0</a>
                        </li>
                        <li class="list-group-item">
                            <b>نام های ارسالی</b> <a class="pull-left">0</a>
                        </li>
                        <li class="list-group-item">
                            <b>وضعیت</b> <a class="pull-left">انلاین</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">مشخصات پرسنل</a></li>
                    <li><a href="#settings" data-toggle="tab">عملیات رمز</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->

                    <div class="active tab-pane" id="activity">
                        <form class="form-horizontal" method="post" action="{{route('edit.profile')}}">
                            @csrf
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">نام و نام خانوادگی</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"
                                           value="{{auth()->user()->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">کد ملی</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email"
                                           value="{{auth()->user()->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">شماره تماس</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone"
                                           value="{{auth()->user()->phone}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">تصویر کاربر</label>

                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="avatar" placeholder="تصویر کاربر">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">ارسال</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" method="post" action="{{route('edit.pass')}}">
                            @csrf
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">کلمه عبور قبلی</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="oldpass"
                                           placeholder="کلمه عبور قبلی">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">کلمه عبور جدید</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="newpass"
                                           placeholder="کلمه عبور جدید">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">ارسال</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
