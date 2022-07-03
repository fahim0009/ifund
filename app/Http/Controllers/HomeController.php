<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd('home controller called');
        // exit();
        // return view('home');
        if (auth()->user()->is_type == 'admin') {
            return redirect()->route('admin.dashboard');
        }elseif (auth()->user()->is_type == 'staff') {
            return redirect()->route('admin.dashboard');
        }elseif (auth()->user()->is_type == 'user') {
            return redirect()->route('fundraiser.profile');
        }elseif (auth()->user()->is_type == 0) {
            $fundraisers= DB::table('users')
            ->leftJoin('fund_requests', 'users.id', '=', 'fund_requests.user_id')
            ->select('fund_requests.*', 'users.*')
            ->where([
                ['users.is_type', '=', 'user'],
                ['fund_requests.status', '=', '1'],
            ])->get();
            return view('frontend.index',compact('fundraisers'));
        }else{
            $fundraisers= DB::table('users')
            ->leftJoin('fund_requests', 'users.id', '=', 'fund_requests.user_id')
            ->select('fund_requests.*', 'users.*')
            ->where([
                ['users.is_type', '=', 'user'],
                ['fund_requests.status', '=', '1'],
            ])->get();
            return view('frontend.index',compact('fundraisers'));
        }
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.dashboard');
    }
    public function agentHome()
    {
        return view('agent.dashboard');
    }
    public function userDashboard()
    {
        return view('user.dashboard');
    }
    public function sellerHome()
    {
        return view('seller.dashboard');
    }


}
