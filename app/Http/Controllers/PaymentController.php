<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
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
        return view('payment');
    }

    public function getDataProduct(request $req){
        $products = $req->all();
        // dd($products);
        return redirect()->route('payment')->with(['products' => $products]);
    }

    public function cek(request $req){
        $products = $req->all();
        dd($products);
    }
}
