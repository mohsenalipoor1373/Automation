<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({

            processing: true,
            serverSide: true,

            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },


            ajax: "{{ route('admin.customers.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'name', name: 'name'},
                {data: 'state', name: 'state'},
                {data: 'method', name: 'method'},
                {data: 'expert', name: 'expert'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#product').val('');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.customer.update') }}" + '/' + product_id, function (data) {
                $('#ajaxModel').modal('show');
                $('#product').val(data.id);
                $('#name').val(data.name);
                $('#code').val(data.code);
                $('#type').val(data.type);
            });

        });


        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.customer.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModel').modal('hide');
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
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }

                }
            });
        });
    });
    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف فروشنده؟',
            text: "مشخصات حذف شده قابل بازیابی نیستند!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'حذف',
            cancelButtonText: 'انصراف',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{route('admin.customers.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات فروشنده با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });
    $('#customer').addClass('active');

</script>
