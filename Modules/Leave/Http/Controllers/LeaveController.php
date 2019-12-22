<?php

namespace Modules\Leave\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Entities\Leave;
use Modules\TheRule\Entities\TheRule;
use Modules\TheRule\Jobs\SendSmsErrorJob;
use Modules\TheRule\Jobs\SendSmsJob;
use Modules\TheRule\Jobs\SendSmsSuccessJob;
use MongoDB\BSON\Type;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;

class LeaveController extends Controller
{

    public function index(Request $request)
    {
//        if ($request->ajax()) {
//            $data = User::orderBy('id', 'desc')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('role', function ($row) {
//                    foreach ($row->getRoleNames() as $name) {
//                        return $role = "<label class=\"btn btn-success\">{$name}</a>";
//                    }
//                })
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.leave.wizard', $row->id) . '" class="edit btn btn-info btn-sm">درخواست مرخصی</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role'])
//                ->make(true);
//        }
        $users = User::get();
        return view('leave::index', compact('users'));
    }

    public function wizard(User $user)
    {
        return view('leave::wizard', compact('user'));

    }

    public function edit(Leave $id)
    {

        $users = User::where('id', $id->user_id)->get();
        foreach ($users as $user)
            return view('leave::edit', compact('id', 'user'));

    }

    public function create()
    {
        return view('leave::create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'Type' => 'required',
        ], [
            'Type.required' => 'نوع مرخصی را انتخاب کنید',
        ]);


