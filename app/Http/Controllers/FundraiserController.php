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

class FundraiserController extends Controller
{
    public function fundRequest()
    {
        $funds = FundRequest::where('user_id', '=', Auth::user()->id)->get();
        // dd($funds);
        return view('frontend.fund_req',compact('funds'));
    }

    public function fundRequestStore(Request $request)
    {
        try{
            $master = new FundRequest();
            $master->user_id= Auth::user()->id;
            $master->source= $request->source;
            $master->desc= $request->desc;
            $master->req_amount= $request->req_amount;
            $master->req_date= $request->req_date;
            $master->status= "0";
            $master->created_by= Auth::user()->id;
            $master->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function profile()
    {
        $profile_data= Auth::user();

        $academic = Profile::where('user_id', '=', Auth::user()->id)->orderby('id','DESC')->first();
        $clspic = ClassSchedule::where('user_id', '=', Auth::user()->id)->first();
        return view('frontend.fundraiser_profile', compact('profile_data','academic','clspic'));
    }

    public function updateProfile(Request $request, $id)
    {
        $profileid = Profile::where('user_id', '=', Auth::user()->id)->get();


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


            // academic profile start

            if (!empty($profileid)) {

                $profile = new Profile();
                $profile->user_id = Auth::user()->id;
                $profile->current_gpa = $request->current_gpa;
                $profile->classification = $request->classification;
                $profile->major_sub = $request->major_sub;
                $profile->fundraiser = "1";

                if ($request->othercollege) {
                    $profile->college = $request->othercollege;
                } else {
                    $profile->college = $request->college;
                }
                $profile->degree = $request->degree;
                $profile->save();


            } else {


                $profile = Profile::find(Profile::where('user_id', '=', Auth::user()->id)->first()->id);
                $profile->user_id = Auth::user()->id;
                $profile->current_gpa = $request->current_gpa;
                $profile->classification = $request->classification;
                $profile->major_sub = $request->major_sub;
                $profile->fundraiser = "1";
                if ($request->othercollege) {
                    $profile->college = $request->othercollege;
                } else {
                    $profile->college = $request->college;
                }
                $profile->degree = $request->degree;
                $profile->save();
            }

            if($profile->id){
                // class_schedule_file upload start
                if ($request->othercollege) {
                        $clg = new University();
                        $clg->name= $request->othercollege;
                        $clg->created_by= Auth::user()->id;
                       $clg->save();
                }
            }

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Fundraiser Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    // addClassSchedule
    public function addClassSchedule(Request $request)
    {

        if(empty($request->clschedule)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Class Schedule \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


            $schedule = new ClassSchedule;
            // $image_path = public_path('images/class_schedule').'/'.$schedule->image;
            // unlink($image_path);
            $schedule->desc= $request->clschedule;
            $schedule->user_id= Auth::user()->id;

            $request->validate([
                'scheduleimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->scheduleimg->extension();
            $request->scheduleimg->move(public_path('images/class_schedule'), $imageName);
            $schedule->name= $imageName;

        if ($schedule->save()) {


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Class Schedule Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    // addClassSchedule end

        // addClassSchedule


        public function addTranscript(Request $request)
        {
            if(empty($request->transcript)){
                $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Transcript \" field..!</b></div>";
                return response()->json(['status'=> 303,'message'=>$message]);
                exit();
            }

                $schedule = new Transcript;
                // $image_path = public_path('images/tranimg').'/'.$schedule->image;
                // unlink($image_path);
                $schedule->desc= $request->transcript;
                $schedule->user_id= Auth::user()->id;

                $request->validate([
                    'tranimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $rand = mt_rand(100000, 999999);
                $imageName = time(). $rand .'.'.$request->tranimg->extension();
                $request->tranimg->move(public_path('images/tranimg'), $imageName);
                $schedule->name= $imageName;

            if ($schedule->save()) {


                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Transcript Create Successfully.</b></div>";
                return response()->json(['status'=> 300,'message'=>$message]);

            }else{
                return response()->json(['status'=> 303,'message'=>'Server Error!!']);
            }
        }

        // addTranscript end


    public function academicProfile()
    {
        $profile_data= Auth::user();
        $academic = Profile::where('user_id', '=', Auth::user()->id)->first();
        $clspic = ClassSchedule::where('user_id', '=', Auth::user()->id)->first();

        return view('frontend.fund_acaprofile')->with('profile_data', $profile_data)->with('academic', $academic)->with('clspic', $clspic);
    }


    public function addAcaProfile(Request $request)
    {

        $profile = new Profile();
        $profile->user_id = Auth::user()->id;
        $profile->transcript = $request->transcript;
        $profile->current_gpa = $request->current_gpa;
        $profile->classification = $request->classification;
        $profile->class_schedule = $request->class_schedule;
        $profile->major_sub = $request->major_sub;
        $profile->fundraiser = "1";
        $profile->college = $request->college;
        $profile->degree = $request->degree;
        $profile->save();

        if($profile->id){
            //class_schedule_file upload start
            if ($request->hasfile('class_schedule_file')) {
                foreach ($request->file('class_schedule_file') as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/storage/postimages/', $name);
                    $data[] = $name;

                    $pic = new ClassSchedule();
                    $pic->name = $name;
                    $pic->user_id= Auth::user()->id;
                   $pic->save();
                }
            }
        }

        if($profile->id){
            // Transcript image upload
            if ($request->hasfile('transcript_file')) {
                foreach ($request->file('transcript_file') as $images) {
                    $rands = mt_rand(100000, 999999);
                    $names = time() . "_" . Auth::id() . "_" . $rands . "." . $images->getClientOriginalExtension();
                    $images->move(public_path() . '/storage/postimages/', $names);
                    $datas[] = $names;
                    $transcript = new Transcript();
                    $transcript->name = $names;
                    $transcript->user_id = Auth::user()->id;
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


    // frontand show
    public function singleFundraiser($id)
    {
        $fundraisers= DB::table('users')
        ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
        ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
        ->where([
            ['users.is_type', '=', 'user'],
            ['fundraisers.id', '=', decrypt($id)],
        ])->first();
        // dd($fundraisers);

        if (!empty(Auth::user()->id)){
            $disable_follow = Follow::where('user_id', '=', Auth::user()->id)->where('fundraiser_id','=', decrypt($id))->first('id');
            // dd($disable_save);
        }else{
            $disable_follow= '';
        }


        $comments= DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->select('comments.*', 'users.*')
        ->where([
            ['comments.fundraiser_id', '=', decrypt($id)],
            ['comments.status', '=', '1'],
        ])->paginate(5);

        // $comments = Comment::where('fundraiser_id', '=', decrypt($id))->where('status', '=', '1')->paginate(5);
        // dd($comments);
        return view('frontend.singlefundraiser',compact('fundraisers','comments','disable_follow'));
    }

    public function allFundraiser()
    {


        $fundraisers= DB::table('users')
        ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
        ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.end_date','fundraisers.image','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
        ->where([
            ['users.is_type', '=', 'user'],
            ['fundraisers.status', '=', '1'],
        ])->get();
        // dd($fundraisers);
        return view('frontend.allfundraiser',compact('fundraisers'));
    }

    // my fundraising
    public function myFundraisering()
    {
        // $funds = FundRequest::where('user_id', '=', Auth::user()->id)->get();
        // dd($funds);
        return view('frontend.myfundraisering');
    }

    public function FundraiseringStore(Request $request)
    {
        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $fund = new Fundraiser();
        $fund->user_id = Auth::user()->id;
        $fund->title = $request->title;
        $fund->goal = $request->goal;
        $fund->end_date = $request->end_date;
        $fund->story = $request->story;
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $rand = mt_rand(100000, 999999);
        $imageName = time(). $rand .'.'.$request->image->extension();
        $request->image->move(public_path('fundraiser'), $imageName);
        $fund->image= $imageName;
        $fund->giving_level = json_encode($request->giving_level);


        if($fund->save()){

            $fundfor = explode(",",$request->fundraisingfor);
            if(count($fundfor)){
                foreach ($fundfor as $raisingfor) {

                    $data = new RaisingFor();
                    $data->name = $raisingfor;
                    $data->fundraiser_id = $fund->id;
                    $data->save();
                }
            }

        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

        return response()->json(['status'=> 303,'message'=>'Server Error!!']);
    }

    // fund request
    public function getFundrequest()
    {
        $funds= DB::table('users')
            ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
            ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
            ->where([
                ['users.is_type', '=', 'user'],
                ['fundraisers.user_id', '=', Auth::user()->id],
            ])->get();
        // $funds = Fundraiser::where('user_id', '=', Auth::user()->id)->get();
        // dd($funds);
        return view('frontend.fundrequest',compact('funds'));
    }


    public function fundRequestDelete($id)
    {
        // dd($id);
        if(Fundraiser::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data deleted successfully!!']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function fundRequestedit($id)
    {

        $info= DB::table('fundraisers')
            ->leftJoin('raising_fors', 'fundraisers.id', '=', 'raising_fors.fundraiser_id')
            ->select('raising_fors.id as rid','raising_fors.fundraiser_id','raising_fors.name','fundraisers.*')->where('fundraisers.id', '=', $id )->get()->first();

        // dd($info);

        $raising_for=DB::table('raising_fors')->where('fundraiser_id', '=',$id)->get();
        // dd($raising_for);
        return response()->json(['info'=> $info,'raising_for'=>$raising_for]);

        // return response()->json($info);
    }


    public function updatefundRequest(Request $request, $id)
    {

        $fundreq = Fundraiser::find($id);
        if($request->image != 'null'){

            $image_path = public_path('fundraiser').'/'.$fundreq->image;
            unlink($image_path);

            $fundreq->user_id = Auth::user()->id;
            $fundreq->title = $request->title;
            $fundreq->goal = $request->goal;
            $fundreq->end_date = $request->end_date;
            $fundreq->story = $request->story;
            $fundreq->giving_level = json_encode($request->giving_level);

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->image->extension();
            $request->image->move(public_path('fundraiser'), $imageName);
            $fundreq->image= $imageName;

        }else{
            $fundreq->user_id = Auth::user()->id;
            $fundreq->title = $request->title;
            $fundreq->goal = $request->goal;
            $fundreq->end_date = $request->end_date;
            $fundreq->story = $request->story;
            $fundreq->giving_level = json_encode($request->giving_level);
        }

        if ($fundreq->save()) {

            if (RaisingFor::where('fundraiser_id', $id)->delete()) {
                $fundfor = explode(",",$request->fundraisingfor);
                if(count($fundfor)){
                    foreach ($fundfor as $raisingfor) {
                        $data = new RaisingFor();
                        $data->name = $raisingfor;
                        $data->fundraiser_id = $fundreq->id;
                        $data->save();
                    }
                }

            }

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Fundrequest Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);


        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        // new code

    }
    //fund raiser


    // donation i made start
    public function getDonationImade()
    {
        $funds= DB::table('donations')
            ->leftJoin('fundraisers', 'donations.project_id', '=', 'fundraisers.id')
            ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','donations.*')
            ->where([
                ['donations.donar_id', '=', Auth::user()->id],
            ])->get();

        // dd($funds);

        return view('frontend.mydonate',compact('funds'));
    }
    // donation i made end




    //donation page

    // frontand show
    public function donation($id)
    {

        $fundraisers= DB::table('users')
            ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
            ->select('fundraisers.id as fid','fundraisers.title','fundraisers.user_id','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
            ->where([
                ['users.is_type', '=', 'user'],
                ['fundraisers.id', '=', decrypt($id)],
                ['fundraisers.status', '=', '1'],
            ])->first();




        // $fundraisers= DB::table('users')
        // ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
        // ->select('fundraisers.*', 'users.*')
        // ->where([
        //     ['users.is_type', '=', 'user'],
        //     ['fundraisers.id', '=', decrypt($id)],
        //     ['fundraisers.status', '=', '1'],
        // ])->first();
        // dd($fundraisers);
        return view('frontend.donation', compact('fundraisers'));
    }

    //favourite fundraiser show
    public function getFavFundraiser()
    {

        $funds = DB::table('favourites')
                ->join('users', 'users.id', '=', 'favourites.user_id')
                ->join('fundraisers', 'fundraisers.id', '=', 'favourites.fundraiser_id')
                ->where('favourites.user_id', '=', Auth::user()->id)
                ->get();



        // dd($funds);

        return view('frontend.favourite',compact('funds'));
    }




    //admin part. show fund request in admin


    public function allfundRequest()
    {
        $funds = Fundraiser::all();
        // dd($funds);
        return view('fundraiser.fund_req',compact('funds'));
    }

    public function changeStatus(Request $request)
    {
        $user = Fundraiser::find($request->id);
        $user->status = $request->status;
        $user->save();

        if($request->status==1){
            $user = Fundraiser::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $user = Fundraiser::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
        }
    }

    public function transcriptDelete($id)
    {
        if(Transcript::destroy($id)){
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data deleted successfully!!</b></div>";
            return response()->json(['success'=>true,'message'=>$message]);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function scheduleDelete($id)
    {
        if(ClassSchedule::destroy($id)){
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data deleted successfully!!</b></div>";
            return response()->json(['success'=>true,'message'=>$message]);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

}
