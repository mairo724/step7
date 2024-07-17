<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Companies;
use App\Models\Sales;
use App\Http\Requests\SalesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // $request->validate([
        //     'items' => 'required|array',
        //     'items.*.product_id' => 'required|exists:products,id',
        //     'items.*.quantity' => 'required|integer|min:1'
        // ]);

        DB::beginTransaction();

        try {
            foreach ($request->items as $item) {
                $product = Products::find($item['product_id']);
                $quantity = $item['quantity'];
                if ($product->stock < $quantity) {
                    throw new \Exception("在庫が不足しています。商品ID: {$product->id} 商品名: {$product->product_name} 在庫数: {$product->stock}");
                }

                // salesテーブルにレコードを追加
                Sales::create([
                    'product_id' => $item['product_id'],
                ]);

                // productsテーブルの在庫数を減算
                $product->stock -= $quantity;
                $product->save();
            }

            DB::commit();

            return response()->json(['message' => '購入処理成功しました'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => '購入処理失敗しました', 'error' => $e->getMessage()], 400);
        }


    }

    public function testOrder(Request $request)
    {
            return csrf_token();
     
    }

}
