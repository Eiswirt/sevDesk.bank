<?php

namespace App\Http\Controllers;

use App\Checkingaccount;
use App\Creditaccount;
use App\Passbook;
use Illuminate\Support\Facades\Auth;

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
        return view('home')->with('check', Checkingaccount::whereUserId(Auth::id())->get())
            ->with('credits', Checkingaccount::whereUserId(Auth::id())->get()
                ->flatMap(function ($it) {
                    return $it->creditaccounts;
                }))->with('passb', Passbook::whereUserId(Auth::id())->get());
    }
}
