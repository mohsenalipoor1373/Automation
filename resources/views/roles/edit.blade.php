@extends('layouts.master')

@section('content')
    @include('massage.msg')

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ویرایش دسترسی
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">

                    <form method="post" action="{{route('admin.roles.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>عنوان بخش</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{$role->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="box box-default"><!-- /.box-header -->
                            <div class="box-header with-border">
                                <h3 class="box-title">دسترسی</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">


                                    @foreach($permission as $value)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ $value->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <hr/>
                                <div class="form-group">
                                    <input type="submit" value="ویرایش دسترسی" class="btn btn-success">
                                    <a href="{{route('admin.roles.show')}}"
                                       class="btn btn-danger">برگشت</a>
                                </div>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection
