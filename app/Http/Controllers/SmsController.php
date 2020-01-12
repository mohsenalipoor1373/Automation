<?php

namespace App\Http\Controllers;

use App\Sms;
use Illuminate\Http\Request;
use function App\Providers\ReturnMsgSuccess;

class SmsController extends Controller
{
    public function store(Request $request)
    {


        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $success = Sms::create($input);
        if ($success) {
            return ReturnMsgSuccess('پیام شما با موفقیت ارسال شد');
        }

    }
}
