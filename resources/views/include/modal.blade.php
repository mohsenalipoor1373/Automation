@can('مساعده')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">درخواست های مساعده</h4>
                </div>
                <div class="modal-body">
                    <p>پاسخ درخواست های مساعده از سمت مدیریت داده شده است</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">خروج</button>
                    <a href="{{route('admin.module.rule.check')}}" type="button" class="btn btn-primary">تایید و
                        بایگانی</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endcan
@can('مرخصی')
    <div class="modal fade" id="modal-leave">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">درخواست های مرخصی</h4>
                </div>
                <div class="modal-body">
                    <p>پاسخ درخواست های مرخصی از سمت مدیریت داده شده است</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">خروج</button>
                    <a href="{{route('admin.module.leave.check')}}" type="button" class="btn btn-primary">تایید و
                        بایگانی</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endcan
@can('کسر کار')
    <div class="modal fade" id="modal-fraction">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">درخواست های کسر کار</h4>
                </div>
                <div class="modal-body">
                    <p>پاسخ درخواست های کسر کار از سمت مدیریت داده شده است</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">خروج</button>
                    <a href="{{route('admin.module.fraction.check')}}" type="button" class="btn btn-primary">تایید و
                        بایگانی</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endcan
@can('اضافه کار')
    <div class="modal fade" id="modal-over">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">درخواست های اضافه کار</h4>
                </div>
                <div class="modal-body">
                    <p>پاسخ درخواست های اضافه کار از سمت مدیریت داده شده است</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">خروج</button>
                    <a href="{{route('admin.module.overtime.check')}}" type="button" class="btn btn-primary">تایید و
                        بایگانی</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endcan
@can('ماموریت')
    <div class="modal fade" id="modal-mission">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">درخواست های ماموریت</h4>
                </div>
                <div class="modal-body">
                    <p>پاسخ درخواست های ماموریت از سمت مدیریت داده شده است</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">خروج</button>
                    <a href="{{route('admin.module.overtime.check')}}" type="button" class="btn btn-primary">تایید و
                        بایگانی</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endcan
