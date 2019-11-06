<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('account');
    }

    public function change()
    {
        return view('changepass');
    }

    public function message(Request $req)
    {
        $to_name = $req->input('name');
        $to_email = $req->input('email');
        $token = $req->input('token');
        
        $data = array('name'=>$to_name, 'body' => $token, 'email' => $to_email);
        
        Mail::send('mail.email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Email Confirmation');
            $message->from('ahmad.ardi06@gmail.com','Activation Email');
        });
    }
}
