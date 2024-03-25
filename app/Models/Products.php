<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;


// エクロアントでDB登録する時に許可の処理が必要なのですか？？質問する

    // protected $table = 'products';

    // protected $primaryKey = 'id';

    // protected $fillable = [
    //     'product_name',
    //     'price',
    //     'stock',
    //     'comment',
    //     'img_path',
    //     'company_id',
    //     'created_at',
    //     'updated_at'
    // ];



    public function getList() {
        // productsテーブルのcompany_id'とcompaniesテーブルのidを結合して全てのデータをとる
        $products = DB::table('products')->paginate(2)
        ->join('companies', 'products.company_id','=','companies.id')
        ->select('products.*', 'companies.company_name')
        ->get();
        return $products;
    }

     // productsテーブルのcompany_id'とcompaniesテーブルのidを結合してproductsテーブルのIDと$idを紐づけて合致したものの最初の一行をとる
    public function getProductById($id) {
        return DB::table('products')
        ->join('Companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name')
        ->where('products.id','=',$id)
        ->first();
    }


         // リストに商品情報を新規登録する処理 formからPOSTで送られてきたデータは$requestに入っている
        //  ？？ 'company_name' のカラムがないというエラーが出る。DBのエラー？？バリデーションの見直し？？
     public function registproduct($request,$img_path) {   
 
        DB::table('products')->insert([
            // 'product_name' => $request-> input('product_name'),
            // 'price' => $request-> input('price'),
            // 'stock' => $request-> input('stock'),
            // 'comment' => $request-> input('comment'),
            // 'img_path' =>  $request -> input('img_path'),
            // 'company_id' =>  $request -> input('company_id'),
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' =>  $img_path,
        ]);
    }

    public function registproduct2($request) {   
 
        DB::table('products')->insert([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
        ]);
    }

    // public function registImg($img_path){
       
    //     DB::table('products')->insert([
    //         'img_path' => $request->$img_path
    //     ]);

    // }

    // public function registProduct($data) {
    //     // 登録処理
    //     DB::table('products') ->insert([
    //         'product_name' => $data->product_name,
    //         'price' => $data->price,
    //         'stock' => $data->stock,
    //         'comment' => $data->comment,
    //         'img_path' => $data->img_path,
    //         'company_id' => $data->company_id,
    //         'created_at' => NOW(),
    //         'updated_at' => NOW(),
            
            
    //     ]);

    // }



    //  // リストから商品情報を削除する
    //  public function deleteProductById($id) {
    //     return DB::table('products')
    //     ->join('companies','products.company_id','=','companies.id')
    //     ->select('products.*','companies.company_name')
    //     ->where('products.id','=',$id)
    //     ->first();

    // }

     // 詳細画面を表示
     public function getProductsDetailsInformation($id) {
        return DB::table('products')
        ->join('companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name')
        ->where('products.id','=',$id)
        ->get();
    }

    // // 更新処理
    // public function update($request, $products)
    // {
    //     $products = DB::table('products');
    //     $result = $products->fill([
    //         'product_name' => $products -> product_name
    //     ])->save();
    //     return $result;
    // }


    // $details = product_details_information::find(1)

   
        //  ？？ddでバックしたら 'company_name'が取れていなかった クエリビルダとエクロアントで書き方が何か違う？まだよくわかっていない
    public function productDetailsInformationUpdate($request, $products, $img_path)
    {
        // 更新処理
        $result = $products->fill([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $img_path,
            // 'updated_at' => NOW(),
            // 'company_id' => $request->company_id ⭐️⭐️質問する！！⭐️
        ])->save();
        // dd($result);

        return $result;
    }

    public function productDetailsInformationUpdate2($request, $products)
    {
        // 更新処理
        $result = $products->fill([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            // 'updated_at' => NOW(),
            // 'company_id' => $request->company_id ⭐️⭐️質問する！！⭐️
        ])->save();
        // dd($result);

        return $result;
    }

    
    // public function getCompanyNameById() {
    //     $products= DB::table('products')
    //         ->join('companies', 'products.company_id', '=', 'companies.id')
    //         ->get();

    //     return $products;
    // }


    // public function getCompanyNameById() {
    //     $products= DB::table('Products')
    //         ->join('companies', 'products.company_id', '=', 'companies.id')
    //         ->get();

    //     return $products;
    // }

    // public function SearchList($keyword, $company_name){
    //     //  検索処理

    //      { $results = DB::table('products') 
    //         ->join('companies', 'products.company_id', '=', 'companies.id') 
    //         ->select('products.company_id', 'products.product_name') 
    //         ->where('products.product_name', 'LIKE', "%{$keyword}%") 
    //         ->orWhere('companies.company_name', 'LIKE', "%{$keyword}%") 
    //         ->paginate(10)
    //         ->get(); 
    //         }

    //        $products=DB::table('products')
    //        ->join('companies','company_id','=','companies.id')
    //        ->select('products.*','companies.campanies_name')
    //        ->where('products.product_name', 'LIKE', "%$keyword%")
    //        ->orwhere('companies.company_name', 'LIKE', "%$keyword%")
    //        ->get();

    //        return $products;
    // }

    public function SearchList($searchKeyword,$searchMaker){
        //  検索処理

        //  { $results = DB::table('products') 
        //     ->join('companies', 'products.company_id', '=', 'companies.id') 
        //     ->select('products.company_id', 'products.product_name') 
        //     ->where('products.product_name', 'LIKE', "%{$keyword}%") 
        //     ->orWhere('companies.company_name', 'LIKE', "%{$keyword}%") 
        //     ->paginate(10)
        //     ->get(); 
            // }


        if($searchKeyword!==''&&$searchMaker!==''){
           $products=DB::table('products')
           ->join('companies','products.company_id','=','companies.id')
           ->select('products.*','companies.company_name')
           ->where('products.product_name', 'LIKE', "%$searchKeyword%")
           ->where('companies.id', 'LIKE', "%$searchMaker%")
           ->get();
        }elseif($searchMaker!==''){

           $products=DB::table('products')
           ->join('companies','products.company_id','=','companies.id')
           ->select('products.*','companies.company_name')
        //    ->where('products.product_name', 'LIKE', "%$searchKeyword%")
           ->where('companies.id', 'LIKE', "%$searchMaker%")
           ->get();
           
        }elseif($searchKeyword!==''){
           $products=DB::table('products')
           ->join('companies','products.company_id','=','companies.id')
           ->select('products.*','companies.company_name')
           ->where('products.product_name', 'LIKE', "%$searchKeyword%")
        //    ->where('companies.id', 'LIKE', "%$searchMaker%")
           ->get();
        }
           return $products;
    }

    //  // 検索情報を取得
    //  public function getProductsByCondition($id) {
    //     return DB::table('products')
    //     ->join('companies','products.company_id','=','companies.id')
    //     ->select('products.*','companies.company_name')
    //     ->where('products.id','=',$id)
    //     ->get();
    // }


}