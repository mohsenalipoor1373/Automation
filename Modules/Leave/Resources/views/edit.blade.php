@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ویرایش درخواست مرخصی
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">

                    <form method="post" action="{{route('admin.module.leave.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره پرسنلی</label>
                                    <input type="text" name="personnel_id" class="form-control" value="{{$user->personnel_id}}"
                                           disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع مرخصی</label>
                                    <select id="Type" name="Type" class="form-control">
                                        <option value="1" @if($id and $id->Type == "استحقاقی") selected @endif>استحقاقی</option>
                                        <option value="2" @if($id and $id->Type == "استعلاجی") selected @endif>استعلاجی</option>
                                        <option value="3" @if($id and $id->Type == "ساعتی") selected @endif>ساعتی</option>
                                    </select>
                                </div>
                            </div>
                            @if($id->Type == "استحقاقی" or $id->Type == "استعلاجی")

                                <div id="example1" class="col-md-3">
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
                                <div id="example2" class="col-md-3">
                                    <div class="form-group">
                                        <label>تا تاریخ</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="todate" class="form-control"
                                                   value="{{$id->todate}}">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div id="example3" class="col-md-3">
                                    <div class="form-group">
                                        <label>در تاریخ</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="history" class="form-control"
                                                   value="{{$id->history}}">
                                        </div>
                                    </div>
                                </div>

                                <div id="FromHour" class="col-md-3">
                                    <div class="form-group">
                                        <label>از ساعت</label>
                                        <input type="text" class="form-control" name="FromHour" value="{{$id->FromHour}}">
                                    </div>
                                </div>

                                <div id="until" class="col-md-3">
                                    <div class="form-group">
                                        <label>تا ساعت</label>
                                        <input type="text" class="form-control" name="until" value="{{$id->until}}">
                                    </div>
                                </div>
                            @endif

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
                                    <input type="text" class="form-control" name="FrommHour"
                                           value="{{$id->FromHour}}">
                                </div>
                            </div>

                            <div id="until" style="display: none" class="col-md-3">
                                <div class="form-group">
                                    <label>تا ساعت</label>
                                    <input type="text" class="form-control" name="unntil"
                                           value="{{$id->until}}">
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
                                    <label>توضیحات</label>
                                    <textarea name="description" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$id->description}}</textarea>
                                </div>
                            </div>


                        </div>
                    <hr/>
                        <div class="form-group">
                            <input type="submit" value="ویرایش درخواست" class=" btn btn-success">
                            <a href="{{route('admin.module.leave.show')}}" class=" btn btn-danger">برگشت</a>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
