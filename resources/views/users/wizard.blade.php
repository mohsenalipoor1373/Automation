@extends('layouts.master')

@section('content')
    @include('massage.msg')

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                افزودن پرسنل
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.users.store')}}" enctype="multipart/form-data">
                        @csrf
                        @if($id)
                            <input type="hidden" name="id" value="{{$id->id}}">
                        @endif
                        <div class="row">
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
                                    <label>تصویر پرسنل</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>بخش</label>
                                    <select name="roles[]" class="form-control select2"
                                            data-placeholder="لطفا بخش را انتخاب کنید"
                                            style="width: 100%;">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>کلمه عبور</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="submit" value="ثبت کاربر جدید" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
