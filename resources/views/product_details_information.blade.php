@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/product_details_infomation_style.css') }}">
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
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">ID</span>
							<span>{{ $products -> id }}</span>
							<span class="col-sm-2"></span>
						</div>
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">{{ __('商品画像') }}</span>
							@if( $products->img_path==NULL)
								<div class="col-sm-2">{{ __('画像なし') }}</div>
							@else
								<div class="col-sm-2"><img src="{{ asset($products->img_path) }}"></div>
							@endif
							<!-- <div class="col-sm-2">{{$products ->img_path }} </div> -->
							<span class="col-sm-2"></span>
						</div>
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">商品名</span>
							<div>{{ $products -> product_name }} </div>
							<span class="col-sm-2"></span>
						</div>
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">メーカー</span>
							<div>{{ $products -> company_name }} </div>
							<span class="col-sm-2"></span>
						</div>
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">価格</span>
							<div>￥{{ $products -> price}}</div>
							<span class="col-sm-2"></span>
						</div>
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">在庫数</span>
							<div>{{ $products -> stock}} </div>
							<span class="col-sm-2"></span>
						</div>
						<div class="form-group form-inline input-group-sm">
							<span class="col-md-2 text-md-right">コメント</span>
							<div>{{ $products -> comment}} </div>
						</div>
							<a href="{{ route('product_information_edit',['id' => $products -> id ])}}" class="btn btn-outline-dark">編集</a>
							<a href="{{ route('product_list') }}" class="btn btn-outline-primary">戻る</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
