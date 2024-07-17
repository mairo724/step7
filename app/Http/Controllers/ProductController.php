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
        $search_keyword = $request->input('searchKeyword');
        $search_maker = $request->input('searchMaker');
        $search_max_price = $request->input('maxPrice');
        $search_min_price = $request->input('minPrice');
        $search_max_store = $request->input('maxStore');
        $search_min_store = $request->input('minStore');
        //$company_name=$request->input('company_name');
        //$products = new Products();
        //$company = new Companies();
        //$products = $products->SearchList($search_keyword,$search_maker);
        // if($search_keyword==='' && $search_maker===''){
        if (is_null($search_keyword) && is_null($search_maker) && is_null($search_max_price) && is_null($search_min_price) && is_null($search_max_store) && is_null($search_min_store))  {
            $products = $model->getList();
            // dd('一覧');
            return view('product_list', ['products' => $products, 'companies' => $companies, 'search_keyword'=>$search_keyword,'search_maker'=>$search_maker,'search_max_price'=>$search_max_price,'search_min_price'=>$search_min_price,'search_max_store'=>$search_max_store,'search_min_store'=>$search_min_store]); 
        }
        else{
            $products = $model->SearchList($search_keyword,$search_maker,$search_max_price,$search_min_price,$search_max_store,$search_min_store);
            // dd('kennsaku');
            return response()->json($products);
            // return response()->json(
            //     [],200
            //     );
        }
        // return view('product_list', ['products' => $products, 'companies' => $companies, 'search_keyword'=>$search_keyword,'search_maker'=>$search_maker,'search_max_price'=>$search_max_price,'search_min_price'=>$search_min_price,'search_max_store'=>$search_max_store,'search_min_store'=>$search_min_store]); 
        // $model2 = new Companies();
        // $articles = $model2->showCompanyName();
        // return view('product_list', ['companies' => $companies]);
    }

    // 一覧表示  
    public function search(Request $request)
    {
    $model = new Products();
    $companymodel = new Companies();
    $companies = $companymodel->getList();
    $search_keyword = $request->input('searchKeyword');
    $search_maker = $request->input('searchMaker');
    $search_max_price = $request->input('maxPrice');
    $search_min_price = $request->input('minPrice');
    $search_max_store = $request->input('maxStore');
    $search_min_store = $request->input('minStore');
    //$company_name=$request->input('company_name');
    //$products = new Products();
    //$company = new Companies();
    //$products = $products->SearchList($search_keyword,$search_maker);
    // if($search_keyword==='' && $search_maker===''){
    if (is_null($search_keyword) && is_null($search_maker) && is_null($search_max_price) && is_null($search_min_price) && is_null($search_max_store) && is_null($search_min_store))  {
        $products = $model->getList();
        // dd('一覧');
    //     return view('product_list', ['products' => $products, 'companies' => $companies, 'search_keyword'=>$search_keyword,'search_maker'=>$search_maker,'search_max_price'=>$search_max_price,'search_min_price'=>$search_min_price,'search_max_store'=>$search_max_store,'search_min_store'=>$search_min_store]); 
    return response()->json($products);     

}
    else{
        $products = $model->SearchList($search_keyword,$search_maker,$search_max_price,$search_min_price,$search_max_store,$search_min_store);
        // dd('kennsaku');
        return response()->json($products);
        // return response()->json(
        //     [],200
        //     );
    }
    // return view('product_list', ['products' => $products, 'companies' => $companies, 'search_keyword'=>$search_keyword,'search_maker'=>$search_maker,'search_max_price'=>$search_max_price,'search_min_price'=>$search_min_price,'search_max_store'=>$search_max_store,'search_min_store'=>$search_min_store]); 
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
        $model = new Products();
        // トランザクション開始
        DB::beginTransaction();
        try {
            if($request->hasFile('img_path')){
                //①画像ファイルの取得
                $img_path = $request->file('img_path');
                //②画像ファイルのファイル名を取得
                $file_name = $img_path->getClientOriginalName();
                //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
                $img_path->storeAs('public/images', $file_name);
                // dd( $img_path);
                //④データベース登録用に、ファイルパスを作成
                $img_path = 'storage/images/'.$file_name;
                // dd( $img_path);
                $model->registproduct($request,$img_path);
            }else{
                $model->registproduct2($request);  
            }
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

    // 詳細編集投稿機能
    public function productDetailsInformationUpdate(ProductNewRegisterRequest $request, $id) {
        try {
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
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
          // 画面にリダイレクト
          return redirect()->route('product_information_edit',['id' => $products-> id ]);
      }

    // 削除機能
    public function delete($id) {
        // return response()->json(
        //     [],200
        // );
            try {
            // 指定されたIDのレコードを削除
            $products = Products::find($id);   //Productsモデルを使用、IDで検索
            $products->delete();
            return response()->json(
                [],200
            );
            // 失敗したら失敗のデータを渡す
            } catch (\Exception $e) {
                // DB::rollback();
                // return back();
                return response()->json(
                    [],400
                );
            }
             // 削除したら一覧画面にリダイレクトしない
            // return redirect()->route('product_list');
        }

    // 検索機能
    // public function search(ProductNewRegisterRequest $request){
    //         $search_keyword = $request->input('searchKeyword');
    //         $search_maker = $request->input('searchMaker');
    //         $products = new Products();
    //         $products = $products->SearchList($search_keyword,$search_maker);      
    //         return view('product_list', ['search_keyword'=>$search_keyword,'search_maker'=>$search_maker]);
    //     }

    // 検索機能 Ajax
        //     public function search(ProductNewRegisterRequest $request){
        //     $search_keyword = $request->input('searchKeyword');
        //     $search_maker = $request->input('searchMaker');
        //     $products = new Products();
        //     $products = $products->SearchList($search_keyword,$search_maker);      
        //     return response()->json(
        //         [],200
        //     );
        // }

}