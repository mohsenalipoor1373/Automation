@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">درخواست مساعده</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('admin.users.store')}}">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>شماره سند حسابداری</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>مبلغ درخواستی(ریال)</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="col-md-1">
                    <input type="submit" value="ثبت" class="form-control btn btn-success">
                </div>
                <div class="col-md-1">
                    <a href="{{route('admin.users.show')}}" class="form-control btn btn-danger">برگشت</a>

                </div>
            </form>

        </div>
    </div>


@endsection
