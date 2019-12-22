@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                درخواست اضافه کار
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.overtime.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control" value="{{$id->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره پرسنلی</label>
                                    <input type="text" name="personnel_id" class="form-control" value="{{$id->personnel_id}}"
                                           disabled>
                                </div>
                            </div>

                            <div id="example3" class="col-md-3">
                                <div class="form-group">
                                    <label>در تاریخ</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="history" class="form-control observer-example">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>از ساعت</label>
                                    <input type="number" class="form-control" name="FromHour">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تا ساعت</label>
                                    <input type="number" class="form-control" name="until">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea name="description" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>


                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="submit" value="ثبت درخواست" class="btn btn-success">
                            <a href="{{route('admin.module.leave.index')}}" class="btn btn-danger">برگشت</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
