@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品情報詳細画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form action="{{ route('product_details_information_update', ['id'=>$products->id])}}" method="post" >
	@csrf

                    <div th:fragment="form">
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">ID</span>
		    <span>{{$products -> id }}</span>
			<span class="col-sm-2"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品画像</span>
		    <input type="file" class="form-control col-sm-10" id="img_path" name="img_path" value="{{ $products -> img_path }}" placeholder="画像">
			<span class="col-sm-2"></span>
			<span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('img_path')}" th:errors="*{img_path}"></span>
			<!-- {{ $products -> img_path }} -->
		</div>

        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品名</span>
		    <input type="text" class="form-control col-sm-10" id="product_name" name="product_name" value="{{ $products -> product_name }}" placeholder="商品名">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('product_name')}" th:errors="*{product_name}"></span>
		</div>
        <!-- <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">メーカー</span>
		    <input type="text" class="form-control col-sm-10" id="company_name" name="company_name" value="{{ $products -> company_name}}" placeholder="メーカー">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('company_name')}" th:errors="*{company_name}"></span>
		</div> -->
		<label for="company_id">{{ __('メーカー名')}}<span class="badge badge-danger ml-2"></span></label>
		<div class="form-group form-inline input-group-sm">
		<select id="company_id" name="company_id">
			@foreach ($companies as $company)
			<option value="{{$company->id}}">{{$company->company_name}}</option>
					<!-- なぜcompanyidでとる？ -->
			@endforeach
        </select>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">価格</span>
		    <input type="number" class="form-control col-sm-10" id="price" name="price" value="{{ $products -> price }}" placeholder="価格">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('price')}" th:errors="*{price}"></span>
		</div>
        
        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">在庫数</span>
		    <input type="number" class="form-control col-sm-10" id="stock" name="stock" value="{{$products -> stock}}" placeholder="在庫数">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('stock')}" th:errors="*{stock}"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">コメント</span>
		    <textarea class="form-control col-sm-10" cols="22" rows="3" id="comment" name="comment"
		    	th:text="{{$products -> comment}}"  placeholder="コメント">{{$products -> comment}}</textarea>
		</div>
<input type="submit" class="btn btn-primary" value="登録">
		<!-- <a href="{{ route('product_information_edit',['id' => $products -> id ])}}" class="btn btn-primary">更新</a> -->
            <a href="{{ route('product_list') }}" class="btn btn-primary">一覧画面へ戻る</a>
	</div>
</form>

	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
