@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های تولید تور قفس
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>نام مشتری</th>
                            <th>تعداد</th>
                            <th>قطر</th>
                            <th>ارتفاع</th>
                            <th>جنس نخ و نمره</th>
                            <th>طناب عمودی</th>
                            <th>طناب افقی</th>
                            <th>طناب کف</th>
                            <th>طناب اتصال</th>
                            <th>دوبل</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Cages as $Cage)
                            <tr>
                                <td>{{$Cage->name}}</td>
                                <td>{{$Cage->number}}</td>
                                <td>{{$Cage->diameter}}</td>
                                <td>{{$Cage->height}}</td>
                                <td>{{$Cage->yarn}}</td>
                                <td>{{$Cage->verticalrope}}</td>
                                <td>{{$Cage->horizontalrope}}</td>
                                <td>{{$Cage->floorrope}}</td>
                                <td>{{$Cage->connectingrope}}</td>
                                <td>{{$Cage->double}}</td>
                                <td>
                                    @if(empty($Cage->description))
                                        <span class="btn btn-info">توضیحی ثبت نشده است</span>
                                    @else
                                        <span class="btn btn-info"
                                              title="{{$Cage->description}}">{{str_limit($Cage->description,20)}}</span>
                                    @endif
                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($Cage->created_at)->format('Y/m/d')}}</td>


                                <td>
                                    @if($Cage->final == null)
                                        <a href="{{route('admin.module.buy.cagemm',$Cage->id)}}"><span
                                                class="btn btn-info">تایید</span></a>

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
