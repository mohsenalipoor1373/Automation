@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های مرخصی
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>درخواست دهنده</th>
                            <th>شماره پرسنلی</th>
                            <th>نوع مرخصی</th>
                            <th>در تاریخ</th>
                            <th>از</th>
                            <th>تا</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Leaves as $Leave)
                            <tr>
                                <td>{{$Leave->user->name}}</td>
                                <td>{{$Leave->user->personnel_id}}</td>
                                <td>{{$Leave->Type}}</td>
                                <td>{{$Leave->history}}</td>
                                <td>
                                    @if(empty($Leave->from))
                                        <span class="btn btn-info">{{$Leave->FromHour}}</span>
                                    @else
                                        <span class="btn btn-info">{{$Leave->from}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($Leave->todate))
                                        <span class="btn btn-info">{{$Leave->until}}</span>
                                    @else
                                        <span class="btn btn-info">{{$Leave->todate}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($Leave->description))
                                        <span class="btn btn-info">توضیحات ثبت نشده است</span>
                                    @else
                                        <span class="btn btn-info"
                                              title="{{$Leave->description}}">{{str_limit($Leave->description,20)}}
                                        </span>
                                    @endif
                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($Leave->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    <a href="{{route('admin.module.leave.supervisor.true',$Leave->id)}}">
                                        <img src="{{url('/icon/icons8-ok-48.png')}}"
                                             width="25" title="تایید درخواست">
                                    </a>
                                    <a href="{{route('admin.module.leave.supervisor.false',$Leave->id)}}">
                                        <img src="{{url('/icon/icons8-delete-64.png')}}"
                                             width="25" title="مخالفت با درخواست">
                                    </a>
                                    <a href="{{route('admin.module.leave.supervisor.list',$Leave->id)}}">
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
