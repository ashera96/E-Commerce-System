<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone_num' => 'required',
            'msg' => 'required'
        ]);

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_num'=>$request->phone_num,
            'msg'=>$request->msg,
        ];

        Mail::send('email.contact_us',$data,function ($message) use ($data){

            $message -> from($data['email']);
            $message -> to('nstudioz950@gmail.com'); ////
            $message -> subject('ContactUs');
           // $message->replyTo($data['email']);
        });

        //Redirect
        return redirect()->back();
    }

}
