<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-right image">
            @if(!empty(auth()->user()->avatar))
                <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="User Image">
            @else
                <img src="{{asset('/icon/download.png')}}" class="img-circle" alt="User Image">

            @endif
        </div>
        <div class="pull-right info">
            <p>{{auth()->user()->name}}</p>
        </div>
    </div>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">

            <a href="{{route('home')}}">
                <i class="fa fa-dashboard"></i> <span>داشبورد</span>
                <span class="pull-left-container">
            </span>
            </a>
        </li>
        @can('پرسنل')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>پرسنل</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.users.wizard')}}"><i class="fa fa-circle-o"></i>افزودن پرسنل</a></li>
                    <li><a href="{{route('admin.users.show')}}"><i class="fa fa-circle-o"></i>مشاهده پرسنل</a></li>
                </ul>
            </li>
        @endcan
        @can('بخش')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>بخش</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.roles.wizard')}}"><i class="fa fa-circle-o"></i>افزودن بخش</a></li>
                    <li><a href="{{route('admin.roles.show')}}"><i class="fa fa-circle-o"></i>مشاهده بخش ها</a></li>
                </ul>
            </li>
        @endcan
        @can('مساعده')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>مساعده</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.rule.index')}}"><i class="fa fa-circle-o"></i>درخواست مساعده</a>
                    </li>
                    <li><a href="{{route('admin.module.rule.show')}}"><i class="fa fa-circle-o"></i>لیست درخواست های
                            مساعده</a>
                    </li>
                    <li><a href="{{route('admin.module.rule.make')}}"><i class="fa fa-circle-o"></i>لیست درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای مساعده-سرپرست')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواستهای مساعده</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.rule.show-rule')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            مساعده</a>
                    </li>
                    <li><a href="{{route('admin.module.rule.make-rule')}}"><i class="fa fa-circle-o"></i>لیست درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای مساعده-مدیریت')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواست های مساعده</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.rule.show-admin')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            مساعده</a>
                    </li>
                    <li><a href="{{route('admin.module.rule.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('مرخصی')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>مرخصی</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.leave.index')}}"><i class="fa fa-circle-o"></i>درخواست مرخصی</a>
                    </li>
                    <li><a href="{{route('admin.module.leave.show')}}"><i class="fa fa-circle-o"></i>لیست درخواست های
                            مرخصی</a>
                    </li>
                    <li><a href="{{route('admin.module.leave.make')}}"><i class="fa fa-circle-o"></i>لیست درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای مرخصی-سرپرست')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواستهای مرخصی</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.leave.show-leave')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            مرخصی</a>
                    </li>
                    <li><a href="{{route('admin.module.leave.make-leave')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای مرخصی-مدیریت')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواست های مرخصی</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.leave.show-admin')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            مرخصی</a>
                    </li>
                    <li><a href="{{route('admin.module.leave.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>

        @endcan
        @can('کسر کار')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>کسر کار</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.fractions.index')}}"><i class="fa fa-circle-o"></i>درخواست کسر
                            کار</a>
                    </li>
                    <li><a href="{{route('admin.module.fractions.show')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            کسر کار</a>
                    </li>
                    <li><a href="{{route('admin.module.fractions.make')}}"><i class="fa fa-circle-o"></i>لیست درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای کسر کار-سرپرست')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواستهای کسر کار</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.fractions.show-fraction')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            مرخصی</a>
                    </li>
                    <li><a href="{{route('admin.module.fractions.make-fraction')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای کسر کار-مدیریت')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواست های کسر کار</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.fractions.show-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            کسر کار</a>
                    </li>
                    <li><a href="{{route('admin.module.fractions.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('اضافه کار')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>اضافه کار</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.overtime.index')}}"><i class="fa fa-circle-o"></i>درخواست
                            اضافه
                            کار</a>
                    </li>
                    <li><a href="{{route('admin.module.overtime.show')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            اضافه کار</a>
                    </li>
                    <li><a href="{{route('admin.module.overtime.list')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواستهای اضافه کار-مدیریت')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواست های اضافه کار</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="{{route('admin.module.overtime.admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            اضافه کار</a>
                    </li>
                    <li><a href="{{route('admin.module.overtime.make')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('ماموریت')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>ماموریت</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.mission.index')}}"><i class="fa fa-circle-o"></i>ثبت ماموریت
                        </a>
                    </li>
                    <li><a href="{{route('admin.module.mission.list')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            ماموریت</a>
                    </li>
                    <li><a href="{{route('admin.module.mission.stores')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواست های ماموریت-سرپرست')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواست های ماموریت</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.mission.show-supervsior')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            ماموریت</a>
                    </li>
                    <li><a href="{{route('admin.module.mission.make-supervsior')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواست های ماموریت-مدیریت')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواستهای ماموریت</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.mission.show-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            ماموریت</a>
                    </li>
                    <li><a href="{{route('admin.module.mission.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('خرید کالا')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>خرید کالا</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.buy.index')}}"><i class="fa fa-circle-o"></i>ثبت خرید کالا
                        </a>
                    </li>
                    <li><a href="{{route('admin.module.buy.list')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                            های
                            خرید کالا</a>
                    </li>
                    <li><a href="{{route('admin.module.buy.stores')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواست های خرید کالا-سرپرست')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواست های خرید کالا</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.buy.show-supervsior')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            خرید کالا</a>
                    </li>
                    <li><a href="{{route('admin.module.buy.make-supervsior')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('درخواست های خرید کالا-مدیریت')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>درخواستهای خرید کالا</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.module.buy.show-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواست
                            های
                            خرید کالا</a>
                    </li>
                    <li><a href="{{route('admin.module.buy.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                            درخواستهای
                            بایگانی شده</a>
                    </li>
                </ul>
            </li>
        @endcan


        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>تولید تور قفس</span>
                <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.module.cage.index')}}"><i class="fa fa-circle-o"></i>ثبت تور قفس
                    </a>
                </li>
                <li><a href="{{route('admin.module.cage.list')}}"><i class="fa fa-circle-o"></i>لیست درخواست
                        های
                        تور قفس</a>
                </li>
                <li><a href="{{route('admin.module.cage.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                        درخواستهای
                        بایگانی شده</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>درخواستهای خرید تور قفس</span>
                <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.module.cage.show-admin')}}"><i class="fa fa-circle-o"></i>لیست
                        درخواست
                        های
                        تور قفس</a>
                </li>
                <li><a href="{{route('admin.module.cage.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                        درخواستهای
                        بایگانی شده</a>
                </li>
            </ul>
        </li>


        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>تولید تورصید ماهی</span>
                <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.module.fish.index')}}"><i class="fa fa-circle-o"></i>ثبت تورصید ماهی
                    </a>
                </li>
                <li><a href="{{route('admin.module.fish.list')}}"><i class="fa fa-circle-o"></i> درخواست
                        های
                        تورصید ماهی</a>
                </li>
                <li><a href="{{route('admin.module.cage.make-admin')}}"><i class="fa fa-circle-o"></i>لیست
                        درخواستهای
                        بایگانی شده</a>
                </li>
            </ul>
        </li>

    </ul>
</section>
