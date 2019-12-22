@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                تولید تور قفس
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">

                    <form method="post" action="{{route('admin.module.cage.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام مشتری</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تعداد</label>
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>قطر</label>
                                    <input type="text" name="diameter" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ارتفاع</label>
                                    <input type="text" name="height" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>جنس نخ و نمره</label>
                                    <input type="text" name="yarn" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>طناب عمودی</label>
                                    <input type="text" name="verticalrope" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>طناب افقی</label>
                                    <input type="text" name="horizontalrope" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>طناب کف</label>
                                    <input type="text" name="floorrope" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>طناب اتصال واتر لاین</label>
                                    <input type="text" name="connectingrope" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>دوبل</label>
                                    <input type="text" name="double" class="form-control">
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
                            <a href="{{route('admin.module.leave.index')}}" class=" btn btn-danger">برگشت</a>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
