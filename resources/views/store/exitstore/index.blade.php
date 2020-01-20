@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                خروج کالا از انبار
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.store.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع کالا</label>
                                    <input type="text" name="type" class="form-control">
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
                                    <label>شماره تماس</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام مشتری</label>
                                    <input type="text" name="name" class="form-control">
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
                                    <label>نشانی مشتری</label>
                                    <textarea name="adders" id="mytextarea"
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
