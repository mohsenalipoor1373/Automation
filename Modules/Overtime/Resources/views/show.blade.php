@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های اضافه کار
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>درخواست دهنده</th>
                            <th>شماره پرسنلی</th>
                            <th>در تاریخ</th>
                            <th>از</th>
                            <th>تا</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>مدیریت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($OverTimes as $OverTime)
                            <tr>
                                <td>{{$OverTime->user->name}}</td>
                                <td>{{$OverTime->user->personnel_id}}</td>
                                <td>{{$OverTime->history}}</td>
                                <td>{{$OverTime->FromHour}}</td>
                                <td>{{$OverTime->until}}</td>
                                <td>
                                    @if(empty($OverTime->description))
                                        <span class="btn btn-info">توضیحی ثبت نشده است</span>
                                    @else
                                        <span class="btn btn-info"
                                              title="{{$OverTime->description}}">{{str_limit($OverTime->description,20)}}</span>
                                    @endif


                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($OverTime->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    @if (empty($OverTime->Admin))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif ($OverTime->Admin == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @else
                                        <span class="btn btn-danger">تایید نشده</span>
                                    @endif


                                </td>
                                <td>
                                    @if(empty($OverTime->Admin))
                                        <a href="{{route('admin.module.overtime.edit',$OverTime->id)}}">
                                            <img src="{{url('/icon/icons8-edit-property-48.png')}}"
                                                 width="25" title="ویرایش ">
                                        </a>
                                        <a href="{{route('admin.module.overtime.delete',$OverTime->id)}}">
                                            <img src="{{url('/icon/icons8-delete-bin-48.png')}}"
                                                 width="25" title="حذف ">
                                        </a>
                                    @else
                                        <a href="{{route('admin.module.overtime.save',$OverTime->id)}}"><span class="btn btn-danger">بایگانی</span></a>
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
