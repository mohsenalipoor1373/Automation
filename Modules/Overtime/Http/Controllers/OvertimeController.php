<?php

namespace Modules\Overtime\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Entities\Leave;
use Modules\Overtime\Entities\Overtime;
use Modules\TheRule\Entities\TheRule;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;

class OvertimeController extends Controller
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
//                    $btn = '<a href="' . route('admin.module.overtime.wizard', $row->id) . '" class="edit btn btn-info btn-sm">درخواست اضافه کار</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role'])
//                ->make(true);
//        }
        $users = User::orderBy('id', 'desc')->get();
        return view('overtime::index', compact('users'));
    }

    public function wizard(User $id)
    {
        return view('overtime::wizard', compact('id'));

    }

    public function store(Request $request)
    {
        $querys = Overtime::where('user_id', $request['id'])
            ->whereNull('Admin')
            ->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست اضافه کار فعال برای این پرسنل در سیستم موجود است');
            }
        $input = $request->all();
        $input['user_id'] = $request['id'];
        Overtime::create($input);
        return ReturnMsgSuccess('درخواست اضافه کار برای پرسنل با موفقیت ثبت شد');

    }

    public function show(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Overtime::whereNull('Archive')->orderBy('id', 'desc')->get();
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
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->until}</label>";
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
//                    if ($row->Admin == null) {
//                        $btn = '<a href="' . route('admin.module.leave.edit', $row->id) . '" class="edit btn btn-primary btn-sm">ویرایش</a>';
//                        $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-danger btn-sm">حذف</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role', 'Admin', 'history', 'from', 'todate', 'description'])
//                ->make(true);
//        }

        $OverTimes = Overtime::whereNull('Archive')->orderBy('id', 'desc')->get();
        return view('overtime::show', compact('OverTimes'));
    }

    public function list(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Overtime::whereNotNull('Admin')->orderBy('id', 'desc')->get();
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
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->until}</label>";
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
//                ->rawColumns(['role', 'Admin', 'history', 'from', 'todate', 'description'])
//                ->make(true);
//        }
        $OverTimes = Overtime::whereNotNull('Admin')->orderBy('id', 'desc')->get();
        return view('overtime::list', compact('OverTimes'));
    }

    public function admin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Overtime::whereNull('Admin')->orderBy('id', 'desc')->get();
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
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->until}</label>";
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
//                        $btn = '<a href="' . route('admin.module.overtime.success', $row->id) . '" class="edit btn btn-primary btn-sm">تایید درخواست</a>';
//                        $btn .= '<a href="' . route('admin.module.overtime.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role', 'Admin', 'history', 'from', 'todate', 'description'])
//                ->make(true);
//        }
        $OverTimes = Overtime::whereNull('Admin')->orderBy('id', 'desc')->get();

        return view('overtime::admin', compact('OverTimes'));
    }


    public function make(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Overtime::whereNotNull('Admin')->orderBy('id', 'desc')->get();
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
//                ->addColumn('history', function ($row) {
//                    if ($row->history == null) {
//                        return "";
//
//                    } else
//                        return "<label class=\"btn btn-info\">{$row->history}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->FromHour}</label>";
//
//                })
//                ->addColumn('todate', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->until}</label>";
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
//                ->rawColumns(['role', 'Admin', 'history', 'from', 'todate', 'description'])
//                ->make(true);
//        }

        $OverTimes = Overtime::whereNotNull('Admin')->orderBy('id', 'desc')->get();
        return view('overtime::make', compact('OverTimes'));
    }


    public function success(Overtime $id)
    {
        $overtimes = Overtime::where('id', $id->id)->get();
        foreach ($overtimes as $overtime)
            Overtime::find($overtime->id)->update([
                'Admin' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست اضافه کار پرسنل موافقت شد');

    }


    public function error(Overtime $id)
    {
        $overtimes = Overtime::where('id', $id->id)->get();
        foreach ($overtimes as $overtime)
            Overtime::find($overtime->id)->update([
                'Admin' => 3,
            ]);
        return ReturnMsgSuccess('درخواست اضافه کار پرسنل رد شد');

    }

    public function check()
    {

        $checks = Overtime::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            Overtime::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        return ReturnMsgSuccess('درخواست ها بایگانی شدند');


    }


}
