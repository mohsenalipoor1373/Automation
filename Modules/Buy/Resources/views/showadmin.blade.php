@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های خرید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>نام کالا</th>
                            <th>تعداد سفارش</th>
                            <th>خریداری شده</th>
                            <th>تاریخ درخواست</th>
                            <th>سرپرست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Buys as $Buy)
                            <tr>
                                <td>{{$Buy->name}}</td>
                                <td>{{$Buy->number}}</td>
                                <td>{{$Buy->store}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($Buy->created_at)->format('Y/m/d')}}</td>

                                <td>
                                    @if(empty($Buy->Supervisor))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif($Buy->Supervisor == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @elseif($Buy->Supervisor == 3)
                                        <span class="btn btn-success">اولویت ضروری</span>
                                    @else
                                        <span class="btn btn-success">تایید نشده</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.module.buy.admin.success',$Buy->id)}}">
                                        <img src="{{url('/icon/icons8-ok-48.png')}}"
                                             width="25" title="تایید درخواست">
                                    </a>
                                    <a href="{{route('admin.module.buy.admin.error',$Buy->id)}}">
                                        <img src="{{url('/icon/icons8-delete-64.png')}}"
                                             width="25" title="مخالفت با درخواست">
                                    </a>
                                    <a href="{{route('admin.module.leave.supervisor.list',$Buy->id)}}">
                                        <img src="{{url('/icon/icons8-zoom-in-64.png')}}"
                                             width="25" title="مشاهده جزییات ">
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
