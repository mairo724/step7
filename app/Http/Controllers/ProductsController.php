<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductNewRegisters;
use App\Http\Requests\ProductNewRegisterRequest;
use Illuminate\Support\Facades\DB;

class ProductNewRegisterController extends Controller
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
    
    public function productNewRegister()
    {

        $model = new ProductNewRegisters();
        $products = $model->getList();

        return view('product_new_register', ['products' => $products]);

    }

    public function productNewRegisterSubmit(ProductNewRegisterRequest $request) {

    // トランザクション開始
    DB::beginTransaction();

    
    try {
        // 登録処理呼び出し
        $model = new ProductNewRegisters();
        $model->ProductNewRegisterRequest($request);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

    // 処理が完了したらregistにリダイレクト
    return redirect(route('product_new_register'));
}

}
