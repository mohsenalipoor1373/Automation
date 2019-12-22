<?php
$therules = \Modules\TheRule\Entities\TheRule::where('Supervisor', null)->count();
$fac = \Modules\Fractions\Entities\Fractions::where('Supervisor', null)->count();
$therulea = \Modules\TheRule\Entities\TheRule::where('Supervisor', 1)->where('Admin', null)->count();
$check = \Modules\TheRule\Entities\TheRule::whereNotNull('Admin')->where('Archive', null)->count();
$fraction = \Modules\Fractions\Entities\Fractions::whereNotNull('Admin')->where('Archive', null)->count();
$leave = \Modules\Leave\Entities\Leave::where('Supervisor', null)->count();
$fractions = \Modules\Fractions\Entities\Fractions::where('Supervisor', null)->count();
$overtime = \Modules\Overtime\Entities\Overtime::whereNotNull('Admin')->whereNull('Archive')->count();
$leaveadmin = \Modules\Leave\Entities\Leave::whereNull('Admin')
    ->where('Supervisor', 1)->orWhere('Supervisor', 3)->count();

$over = \Modules\Overtime\Entities\Overtime::whereNull('Admin')->count();
$fractionadmin = \Modules\Fractions\Entities\Fractions::whereNull('Admin')
    ->where('Supervisor', 1)->orWhere('Supervisor', 3)->count();
$checkleave = \Modules\Leave\Entities\Leave::where('Admin', '!=', null)->where('Archive', null)->count();
$checkfraction = \Modules\Fractions\Entities\Fractions::where('Admin', '!=', null)
    ->where('Archive', null)->count();
$users = \App\User::all();


$mission = \Modules\Mission\Entities\Mission::whereNull('Supervisor')->count();
$missionadmin = \Modules\Mission\Entities\Mission::whereNull('Admin')->where('Supervisor', 1)->count();
$missionstore = \Modules\Mission\Entities\Mission::whereNotNull('Supervisor')->whereNull('Archive')->count();

