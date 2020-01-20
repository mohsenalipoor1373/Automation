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
        $('#saveBtn').click(function (e) {
            $("#saveBtn").attr("disabled", true);
            $("#saveBtn").val('در حال ثبت اطلاعات');

            e.preventDefault();
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.sell.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $("#saveBtn").attr("disabled", false);
                    $("#saveBtn").val('ثبت');
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

