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
                            <th>سرپرست</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->user->name}}</td>
                                <td>{{$user->user->personnel_id}}</td>
                                <td>{{$user->Type}}</td>
                                <td>{{$user->history}}</td>
                                <td>
                                    @if(empty($user->from))
                                        <span class="btn btn-info">{{$user->FromHour}}</span>
                                    @else
                                        <span class="btn btn-info">{{$user->from}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($user->todate))
                                        <span class="btn btn-info">{{$user->until}}</span>
                                    @else
                                        <span class="btn btn-info">{{$user->todate}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($user->description))
                                        <span class="btn btn-info">توضیحات ثبت نشده است</span>
                                    @else
                                        <span class="btn btn-info"
                                              title="{{$user->description}}">{{str_limit($user->description,20)}}
                                        </span>
                                    @endif
                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    @if (empty($user->Supervisor))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif ($user->Supervisor == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @elseif ($user->Supervisor == 3)
                                        <span class="btn btn-primary">اولویت ضروری</span>
                                    @else
                                        <span class="btn btn-danger">تایید نشده</span>
                                    @endif


                                </td>
                                <td>
                                    @if (empty($user->Admin))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif ($user->Admin == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @elseif ($user->Admin == 2)
                                        <span class="btn btn-primary">تایید نشده توسط سرپرست</span>
                                    @else
                                        <span class="btn btn-danger">تایید نشده</span>
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
