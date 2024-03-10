<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'company_id',
        'created_at',
        'updated_at'
    ];


// 質問する

    public function getList() {
        // productsテーブルのcompany_id'とcompaniesテーブルのidを結合してデータを取得
        $products = DB::table('products')
        ->join('companies', 'products.company_id','=','companies.id')
        ->select('products.*', 'companies.company_name')
        ->get();
        return $products;
    }

     // テーブルを結合してプロダクトテーブルのIDとメーカー名を紐づけて＄IDをとる
    public function getProductById($id) {
        return DB::table('Products')
        ->join('companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name')
        ->where('products.id','=',$id)
        ->first();
    }


         // リストに商品情報を新規登録する
     public function registproduct($request) {   
     // 登録処理  
 
        DB::table('Products')->insert([
            'product_name' => $request-> input('product_name'),
            'company_name' => $request-> input('company_name'),
            'price' => $request-> input('price'),
            'stock' => $request-> input('stock'),
            'comment' => $request-> input('comment'),
            'img_path' =>  $request -> input('img_path'),
            'company_id' =>  $request -> input('company_id'),
            // 'product_name' => $request->product_name,
            // 'company_name' => $request->company_name,
            // 'price' => $request->price,
            // 'stock' => $request->stock,
            // 'comment' => $request->comment,
            // 'img_path' =>  $request -> img_path,

        ]);
    }



    //  // リストに商品情報を追加する
    //  public function addProductById($id) {   
    //  // 登録処理  
    //     DB::table('products')->insert([
    //         'product_name' => $products->product_name,
    //         'company_name' => $products->company_name,
    //         'price' => $products->price,
    //         'stock' => $products->stock,
    //         'img_path' =>  $products -> img_path ,
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


     // 検索情報を取得
    public function getProductsByCondition($id) {
        return DB::table('products')
        ->join('companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name')
        ->where('products.id','=',$id)
        ->get();
    }

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

   

    public function productDetailsInformationUpdate($request, $products)
    {
        // 更新処理
        $result = $products->fill([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
            // 'updated_at' => NOW(),
            // 'company_id' => $request->company_id ⭐️⭐️質問する！！⭐️
        ])->save();
        // dd($result);

        return $result;
    }

    public function getCompanyNameById() {
        $products= DB::table('Products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->get();

        return $products;
    }

    public function SearchList($keyword, $company_name){
        //  検索処理

         { $results = DB::table('products') 
            ->join('companies', 'products.company_id', '=', 'companies.id') 
            ->select('products.company_id', 'products.product_name') 
            ->where('products.product_name', 'LIKE', "%{$keyword}%") 
            ->orWhere('companies.company_name', 'LIKE', "%{$keyword}%") 
            ->paginate(10)
            ->get(); 
            }

           $products=DB::table('products')
           ->join('companies','company_id','=','companies.id')
           ->select('products.*','companies.campanies_name')
           ->where('products.product_name', 'LIKE', "%$keyword%")
           ->orwhere('companies.company_name', 'LIKE', "%$keyword%")
           ->get();

           return $products;
    }



}