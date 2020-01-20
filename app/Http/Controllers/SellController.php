<?php

namespace App\Http\Controllers;

use App\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Providers\ReturnMsgError;

class SellController extends Controller
{
    public function index()
    {
        return view('Sell.index');

    }

    public function store(Request $request)
    {
        $sell = Sell::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        try {
            $size = count(collect($request)->get('f_calla'));
            for ($i = 0; $i <= $size; $i++) {
                DB::table('sell_user')->insert([
                    'sell_id' => $sell->id,
                    'code_calla' => $request->get('code_calla')[$i],
                    'name_calla' => $request->get('name_calla')[$i],
                    'tedad_calla' => $request->get('tedad_calla')[$i],
                    'f_calla' => $request->get('f_calla')[$i],
                    'price_calla' => $request->get('price_calla')[$i],
                    't_calla' => $request->get('t_calla')[$i],
                    'mfinal_calla' => $request->get('mfinal_calla')[$i],
                    'dec_calla' => $request->get('dec_calla')[$i],

                ]);
            }
            return response()->json(['success' => 'مشخصات فروش با موفقیت در سیستم ثبت شد']);
        } catch (\Exception $e) {
            return response()->json(['success' => 'مشخصات فروش با موفقیت در سیستم ثبت شد']);
        }

    }

    public function list()
    {
        $sells = Sell::all();
        return view('Sell.list', compact('sells'));

    }

    public function view(Sell $id)
    {
        $sells = DB::table('sell_user')->where('sell_id', $id->id)
            ->get();
        return view('Sell.view', compact('sells', 'id'));

    }

    public function edit(Sell $id)
    {
        $sells = DB::table('sell_user')->where('sell_id', $id->id)
            ->get();
        return view('Sell.edit', compact('sells', 'id'));

    }

    public function delete(Sell $id)
    {
        $success = $id->delete();
        if ($success) {
            return ReturnMsgError('مشخصات با موفقیت از سیستم حذف شد');
        }

    }

    public function update(Request $request)
    {

        Sell::
        where('id', $request->id)
            ->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);
        DB::table('sell_user')->where('sell_id', $request->id)
            ->delete();
        try {

            $size = count(collect($request)->get('f_calla'));
            for ($i = 0; $i <= $size; $i++) {
                DB::table('sell_user')
                    ->insert([
                        'sell_id' => $request->id,
                        'code_calla' => $request->get('code_calla')[$i],
                        'name_calla' => $request->get('name_calla')[$i],
                        'tedad_calla' => $request->get('tedad_calla')[$i],
                        'f_calla' => $request->get('f_calla')[$i],
                        'price_calla' => $request->get('price_calla')[$i],
                        't_calla' => $request->get('t_calla')[$i],
                        'mfinal_calla' => $request->get('mfinal_calla')[$i],
                        'dec_calla' => $request->get('dec_calla')[$i]

                    ]);
            }
            return response()->json(['success' => 'مشخصات فروش با موفقیت در سیستم ویرایش شد']);
        } catch (\Exception $e) {
            return response()->json(['success' => 'مشخصات فروش با موفقیت در سیستم ویرایش شد']);
        }

    }

}
