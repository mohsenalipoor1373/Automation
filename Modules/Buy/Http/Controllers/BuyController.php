<?php

namespace Modules\Buy\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Buy\Entities\Buy;
use Modules\Mission\Entities\Mission;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class BuyController extends Controller
{

    public function index()
    {
        $roles = Role::get();
        return view('buy::index', compact('roles'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Buy::create($input);
        return ReturnMsgSuccess('درخواست خرید با موفقیت در سیستم ثبت شد');
    }

    public function list(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Buy::whereNull('Archive')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//
//                    return $row->name;
//
//                })
//                ->addColumn('role_id', function ($row) {
//
//                    $roles = Role::where('id', $row->role_id)->get();
//                    foreach ($roles as $role)
//                        return "<label class=\"btn btn-info\">{$role->name}</label>";
//                })
//                ->addColumn('number', function ($row) {
//
//                    return $row->number;
//
//                })
//                ->addColumn('store', function ($row) {
//
//                    return $row->store;
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
//                ->rawColumns(['action', 'role_id', 'Supervisor',
//                    'Admin'])
//                ->make(true);
//        }
        $Buys = Buy::whereNull('Archive')->get();
        return view('buy::list', compact('Buys'));
    }

    public function shows(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Buy::whereNull('Supervisor')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//
//                    return $row->name;
//
//                })
//                ->addColumn('role_id', function ($row) {
//
//                    $roles = Role::where('id', $row->role_id)->get();
//                    foreach ($roles as $role)
//                        return "<label class=\"btn btn-info\">{$role->name}</label>";
//                })
//                ->addColumn('number', function ($row) {
//
//                    return $row->number;
//
//                })
//                ->addColumn('store', function ($row) {
//
//                    return $row->store;
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
//
//                })
//                ->addColumn('action', function ($row) {
//                    if ($row->Supervisor == null) {
//                        $btn = '<a href="' . route('admin.module.buy.super.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                        $btn .= '<a href="' . route('admin.module.buy.super.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                        $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-info btn-sm">جزییات</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role_id'])
//                ->make(true);
//        }
        $Buys = Buy::whereNull('Supervisor')->get();
        return view('buy::shows', compact('Buys'));
    }

    public function supers(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Supervisor' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست خرید موافقت شد');
    }

    public function errors(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        return ReturnMsgError('درخواست خرید رد شد');
    }

    public function make(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Buy::whereNotNull('Supervisor')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//
//                    return $row->name;
//
//                })
//                ->addColumn('role_id', function ($row) {
//
//                    $roles = Role::where('id', $row->role_id)->get();
//                    foreach ($roles as $role)
//                        return "<label class=\"btn btn-info\">{$role->name}</label>";
//                })
//                ->addColumn('number', function ($row) {
//
//                    return $row->number;
//
//                })
//                ->addColumn('store', function ($row) {
//
//                    return $row->store;
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
//                ->rawColumns(['role_id', 'Supervisor',
//                    'Admin'])
//                ->make(true);
//        }
        $Buys = Buy::whereNotNull('Supervisor')->get();
        return view('buy::make', compact('Buys'));
    }

    public function showadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Buy::whereNull('Admin')->whereNotNull('Supervisor')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//
//                    return $row->name;
//
//                })
//                ->addColumn('role_id', function ($row) {
//
//                    $roles = Role::where('id', $row->role_id)->get();
//                    foreach ($roles as $role)
//                        return "<label class=\"btn btn-info\">{$role->name}</label>";
//                })
//                ->addColumn('number', function ($row) {
//
//                    return $row->number;
//
//                })
//                ->addColumn('store', function ($row) {
//
//                    return $row->store;
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
//                ->addColumn('action', function ($row) {
//
//                    $btn = '<a href="' . route('admin.module.buy.admin.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.buy.admin.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-info btn-sm">جزییات</a>';
//                    return $btn;
//
//                })
//                ->rawColumns(['action', 'role_id', 'Supervisor',])
//                ->make(true);
//        }
        $Buys = Buy::whereNull('Admin')->whereNotNull('Supervisor')->get();
        return view('buy::showadmin', compact('Buys'));
    }

    public function admins(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Admin' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست خرید موافقت شد');
    }

    public function admine(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Admin' => 3,
            ]);
        return ReturnMsgError('درخواست خرید رد شد');
    }

    public function makeadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Buy::whereNotNull('Admin')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->addColumn('name', function ($row) {
//
//                    return $row->name;
//
//                })
//                ->addColumn('role_id', function ($row) {
//
//                    $roles = Role::where('id', $row->role_id)->get();
//                    foreach ($roles as $role)
//                        return "<label class=\"btn btn-info\">{$role->name}</label>";
//                })
//                ->addColumn('number', function ($row) {
//
//                    return $row->number;
//
//                })
//                ->addColumn('store', function ($row) {
//
//                    return $row->store;
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
//                ->rawColumns(['role_id', 'Supervisor',
//                    'Admin'])
//                ->make(true);
//        }
        $Buys = Buy::whereNotNull('Admin')->get();
        return view('buy::makeadmin', compact('Buys'));
    }

    public function stores()
    {
        $Buys = Buy::whereNotNull('Supervisor')->get();
        return view('buy::stores', compact('Buys'));

    }


}
