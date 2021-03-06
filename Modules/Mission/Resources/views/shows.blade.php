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
                            <th>عملیات</th>
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
                                    <a href="{{route('admin.module.mission.super.success',$Mission->id)}}">
                                        <img src="{{url('/icon/icons8-ok-48.png')}}"
                                             width="25" title="تایید درخواست">
                                    </a>
                                    <a href="{{route('admin.module.mission.super.error',$Mission->id)}}">
                                        <img src="{{url('/icon/icons8-delete-64.png')}}"
                                             width="25" title="مخالفت با درخواست">
                                    </a>
                                    <a href="{{route('admin.module.leave.supervisor.list',$Mission->id)}}">
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
