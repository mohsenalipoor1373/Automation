@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ویرایش اطلاعات فروش جدید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="registercontpage">
                        <form autocomplete="off" id="productForm"
                              name="productForm" class="form-horizontal">
                            <input type="hidden" id="id" name="id" value="{{$id->id}}">
                            @csrf
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <label>نام مشتری</label>
                                    <input class="form-control"
                                           value="{{$id->name}}"
                                           type="text" name="name" id="name">

                                </div>
                                <div class="col-md-6">
                                    <label>کد مشتری</label>
                                    <input class="form-control"
                                           value="{{$id->code}}"
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
                                                <td>عملیات</td>
                                            </tr>
                                            </thead>
                                            <tbody id="TextBoxContainer">
                                            @foreach($sells as $sell)
                                                <tr>
                                                    <td><input name="code_calla[]" type="text"
                                                               value="{{$sell->code_calla}}" class="form-control"/></td>
                                                    <td><input name="name_calla[]" type="text"
                                                               value="{{$sell->name_calla}}" class="form-control"/></td>
                                                    <td><input name="tedad_calla[]" type="text"
                                                               value="{{$sell->tedad_calla}}" class="form-control"/>
                                                    </td>
                                                    <td><input name="f_calla[]" type="text" value="{{$sell->f_calla}}"
                                                               class="form-control"/></td>
                                                    <td><input name="price_calla[]" type="text"
                                                               value="{{$sell->price_calla}}" class="form-control"/>
                                                    </td>
                                                    <td><input name="t_calla[]" type="text" value="{{$sell->t_calla}}"
                                                               class="form-control"/></td>
                                                    <td><input name="mfinal_calla[]" type="text"
                                                               value="{{$sell->mfinal_calla}}" class="form-control"/>
                                                    </td>
                                                    <td><input name="dec_calla[]" type="text"
                                                               value="{{$sell->dec_calla}}" class="form-control"/></td>
                                                    <td>
                                                        <button type="button" data-original-title="حذف"
                                                                class="btn btn-danger remove"><i
                                                                class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
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
                            <input type="submit" class="btn btn-primary" id="editBtn" value="ثبت">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/1.js')}}"></script>
    <link href="{{asset('/css/1.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{asset('/js/2.js')}}"></script>
    <script>

        $(function () {
            $("#btnAdd").bind("click", function () {
                var div = $("<tr />");
                div.html(GetDynamicTextBox(""));
                $("#TextBoxContainer").append(div);
            });
            $("body").on("click", ".remove", function () {
                $(this).closest("tr").remove();
            });
        });

        function GetDynamicTextBox(value) {


            return '<td><input name = "code_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "name_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "tedad_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "f_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "price_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "t_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "mfinal_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><input name = "dec_calla[]" type="text" value = "' + value + '" class="form-control" /></td>' +
                '<td><button type="button" data-original-title="حذف" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>'
        }

    </script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#editBtn').click(function (e) {
                $("#editBtn").attr("disabled", true);
                $("#editBtn").val('در حال ثبت اطلاعات');

                e.preventDefault();
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('admin.sell.update') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $("#editBtn").attr("disabled", false);
                        $("#editBtn").val('ثبت');
                        if (data.errors) {
                            jQuery.each(data.errors, function (key, value) {
                                Swal.fire({
                                    title: 'خطا!',
                                    text: value,
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                })
                            });
                        }
                        if (data.success) {

                            Swal.fire({
                                title: 'موفق',
                                text: data.success,
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })

                        }
                    }
                });
            });
        });

    </script>


@endsection
