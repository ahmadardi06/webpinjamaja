<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormOrderController extends Controller
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
        return view('form-order');
    }

    public function getDataProduct(request $req){
        $products = $req->all();
        // dd($products);
        
        return redirect()->route('form-order', ['id' => $products['item_id']])->with(['products' => $products]);
    }
}
