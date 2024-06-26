<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductNewRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required | max:30',
            'company_id' => 'required',
            'price' => 'required | alpha_num',
            'stock' => 'required | alpha_num',
            'comment' => 'max:255',
            'img_path' => 'file  | image',            
        ];
    }
    /**
 * 項目名
 *
 * @return array
 */
public function attributes()
{
    return [
        'product_name' => '商品名',
        'company_id' => 'メーカー',
        'price' => '価格',
        'stock' => '在庫数',
        'comment' => 'コメント',
        'img_path' => '画像',

    ];
}

/**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'product_name.required' => ':attributeは必須項目です。',
        'product_name.max' => ':attributeは:max字以内で入力してください。',
        'company_id.required' => ':attributeは必須項目です。',
        'price.required' => ':attributeは必須項目です。',
        'stock.required' => ':attributeは必須項目です。',
        'comment.max' => ':attributeは:max字以内で入力してください。',
        'img_path.file' => ':attributeはファイル形式で入力してください。',
        'img_path.image' => ':attributeは画像形式で入力してください。',
    ];
}
    
}
