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

    public function phone(Request $req)
    {
        $userkey = env('APP_SMS_KEY');
        $passkey = env('APP_SMS_SECRET');
        $tlp = $req->input('phone');
        $otp = $req->input('token');
        $url = "https://reguler.zenziva.net/apps/smsotp.php";
        
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS,
        'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$tlp.'&kode_otp='.$otp);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);
        
        $XMLdata = new SimpleXMLElement($results);
        $status = $XMLdata->message[0]->text;
        return $status;
    }
}
