@extends('layouts.master')

@section('content')
    @include('massage.msg')

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ویرایش درخواست مساعده
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.module.rule.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره پرسنلی</label>
                                    <input type="text" name="personnel_id" class="form-control" value="{{$user->personnel_id}}"
                                           disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>مبلغ درخواستی(ریال)</label>
                                    <input type="text" name="price" class="form-control"
                                           @if($id) value="{{$id->price}}" @endif>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>اولویت</label>
                                    <select class="form-control" name="Priority">
                                        <option value="1" @if($id->Priority == 1) selected @endif>ضروری</option>
                                        <option value="2" @if($id->Priority == 2) selected @endif>عادی</option>
                                    </select>
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
                            <input type="submit" value="ویرایش درخواست" class="btn btn-success">
                            <a href="{{route('admin.module.rule.show')}}" class="btn btn-danger">برگشت</a>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection
