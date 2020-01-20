@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        باسگانی رسید کالا به انبار
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>نوع کالا</th>
                            <th>تعداد</th>
                            <th>واحد</th>
                            <th>ارسال کننده</th>
                            <th>شرح کالا</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goods as $good)
                            <tr>
                                <td>{{$good->name}}</td>
                                <td>{{$good->number}}</td>
                                <td>{{$good->role}}</td>
                                <td>{{$good->sender}}</td>
                                <td>{{$good->summary}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($good->created_at)->format('Y/m/d')}}</td>
                                <td>
                                        <a href="{{route('admin.module.buy.edit',$good->id)}}">
                                            <img src="{{url('/icon/icons8-edit-property-48.png')}}"
                                                 width="25" title="ویرایش ">
                                        </a>
                                        <a href="{{route('admin.module.buy.delete',$good->id)}}">
                                            <img src="{{url('/icon/icons8-delete-bin-48.png')}}"
                                                 width="25" title="حذف ">
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
