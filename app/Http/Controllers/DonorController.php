<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Auth;
use DB;
use App\Models\User;
use App\Models\Profile;
use App\Models\Follow;
use App\Models\Comment;
use App\Models\Fundraiser;
use App\Models\ClassSchedule;
use App\Models\Transcript;
use App\Models\FundRequest;
use App\Models\RaisingFor;
use App\Models\University;
use App\Models\Favourite;

class DonorController extends Controller
{
    public function donorprofile()
    {
        $profile_data= Auth::user();

        $academic = Profile::where('user_id', '=', Auth::user()->id)->orderby('id','DESC')->first();
        $clspic = ClassSchedule::where('user_id', '=', Auth::user()->id)->first();
        return view('frontend.donor_profile', compact('profile_data','academic','clspic'));
    }

    public function updateProfile(Request $request, $id)
    {



        $fundraiser = User::find($id);
        $fundraiser->fname= $request->fname;
        $fundraiser->lname= $request->lname;
        $fundraiser->email= $request->email;
        $fundraiser->phone= $request->phone;
        $fundraiser->address= $request->address;
        $fundraiser->city= $request->city;
        $fundraiser->postal_code= $request->postal_code;
        $fundraiser->state= $request->state;
        $fundraiser->country= $request->country;
        $fundraiser->dob= $request->dob;
        $fundraiser->linkedin= $request->linkedin;
        $fundraiser->facebook= $request->facebook;

        if ($fundraiser->save()) {

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Donor Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }
}
