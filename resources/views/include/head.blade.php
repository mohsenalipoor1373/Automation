@php
    $users = \App\User::all();
@endphp
<ul class="nav navbar-nav">
    <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">1</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">1 پیام خوانده نشده</li>
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

    @can('مساعده-سرپرست')
        @php
            $rule = \Modules\TheRule\Entities\TheRule::whereNull('Supervisor')->count();
            $leave = \Modules\Leave\Entities\Leave::whereNull('Supervisor')->count();
            $work = \Modules\Fractions\Entities\Fractions::whereNull('Supervisor')->count();
            $buy = \Modules\Buy\Entities\Buy::whereNull('Supervisor')->count();
            $cage = \Modules\Cage\Entities\Cage::whereNull('buy')->count();
            $fish= \Modules\Fish\Entities\Fish::whereNull('buy')->whereNotNull('off')->count();
            $mission= \Modules\Mission\Entities\Mission::whereNull('Supervisor')->count();
            $overtime = \Modules\Overtime\Entities\Overtime::whereNotNull('Admin')->whereNull('Archive')->count();
        @endphp

        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <?php
                $sum = $rule + $leave + $work + $buy + $cage + $fish + $overtime + $mission;
                ?>
                @if(!empty($sum))
                    <span class="label label-warning">{{$sum}}</span>
                @endif
            </a>
            <ul class="dropdown-menu">
                <?php
                $sum = $rule + $leave + $work + $buy + $cage + $fish + $overtime + $mission;
                ?>
                @if(!empty($sum))
                    <li class="header">{{$sum}} اعلان جدید</li>
                @endif
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        @can('مساعده-سرپرست')
                            @if(!empty($rule))
                                <li>
                                    <a href="{{route('admin.module.rule.show-rule')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$rule}} درخواست مساعده دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('مرخصی-سرپرست')
                            @if(!empty($leave))
                                <li>
                                    <a href="{{route('admin.module.leave.show-leave')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$leave}} درخواست مرخصی دارید
                                    </a>
                                </li>
                            @endif
                        @endcan

                        @can('کسر کار-سرپرست')
                            @if(!empty($work))
                                <li>
                                    <a href="{{route('admin.module.fractions.show-fraction')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$work}} درخواست کسر کار دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('خرید کالا-سرپرست')
                            @if(!empty($buy))
                                <li>
                                    <a href="{{route('admin.module.buy.show-supervsior')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$buy}} درخواست خرید کالا دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای تور قفس')
                            @if(!empty($cage))
                                <li>
                                    <a href="{{route('admin.module.cage.show-admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$cage}} درخواست تولید تور قفس دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('درخواستهای تور صیدماهی')
                            @if(!empty($fish))
                                <li>
                                    <a href="{{route('admin.module.fish.make')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$fish}} درخواست تولید تور صیدماهی
                                        دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('اضافه کار')
                            @if(!empty($overtime))
                                <li>
                                    <a href="{{route('admin.module.overtime.show')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$overtime}} پاسخ اضافه کار
                                        دارید
                                    </a>
                                </li>
                            @endif
                        @endcan

                        @can('ماموریت-سرپرست')
                            @if(!empty($mission))
                                <li>
                                    <a href="{{route('admin.module.mission.show-supervsior')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$mission}} درخواست ماموریت
                                        دارید
                                    </a>
                                </li>
                            @endif
                        @endcan


                    </ul>
                </li>
            </ul>
        </li>
    @endcan

    @can('مساعده-مدیریت')
        @php
            $rule = \Modules\TheRule\Entities\TheRule::whereNull('Admin')->whereNotNull('Supervisor')->count();
            $leave = \Modules\Leave\Entities\Leave::whereNull('Admin')->whereNotNull('Supervisor')->count();
            $work = \Modules\Fractions\Entities\Fractions::whereNull('Admin')->whereNotNull('Supervisor')->count();
            $buy = \Modules\Buy\Entities\Buy::whereNull('Admin')->whereNotNull('Supervisor')->count();
            $mission = \Modules\Mission\Entities\Mission::whereNull('Admin')->whereNotNull('Supervisor')->count();
            $overtime = \Modules\Overtime\Entities\Overtime::whereNull('Admin')->count();
        @endphp

        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <?php
                $sum = $rule + $leave + $work + $buy + $overtime + $mission;
                ?>
                @if(!empty($sum))
                    <span class="label label-warning">{{$sum}}</span>
                @endif
            </a>
            <ul class="dropdown-menu">
                <?php
                $sum = $rule + $leave + $work + $buy + $overtime + $mission;
                ?>
                @if(!empty($sum))
                    <li class="header">{{$sum}} اعلان جدید</li>
                @endif
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        @can('مساعده-مدیریت')
                            @if(!empty($rule))
                                <li>
                                    <a href="{{route('admin.module.rule.show-admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$rule}} درخواست مساعده دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('مرخصی-مدیریت')
                            @if(!empty($leave))
                                <li>
                                    <a href="{{route('admin.module.leave.show-admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$leave}} درخواست مرخصی دارید
                                    </a>
                                </li>
                            @endif
                        @endcan

                        @can('کسر کار-مدیریت')
                            @if(!empty($work))
                                <li>
                                    <a href="{{route('admin.module.fractions.show-admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$work}} درخواست کسر کار دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('خرید کالا-مدیریت')
                            @if(!empty($buy))
                                <li>
                                    <a href="{{route('admin.module.buy.show-admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$buy}} درخواست خرید کالا دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('اضافه کار-مدیریت')
                            @if(!empty($overtime))
                                <li>
                                    <a href="{{route('admin.module.overtime.admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$overtime}} درخواست اضافه کار دارید
                                    </a>
                                </li>
                            @endif
                        @endcan


                        @can('ماموریت-مدیریت')
                            @if(!empty($mission))
                                <li>
                                    <a href="{{route('admin.module.mission.show-admin')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$mission}} درخواست ماموریت دارید
                                    </a>
                                </li>
                            @endif
                        @endcan


                    </ul>
                </li>
            </ul>
        </li>
    @endcan

    @can('مساعده')
        @php
            $rule = \Modules\TheRule\Entities\TheRule::whereNotNull('Admin')->whereNull('Archive')->count();
            $leave = \Modules\Leave\Entities\Leave::whereNotNull('Admin')->whereNull('Archive')->count();
            $work = \Modules\Fractions\Entities\Fractions::whereNotNull('Admin')->whereNull('Archive')->count();
            $fish= \Modules\Fish\Entities\Fish::whereNull('fina')->count();
                        $cage= \Modules\Cage\Entities\Cage::whereNull('fina')->count();

            $fishm= \Modules\Fish\Entities\Fish::whereNotNull('buy')->whereNull('final')->count();
            $cagem= \Modules\Cage\Entities\Cage::whereNotNull('buy')->whereNull('final')->count();

        @endphp

        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <?php
                $sum = $rule + $leave + $work + $fish + $fishm +$cage +$cagem;
                ?>
                @if(!empty($sum))
                    <span class="label label-warning">{{$sum}}</span>
                @endif
            </a>
            <ul class="dropdown-menu">
                <?php
                $sum = $rule + $leave + $work + $fish + $fishm +$cage +$cagem;
                ?>
                @if(!empty($sum))
                    <li class="header">{{$sum}} اعلان جدید</li>
                @endif
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        @can('مساعده')
                            @if(!empty($rule))
                                <li>
                                    <a href="{{route('admin.module.rule.show')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$rule}} پاسخ مساعده دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('مرخصی')
                            @if(!empty($leave))
                                <li>
                                    <a href="{{route('admin.module.leave.show')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$leave}} پاسخ مرخصی دارید
                                    </a>
                                </li>
                            @endif
                        @endcan

                        @can('کسر کار')
                            @if(!empty($work))
                                <li>
                                    <a href="{{route('admin.module.fractions.show')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$work}} پاسخ کسر کار دارید
                                    </a>
                                </li>
                            @endif
                        @endcan

                        @if(!empty($fish))
                            <li>
                                <a href="{{route('admin.module.fish.makes.m')}}">
                                    <i class="fa fa-warning text-yellow"></i> {{$fish}} درخواست تور صیدماهی دارید
                                </a>
                            </li>
                        @endif

                        @if(!empty($fishm))
                            <li>
                                <a href="{{route('admin.module.fish.makes.buym')}}">
                                    <i class="fa fa-warning text-yellow"></i> {{$fishm}}پاسخ تولید تورصیدماهی دارید
                                </a>
                            </li>
                        @endif

                            @if(!empty($cage))
                                <li>
                                    <a href="{{route('admin.module.cage.makes.cagem')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$cage}}درخواست تولید تور قفس دارید
                                    </a>
                                </li>
                            @endif
                            @if(!empty($cagem))
                                <li>
                                    <a href="{{route('admin.module.cage.makes.cagemm')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$cagem}}پاسخ تولید تور قفس دارید
                                    </a>
                                </li>
                            @endif
                    </ul>
                </li>
            </ul>
        </li>
    @endcan

    @can('ماموریت')
        @php
            $mission = \Modules\Mission\Entities\Mission::whereNotNull('Admin')->whereNull('Archive')->count();
            $buy = \Modules\Buy\Entities\Buy::whereNotNull('Admin')->whereNull('Archive')->count();
            $cage_date = \Modules\Cage\Entities\Cage::whereNotNull('buy')->whereNull('Archive')->count();
            $fisha = \Modules\Fish\Entities\Fish::whereNotNull('fina')->whereNull('off')->count();
            $cagea = \Modules\Cage\Entities\Cage::whereNotNull('fina')->whereNull('off')->count();
        @endphp

        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <?php
                $sum = $mission + $buy + $cage_date + $fisha +$cagea;
                ?>
                @if(!empty($sum))
                    <span class="label label-warning">{{$sum}}</span>
                @endif
            </a>
            <ul class="dropdown-menu">
                <?php
                $sum = $mission + $buy + $cage_date + $fisha +$cagea;
                ?>
                @if(!empty($sum))
                    <li class="header">{{$sum}} اعلان جدید</li>
                @endif
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        @can('ماموریت')
                            @if(!empty($mission))
                                <li>
                                    <a href="{{route('admin.module.rule.show')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$mission}} پاسخ ماموریت دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('خرید کالا')
                            @if(!empty($buy))
                                <li>
                                    <a href="{{route('admin.module.buy.list')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$buy}} پاسخ خرید کالا دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('تور قفس')
                            @if(!empty($cage_date))
                                <li>
                                    <a href="{{route('admin.module.cage.list')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$cage_date}} پاسخ تولید تور قفس
                                        دارید
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('تور صیدماهی')
                            @if(!empty($fisha))
                                <li>
                                    <a href="{{route('admin.module.fish.list')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$fisha}} پاسخ مالی تور صیدماهی دارید
                                    </a>
                                </li>
                            @endif
                        @endcan

                            @if(!empty($cagea))
                                <li>
                                    <a href="{{route('admin.module.cage.list')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$cagea}} پاسخ مالی تور قفس دارید
                                    </a>
                                </li>
                            @endif

                    </ul>
                </li>
            </ul>
        </li>
    @endcan


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
