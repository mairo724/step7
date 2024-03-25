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
<div >
  <form action="{{ route('product_list') }}" method="GET" class="flex">
    
  @csrf
<div class="search flex">
    
        <div class="form-group form-inline input-group-sm">
          <input type='text' id="search-keyword"  name="search-keyword" class="form-control col-sm-10"  value="{{ $searchKeyword}}" placeholder="検索キーワード">
          <span class="col-sm-2"></span>
         <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('keyword')}" th:errors="*{keyword}"></span>
        </div>
    
		<div class="form-group form-inline input-group-sm select-wrap-list">
                <select name="search-maker" id="myselect" class="form-control">
                    <label for="company_name">{{ __('メーカー名')}}<span class="badge badge-danger ml-2"></span></label>
                    <option value="">メーカー名</option>
                    @foreach ($companies as $company)
                        @if($searchMaker == $company->id)
                            <!-- if -->
                            <option value="{{$company->id}}" selected>{{$company -> company_name }}</option>
                        @else
                            <!-- else -->
                            <option value="{{$company->id}}">{{$company->company_name}} </option>		
                        @endif
                    @endforeach
                </select>
            </div>


                        <!-- <button type="button" id="submit" class="btn btn-light">検索</button> -->
                        <div>
                            <input type="submit" class="btn btn-light" value="検索">
                        </div>
                        <!-- <div>
                        <input type="button" onclick="location.href='{{ route('product_list') }}'" class="btn btn-light" value="一覧表示">
                        </div> -->
</div>
  </form>
  <!-- 検索機能ここまで -->
</div>


    <div class="ichiran">
  <table class="table table-striped">
     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th></th>
            <th class="new-btn"><button type="button" onclick="location.href='{{ route('product_new_register') }}'" id="submit" class="btn btn-outline-dark">新規登録</button></th>
        </tr>    
    </thead>

    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            @if($product->img_path==NULL)
            <td class="img_list"><img src="../public/img/ni.png"></td>
            @else
            <td class="img_list"><img src="{{ asset($product->img_path) }}"></td>
            @endif
            <!-- <td>{{ $product->img_path }}</td> -->
            <td>{{ $product->product_name }}</td>
            <td>￥{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_name }}</td>
            <td><a href="{{ route('product_details_information', ['id'=>$product->id]) }}" class="btn btn-outline-primary">詳細</a></td>
            <td>
             
                <form action="{{ route('product_delete', ['id'=>$product->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger">削除</button>
        </form>
                <!-- <button type="button" onclick="location.href='{{ route('product_delete', ['id'=>$product->id])  }}'" id="submit" class="btn btn-danger" method="POST">削除</button></th> -->
                <!-- <button type="submit" class="btn btn-danger">削除</button> -->
              
            </td>
    @endforeach
    </tr>
    </tbody> 
  </table>
</div>          

    <p id="result"></p>
  
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
