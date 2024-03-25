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
    public function index(Request $request)
    {
     
        $model = new Products();
        $companymodel = new Companies();
        $companies = $companymodel->getList();

        $searchKeyword = $request->input('search-keyword');
        $searchMaker = $request->input('search-maker');
        // $company_name=$request->input('company_name');

        //$products = new Products();
        //$company = new Companies();

        //$products = $products->SearchList($searchKeyword,$searchMaker);

        if($searchKeyword==='' && $searchMaker===''){
            $products = $model->getList();

        }
        else{
            $products = $model->SearchList($searchKeyword,$searchMaker);
        }
        return view('product_list', ['products' => $products, 'companies' => $companies, 'searchKeyword'=>$searchKeyword,'searchMaker'=>$searchMaker]); 
        // $model2 = new Companies();
        // $articles = $model2->showCompanyName();

        // return view('product_list', ['companies' => $companies]);
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
        if($request->hasFile('img_path')){
                    //①画像ファイルの取得
                    $img_path = $request->file('img_path');

                    //②画像ファイルのファイル名を取得
                    $file_name = $img_path->getClientOriginalName();
                    // dd($file_name);
                    //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
                    $img_path->storeAs('public/images', $file_name);
                    // dd( $img_path);
                    //④データベース登録用に、ファイルパスを作成
                    $img_path = 'storage/images/'.$file_name;
                    // dd( $img_path);
                    

        $model = new Products();
        $model->registproduct($request,$img_path);
    }else{
        $model = new Products();
        $model->registproduct2($request);  
    }
        // dd($model );
        try {
      
            // 登録処理呼び出し
        //    dd($img_path );
        //    $model = new Products();

            //  dd($img_path );
            // $model->registImg($img_path);
            //  dd($img_path );
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
      
          // 登録したら登録画面にリダイレクト
          return redirect(route('product_new_register'));
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
        // dd($products );
        // $products = Products::find($id);
        $model2 = new Companies();
        $companies = $model2->getList();
        // dd($companies );

        return view('product_information_edit' , ['products' => $products], ['companies' => $companies]);

    }


      // 詳細編集投稿機能！

      
    public function productDetailsInformationUpdate(ProductNewRegisterRequest $request, $id) {
    
//         if($request->hasFile('img_path')){
//             //①画像ファイルの取得
//             $img_path = $request->file('img_path');

//             //②画像ファイルのファイル名を取得
//             $file_name = $img_path->getClientOriginalName();
//             // dd($file_name);
//             //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
//             $img_path->storeAs('public/images', $file_name);
//             // dd( $img_path);
//             //④データベース登録用に、ファイルパスを作成
//             $img_path = 'storage/images/'.$file_name;
//             // dd( $img_path);
            
// }
        // $model = new Products();
        // $products =  $model->getProductById($id);

        // $products = Products::find($id);
        // $update = $this->products->update($request, $products);

        // return view('product_details_information_update' , ['products' => $products]);

        $products = Products::find($id);
        if($request->hasFile('img_path')){
            //①画像ファイルの取得
            $img_path = $request->file('img_path');

            //②画像ファイルのファイル名を取得
            $file_name = $img_path->getClientOriginalName();
            // dd($file_name);
            //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
            $img_path->storeAs('public/images', $file_name);
            // dd( $img_path);
            //④データベース登録用に、ファイルパスを作成
            $img_path = 'storage/images/'.$file_name;
            // dd( $img_path);       

        $products->productDetailsInformationUpdate($request, $products,$img_path);
        }else{
            $products->productDetailsInformationUpdate2($request, $products);
        }
       
        $companies = $products ->getList();
        //         $model = new Products();
        // $products =  $model->getProductById($id);
        // dd($products );
          // 画面にリダイレクト
          return redirect()->route('product_information_edit',['id' => $products-> id ]);
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

            // 削除機能
        public function delete($id)
        {
     
            $product = Products::find($id);
            
            $product->delete();
            
            return redirect()->route('product_list');
        }




        // 検索機能

        public function search(ProductNewRegisterRequest $request){

            $searchKeyword = $request->input('search-keyword');
            $searchMaker = $request->input('search-maker');
            // $company_name=$request->input('company_name');
    
            $products = new Products();
            $company = new Companies();
    
            $products = $products->SearchList($searchKeyword,$searchMaker);
           
    
            return view('product_list', ['searchKeyword'=>$searchKeyword,'searchMaker'=>$searchMaker]);
        }
    

}