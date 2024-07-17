@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品一覧画面') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- 検索機能ここから -->
                        <div>
                            <form action="{{ route('product_list') }}" method="GET" class="form">      
                            @csrf
                            <!-- <form class="form" id="search">  -->
                                <div class="search searchflex">    
                                        <div class="form-group form-inline input-group-sm search_keyword">
                                            <input type='text' id="searchKeyword"  name="searchKeyword" class="form-control col-sm-10"  value="{{$search_keyword}}" placeholder="検索キーワード">
                                            <span class="col-sm-2"></span>
                                        </div>
                                        <div class="form-group form-inline input-group-sm select-wrap-list search_maker">
                                            <select name="searchMaker" id="searchMaker" class="form-control">
                                                
                                         
                                           
                                                    <label for="company_name">{{ __('メーカー名')}}<span class="badge badge-danger ml-2"></span></label>
                                                        <option value="">メーカー名</option>
                                                            @foreach ( $companies as $company)
                                                                @if( $search_maker == $company->id)
                                                                    <!-- if -->
                                                                    <option value="{{ $company->id}}" selected>{{ $company -> company_name }}</option>
                                                                @else
                                                                    <!-- else -->
                                                                    <option value="{{ $company->id}}">{{ $company->company_name}} </option>		
                                                                @endif
                                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group form-inline input-group-sm searchflex price-input">
                                            <div class="min-price">
                                                <input type="number" autocomplete="off" class="form-control col-sm-10 no-spin" name="minPrice" id="minPrice" placeholder="価格下限" maxlength="7">
                                            </div>
                                            <div class="vertical-middle">{{ __('円')}}</div>
                                            <div class="vertical-middle">{{ __('〜')}}</div>
                                            <div class="max-price">
                                                <input type="number" autocomplete="off" class="form-control col-sm-10 price input no-spin" name="maxPrice" id="maxPrice" placeholder="価格上限" maxlength="7">
                                            </div>
                                            <div class="vertical-middle">{{ __('円')}}</div>
                                        </div>

                                        <div class="form-group form-inline input-group-sm searchflex store-input">
                                            <div class="min-store">
                                                <input type="number" autocomplete="off" class="form-control col-sm-10 price input no-spin" name="minStore" id="minStore" placeholder="在庫下限" maxlength="7">
                                            </div>
                                            <div class="vertical-middle">{{ __('本')}}</div>
                                            <div class="vertical-middle">{{ __('〜')}}</div>
                                            <div class="max-store">
                                                <input type="number" autocomplete="off" class="form-control col-sm-10 price input no-spin" name="maxStore" id="maxStore" placeholder="在庫上限" maxlength="7">
                                            </div>
                                            <div class="vertical-middle">{{ __('本')}}</div>
                                        </div>

                                        <div>
                                        <!-- <input type="image" src="../public/img/Seach.png" alt="検索する"> -->
                                        <input type="button" class="search_js btn btn-outline-secondary" value="検索" name="search">
                                         <!-- <input type="submit" class="search_js btn btn-outline-secondary" value="検索"> -->
                                         <!-- <button class="search_js btn btn-outline-secondary" value="検索">検索</button> -->
                                        </div>
                                                        <!-- <div>
                                                        <input type="button" onclick="location.href='{{ route('product_list') }}'" class="btn btn-light" value="一覧表示">
                                                        </div> -->
                                </div>
                            </form>
                        </div>
                        <!-- 検索機能ここまで -->
                        <table class="table table-striped" id="fav-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="sorter-false">商品画像</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>在庫数</th>
                                    <th>メーカー名</th>
                                    <th class="btn_width sorter-false sorter-border-light"></th>
                                    <th class="new-btn btn_width btn_adj sorter-false sorter-border-light"><button type="button" onclick="location.href='{{ route('product_new_register') }}'" id="submit" class="btn btn-dark">新規登録</button></th>
                                </tr>    
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                            @if( $product->img_path==NULL)
                                            <td class="img_list img_pos"><img src="../public/img/no_image.png"></td>
                                            @else
                                            <td class="img_list img_pos"><img src="{{ asset($product->img_path) }}"></td>
                                            @endif
                                            <!-- <td>{{ $product->img_path }}</td> -->
                                        <td>{{ $product->product_name }}</td>
                                        <td>￥{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->company_name }}</td>
                                        <td class="btn_adj"><a href="{{ route('product_details_information', ['id'=>$product->id]) }}" class="btn btn-outline-primary">詳細</a></td>
                                        <td class="btn_adj">
                                            <!-- <form class="del_js"> -->
                                            <!-- <form id="del_js" action="{{ route('product_delete', ['id'=>$product->id]) }}" method="POST"> -->
                                                <!-- @csrf -->
                                                <button class="del_js btn btn-outline-danger" id="{{ $product->id }}" value="削除">削除</button>
                                                <!-- <button type="submit" class="btn btn-outline-danger" value="削除" onclick='return confirm("本当に削除しますか？")'>削除</button> -->
                                            <!-- </form> -->
                                                <!-- <button type="button" onclick="location.href='{{ route('product_delete', ['id'=>$product->id])  }}'" id="submit" class="btn btn-danger" method="POST">削除</button></th> -->
                                                <!-- <button type="submit" class="btn btn-danger">削除</button> -->   
                                        </td>
                                    </tr>
                                @endforeach                           
                            </tbody> 
                        </table>
                    
                    </div>          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
