@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/product_details_infomation_style.css') }}">
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

                    <div th:fragment="form">

		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">ID</span>
		    <span>{{$products -> id }}</span>
			<span class="col-sm-2"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品画像</span>
		    <div class="col-sm-2">{{$products ->img_path }} </div>
			<span class="col-sm-2"></span>
			<span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('img_path')}" th:errors="*{img_path}"></span>
		</div>

        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品名</span>
		    <div>{{$products -> product_name }} </div>
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('publisher')}" th:errors="*{publisher}"></span>
		</div>
        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">メーカー</span>
			<div>{{$products -> company_name }} </div>
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('publisher')}" th:errors="*{company_name}"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">価格</span>
			<div>{{$products -> price}} </div>
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('price')}" th:errors="*{price}"></span>
		</div>
        
        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">在庫数</span>
		    <div>{{$products -> stock}} </div>
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('price')}" th:errors="*{stock}"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">コメント</span>
			<div>{{$products -> comment}} </div>
		</div>

		<a href="{{ route('product_information_edit',['id' => $products -> id ])}}" class="btn btn-primary">編集</a>
            <a href="{{ route('product_list') }}" class="btn btn-primary">戻る</a>

	</div>
	</div>



    
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
