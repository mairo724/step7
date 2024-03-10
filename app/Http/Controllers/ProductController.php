<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Companies;
use App\Http\Requests\ProductNewRegisterRequest;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
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
    

       // 一覧表示  
    public function index()
    {
     
        $model = new Products();
        $products = $model->getList();

        return view('product_list', ['products' => $products]); 

        // インスタンス生成

        $model = new Companies();
        $articles = $model->showCompanyName();

        return view('product_list', ['companies' => $companies]);
    }



    // 新規登録画面に遷移
    public function productNewRegister() {

        $model = new Companies();
        $companies = $model->getList();
        // dd($companies );

        return view('product_new_register',['companies' => $companies] );

    }
 

    // 新規登録処理
      public function productNewRegistSubmit(ProductNewRegisterRequest $request){

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Products();
            $model->registproduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
  
          // 登録したら登録画面にリダイレクト
          return redirect(route('product_list'));
      }





       // 詳細画面表示 

    public function productDetailsInformation($id) {
        $model = new Products();
        $products = $model->getProductById($id);
        // dd($products);
        // $products = Products::find($id);

        return view('product_details_information' , ['products' => $products]);

        

    }


       // 詳細編集画面表示

    public function productInformationEdit($id) {
        $model = new Products();
        $products =  $model->getProductById($id);
        // $products = Products::find($id);
        $model2 = new Companies();
        $companies = $model2->getList();
        // dd($companies );

        return view('product_information_edit' , ['products' => $products], ['companies' => $companies]);

    }


      // 詳細編集投稿機能 途中！！
    public function productDetailsInformationUpdate(ProductNewRegisterRequest $request, $id) {
    
        // $model = new Products();
        // $products =  $model->getProductById($id);



        // $products = Products::find($id);
        // $update = $this->products->update($request, $products);

        // return view('product_details_information_update' , ['products' => $products]);

        $products = Products::find($id);
        $products->productDetailsInformationUpdate($request, $products);
        $companies = $products ->getCompanyNameById();
      
          // 画面にリダイレクト
          return redirect()->route('product_details_information',['id' => $products-> id ]);
      }


        /**
     * 削除処理
     */
    // public function destroy($id)
    // {
    //     // 指定されたIDのレコードを削除
    //     $products = $this->products->deleteproductById($id);
    //     // 削除したら一覧画面にリダイレクト
    //     return redirect()->route('product_list');
    // }


        public function delete($id)
        {
            // 削除機能
            
            $product = Products::find($id);
            
            $product->delete();
            
            return redirect()->route('product_list');
        }




        // 検索機能

        public function search(Request $request){

            $keyword = $request->input('keyword');
            $company_name=$request->input('company_name');
    
            $products = new Products();
            $company = new Companies();
    
            $products = $products->SearchList($keyword);
           
    
            return view('product_list');
        }
    


}