        $querys = Leave::where('user_id', $request['id'])->where('Supervisor', null)
            ->orwhere('Supervisor', 1)
            ->whereNull('Admin')
            ->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست مرخصی فعال برای این پرسنل در سیستم موجود است');
            }

        if ($request['Type'] == 0) {
            return ReturnMsgError('لطفا نوع مرخصی را انتخاب کنید');
        } else
            if ($request['Type'] == 1) {
                $type = 'استحقاقی';
            } elseif ($request['Type'] == 2) {
                $type = 'استعلاجی';
            } else {
                $type = 'ساعتی';
            }
        if ($request['Type'] == 1 || $request['Type'] == 2) {
            $history = null;
        } else {
            $history = $request['history'];
        }
        if ($request['Type'] == 3) {
            $from = null;
            $todate = null;
        } else {
            $todate = $request['todate'];
            $from = $request['from'];
        }


        $input = $request->all();
        $input['user_id'] = $request['id'];
        $input['Type'] = $type;
        $input['history'] = $history;
        $input['from'] = $from;
        $input['todate'] = $todate;
        $leave = Leave::create($input);
        if ($leave->Priority == 1) {
            $leave->update([
                'Supervisor' => 3,
            ]);
            $user = User::where('id', $leave->user_id)->first();
            \Modules\Leave\Jobs\SendSmsJob::dispatch($leave, $user);
        }

        return ReturnMsgSuccess('درخواست مرخصی با موفقیت ارسال شد');
    }

    public function show(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Leave::whereNull('Archive')->orderBy('id', 'desc')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//                    return optional($row->user)->name;
//                })->addColumn('personnel_id', function ($row) {
//                    return optional($row->user)->personnel_id;
//                })->addColumn('role', function ($row) {
//                    $users = $row->user->id;
//                    $q = DB::table('model_has_roles')
//                        ->where('model_id', $users)
//                        ->pluck('role_id');
//                    $querys = Role::where('id', $q)->pluck('name');
//                    foreach ($querys as $query)
//                        return $role = "<label class=\"btn btn-success\">{$query}</label>";
//                })
//                ->addColumn('Type', function ($row) {
//                    return "<label class=\"btn btn-danger\">{$row->Type}</label>";
//
//                })
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//                    if ($row->from == null) {
//                        return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//                    if ($row->todate == null) {
//                        return "<label class=\"btn btn-info\">{$row->until}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->todate}</label>";
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('Supervisor', function ($row) {
//                    if (empty($row->Supervisor)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Supervisor == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Supervisor == 3) {
//                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('Admin', function ($row) {
//                    if (empty($row->Admin)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Admin == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Admin == 2) {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده توسط سرپرست</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('action', function ($row) {
//                    if ($row->Supervisor == null) {
//                        $btn = '<a href="' . route('admin.module.leave.edit', $row->id) . '" class="edit btn btn-primary btn-sm">ویرایش</a>';
//                        $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-danger btn-sm">حذف</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role', 'Type', 'Supervisor', 'Admin', 'history', 'from', 'todate'])
//                ->make(true);
//        }
        $Leaves = Leave::whereNull('Archive')->orderBy('id', 'desc')->get();
        return view('leave::show', compact('Leaves'));
    }

    public function delete(Leave $id)
    {
        $id->delete();
        return ReturnMsgError('اطلاعات مرخصی با موفقیت حذف شد');

    }

    public function update(Request $request)
    {

        if ($request['Type'] == 1) {
            $type = 'استحقاقی';
        } elseif ($request['Type'] == 2) {
            $type = 'استعلاجی';
        } else {
            $type = 'ساعتی';
        }

        if ($request['Type'] == 1 || $request['Type'] == 2) {
            $history = null;
        } else {
            $history = $request['history'];
        }
        if ($request['Type'] == 3) {
            $from = null;
            $todate = null;
        } else {
            $todate = $request['todate'];
            $from = $request['from'];
        }

        $leave = Leave::where('id', $request['id'])->first();
        $leave->update([
            'Type' => $type,
            'history' => $history,
            'from' => $from,
            'todate' => $todate,
            'FromHour' => $request['FromHour'],
            'until' => $request['until'],
            'Priority' => $request['Priority'],
            'description' => $request['description'],
        ]);
        return ReturnMsgSuccess('درخواست مرخصی با موفقیت ویرایش شد');


    }

    public function showleave(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Leave::where('Supervisor', null)->orderBy('id', 'desc')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//                    return optional($row->user)->name;
//                })->addColumn('personnel_id', function ($row) {
//                    return optional($row->user)->personnel_id;
//                })->addColumn('role', function ($row) {
//                    $users = $row->user->id;
//                    $q = DB::table('model_has_roles')
//                        ->where('model_id', $users)
//                        ->pluck('role_id');
//                    $querys = Role::where('id', $q)->pluck('name');
//                    foreach ($querys as $query)
//                        return $role = "<label class=\"btn btn-success\">{$query}</label>";
//                })
//                ->addColumn('Type', function ($row) {
//                    return "<label class=\"btn btn-danger\">{$row->Type}</label>";
//
//                })
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//                    if ($row->from == null) {
//                        return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//                    if ($row->todate == null) {
//                        return "<label class=\"btn btn-info\">{$row->until}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->todate}</label>";
//
//                })
//                ->addColumn('description', function ($row) {
//                    if (empty($row->description)) {
//                        return "<label class=\"btn btn-info\">توضیحات ثبت نشده است</label>";
//                    } else {
//                        $description = $row->description;
//                        $descriptiond = str_limit($row->description, 20);
//                        return "<label title='{$description}' class=\"btn btn-info\">{$descriptiond}</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.leave.supervisor.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.supervisor.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'todate', 'description'])
//                ->make(true);
//        }
        $Leaves = Leave::where('Supervisor', null)->orderBy('id', 'desc')->get();

        return view('leave::showleave', compact('Leaves'));
    }

    public function showadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Leave::whereNull('Admin')->where('Supervisor', 1)
//                ->orwhere('Supervisor', 3)->whereNull('Admin')->orderBy('id', 'desc')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//                    return optional($row->user)->name;
//                })->addColumn('personnel_id', function ($row) {
//                    return optional($row->user)->personnel_id;
//                })->addColumn('role', function ($row) {
//                    $users = $row->user->id;
//                    $q = DB::table('model_has_roles')
//                        ->where('model_id', $users)
//                        ->pluck('role_id');
//                    $querys = Role::where('id', $q)->pluck('name');
//                    foreach ($querys as $query)
//                        return $role = "<label class=\"btn btn-success\">{$query}</label>";
//                })
//                ->addColumn('Type', function ($row) {
//                    return "<label class=\"btn btn-danger\">{$row->Type}</label>";
//
//                })
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//                    if ($row->from == null) {
//                        return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//                    if ($row->todate == null) {
//                        return "<label class=\"btn btn-info\">{$row->until}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->todate}</label>";
//
//                })
//                ->addColumn('description', function ($row) {
//                    if (empty($row->description)) {
//                        return "<label class=\"btn btn-info\">توضیحات ثبت نشده است</label>";
//                    } else {
//                        $description = $row->description;
//                        $descriptiond = str_limit($row->description, 20);
//                        return "<label title='{$description}' class=\"btn btn-info\">{$descriptiond}</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('Supervisor', function ($row) {
//                    if (empty($row->Supervisor)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Supervisor == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Supervisor == 3) {
//                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('Admin', function ($row) {
//                    if (empty($row->Admin)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Admin == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Admin == 2) {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده توسط سرپرست</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.leave.admin.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.admin.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'todate', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Leaves = Leave::whereNull('Admin')->where('Supervisor', 1)
            ->orwhere('Supervisor', 3)->whereNull('Admin')->orderBy('id', 'desc')->get();

        return view('leave::showadmin', compact('Leaves'));
    }

    public function supervisorTrue(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست مرخصی پرسنل موافقت شد و برای تایید نهایی به مدیریت ارسال شد');
    }

    public function supervisorFalse(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        $user = User::where('id', $ide->user_id)->first();
        \Modules\Leave\Jobs\SendSmsErrorJob::dispatch($ide, $user);
        return ReturnMsgError('با درخواست مرخصی پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود');
    }

    public function adminTrue(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 1,
            ]);
        $user = User::where('id', $ide->user_id)->first();
        \Modules\Leave\Jobs\SendSmsSuccessJob::dispatch($ide, $user);

        return ReturnMsgSuccess('با درخواست مرخصی پرسنل موافقت شد نتیجه برای پرسنل پیامک میشود.');
    }

    public function adminFalse(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 3,
            ]);
        $user = User::where('id', $ide->user_id)->first();
        \Modules\Leave\Jobs\SendSmsErrorJob::dispatch($ide, $user);
        return ReturnMsgError('با درخواست مرخصی پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود.');
    }

    public function makeleave(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Leave::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();
//
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//                    return optional($row->user)->name;
//                })->addColumn('personnel_id', function ($row) {
//                    return optional($row->user)->personnel_id;
//                })->addColumn('role', function ($row) {
//                    $users = $row->user->id;
//                    $q = DB::table('model_has_roles')
//                        ->where('model_id', $users)
//                        ->pluck('role_id');
//                    $querys = Role::where('id', $q)->pluck('name');
//                    foreach ($querys as $query)
//                        return $role = "<label class=\"btn btn-success\">{$query}</label>";
//                })
//                ->addColumn('Type', function ($row) {
//                    return "<label class=\"btn btn-danger\">{$row->Type}</label>";
//
//                })
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//                    if ($row->from == null) {
//                        return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//                    if ($row->todate == null) {
//                        return "<label class=\"btn btn-info\">{$row->until}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->todate}</label>";
//
//                })
//                ->addColumn('description', function ($row) {
//                    if (empty($row->description)) {
//                        return "<label class=\"btn btn-info\">توضیحات ثبت نشده است</label>";
//                    } else {
//                        $description = $row->description;
//                        $descriptiond = str_limit($row->description, 20);
//                        return "<label title='{$description}' class=\"btn btn-info\">{$descriptiond}</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('Supervisor', function ($row) {
//                    if (empty($row->Supervisor)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Supervisor == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Supervisor == 3) {
//                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('Admin', function ($row) {
//                    if (empty($row->Admin)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Admin == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Admin == 2) {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده توسط سرپرست</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->rawColumns(['role', 'Type', 'history', 'from', 'todate', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Leaves = Leave::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();

        return view('leave::makeleave', compact('Leaves'));
    }

    public function makeadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Leave::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
