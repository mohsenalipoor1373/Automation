@extends('layouts.master')

@section('content')


    <div class="row">
        <div class="col-md-3">
            <a href="{{route('send')}}" class="btn btn-primary btn-block margin-bottom">ارسال پیام جدید</a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">پوشه ها</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
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
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>موضوع</h3>
                        <h5>از: help@example.com
                            <span class="mailbox-read-time pull-left">۳ مرداد ۱۳۹۶ ساعت ۱۴:۳۲</span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                                <i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                                <i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                <i class="fa fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                            <i class="fa fa-print"></i></button>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <p>سلام</p>

                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>

                        <p>با تشکر<br>جان</p>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="mailbox-attachments clearfix">
                        <li>
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                            <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                                <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-left"><i class="fa fa-cloud-download"></i></a>
                        </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /. box -->
        </div>

    </div>



@endsection
