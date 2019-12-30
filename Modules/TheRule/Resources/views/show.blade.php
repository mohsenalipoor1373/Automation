@extends('layouts.master')
@section('content')
    @include('massage.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست درخواست های مساعده
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                        <tr>
                            <th>درخواست دهنده</th>
                            <th>شماره پرسنلی</th>
                            <th>مبلغ درخواستی</th>
                            <th>تاریخ درخواست</th>
                            <th>سرپرست</th>
                            <th>مدیریت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($TheRules as $TheRule)
                            <tr>
                                <td>{{$TheRule->user->name}}</td>
                                <td>{{$TheRule->user->personnel_id}}</td>
                                <td>{{number_format($TheRule->price)}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($TheRule->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    @if (empty($TheRule->Supervisor))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif ($TheRule->Supervisor == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @elseif ($TheRule->Supervisor == 3)
                                        <span class="btn btn-primary">اولویت ضروری</span>
                                    @else
                                        <span class="btn btn-danger">تایید نشده</span>
                                    @endif


                                </td>
                                <td>
                                    @if (empty($TheRule->Admin))
                                        <span class="btn btn-info">در انتظار پاسخ</span>
                                    @elseif ($TheRule->Admin == 1)
                                        <span class="btn btn-success">تایید شده</span>
                                    @elseif ($TheRule->Admin == 2)
                                        <span class="btn btn-primary">تایید نشده توسط سرپرست</span>
                                    @else
                                        <span class="btn btn-danger">تایید نشده</span>
                                    @endif


                                </td>
                                <td>
                                    @if(empty($TheRule->Admin))
                                        <a href="{{route('admin.module.rule.edit',$TheRule->id)}}">
                                            <img src="{{url('/icon/icons8-edit-property-48.png')}}"
                                                 width="25" title="ویرایش ">
                                        </a>
                                        <a href="{{route('admin.module.rule.delete',$TheRule->id)}}">
                                            <img src="{{url('/icon/icons8-delete-bin-48.png')}}"
                                                 width="25" title="حذف ">
                                        </a>
                                    @else
                                        <a href="{{route('admin.module.rule.save',$TheRule->id)}}"><span class="btn btn-danger">بایگانی</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
