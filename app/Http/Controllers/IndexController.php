<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
        // frontend
        public function frontendIndex()
        {
            $fundraisers= DB::table('users')
                ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
                ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
                ->where([
                    ['users.is_type', '=', 'user'],
                    ['fundraisers.status', '=', '1'],
                ])->get();

            return view('frontend.index',compact('fundraisers'));
        }

        //about

        public function about()
        {
            return view('frontend.about');
        }

        // contact
        public function contact()
        {
            return view('frontend.contact');
        }

        public function saveContact(Request $request) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'phone' => 'required',
                'message' => 'required'
            ]);

            // $contact = new Contact;

            // $contact->name = $request->name;
            // $contact->email = $request->email;
            // $contact->subject = $request->subject;
            // $contact->phone_number = $request->phone_number;
            // $contact->message = $request->message;

            // $contact->save();

            $mail['name']=$request->name;
            $mail['subject']=$request->subject;
            $mail['phone']=$request->phone;
            $mail['message']=$request->message;
            $mail['email']=$request->email;
            $email_to = "kazimuhammadullah@gmail.com";
            Mail::send('email.contact', compact('mail'), function($message)use($mail,$email_to) {
                $message->from('test@fund.com', 'Fund');
                $message->to($email_to)
                ->subject($mail['subject']);
                });

              return back()->with('success', 'Thank you for contact us!');

        }

        public function fundraisersearch(Request $request)
    {
        $search = $request->input('search');
        // dd($search);

        $fundraisers= DB::table('users')
                ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
                ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
                ->where([
                    ['users.fname', '=', $search],
                    ['users.is_type', '=', 'user'],
                    ['fundraisers.status', '=', '1'],
                ])->orWhere([
                    ['users.lname', '=', $search],
                    ['users.is_type', '=', 'user'],
                    ['fundraisers.status', '=', '1'],
                ])->orWhere([
                    ['users.email', '=', $search],
                    ['users.is_type', '=', 'user'],
                    ['fundraisers.status', '=', '1'],
                ])->get();

        // $properties = Property::where([
        //     ['city', '=', $search]
        // ])->orWhere('status', '=', $radio)->get();

        return view('frontend.search')
            ->with('fundraisers',$fundraisers);
    }
}
