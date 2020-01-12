@extends('layouts.master')

@section('content')


    <div class="row">
        <div class="col-md-3">
            <a href="{{route('send')}}" class="btn btn-primary btn-block margin-bottom">ارسال پیام جدید</a>

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

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">پیام</h3>

                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                                class="fa fa-chevron-right"></i></a>
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                                class="fa fa-chevron-left"></i></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>{{$id->title}}</h3>
                        @foreach($users as $user)
                            @if($user->id == $id->user_id)
                                <h5>از: {{$user->name}}
                                    <span
                                        class="mailbox-read-time pull-left">{{\Morilog\Jalali\Jalalian::forge($id->created_at)->ago()}}</span>
                                </h5>
                            @endif
                        @endforeach
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                    data-container="body" title="Delete">
                                <i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                    data-container="body" title="Reply">
                                <i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                    data-container="body" title="Forward">
                                <i class="fa fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                            <i class="fa fa-print"></i></button>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">


                        <p>{{$id->description}}</p>


                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="mailbox-attachments clearfix">
                        @if(!empty($id->file))
                            <li>
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                <div class="mailbox-attachment-info">
                                    <span class="mailbox-attachment-size">
                          <a href="#" class="btn btn-default btn-xs pull-left"><i class="fa fa-cloud-download"></i></a>
                        </span>
                                </div>
                            </li>


                        @endif
                    </ul>
                </div>
            </div>
            <!-- /. box -->
        </div>

    </div>



@endsection
