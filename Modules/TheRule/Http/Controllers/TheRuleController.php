<?php

namespace Modules\TheRule\Http\Controllers;

use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\TheRule\Entities\TheRule;
use Modules\TheRule\Jobs\SendSmsErrorJob;
use Modules\TheRule\Jobs\SendSmsJob;
use Modules\TheRule\Jobs\SendSmsSuccessJob;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;


class TheRuleController extends Controller
{


    public function index(Request $request)
    {
        $users = User::get();
        return view('therule::index', compact('users'));
    }

    public function wizard(User $id)
    {
        return view('therule::wizard', compact('id'));
    }

    public function edit(TheRule $id)
    {
        $users = User::where('id', $id->user_id)->get();
        foreach ($users as $user)

            return view('therule::edit', compact('id', 'user'));

    }

    public function store(Request $request)
    {


        $request->validate([
            'price' => 'required',
        ], [
            'price.required' => 'لطفا مبلغ را وارد کنید',
        ]);

        $querys = TheRule::where('user_id', $request['id'])->where('Supervisor', null)
            ->orwhere('Supervisor', 1)
            ->where('Admin', null)
            ->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست مساعده فعال برای این پرسنل در سیستم موجود است');
            }
        $input = $request->all();
        $input['user_id'] = $request['id'];
        $theRule = TheRule::create($input);
        if ($theRule->Priority == 1) {
            $theRule->update([
                'Supervisor' => 3,
            ]);
            $user = User::where('id', $theRule->user_id)->first();
            SendSmsJob::dispatch($theRule, $user);
        }


        return ReturnMsgSuccess('درخواست مساعده با موفقیت ارسال شد');


    }

    public function show(Request $request)
    {

//        if ($request->ajax()) {
//            $data = TheRule::where('Archive', null)->orderBy('id', 'desc')->get();
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
//                ->addColumn('price', function ($row) {
//                    $price = $row->price;
//                    $title = number_format($row->price);
//                    return "<label title='{$title}' class=\"btn btn-danger\">{$price} ریال</label>";
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
//                        $btn = '<a href="' . route('admin.module.rule.edit', $row->id) . '" class="edit btn btn-primary btn-sm">ویرایش</a>';
//                        $btn .= '<a href="' . route('admin.module.rule.delete', $row->id) . '" class="edit btn btn-danger btn-sm">حذف</a>';
//                        return $btn;
//                    }
//                    return "<label class=\"btn btn-info\">دسترسی به این درخواست ندارید</label>";
//
//                })
//                ->rawColumns(['action', 'role', 'price', 'Supervisor', 'Admin'])
//                ->make(true);
//        }
        $TheRules = TheRule::where('Archive', null)->orderBy('id', 'desc')->get();
        return view('therule::show', compact('TheRules'));
    }

    public function delete(TheRule $id)
    {
        $id->delete();
        return ReturnMsgError('با موفقیت حذف شد');

    }

    public function update(Request $request)
    {
        TheRule::find($request['id'])->update([
            'price' => $request['price'],
            'Priority' => $request['Priority'],
            'description' => $request['description'],
        ]);

        return ReturnMsgSuccess('درخواست مساعده با موفقیت ویرایش شد');

    }

    public function make(Request $request)
    {

//        if ($request->ajax()) {
//            $data = TheRule::where('Archive', '!=', "")->orderBy('id', 'desc')->get();
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
//                ->addColumn('price', function ($row) {
//                    $price = $row->price;
//                    $title = number_format($row->price);
//                    return "<label title='{$title}' class=\"btn btn-danger\">{$price} ریال</label>";
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
//                    $btn = '<a href="' . route('admin.module.rule.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'price', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $TheRules = TheRule::where('Archive', '!=', "")->orderBy('id', 'desc')->get();

        return view('therule::make', compact('TheRules'));
    }

    public function supervisorlist(Request $request, TheRule $id)
    {

        $TheRules = TheRule::where('user_id', $id->user_id)->orderBy('id', 'desc')->get();
        $user_id = User::all();
        return view('therule::list', compact('TheRules', 'user_id'));
    }

    public function showrule(Request $request)
    {

//        if ($request->ajax()) {
//            $data = TheRule::where('Supervisor', null)->orderBy('id', 'desc')->get();
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
//                ->addColumn('price', function ($row) {
//                    $price = $row->price;
//                    $title = number_format($row->price);
//                    return "<label title='{$title}' class=\"btn btn-danger\">{$price} ریال</label>";
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
//                    $btn = '<a href="' . route('admin.module.rule.supervisor.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.rule.supervisor.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.rule.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'price', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $TheRules = TheRule::where('Supervisor', null)->orderBy('id', 'desc')->get();

        return view('therule::showrule', compact('TheRules'));
    }

    public function supervisorTrue(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست مساعده پرسنل موافقت شد و برای تایید نهایی به مدیریت ارسال شد.');
    }

    public function supervisorFalse(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        $user = User::where('id', $ide->user_id)->first();
        SendSmsErrorJob::dispatch($ide, $user);
        return ReturnMsgError('با درخواست مساعده پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود.');
    }

    public function makerule(Request $request)
    {

//        if ($request->ajax()) {
//            $data = TheRule::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();
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
//                ->addColumn('price', function ($row) {
//                    $price = $row->price;
//                    $title = number_format($row->price);
//                    return "<label title='{$title}' class=\"btn btn-danger\">{$price} ریال</label>";
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
//                ->rawColumns(['role', 'price', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $TheRules = TheRule::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();

        return view('therule::makerule',compact('TheRules'));
    }

    public function showadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = TheRule::where('Admin', null)->where('Supervisor', 1)
