@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                درخواست مرخصی
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.leave.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره پرسنلی</label>
                                    <input type="text" name="personnel_id" class="form-control"
                                           value="{{$user->personnel_id}}"
                                           disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع مرخصی</label>
                                    <select id="Type" name="Type" class="form-control">
                                        <option value="0">انتخاب کنید...</option>
                                        <option value="1">استحقاقی</option>
                                        <option value="2">استعلاجی</option>
                                        <option value="3">ساعتی</option>
                                    </select>
                                </div>
                            </div>


                            <div style="display: none" id="example1" class="col-md-3">
                                <div class="form-group">
                                    <label>از تاریخ</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="from" class="form-control observer-example">
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" id="example2" class="col-md-3">
                                <div class="form-group">
                                    <label>تا تاریخ</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="todate" class="form-control observer-example">
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" id="example3" class="col-md-3">
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

                            <div id="FromHour" style="display: none" class="col-md-3">
                                <div class="form-group">
                                    <label>از ساعت</label>
                                    <input type="text" class="form-control" name="FromHour">
                                </div>
                            </div>

                            <div id="until" style="display: none" class="col-md-3">
                                <div class="form-group">
                                    <label>تا ساعت</label>
                                    <input type="text" class="form-control" name="until">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>اولویت</label>
                                    <select class="form-control" name="Priority">
                                        <option value="1">ضروری</option>
                                        <option value="2">عادی</option>
                                    </select>
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
