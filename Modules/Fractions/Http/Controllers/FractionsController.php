<?php

namespace Modules\Fractions\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Fractions\Entities\Fractions;
use Modules\Leave\Entities\Leave;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;

class FractionsController extends Controller
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
//                    $btn = '<a href="' . route('admin.module.fractions.wizard', $row->id) . '" class="edit btn btn-info btn-sm">درخواست کسر کار</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role'])
//                ->make(true);
//        }
        $users = User::get();
        return view('fractions::index', compact('users'));
    }

    public function wizard(User $user)
    {
        return view('fractions::wizard', compact('user'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'Term' => 'required',
        ], [
            'Term.required' => 'لطفا مدت کسر کار را وارد کنید',
        ]);

        $querys = Fractions::where('user_id', $request['id'])->whereNull('Admin')->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست کسر کار فعال برای این پرسنل در سیستم موجود است');
            }

        $input = $request->all();
        $input['user_id'] = $request['id'];
        $leave = Fractions::create($input);
        if ($leave->Priority == 1) {
            $leave->update([
                'Supervisor' => 3,
            ]);
//            $user = User::where('id', $leave->user_id)->first();
//            \Modules\Leave\Jobs\SendSmsJob::dispatch($leave, $user);
        }

        return ReturnMsgSuccess('درخواست کسر کار با موفقیت ارسال شد');
    }

    public function update(Request $request)
    {
        $fraction = Fractions::where('id', $request['id'])->first();
        $fraction->update([
            'history' => $request['history'],
            'Term' => $request['Term'],
            'type' => $request['type'],
            'Priority' => $request['Priority'],
            'description' => $request['description'],
        ]);
        return ReturnMsgSuccess('درخواست کسر کار با موفقیت ویرایش شد');


    }

    public function show(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Fractions::whereNull('Archive')->orderBy('id', 'desc')->get();
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
//                    return "<label class=\"btn btn-danger\">{$row->type}</label>";
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
//
//                    return "<label class=\"btn btn-info\">{$row->Term}</label>";
//
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
//                        $btn = '<a href="' . route('admin.module.fraction.edit', $row->id) . '" class="edit btn btn-primary btn-sm">ویرایش</a>';
//                        $btn .= '<a href="' . route('admin.module.fraction.delete', $row->id) . '" class="edit btn btn-danger btn-sm">حذف</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role', 'Type', 'Supervisor', 'Admin', 'history', 'from'])
//                ->make(true);
//        }
        $Fractions = Fractions::whereNull('Archive')->orderBy('id', 'desc')->get();
        return view('fractions::show', compact('Fractions'));
    }

    public function make(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Fractions::whereNotNull('Archive')->orderBy('id', 'desc')->get();
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
//                    return "<label class=\"btn btn-danger\">{$row->type}</label>";
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
//
//                    return "<label class=\"btn btn-info\">{$row->Term}</label>";
//
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
//                ->rawColumns(['role', 'Type', 'history', 'from', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Fractions = Fractions::whereNotNull('Archive')->orderBy('id', 'desc')->get();
        return view('fractions::make', compact('Fractions'));
    }

    public function showfraction(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Fractions::where('Supervisor', null)->orderBy('id', 'desc')->get();
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
//                    return "<label class=\"btn btn-danger\">{$row->type}</label>";
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
//
//                    return "<label class=\"btn btn-info\">{$row->Term}</label>";
//
//
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->ago();
//                    return $created_at;
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
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.fractions.supervisor.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.fractions.supervisor.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.fractions.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'description'])
//                ->make(true);
//        }
        $Fractions = Fractions::where('Supervisor', null)->orderBy('id', 'desc')->get();
        return view('fractions::showfraction', compact('Fractions'));
    }

    public function supervisorTrue(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست کسر کار پرسنل موافقت شد و برای تایید نهایی به مدیریت ارسال شد');
    }

    public function supervisorFalse(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        return ReturnMsgError('با درخواست کسر کار پرسنل موافقت نشد');
    }

    public function makefraction(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Fractions::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();
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
//                    return "<label class=\"btn btn-danger\">{$row->type}</label>";
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
//
//                    return "<label class=\"btn btn-info\">{$row->Term}</label>";
//
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
//                ->rawColumns(['role', 'Type', 'history', 'from', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Fractions = Fractions::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();
        return view('fractions::makefraction', compact('Fractions'));
    }

    public function showadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Fractions::whereNull('Admin')->where('Supervisor', 1)
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
//                    return "<label class=\"btn btn-danger\">{$row->type}</label>";
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
//
//                    return "<label class=\"btn btn-info\">{$row->Term}</label>";
//
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
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.fractions.admin.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.fractions.admin.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.fractions.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'Supervisor', 'description'])
//                ->make(true);
//        }
        $Fractions = Fractions::whereNull('Admin')->where('Supervisor', 1)
            ->orwhere('Supervisor', 3)->whereNull('Admin')->orderBy('id', 'desc')->get();
        return view('fractions::showadmin', compact('Fractions'));
    }

    public function adminTrue(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 1,
            ]);
//        $user = User::where('id', $ide->user_id)->first();
//        \Modules\Leave\Jobs\SendSmsSuccessJob::dispatch($ide, $user);

        return ReturnMsgSuccess('با درخواست کسر کار پرسنل موافقت شد');
    }

    public function adminFalse(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 3,
            ]);
//        $user = User::where('id', $ide->user_id)->first();
//        \Modules\Leave\Jobs\SendSmsErrorJob::dispatch($ide, $user);
        return ReturnMsgError('با درخواست کسر کار پرسنل موافقت نشد');
    }

    public function list(Fractions $id, Request $request)
    {

        $Fractions = Fractions::where('user_id', $id->user_id)->orderBy('id', 'desc')->get();
        $user_id = User::all();


        return view('fractions::list', compact('Fractions', 'user_id', 'id'));


    }

    public function makeadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = Fractions::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
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
//                    return "<label class=\"btn btn-danger\">{$row->type}</label>";
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
//
//                    return "<label class=\"btn btn-info\">{$row->Term}</label>";
//
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
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.module.fractions.admin.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.fractions.admin.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.fractions.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'Type', 'history', 'from', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $Fractions = Fractions::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
        return view('fractions::makeadmin', compact('Fractions'));
    }

    public function delete(Fractions $id)
    {
        $id->delete();
        return ReturnMsgError('اطلاعات کسر کار با موفقیت حذف شد');

    }

    public function check()
    {

        $checks = Fractions::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            Fractions::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        return ReturnMsgSuccess('درخواست ها بایگانی شدند');


    }

    public function edit(Fractions $id)
    {

        $users = User::where('id', $id->user_id)->get();
        foreach ($users as $user)
            return view('fractions::edit', compact('id', 'user'));

    }

}
