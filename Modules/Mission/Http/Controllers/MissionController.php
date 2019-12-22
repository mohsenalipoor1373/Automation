<?php

namespace Modules\Mission\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Entities\Leave;
use Modules\Mission\Entities\Mission;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class MissionController extends Controller
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
//                    $btn = '<a href="' . route('admin.module.mission.wizard', $row->id) . '" class="edit btn btn-info btn-sm">ثبت ماموریت</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role'])
//                ->make(true);
//        }
        $users = User::orderBy('id', 'desc')->get();
        return view('mission::index', compact('users'));
    }

    public function wizard(User $id)
    {
        return view('mission::wizard', compact('id'));

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = $request->id;

        Mission::create($input);
        return ReturnMsgSuccess('ماموریت با موفقیت در سیستم ثبت شد');

    }

    public function list(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Mission::whereNull('Archive')->get();
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
//                ->addColumn('location', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->location}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('to', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->to}</label>";
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
//                ->rawColumns(['action', 'role', 'Supervisor',
//                    'Admin', 'from', 'to', 'location'])
//                ->make(true);
//        }
        $Missions = Mission::whereNull('Archive')->get();
        return view('mission::list', compact('Missions'));
    }

    public function stores(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Mission::whereNotNull('Archive')->get();
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
//                ->addColumn('location', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->location}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('to', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->to}</label>";
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
//                ->rawColumns(['role', 'Supervisor',
//                    'Admin', 'from', 'to', 'location'])
//                ->make(true);
//        }
        $Missions = Mission::whereNotNull('Archive')->get();
        return view('mission::store', compact('Missions'));
    }

    public function shows(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Mission::whereNull('Supervisor')->get();
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
//                ->addColumn('location', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->location}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('to', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->to}</label>";
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('action', function ($row) {
//                    if ($row->Supervisor == null) {
//                        $btn = '<a href="' . route('admin.module.mission.super.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                        $btn .= '<a href="' . route('admin.module.mission.super.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد درخواست</a>';
//                        $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-info btn-sm">جزییات</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role', 'from', 'to', 'location'])
//                ->make(true);
//        }
        $Missions = Mission::whereNull('Supervisor')->get();
        return view('mission::shows', compact('Missions'));
    }

    public function supersuccess(Mission $id)
    {
        Mission::find($id->id)->update([
            'Supervisor' => 1,
        ]);
        return ReturnMsgSuccess('با درخواست ماموریت موافقت شد');

    }

    public function supererror(Mission $id)
    {
        Mission::find($id->id)->update([
            'Supervisor' => 2,
            'Admin' => 2,
        ]);
        return ReturnMsgError('درخواست ماموریت پرسنل رد شد');

    }

    public function makes(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Mission::whereNotNull('Supervisor')->get();
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
//                ->addColumn('location', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->location}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('to', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->to}</label>";
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
//                ->rawColumns(['Admin', 'Supervisor', 'role', 'from', 'to', 'location'])
//                ->make(true);
//        }
        $Missions = Mission::whereNotNull('Supervisor')->get();
        return view('mission::makes', compact('Missions'));
    }

    public function showadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Mission::whereNull('Admin')->where('Supervisor', 1)->get();
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
//                ->addColumn('location', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->location}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('to', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->to}</label>";
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('Supervisor', function ($row) {
//                    return "<label class=\"btn btn-success\">تایید شده</label>";
//
//                })
//                ->addColumn('action', function ($row) {
//
//                    $btn = '<a href="' . route('admin.module.mission.admin.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.mission.admin.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-info btn-sm">جزییات</a>';
//                    return $btn;
//
//
//                })
//                ->rawColumns(['action', 'role', 'from', 'to', 'location', 'Supervisor'])
//                ->make(true);
//        }
        $Missions = Mission::whereNull('Admin')->where('Supervisor', 1)->get();
        return view('mission::showadmin', compact('Missions'));
    }

    public function adminsuccess(Mission $id)
    {
        Mission::find($id->id)->update([
            'Admin' => 1,
        ]);
        return ReturnMsgSuccess('با درخواست ماموریت موافقت شد');

    }

    public function adminerror(Mission $id)
    {
        Mission::find($id->id)->update([
            'Admin' => 3,
        ]);
        return ReturnMsgError('درخواست ماموریت پرسنل رد شد');

    }

    public function makeadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Mission::whereNotNull('Admin')->get();
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
//                ->addColumn('location', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->location}</label>";
//
//                })
//                ->addColumn('from', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->from}</label>";
//
//                })
//                ->addColumn('to', function ($row) {
//
//                    return "<label class=\"btn btn-info\">{$row->to}</label>";
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
//
//                    $btn = '<a href="' . route('admin.module.mission.admin.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.mission.admin.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-info btn-sm">جزییات</a>';
//                    return $btn;
//
//
//                })
//                ->rawColumns(['action', 'role', 'from', 'to', 'location', 'Supervisor', 'Admin'])
//                ->make(true);
//        }
        $Missions = Mission::whereNotNull('Admin')->get();
        return view('mission::makeadmin', compact('Missions'));
    }

    public function edit(Mission $id)
    {
        return view('mission::edit', compact('id'));

    }

    public function delete(Mission $id)
    {
        $id->delete();
        return ReturnMsgError('مشخصات ماموریت با موفقیت حذف شد');


    }

    public function update(Request $request)
    {
        Mission::find($request->id)->update([
            'location' => $request['location'],
            'from' => $request['from'],
            'fromtime' => $request['fromtime'],
            'to' => $request['to'],
            'totime' => $request['totime'],
            'summary' => $request['summary'],
            'description' => $request['description'],
        ]);
        return ReturnMsgSuccess('مشخصات ماموریت با موفقیت ویرایش شد');
    }

}
