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

<form action="{{route( 'product_new_regist_submit' )}}" method="post" enctype='multipart/form-data'>
@csrf
        <div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="product_name">商品名<span class="required">*</span></label>
		    <input type="text" class="form-control col-sm-10" id="product_name" name="product_name" value="{{ old('product_name')}}" placeholder="商品名">
		    <span class="col-sm-2"></span>
			@if($errors->has('product_name'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('product_name') }}</span>
			@endif
		</div>

	
		<!-- companyidでとる？ -->
		
		<label for="company_id">{{ __('メーカー名')}}<span class="required">*</span></label>
		<div class="form-group form-inline input-group-sm select-wrap">
		<select id="company_id" class="form-control"  name="company_id" value="{{ old('company_id')}}">

		<option value="{{ old('$company_id')}}" selected style="display:none;">メーカー名</option>
			@foreach ($companies as $company)
			<option value="{{$company->id}}">{{ $company->company_name}}</option>
			@endforeach

        </select>
		@if($errors->has('company_id'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('company_id') }}</span>
			@endif
	
		<!-- <select class="form-control" name="company_id" id="company_id" value="{{ old('company_id')}}">
  @foreach ($companies as $company)
    <option value='{{$company->id}}'>{{ $company->company_name }}</option>
  @endforeach
  </select> -->
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
		<label class="col-md-2 text-md-right" for="price">価格<span class="required">*</span></label>
		    <input type="number" class="form-control col-sm-10" id="price" name="price" value="{{ old('price')}}" placeholder="価格">
		    <span class="col-sm-2"></span>
			@if($errors->has('price'))     
		    <span class="col-sm-10 text-danger small">{{ $errors->first('price') }}</span>
			@endif
		</div>
        
        <div class="form-group form-inline input-group-sm">
		<label class="col-md-2 text-md-right" for="stock">在庫数<span class="required">*</span></label>
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
		    <input type="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control col-sm-10" id="img_path" name="img_path" value="old{img_path}" placeholder="画像">
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