?>
<ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->
    <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">4</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">۴ پیام خوانده نشده</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <li><!-- start message -->
                        <a href="#">
                            <div class="pull-right">
                                @if(!empty(auth()->user()->avatar))
                                    <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="User Image">
                                @else
                                    <img src="{{asset('/icon/download.png')}}" class="img-circle" alt="User Image">

                                @endif
                            </div>
                            <h4>
                                علیرضا
                                <small><i class="fa fa-clock-o"></i> ۵ دقیقه پیش</small>
                            </h4>
                            <p>متن پیام</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="footer"><a href="#">نمایش تمام پیام ها</a></li>
        </ul>

    </li>


    <li class="dropdown messages-menu">
        <a href="{{route('admin.lock')}}">
            <i class="fa fa-lock"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <!-- inner menu: contains the actual data -->
            </li>
        </ul>

    </li>

    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>


            @can('ماموریت')
                @if(!empty($missionstore))
                    <span class="label label-warning">{{$missionstore}}</span>
                @endif
            @endcan

            @can('مساعده','مرخصی','کسر کار')
                <?php
                $mali = $checkleave + $check + $fraction;
                ?>
                @if(!empty($mali))
                    <span class="label label-warning">{{$mali}}</span>
                @endif
            @endcan
            @can('درخواست های ماموریت-سرپرست','درخواستهای مرخصی-سرپرست','درخواستهای مساعده-سرپرست','درخواستهای کسر کار-سرپرست','اضافه کار')
                <?php
                $m = $leave + $therules + $fractions + $overtime + $mission;
                ?>
                @if(!empty($m))
                    <span class="label label-warning">{{$m}}</span>
                @endif
            @endcan
            @can('درخواست های ماموریت-مدیریت','درخواستهای مساعده-مدیریت','درخواستهای مرخصی-مدیریت','درخواستهای کسر کار-مدیریت','درخواستهای اضافه کار-مدیریت')
                <?php
                $admin = $leaveadmin + $therulea + $fractionadmin + $over + $missionadmin;
                ?>
                @if(!empty($admin))
                    <span class="label label-warning">{{$admin}}</span>
                @endif
            @endcan
        </a>
        <ul class="dropdown-menu">
            @can('درخواست های ماموریت-سرپرست','درخواستهای مرخصی-سرپرست','درخواستهای مساعده-سرپرست','درخواستهای کسر کار-سرپرست','اضافه کار')
                <?php
                $s = $leave + $therules + $fractions + $overtime + $mission;
                ?>
                @if(!empty($s))
                    <li class="header">{{$s}} اعلان جدید</li>
                @endif
            @endcan
            @can('درخواست های ماموریت-مدیریت','درخواستهای مساعده-مدیریت','درخواستهای مرخصی-مدیریت','درخواستهای کسر کار-مدیریت','درخواستهای اضافه کار-مدیریت')
                <?php
                $adminn = $leaveadmin + $therulea + $fractionadmin + $over + $missionadmin;
                ?>
                @if(!empty($adminn))

                    <li class="header">{{$adminn}} اعلان جدید</li>
                @endif
            @endcan
            @can('مساعده','مرخصی','کسر کار')
                <?php
                $malii = $checkleave + $check + $fraction;
                ?>
                @if(!empty($malii))
                    <li class="header">{{$malii}} اعلان جدید</li>
                @endif
            @endcan
            @can('ماموریت')
                @if(!empty($missionstore))
                    <li class="header">{{$missionstore}} اعلان جدید</li>
                @endif
            @endcan
            <li>
                <!-- inner menu: contains the actual data -->
                <div id="pageMessages">
                    <ul class="menu">

                        @can('درخواست های ماموریت-سرپرست')
                            @if(!empty($mission))
                                <li>
                                    <i class="fa fa-users text-aqua">
                                        <a href="{{route('admin.module.mission.show-supervsior')}}"
                                           class="btn btn-info">
                                            {{$mission}}درخواست جدید ماموریت
                                            دارید
                                        </a>
                                    </i>
                                </li>
                            @endif
                        @endcan
                        @can('درخواست های ماموریت-مدیریت')
                            @if(!empty($missionadmin))
                                <li>
                                    <i class="fa fa-users text-aqua">
                                        <a href="{{route('admin.module.mission.show-admin')}}"
                                           class="btn btn-info">
                                            {{$missionadmin}}درخواست جدید ماموریت
                                            دارید
                                        </a>
                                    </i>
                                </li>
                            @endif
                        @endcan
                        @can('مساعده')
                            @if(!empty($check))
                                <li>
                                    <button type="button" class="btn btn-info"
                                            data-toggle="modal" data-target="#modal-default">
                                        {{$check}}درخواست جدید مساعده
                                        دارید
                                    </button>
                                </li>
                            @endif
                        @endcan
                        @can('مرخصی')
                            @if(!empty($checkleave))
                                <br/>
                                <li>
                                    <i class="fa fa-users text-aqua"></i>
                                    <button type="button" class="btn btn-info"
                                            data-toggle="modal" data-target="#modal-leave">
                                        {{$checkleave}}درخواست جدید مرخصی
                                        دارید
                                    </button>
                                </li>
                            @endif
                        @endcan
                        @can('کسر کار')
                            @if(!empty($checkfraction))
                                <br/>
                                <li>
                                    <i class="fa fa-users text-aqua"></i>
                                    <button type="button" class="btn btn-info"
                                            data-toggle="modal" data-target="#modal-fraction">
                                        {{$checkfraction}}درخواست جدید کسر کار
                                        دارید
                                    </button>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای مساعده-سرپرست')
                            @if(!empty($therules))
                                <li>

                                        <a href="{{route('admin.module.rule.show-rule')}}" class="btn btn-info">
                                            {{$therules}}درخواست جدید مساعده
                                            دارید
                                        </a>
                                </li>
                            @endif
                        @endcan
                        @can('ماموریت')
                            @if(!empty($missionstore))
                                <li>
                                    <i class="fa fa-users text-aqua"></i>
                                    <button type="button" class="btn btn-info"
                                            data-toggle="modal" data-target="#modal-mission">
                                        {{$missionstore}}درخواست جدید ماموریت
                                        دارید
                                    </button>
                                </li>
                            @endif
                        @endcan
                        @can('اضافه کار')
                            @if(!empty($overtime))
                                <li>
                                    <i class="fa fa-users text-aqua">
                                        <button type="button" class="btn btn-info"
                                                data-toggle="modal" data-target="#modal-over">
                                            {{$overtime}}درخواست جدید اضافه کار
                                            دارید
                                        </button>
                                    </i>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای کسر کار-سرپرست')
                            @if(!empty($fac))
                                <li>
                                    <i class="fa fa-users text-aqua">
                                        <a href="{{route('admin.module.fractions.show-fraction')}}"
                                           class="btn btn-info">
                                            {{$fac}}درخواست جدید کسر کار
                                            دارید
                                        </a>
                                    </i>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای اضافه کار-مدیریت')
                            @if(!empty($overtime))
                                <li>
                                    <i class="fa fa-users text-aqua">
                                        <a href="{{route('admin.module.overtime.admin')}}"
                                           class="btn btn-info">
                                            {{$overtime}}درخواست جدید اضافه کار
                                            دارید
                                        </a>
                                    </i>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای مرخصی-سرپرست')
                            @if(!empty($leave))
                                <br/>
                                <li>
                                        <a href="{{route('admin.module.leave.show-leave')}}" class="btn btn-info">
                                            {{$leave}}درخواست جدید مرخصی
                                            دارید
                                        </a>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای مساعده-مدیریت')
                            @if(!empty($therulea))
                                <li>
                                        <a href="{{route('admin.module.rule.show-admin')}}" class="btn btn-info">
                                            {{$therulea}}درخواست جدید مساعده
                                            دارید
                                        </a>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای مرخصی-مدیریت')
                            @if(!empty($leaveadmin))
                                <br/>
                                <li>
                                        <a href="{{route('admin.module.leave.show-admin')}}" class="btn btn-info">
                                            {{$leaveadmin}}درخواست جدید مرخصی
                                            دارید
                                        </a>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای کسر کار-مدیریت')
                            @if(!empty($fractionadmin))
                                <br/>
                                <li>
                                    <i class="fa fa-users text-aqua">
                                        <a href="{{route('admin.module.fractions.show-admin')}}" class="btn btn-info">
                                            {{$fractionadmin}}درخواست جدید کسر کار
                                            دارید
                                        </a>
                                    </i>
                                </li>
                            @endif
                        @endcan
                    </ul>
                </div>
            </li>
        </ul>
    </li>

    <!--Modal: modalPush-->
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(!empty(auth()->user()->avatar))
                <img src="{{url(auth()->user()->avatar)}}" class="user-image" alt="User Image">

            @else
                <img src="{{asset('/icon/download.png')}}" class="user-image" alt="User Image">

            @endif
            <span class="hidden-xs">{{auth()->user()->name}}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                @if(!empty(auth()->user()->avatar))
                    <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="User Image">
                @else
                    <img src="{{asset('/icon/download.png')}}" class="img-circle" alt="User Image">

                @endif

                <p>
                    {{auth()->user()->name}}
                    @foreach($users as $user)
                        @if($user->id == auth()->user()->id)
                            @foreach($user->getRoleNames() as $role)
                                <small>{{$role}}</small>
                            @endforeach
                        @endif
                    @endforeach
                </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-right">
                    <a href="{{route('profile')}}" class="btn btn-default btn-flat">پروفایل</a>
                </div>
                <div class="pull-left">


                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                        خروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </li>

</ul>

