@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ثبت خرید کالا
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.buy.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام کالا</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{$id->name}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>بخش</label>
                                    <select name="role_id" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"
                                                    @if($id->role_id == $role->id) selected @endif>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تعداد سفارش</label>
                                    <input type="number" name="number" class="form-control"
                                           value="{{$id->number}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>خریداری شده</label>
                                    <input type="text" name="store" class="form-control"
                                           value="{{$id->store}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>اولویت</label>
                                    <select name="Priority" class="form-control">
                                        <option value="1" @if($id->Priority == 1) selected @endif>ضروری</option>
                                        <option value="2" @if($id->Priority == 2) selected @endif>عادی</option>
                                    </select>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea name="description" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$id->description}}</textarea>
                                </div>
                            </div>


                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="submit" value="ثبت" class=" btn btn-success">
                            <a href="{{route('admin.module.leave.index')}}" class=" btn btn-danger">برگشت</a>

                        </div>
                    </form>

                </div>
            </div>


        </div>
    </div>


@endsection
