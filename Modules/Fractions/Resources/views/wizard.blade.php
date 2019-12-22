@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                درخواست کسر کار
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.fractions.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
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
                                    <label>به مدت</label>
                                    <input type="number" name="Term" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع</label>
                                    <select class="form-control" name="type">
                                        <option value="روز">روز</option>
                                        <option value="ساعت">ساعت</option>
                                    </select>
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
                            <input type="submit" value="ثبت درخواست" class=" btn btn-success">
                            <a href="{{route('admin.module.fractions.index')}}" class=" btn btn-danger">برگشت</a>

                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>



@endsection
