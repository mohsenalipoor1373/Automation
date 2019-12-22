<?php

namespace Modules\Fish\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cage\Entities\Cage;
use Modules\Fish\Entities\Fish;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgSuccess;

class FishController extends Controller
{

    public function index()
    {
        return view('fish::index');
    }

    public function store(Request $request)
    {
        Fish::create($request->all());

        return ReturnMsgSuccess('درخواست شما با موفقیت ارسال شد');

    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Fish::whereNull('buy')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->number;
                })
                ->addColumn('dimensions', function ($row) {
                    return $row->dimensions;
                })
                ->addColumn('mesh', function ($row) {
                    return $row->mesh;
                })
                ->addColumn('yarn', function ($row) {
                    return $row->yarn;
                })
                ->addColumn('lead', function ($row) {
                    return $row->lead;
                })
                ->addColumn('ropeone', function ($row) {
                    return $row->ropeone;
                })
                ->addColumn('ropetwo', function ($row) {
                    return $row->ropetwo;
                })
                ->addColumn('booy', function ($row) {
                    return $row->booy;
                })
                ->addColumn('strands', function ($row) {
                    return $row->strands;
                })
                ->addColumn('ring', function ($row) {
                    return $row->ring;
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
                ->rawColumns(['name', 'number', 'dimensions', 'mesh',
                    'yarn', 'lead',
                    'ropeone', 'ropetwo', 'booy', 'strands',
                    'ring', 'description', 'created_at'
                    , 'date', 'buy', 'action'])
                ->make(true);
        }

        return view('fish::list');

    }


}
