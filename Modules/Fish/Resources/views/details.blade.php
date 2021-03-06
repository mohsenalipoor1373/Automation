@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های تولید تور صید ماهی
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>نام مشتری</th>
                            <th>تعداد</th>
                            <th>ابعاد</th>
                            <th>مش</th>
                            <th>جنس نخ و نمره</th>
                            <th>سرب</th>
                            <th>طناب1</th>
                            <th>طناب2</th>
                            <th>بویه</th>
                            <th>رشته های نخ</th>
                            <th>حلقه</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>تاریخ تولید</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Fishs as $Fish)
                            <tr>
                                <td>{{$Fish->name}}</td>
                                <td>{{$Fish->number}}</td>
                                <td>{{$Fish->dimensions}}</td>
                                <td>{{$Fish->mesh}}</td>
                                <td>{{$Fish->yarn}}</td>
                                <td>{{$Fish->lead}}</td>
                                <td>{{$Fish->ropeone}}</td>
                                <td>{{$Fish->ropetwo}}</td>
                                <td>{{$Fish->booy}}</td>
                                <td>{{$Fish->strands}}</td>
                                <td>{{$Fish->ring}}</td>
                                <td>
                                    @if(empty($Fish->description))
                                        <span class="btn btn-info">توضیحی ثبت نشده است</span>
                                    @else
                                        <span class="btn btn-info"
                                              title="{{$Fish->description}}">{{str_limit($Fish->description,20)}}</span>
                                    @endif
                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($Fish->created_at)->format('Y/m/d')}}</td>
                                <td>


                                    @if(empty($Fish->date))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @else
                                        <span class="btn btn-info">{{$Fish->date}}</span>
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
