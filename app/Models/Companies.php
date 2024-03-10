<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{

    // use HasFactory;

    protected $table = 'companies';

    protected $primaryKey = 'id';

    protected $fillable = [
        'company_name',
        'street_address',
        'representative',
        'created_at',
        'updated_at'
    ];


    public function getList() {
        // Companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();
        return $companies;
    }

    


}