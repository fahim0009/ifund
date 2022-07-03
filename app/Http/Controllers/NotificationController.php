<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Favourite;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\db;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function storeFollow(Request $request)
    {
        try{
            $notification = new Follow();
            $notification->user_id = Auth::user()->id;
            $notification->fundraiser_id = $request->fundraiserid;
            $notification->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Following.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'<p style="color:red">Please Login First</p>']);

        }
    }

    public function unFollow($id)
    {
        // dd("controller called");
        // exit();
        $where = Follow::where('user_id', '=', Auth::user()->id)->where('fundraiser_id', '=', $id)->first()->id;
        // DB::table('follows')->where('id', $where)->delete();
        if(DB::table('follows')->where('id', $where)->delete()){
            return response()->json(['success'=>true,'message'=>'Unfollow...']);
        }else{
            return response()->json(['success'=>false,'message'=>'Unfollow Failed']);
        }
    }

    public function favouriteStore(Request $request)
    {

        // $fav = Favourite::where('user_id', '=', Auth::user()->id)->where('fundraiser_id', '=', $request->fundraiserid)->first();
        // dd($fav);

        if (Auth::user()) {
            //newcode

            if (!empty(Favourite::where('user_id', '=', Auth::user()->id)->where('fundraiser_id', '=', $request->fundraiserid)->first()->id)) {

                DB::table('favourites')->where('id', Favourite::where('user_id', '=', Auth::user()->id)->where('fundraiser_id', '=', $request->fundraiserid)->first()->id)->delete();
    
            } else {
                
                try{
                    $notification = new Favourite();
                    $notification->user_id = Auth::user()->id;
                    $notification->fundraiser_id = $request->fundraiserid;
                    $notification->save();
        
                    $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Favourite added.</b></div>";
                    return response()->json(['status'=> 300,'message'=>$message]);
        
                }catch (\Exception $e){
                    return response()->json(['status'=> 303,'message'=>'<p style="color:red">Please Login First</p>']);
                }
            }

            //new code end
            
        } else {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Login first.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        
        
    }
}
