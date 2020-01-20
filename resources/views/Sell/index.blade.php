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
                                    <input class="form-control" type="text" name="name" id="name">

                                </div>
                                <div class="col-md-6">
                                    <label>کد مشتری</label>
                                    <input class="form-control" type="text" name="code" id="code">

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
                                                        <td>عملیات</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="TextBoxContainer">
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>

                                                            <button id="btnAdd" type="button"
                                                                    class="btn btn-primary"
                                                                    data-toggle="tooltip">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                            <input type="submit" class="btn btn-primary" id="saveBtn" value="ثبت">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
