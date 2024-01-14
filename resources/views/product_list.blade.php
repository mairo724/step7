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

    <div class="form-group">
      <input type='text' id="keyword" class="form-control" placeholder="検索キーワード">
    </div>

    <div class="flex">
        <select id="myselect">
        <option value="" disabled selected style="display:none;">メーカー名</option>
                            <option value="1">テスト</option>
                            <option value="2">テス１</option>
        </select>
                    <button type="button" id="submit" class="btn">検索</button>
    </div>


    <div class="ichiran">
  <table>
     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th></th>
            <th></th>
            <th><button type="button" id="submit" class="btn">新規登録</button></th>
        </tr>
        
    </thead>
    <tbody>



    </tbody>
  </table>
</div>


    
                
    <p id="result"></p>
                    {{ __('aaaaaa') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
