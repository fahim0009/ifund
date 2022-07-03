<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\Fundraiser;
use DB;
use Session;
use Illuminate\support\Facades\Auth;

class TransactionController extends Controller
{
    public function withdraw()
    {
        $funds= DB::table('users')
            ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
            ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.balance','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
            ->where([
                ['users.is_type', '=', 'user'],
                ['fundraisers.user_id', '=', Auth::user()->id],
            ])->get();
        // dd($funds);
        return view('frontend.withdraw',compact('funds'));
    }

    public function fundWithdraw($id)
    {
        $totalwithdraw = 0;
        $funds= DB::table('users')
            ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
            ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.balance','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
            ->where([
                ['users.is_type', '=', 'user'],
                ['fundraisers.id', '=', decrypt($id)],
                ['fundraisers.user_id', '=', Auth::user()->id],
            ])->first();

        $withdraw = DB::table('withdraws')
                ->leftJoin('fundraisers', 'withdraws.fundraiser_id', '=', 'fundraisers.id')
                ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','withdraws.*')
                ->where([
                    ['fundraisers.id', '=', decrypt($id)],
                    ['withdraws.user_id', '=', Auth::user()->id],
                ])->get();
        // dd($withdraw);

         $mywithdraw = Withdraw::selectRaw('SUM(amount) as sumamount, fundraiser_id')->where([
            ['status','=', 'Pending'],
            ['fundraiser_id','=', decrypt($id)]
        ])->groupBy('fundraiser_id')->get();

        foreach ($mywithdraw as $data){
            $data->sumamount;
            $totalwithdraw = $data->sumamount + $totalwithdraw;
        }

        $collected_amount = Fundraiser::where('id', '=', decrypt($id))->get()->first()->collected_amount;
        $rcv_amount = Fundraiser::where('id', '=', decrypt($id))->get()->first()->balance;
        $balance = $rcv_amount-$collected_amount;

        //  dd($info);


        return view('frontend.fundwithdraw',compact('funds','withdraw','totalwithdraw','balance'));
    }

    public function cashout(Request $request)
    {
        
            $team = new Withdraw();
            $team->user_id= Auth::user()->id;
            $team->fundraiser_id= $request->fundid;
            $team->status= "Pending";
            $team->amount= $request->amount;
            $team->viewed= "0";
            $team->created_by= Auth::user()->id;

            if($team->save()){
                
                $where = [
                    'id'=> $request->fundid
                ];
                $user = Fundraiser::where($where)->get()->first();
                $user->collected_amount= $request->amount;
                $user->save();

                Session::flash('success', 'Withdraw successful!');
                return redirect()->route('fundraiser.fundwithdraw', encrypt($request->fundid));

            }
            else{
                return back();
            }
    }
}
