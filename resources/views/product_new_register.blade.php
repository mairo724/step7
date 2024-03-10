@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品新規登録画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<form action="{{route( 'product_new_regist_submit' )}}" method="post" >
@csrf
        <div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="product_name">商品名</label>
		    <input type="text" class="form-control col-sm-10" id="product_name" name="product_name" value="{{ old('product_name')}}" placeholder="商品名">
		    <span class="col-sm-2"></span>
			@if($errors->has('product_name'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('product_name') }}</span>
			@endif
		</div>

	<div>
		<!-- companyidでとる？ -->
		<label for="company_id">{{ __('メーカー名')}}<span class="badge badge-danger ml-2"></span></label>
		<select id="company_id" name="company_id">
			@foreach ($companies as $company)
			<option value="{{$company->id}}">{{ $company->company_name}}</option>
			@endforeach
        </select>
	</div>

        <!-- <div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="company_name">メーカー名</label>
		    <input type="text" class="form-control col-sm-10" id="company_name" name="company_name" value="{{ old('company_name')}}" placeholder="メーカー">
		    <span class="col-sm-2"></span>
			@if($errors->has('company_name'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('company_name') }}</span>
			@endif
		</div> -->
		<div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="price">価格</label>
		    <input type="number" class="form-control col-sm-10" id="price" name="price" value="{{ old('price')}}" placeholder="価格">
		    <span class="col-sm-2"></span>
			@if($errors->has('price'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('price') }}</span>
			@endif
		</div>
        
        <div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="stock">在庫数</label>
		    <input type="number" class="form-control col-sm-10" id="stock" name="stock" value="{{ old('stock')}}" placeholder="在庫数">
		    <span class="col-sm-2"></span>
			@if($errors->has('stock'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('stock') }}</span>
			@endif
		</div>
		<div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="comment">コメント</label>
			<textarea class="form-control col-sm-10" cols="22" rows="3" id="comment" name="comment"
		    	placeholder="コメント">{{ old('comment') }}</textarea>
		</div>
			<span class="col-sm-2"></span>
			@if($errors->has('comment'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('stock') }}</span>
			@endif

		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品画像</span>
		    <input type="file" class="form-control col-sm-10" id="img_path" name="img_path" value="old{img_path}" placeholder="画像">
			<span class="col-sm-2"></span>
			@if($errors->has('img_path'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('img_path') }}</span>
			@endif
		</div>

		<!-- <button type="submit" class="btn btn-primary">登録</button> -->

		<input type="submit" class="btn btn-primary" value="登録">

            <a href="{{ route('product_list') }}" class="btn btn-primary">戻る</a>
</form>

	</div>



    
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




<!-- 

<div th:fragment="form">

<form action="{{route('product_new_regist_submit')}}" method="POST" >
@csrf
        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品名</span>
		    <input type="text" class="form-control col-sm-10" id="product_name" name="product_name" th:value="old{product_name}" placeholder="商品名">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('product_name')}" th:errors="*{product_name}"></span>
		</div>
        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">メーカー名</span>
		    <input type="text" class="form-control col-sm-10" id="company_name" name="company_name" th:value="old{company_name}" placeholder="メーカー">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('company_name')}" th:errors="*{company_name}"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">価格</span>
		    <input type="number" class="form-control col-sm-10" id="price" name="price" th:value="old{price}" placeholder="価格">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('price')}" th:errors="*{price}"></span>
		</div>
        
        <div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">在庫数</span>
		    <input type="number" class="form-control col-sm-10" id="stock" name="stock" th:value="old{stock}" placeholder="在庫数">
		    <span class="col-sm-2"></span>
		    <span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('stock')}" th:errors="*{stock}"></span>
		</div>
		<div class="form-group form-inline input-group-sm">
		    <span class="col-md-2 text-md-right">商品画像</span>
		    <input type="file" class="form-control col-sm-10" id="img_path" name="img_path" th:value="old{img_path}" placeholder="画像">
			<span class="col-sm-2"></span>
			<span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('img_path')}" th:errors="*{img_path}"></span>
		</div>

		<button type="submit" class="btn btn-primary">登録</button>
<input type="submit" class="btn btn-primary" value="登録">

            <a href="{{ route('product_list') }}" class="btn btn-primary">戻る</a>
</form>

	</div> -->