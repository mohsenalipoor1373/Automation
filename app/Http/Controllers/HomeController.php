<?php

namespace App\Http\Controllers;

use App\Sms;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function inbox()
    {
        $smss = Sms::where('use_id', auth()->user()->id)->get();
        $users = User::all();
        return view('inbox.index', compact('smss', 'users'));
    }

    public function send()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('inbox.send', compact('users'));
    }

    public function read(Sms $id)
    {
        $users = User::all();
        return view('inbox.read', compact('id','users'));
    }
}
