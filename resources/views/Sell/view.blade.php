@extends('layouts.master')
@include('Sell.scripts.layout')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ثبت اطلاعات فروش جدید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="registercontpage">
                        <form autocomplete="off" id="productForm"
                              name="productForm" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label>نام مشتری</label>
                                    <input class="form-control"
                                           value="{{$id->name}}"
                                           disabled
                                           type="text" name="name" id="name">

                                </div>
                                <div class="col-md-6">
                                    <label>کد مشتری</label>
                                    <input class="form-control"
                                           value="{{$id->code}}" disabled
                                           type="text" name="code" id="code">

                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                    <div class="table table-responsive">
                                        <table
                                            class="table table-responsive table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <td>کد کالا</td>
                                                <td>نام کالا</td>
                                                <td>تعداد</td>
                                                <td>فی</td>
                                                <td>مبلغ</td>
                                                <td>تخفیف</td>
                                                <td>مبلغ نهایی</td>
                                                <td>توضیحات</td>
                                            </tr>
                                            </thead>
                                            <tbody id="TextBoxContainer">
                                            @foreach($sells as $sell)
                                                <tr>
                                                    <td><input disabled name = "code_calla[]" type="text" value="{{$sell->code_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "name_calla[]" type="text" value="{{$sell->name_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "tedad_calla[]" type="text" value="{{$sell->tedad_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "f_calla[]" type="text" value="{{$sell->f_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "price_calla[]" type="text" value="{{$sell->price_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "t_calla[]" type="text" value="{{$sell->t_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "mfinal_calla[]" type="text" value="{{$sell->mfinal_calla}}" class="form-control" /></td>
                                                    <td><input disabled name = "dec_calla[]" type="text" value="{{$sell->dec_calla}}" class="form-control" /></td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
