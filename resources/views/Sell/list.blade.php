@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        بایگانی فروش ها
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>کد مشتری</th>
                            <th>نام مشتری</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sells as $sell)
                            <tr>
                                <td>{{$sell->code}}</td>
                                <td>{{$sell->name}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($sell->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    <a href="{{route('admin.sell.view',$sell->id)}}">
                                        <img src="{{url('/icon/icons8-analyze-96.png')}}"
                                             width="25" title="مشاهده ">
                                    </a>

                                    <a href="{{route('admin.sell.edit',$sell->id)}}">
                                        <img src="{{url('/icon/icons8-edit-property-48.png')}}"
                                             width="25" title="ویرایش ">
                                    </a>
                                    <a href="{{route('admin.sell.delete',$sell->id)}}">
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
