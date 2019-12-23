@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های کسر کار
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره پرسنلی</th>
                            <th>در تاریخ</th>
                            <th>به مدت</th>
                            <th>نوع کسر کار</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Fractions as $Fraction)
                            <tr>
                                <td>{{$Fraction->user->name}}</td>
                                <td>{{$Fraction->user->personnel_id}}</td>
                                <td>{{$Fraction->history}}</td>
                                <td>{{$Fraction->Term}}</td>
                                <td>{{$Fraction->type}}</td>
                                <td>
                                    @if(empty($Fraction->description))
                                        <span class="btn btn-info">توضیحی ثبت نشده است</span>
                                    @else
                                        <span class="btn btn-info"
                                              title="{{$Fraction->description}}">{{str_limit($Fraction->description,20)}}</span>

                                    @endif


                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($Fraction->created_at)->format('Y/m/d')}}</td>


                                <td>
                                    <a href="{{route('admin.module.fractions.supervisor.true',$Fraction->id)}}">
                                        <img src="{{url('/icon/icons8-ok-48.png')}}"
                                             width="25" title="تایید درخواست">
                                    </a>
                                    <a href="{{route('admin.module.fractions.supervisor.false',$Fraction->id)}}">
                                        <img src="{{url('/icon/icons8-delete-64.png')}}"
                                             width="25" title="مخالفت با درخواست">
                                    </a>
                                    <a href="{{route('admin.module.fractions.supervisor.list',$Fraction->id)}}">
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
