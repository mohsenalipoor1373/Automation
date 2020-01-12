@extends('layouts.master')

@section('content')
@include('massage.msg')

    <div class="row">
        <div class="col-md-3">
            <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">بازشگت</a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">پوشه ها</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="mailbox.html"><i class="fa fa-inbox"></i> صندوق ورودی
                                <span class="label label-primary pull-left">1</span></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> ارسال شده</a></li>
                        <li><a href="#"><i class="fa fa-trash-o"></i>سطل زباله</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ارسال پیام جدید</h3>
                </div>
                <!-- /.box-header -->
                <form action="{{route('admin.sms.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>به</label>
                            <select name="use_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">
                                        {{$user->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>موضوع</label>

                            <input name="title" class="form-control" placeholder="موضوع">
                        </div>
                        <div class="form-group">
                            <label>متن پیام</label>
                            <textarea name="description" id="mytextarea" class="form-control" rows="8" cols="100"
                                      placeholder="پیام خود را وارد کنید">

                    </textarea>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> ضمیمه
                                <input type="file" name="file">
                            </div>
                            <p class="help-block">حداکثر سایز 32MB</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-primary" value="ارسال">

                        </div>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> انصراف</button>
                    </div>
                </form>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
