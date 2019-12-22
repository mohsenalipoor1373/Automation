@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست درخواست های تولید تور قفس</h3>
                </div>
                <!-- /.box-header -->
                @include('massage.msg')

                <div class="box-body">
                    <table class="table table-bordered table-striped data-table">
                        <thead>
                        <tr>
                            <th>نام مشتری</th>
                            <th>تعداد</th>
                            <th>قطر</th>
                            <th>ارتفاع</th>
                            <th>جنس نخ ونمره</th>
                            <th>طناب عمودی</th>
                            <th>طناب افقی</th>
                            <th>طناب کف</th>
                            <th>طناب اتصال</th>
                            <th>دوبل</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>تاریخ تولید</th>
                            <th>تولید</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>


    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: '300px',
                sScrollX: '100%',
                sScrollXInner: '170%',
                scrollCollapse: true,
                paging: false,
                rowReorder: true,

                ajax: "{{ route('admin.module.cage.list') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'number', name: 'number'},
                    {data: 'diameter', name: 'diameter'},
                    {data: 'height', name: 'height'},
                    {data: 'yarn', name: 'yarn'},
                    {data: 'verticalrope', name: 'verticalrope'},
                    {data: 'horizontalrope', name: 'horizontalrope'},
                    {data: 'floorrope', name: 'floorrope'},
                    {data: 'connectingrope', name: 'connectingrope'},
                    {data: 'double', name: 'double'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'date', name: 'date'},

                    {data: 'buy', name: 'buy'},
                    {
                        data: 'action', name: 'action'
                    },
                ]
            });
        });

    </script>
@endsection