//
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//                    return optional($row->user)->name;
//                })->addColumn('personnel_id', function ($row) {
//                    return optional($row->user)->personnel_id;
//                })->addColumn('role', function ($row) {
//                    $users = $row->user->id;
//                    $q = DB::table('model_has_roles')
//                        ->where('model_id', $users)
//                        ->pluck('role_id');
//                    $querys = Role::where('id', $q)->pluck('name');
//                    foreach ($querys as $query)
//                        return $role = "<label class=\"btn btn-success\">{$query}</label>";
//                })
//                ->addColumn('Type', function ($row) {
//                    return "<label class=\"btn btn-danger\">{$row->Type}</label>";
//
//                })
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//                    if ($row->from == null) {
//                        return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//                    if ($row->todate == null) {
//                        return "<label class=\"btn btn-info\">{$row->until}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->todate}</label>";
//
//                })
//                ->addColumn('description', function ($row) {
//                    if (empty($row->description)) {
//                        return "<label class=\"btn btn-info\">توضیحات ثبت نشده است</label>";
//                    } else {
//                        $description = $row->description;
//                        $descriptiond = str_limit($row->description, 20);
//                        return "<label title='{$description}' class=\"btn btn-info\">{$descriptiond}</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('Supervisor', function ($row) {
//                    if (empty($row->Supervisor)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Supervisor == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Supervisor == 3) {
//                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('Admin', function ($row) {
//                    if (empty($row->Admin)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Admin == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Admin == 2) {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده توسط سرپرست</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.leave.admin.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.admin.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'todate', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Leaves = Leave::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();

        return view('leave::makeadmin', compact('Leaves'));
    }

    public function list(Leave $id, Request $request)
    {

        $users = Leave::where('user_id', $id->user_id)->orderBy('id', 'desc')->get();
        $user_id = User::all();


        return view('leave::list', compact('users', 'user_id', 'id'));


    }

    public function check()
    {

        $checks = Leave::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            Leave::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        return ReturnMsgSuccess('درخواست ها بایگانی شدند');


    }

    public function make(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Leave::whereNotNull('Archive')->orderBy('id', 'desc')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//                    return optional($row->user)->name;
//                })->addColumn('personnel_id', function ($row) {
//                    return optional($row->user)->personnel_id;
//                })->addColumn('role', function ($row) {
//                    $users = $row->user->id;
//                    $q = DB::table('model_has_roles')
//                        ->where('model_id', $users)
//                        ->pluck('role_id');
//                    $querys = Role::where('id', $q)->pluck('name');
//                    foreach ($querys as $query)
//                        return $role = "<label class=\"btn btn-success\">{$query}</label>";
//                })
//                ->addColumn('Type', function ($row) {
//                    return "<label class=\"btn btn-danger\">{$row->Type}</label>";
//
//                })
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//                    if ($row->from == null) {
//                        return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//                    if ($row->todate == null) {
//                        return "<label class=\"btn btn-info\">{$row->until}</label>";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->todate}</label>";
//
//                })
//                ->addColumn('description', function ($row) {
//                    if (empty($row->description)) {
//                        return "<label class=\"btn btn-info\">توضیحات ثبت نشده است</label>";
//                    } else {
//                        $description = $row->description;
//                        $descriptiond = str_limit($row->description, 20);
//                        return "<label title='{$description}' class=\"btn btn-info\">{$descriptiond}</label>";
//                    }
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('Supervisor', function ($row) {
//                    if (empty($row->Supervisor)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Supervisor == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Supervisor == 3) {
//                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('Admin', function ($row) {
//                    if (empty($row->Admin)) {
//                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
//                    } elseif ($row->Admin == 1) {
//                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
//                    } elseif ($row->Admin == 2) {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده توسط سرپرست</label>";
//                    } else {
//                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
//                    }
//
//                })
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.leave.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'todate', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Leaves = Leave::whereNotNull('Archive')->orderBy('id', 'desc')->get();
        return view('leave::make', compact('Leaves'));
    }

}