//                ->orwhere('Supervisor', 3)->orderBy('id', 'desc')->get();
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
//                ->addColumn('price', function ($row) {
//                    $price = $row->price;
//                    $title = number_format($row->price);
//                    return "<label title='{$title}' class=\"btn btn-danger\">{$price} ریال</label>";
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
//                    $btn = '<a href="' . route('admin.module.rule.admin.true', $row->id) . '" class="edit btn btn-success btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.rule.admin.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.rule.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'price', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $TheRules = TheRule::where('Admin', null)->where('Supervisor', 1)
            ->orwhere('Supervisor', 3)->orderBy('id', 'desc')->get();
        return view('therule::showadmin',compact('TheRules'));
    }

    public function adminTrue(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 1,
            ]);
        $user = User::where('id', $ide->user_id)->first();
        SendSmsSuccessJob::dispatch($ide, $user);


        return ReturnMsgSuccess('با درخواست مساعده پرسنل موافقت شد نتیجه برای پرسنل پیامک میشود.');
    }

    public function adminFalse(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 3,
            ]);
        $user = User::where('id', $ide->user_id)->first();
        SendSmsErrorJob::dispatch($ide, $user);
        return ReturnMsgError('با درخواست مساعده پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود.');
    }

    public function makeadmin(Request $request)
    {

//        if ($request->ajax()) {
//            $data = TheRule::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
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
//                ->addColumn('price', function ($row) {
//                    $price = $row->price;
//                    $title = number_format($row->price);
//                    return "<label title='{$title}' class=\"btn btn-danger\">{$price} ریال</label>";
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
//                    $btn = '<a href="' . route('admin.module.rule.admin.true', $row->id) . '" class="edit btn btn-primary btn-sm">تایید درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.rule.admin.false', $row->id) . '" class="edit btn btn-danger btn-sm">رد کردن درخواست</a>';
//                    $btn .= '<a href="' . route('admin.module.rule.supervisor.list', $row->id) . '" class="edit btn btn-info btn-sm">مشاهده جزییات</a>';
//
//                    return $btn;
//                })
//                ->rawColumns(['action', 'role', 'price', 'Supervisor', 'Admin', 'description'])
//                ->make(true);
//        }
        $TheRules = TheRule::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
        return view('therule::makeadmin',compact('TheRules'));
    }

    public function check()
    {

        $checks = TheRule::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            TheRule::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        return ReturnMsgSuccess('درخواست ها بایگانی شدند');


    }

}
