@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های ماموریت
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>مامور</th>
                            <th>شماره پرسنلی</th>
                            <th>محل ماموریت</th>
                            <th>از</th>
                            <th>تا</th>
                            <th>تاریخ درخواست</th>
                            <th>سرپرست</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Missions as $Mission)
                            <tr>
                                <td>{{$Mission->user->name}}</td>
                                <td>{{$Mission->user->personnel_id}}</td>
                                <td>{{$Mission->location}}</td>
                                <td>{{$Mission->from}}</td>
                                <td>{{$Mission->to}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($Mission->created_at)->format('Y/m/d')}}</td>

                                <td>
                                    @if(empty($Mission->Supervisor))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif($Mission->Supervisor == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @elseif($Mission->Supervisor == 3)
                                        <span class="btn btn-success">اولویت ضروری</span>
                                    @else
                                        <span class="btn btn-success">تایید نشده</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($Mission->Admin))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif($Mission->Admin == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @else
                                        <span class="btn btn-success">تایید نشده</span>
                                    @endif
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
