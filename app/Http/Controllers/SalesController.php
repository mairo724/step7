<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductLists;

class SalesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {

        $model = new ProductLists();
        $products = $model->getList();

        return view('product_list', ['products' => $products]);

    }


}
