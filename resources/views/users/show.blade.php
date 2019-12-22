@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست کاربران
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th> نام و نام خانوادگی</th>
                            <th>دسترسی</th>
                            <th> کد ملی</th>
                            <th> شماره تماس</th>
                            <th> کد پرسنلی</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        @if(!empty($role))
                                            <span class="btn btn-danger">{{$role}}</span>
                                        @else
                                            <span class="btn btn-info">بدون دسترسی</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->personnel_id}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('Y/m/d')}}</td>
                                <td>
                                        <a href="{{route('admin.users.edit',$user->id)}}">
                                            <img src="{{url('/icon/icons8-edit-property-48.png')}}"
                                                 width="25" title="ویرایش کاربر">
                                        </a>
                                        <a href="{{route('admin.users.delete',$user->id)}}">
                                            <img src="{{url('/icon/icons8-delete-bin-48.png')}}"
                                                 width="25" title="حذف کاربر">
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
