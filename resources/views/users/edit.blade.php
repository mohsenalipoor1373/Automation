@extends('layouts.master')

@section('content')

    @include('massage.msg')

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ویرایش پرسنل
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.users.update')}}">

                        <div class="row">
                            @csrf
                            @if($id)
                                <input type="hidden" name="id" value="{{$id->id}}">
                            @endif
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control"
                                           @if($id) value="{{$id->name}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>کد ملی</label>
                                    <input type="text" name="email" class="form-control"
                                           @if($id) value="{{$id->email}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره تماس</label>
                                    <input type="text" name="phone" class="form-control"
                                           @if($id) value="{{$id->phone}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره پرسنلی</label>
                                    <input type="text" name="personnel_id" class="form-control"
                                           @if($id) value="{{$id->personnel_id}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>بخش</label>
                                    <select name="roles[]" class="form-control select2"
                                            data-placeholder="لطفا بخش را انتخاب کنید"
                                            style="width: 100%;">
                                        @foreach($roles as $role)
                                            @foreach($userRoles as $userRole)
                                                <option value="{{$role->id}}"
                                                        @if($id and $userRole == $role->id) selected @endif>
                                                    {{$role->name}}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>کلمه عبور</label>
                                    <input type="password" name="password" class="form-control"
                                           @if($id) value="{{$id->password}}" @endif>
                                </div>
                            </div>

                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="submit" value="ویرایش پرسنل" class="btn btn-success">
                            <a href="{{route('admin.users.show')}}" class="btn btn-danger">برگشت</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection
