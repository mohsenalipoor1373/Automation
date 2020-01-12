@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{route('send')}}" class="btn btn-primary btn-block margin-bottom">ارسال پیام</a>
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
                        <li class="active"><a href="#"><i class="fa fa-inbox"></i> صندوق ورودی
                                <span class="label label-primary pull-left">1</span></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> ارسال شده</a></li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> سطح زباله</a></li>
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
                    <h3 class="box-title">پیام ما</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="جستجو">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <div class="pull-left">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            @foreach($smss as $sms)
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                    @foreach($users as $user)
                                        @if($user->id == $sms->user_id)
                                            <td class="mailbox-name"><a
                                                    href="{{route('read',$sms->id)}}">{{$user->name}}</a>
                                            </td>
                                        @endif
                                    @endforeach
                                    <td class="mailbox-subject"><b>{{$sms->title}}</b>-
                                        {{$sms->description}}
                                    </td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">5 دقیقه پیش</td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>






@endsection
