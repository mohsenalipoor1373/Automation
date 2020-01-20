@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                رسید کالا
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.Goods.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع کالا</label>
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
                                    <label>ارسال کننده</label>
                                    <input type="text" name="sender" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>واحد</label>
                                    <input type="text" name="role" class="form-control">
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea name="description" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>شرح کالا</label>
                                    <textarea name="summary" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
