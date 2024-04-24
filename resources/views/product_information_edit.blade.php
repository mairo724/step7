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
						<form action="{{ route('product_details_information_update', ['id'=>$products->id])}}" method="post" enctype='multipart/form-data'>
							@csrf
								<div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">ID</span>
									<span>{{$products -> id }}</span>
								</div>
								<div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">商品画像</span>
									<input type="file" accept=".png, .jpg, .jpeg, .pdf,.webp" class="form-control col-sm-10" id="img_path" name="img_path" value="{{ $products -> img_path }}" placeholder="画像">
									@if($errors->has('img_path'))     
										<span class="col-sm-10 text-danger small">{{ $errors->first('img_path') }}</span>
									@endif
									<!-- {{ $products -> img_path }} -->
								</div>
								<div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">商品名<span class="required">*</span></span>
									<input type="text" class="form-control col-sm-10" id="product_name" name="product_name" value="{{ $products -> product_name }}" placeholder="商品名">
									@if($errors->has('product_name'))     
										<span class="col-sm-10 text-danger small">{{ $errors->first('product_name') }}</span>
									@endif
								</div>
								<!-- <div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">メーカー</span>
									<input type="text" class="form-control col-sm-10" id="company_name" name="company_name" value="{{ $products -> company_name}}" placeholder="メーカー">
									<span class="col-sm-2"></span>
									<span class="col-sm-10 text-danger small" th:if="${#fields.hasErrors('company_name')}" th:errors="*{company_name}"></span>
								</div> -->
								<label for="company_id">{{ __('メーカー名')}}<span class="required">*</span></label>
								<div class="form-group form-inline input-group-sm select-wrap">
									<select id="company_id" name="company_id" class="form-control">
										@foreach ($companies as $company)
										<!-- <option value="{{$company->id}}" selected style="display:none;">{{$products -> company_name }}</option> -->
										<!-- <option value="{{$company->company_name}}" disabled selected style="display:none;">{{$products -> company_name }}</option> -->
										<!-- disabledは１行目が選択できない -->
											@if($products->company_id == $company->id)
													<!-- if -->
													<option value="{{$company->id}}" selected>{{$company -> company_name }}</option>
											@else
													<!-- else -->
													<option value="{{$company->id}}">{{$company->company_name}} </option>		
											@endif
										@endforeach
									</select>
								</div>
								<div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">価格<span class="required">*</span></span>
									<input type="number" class="form-control col-sm-10 no-spin" id="price" name="price" value="{{ $products -> price }}" placeholder="価格">
									@if($errors->has('price'))     
										<span class="col-sm-10 text-danger small">{{ $errors->first('price') }}</span>
									@endif
								</div>   
								<div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">在庫数<span class="required">*</span></span>
									<input type="number" class="form-control col-sm-10 no-spin" id="stock" name="stock" value="{{$products -> stock}}" placeholder="在庫数">
									@if($errors->has('stock'))     
										<span class="col-sm-10 text-danger small">{{ $errors->first('stock') }}</span>
									@endif
								</div>
								<div class="form-group form-inline input-group-sm">
									<span class="col-md-2 text-md-right">コメント</span>
									<textarea class="form-control col-sm-10" cols="22" rows="3" id="comment" name="comment"
										text="{{$products -> comment}}"  placeholder="コメント">{{$products -> comment}}</textarea>
								</div>
									@if($errors->has('comment'))     
										<span class="col-sm-10 text-danger small">{{ $errors->first('comment') }}</span>
									@endif
								<input type="submit" class="btn btn-outline-dark" value="登録">
								<!-- <a href="{{ route('product_information_edit',['id' => $products -> id ])}}" class="btn btn-primary">更新</a> -->
								<a href="{{ route('product_list') }}" class="btn btn-outline-primary">戻る</a>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
