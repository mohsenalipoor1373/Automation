@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ویرایش ماموریت
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.mission.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control" value="{{$id->user->name}}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره پرسنلی</label>
                                    <input type="text" name="personnel_id" class="form-control"
                                           value="{{$id->user->personnel_id}}"
                                           disabled>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>محل ماموریت</label>
                                    <input type="text" name="location" class="form-control"
                                           value="{{$id->location}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>از تاریخ</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="from" class="form-control"
                                               value="{{$id->from}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>از ساعت</label>
                                    <input type="text" name="fromtime" class="form-control"
                                           value="{{$id->fromtime}}">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تا تاریخ</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="to" class="form-control"
                                               value="{{$id->to}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تا ساعت</label>
                                    <input type="text" name="totime" class="form-control"
                                           value="{{$id->totime}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>اولویت</label>
                                    <select class="form-control" name="Priority">
                                        <option value="1" @if($id->Priority == 1) selected @endif>ضروری</option>
                                        <option value="2" @if($id->Priority == 2) selected @endif>عادی</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>شرح اقدامات انجام شده</label>
                                    <textarea name="summary" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$id->summary}}</textarea>
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
                            <input type="submit" value="ثبت درخواست" class="btn btn-success">
                            <a href="{{route('admin.module.leave.index')}}" class="btn btn-danger">برگشت</a>

                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection
