<?php

namespace Modules\Cage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Buy\Entities\Buy;
use Modules\Cage\Entities\Cage;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgSuccess;

class CageController extends Controller
{

    public function index()
    {
        return view('cage::index');
    }

    public function store(Request $request)
    {
        Cage::create($request->all());
        return ReturnMsgSuccess('مشخصات خرید کالا با موفقیت در سیستم ثبت شد');

    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Cage::whereNull('buy')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->number;
                })
                ->addColumn('diameter', function ($row) {
                    return $row->diameter;
                })
                ->addColumn('height', function ($row) {
                    return $row->height;
                })
                ->addColumn('yarn', function ($row) {
                    return $row->yarn;
                })
                ->addColumn('verticalrope', function ($row) {
                    return $row->verticalrope;
                })
                ->addColumn('horizontalrope', function ($row) {
                    return $row->horizontalrope;
                })
                ->addColumn('floorrope', function ($row) {
                    return $row->floorrope;
                })
                ->addColumn('connectingrope', function ($row) {
                    return $row->connectingrope;
                })
                ->addColumn('double', function ($row) {
                    return $row->double;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at;

                })
                ->addColumn('date', function ($row) {
                    return $row->date;
                })
                ->addColumn('buy', function ($row) {
                    if (empty($row->buy)) {
                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
                    } elseif ($row->buy == 1) {
                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
                    } elseif ($row->buy == 3) {
                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
                    } else {
                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
                    }

                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('admin.module.buy.admin.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
                    $btn .= '<a href="' . route('admin.module.buy.admin.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
                    $btn .= '<a href="' . route('admin.module.leave.delete', $row->id) . '" class="edit btn btn-info btn-sm">اعلام تاریخ</a>';
                    return $btn;

                })
                ->rawColumns(['name', 'buy', 'action'
                    , 'number', 'diameter', 'height', 'yarn', 'verticalrope', 'horizontalrope', 'floorrope'
                    , 'connectingrope', 'double', 'description', 'date'
                ])
                ->make(true);
        }

        return view('cage::list');

    }

    public function showadmin(Request $request)
    {
        if ($request->ajax()) {
            $data = Cage::whereNull('buy')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->number;
                })
                ->addColumn('diameter', function ($row) {
                    return $row->diameter;
                })
                ->addColumn('height', function ($row) {
                    return $row->height;
                })
                ->addColumn('yarn', function ($row) {
                    return $row->yarn;
                })
                ->addColumn('verticalrope', function ($row) {
                    return $row->verticalrope;
                })
                ->addColumn('horizontalrope', function ($row) {
                    return $row->horizontalrope;
                })
                ->addColumn('floorrope', function ($row) {
                    return $row->floorrope;
                })
                ->addColumn('connectingrope', function ($row) {
                    return $row->connectingrope;
                })
                ->addColumn('double', function ($row) {
                    return $row->double;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at;

                })
                ->addColumn('date', function ($row) {
                    return $row->date;
                })
                ->addColumn('buy', function ($row) {
                    if (empty($row->buy)) {
                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
                    } elseif ($row->buy == 1) {
                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
                    } elseif ($row->buy == 3) {
                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
                    } else {
                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
                    }

                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('admin.module.cage.admin.date', $row->id) . '" class="edit btn btn-info btn-sm">ثبت تاریخ</a>';
                    $btn .= '<a href="' . route('admin.module.cage.admin.success', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
                    $btn .= '<a href="' . route('admin.module.cage.admin.error', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
                    return $btn;

                })
                ->rawColumns(['name', 'buy', 'action'
                    , 'number', 'diameter', 'height', 'yarn', 'verticalrope', 'horizontalrope', 'floorrope'
                    , 'connectingrope', 'double', 'description', 'date'
                ])
                ->make(true);
        }

        return view('cage::showadmin');

    }

    public function date(Cage $id)
    {
        return view('cage::date', compact('id'));

    }

    public function datestore(Request $request)
    {
        $cages = Cage::where('id', $request->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'date' => $request['date'],
            ]);
        return ReturnMsgSuccess('تاریخ با موفقیت برای این درخواست ثبت شد');
    }

    public function success(Cage $id)
    {
        $cages = Cage::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'buy' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست تولید موافقت شد');

    }
    public function error(Cage $id)
    {
        $cages = Cage::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'buy' => 2,
            ]);
        return ReturnMsgSuccess('درخواست تولید رد شد');

    }

    public function make(Request $request)
    {
        if ($request->ajax()) {
            $data = Cage::whereNotNull('buy')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->number;
                })
                ->addColumn('diameter', function ($row) {
                    return $row->diameter;
                })
                ->addColumn('height', function ($row) {
                    return $row->height;
                })
                ->addColumn('yarn', function ($row) {
                    return $row->yarn;
                })
                ->addColumn('verticalrope', function ($row) {
                    return $row->verticalrope;
                })
                ->addColumn('horizontalrope', function ($row) {
                    return $row->horizontalrope;
                })
                ->addColumn('floorrope', function ($row) {
                    return $row->floorrope;
                })
                ->addColumn('connectingrope', function ($row) {
                    return $row->connectingrope;
                })
                ->addColumn('double', function ($row) {
                    return $row->double;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at;

                })
                ->addColumn('date', function ($row) {
                    return $row->date;
                })
                ->addColumn('buy', function ($row) {
                    if (empty($row->buy)) {
                        return $role = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
                    } elseif ($row->buy == 1) {
                        return $role = "<label class=\"btn btn-success\">تایید شده</label>";
                    } elseif ($row->buy == 3) {
                        return $role = "<label class=\"btn btn-primary\">اولویت ضروری</label>";
                    } else {
                        return $role = "<label class=\"btn btn-danger\">تایید نشده</label>";
                    }

                })
                ->rawColumns(['name', 'buy'
                    , 'number', 'diameter', 'height', 'yarn', 'verticalrope', 'horizontalrope', 'floorrope'
                    , 'connectingrope', 'double', 'description', 'date'
                ])
                ->make(true);
        }

        return view('cage::make');

    }


}
