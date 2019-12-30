@extends('layouts.master')

@section('content')
    @include('massage.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                تور صید ماهی
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.fish.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام مشتری</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{$id->name}}">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تعداد</label>
                                    <input type="number" name="number" class="form-control"
                                           value="{{$id->number}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ابعاد</label>
                                    <input type="text" name="dimensions" class="form-control"
                                           value="{{$id->dimensions}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>مش</label>
                                    <input type="text" name="mesh" class="form-control"
                                           value="{{$id->mesh}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>جنس نخ و نمره</label>
                                    <input type="text" name="yarn" class="form-control"
                                           value="{{$id->yarn}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>سرب</label>
                                    <input type="text" name="lead" class="form-control"
                                           value="{{$id->lead}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>طناب1</label>
                                    <input type="text" name="ropeone" class="form-control"
                                           value="{{$id->ropeone}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>طناب2</label>
                                    <input type="text" name="ropetwo" class="form-control"
                                           value="{{$id->ropetwo}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>بویه</label>
                                    <input type="text" name="booy" class="form-control"
                                           value="{{$id->booy}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>رشته های نخ اتصال</label>
                                    <input type="text" name="strands" class="form-control"
                                           value="{{$id->strands}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>حلقه</label>
                                    <input type="text" name="ring" class="form-control"
                                           value="{{$id->ring}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea name="description" id="mytextarea"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$id->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="submit" value="ثبت درخواست" class=" btn btn-success">
                            <a href="{{route('admin.module.leave.index')}}" class=" btn btn-danger">برگشت</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection
