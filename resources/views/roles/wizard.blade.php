@extends('layouts.master')

@section('content')
    @include('massage.msg')

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                افزودن دسترسی
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.roles.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>عنوان دسترسی</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box box-default"><!-- /.box-header -->
                            <div class="box-header with-border">
                                <h3 class="box-title">دسترسی</h3>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <input name="permission[]" type="checkbox" value="{{$permission->id}}">
                                                    {{$permission->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            <hr/>
                                <div class="form-group">
                                    <input type="submit" value="ثبت دسترسی" class="btn btn-success">
                                </div>

                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection
