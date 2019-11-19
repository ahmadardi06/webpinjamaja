<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentProductController extends Controller
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
        return view('rent-product');
    }

    public function item()
    {
        return view('store-item');
    }
}
