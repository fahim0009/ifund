<?php

namespace App\Http\Controllers;
use App\Models\Softcode;
use App\Models\Master;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Transcript;
use App\Models\ClassSchedule;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $masters = User::where('is_type', '=', 'user')->get();
        // $masters = ClassSchedule::all();
        // dd($masters);
        return view('admin.fundraiser',compact('masters'));
    }

    public function store(Request $request)
    {
    
        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->phone;
        $user->is_type = "user";
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->linkedin = $request->linkedin;
        $user->facebook = $request->facebook;
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $rand = mt_rand(100000, 999999);
        $imageName = time(). $rand .'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('images/profile_pic'), $imageName);
        $user->photo = $imageName;
        $user->save();

        if($user->id){
            
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->transcript = $request->transcript;
            $profile->current_gpa = $request->current_gpa;
            $profile->classification = $request->classification;
            $profile->class_schedule = $request->class_schedule;
            $profile->major_sub = $request->major_sub;
            $profile->fundraiser = "1";
            $profile->college = $request->college;
            $profile->degree = $request->degree;
            $profile->save();
            
        }
        
        if($user->id){
            //class_schedule_file upload start
            if ($request->hasfile('class_schedule_file')) {
                foreach ($request->file('class_schedule_file') as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/storage/postimages/', $name);
                    $data[] = $name;
                    
                    $pic = new ClassSchedule();
                    $pic->name = $name;
                    $pic->user_id= $user->id;
                   $pic->save();
                }
            }
        }
        
        if($user->id){
            // Transcript image upload
            if ($request->hasfile('transcript_file')) {
                foreach ($request->file('transcript_file') as $images) {
                    $rands = mt_rand(100000, 999999);
                    $names = time() . "_" . Auth::id() . "_" . $rands . "." . $images->getClientOriginalExtension();
                    $images->move(public_path() . '/storage/postimages/', $names);
                    $datas[] = $names;
                    $transcript = new Transcript();
                    $transcript->name = $names;
                    $transcript->user_id = $user->id;
                    $transcript->save(); 
                }
            }
            //image upload end
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Created Successfully.</b></div>";

                return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function fundraiserdestroy($id)
    {

        // dd($id);
        if(User::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function getAccountSetting()
    {
        // dd($funds);
        return view('frontend.accsetings');
    }

    public function changeUserPassword(Request $request)
    {

        if(empty($request->opassword)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Old Password\" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"New Password\" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->password === $request->confirmpassword)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $hashedPassword = Auth::user()->password;

    if (\Hash::check($request->opassword , $hashedPassword )) {

        if (!\Hash::check($request->password , $hashedPassword)) {
                $where = [
                    'id'=>auth()->user()->id
                ];
                $passwordchange = User::where($where)->get()->first();
                $passwordchange->password =Hash::make($request->password);

                if ($passwordchange->save()) {
                    $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password Change Successfully.</b></div>";
                    return response()->json(['status'=> 300,'message'=>$message]);
                }else{
                    return response()->json(['status'=> 303,'message'=>'Server Error!!']);
                }

        }else{
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New password can not be the old password.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
                }

        }else{
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Old password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            }

        }

}
