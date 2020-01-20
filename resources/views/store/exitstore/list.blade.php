@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        بایگانی خروجی کالا از انبار
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>نوع کالا</th>
                            <th>تعداد</th>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>تاریخ درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td>{{$store->type}}</td>
                                <td>{{$store->number}}</td>
                                <td>{{$store->name}}</td>
                                <td>{{$store->phone}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($store->created_at)->format('Y/m/d')}}</td>
                                <td>
                                        <a href="{{route('admin.module.buy.edit',$store->id)}}">
                                            <img src="{{url('/icon/icons8-edit-property-48.png')}}"
                                                 width="25" title="ویرایش ">
                                        </a>
                                        <a href="{{route('admin.module.buy.delete',$store->id)}}">
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
