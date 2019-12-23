@extends('layouts.master')

@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">ثبت تاریخ</h3>
        </div>
    @include('massage.msg')

    <!-- /.box-header -->

        <div class="box-body">

            <form method="post" action="{{route('admin.module.fish.date.store')}}">
                @csrf
                <input type="hidden" name="id" value="{{$id->id}}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تاریخ</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" class="form-control observer-example">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1">
                    <input type="submit" value="ثبت" class="form-control btn btn-success">
                </div>
                <div class="col-md-1">
                    <a href="{{route('admin.module.leave.index')}}" class="form-control btn btn-danger">برگشت</a>
                </div>
            </form>

        </div>
    </div>


@endsection
