@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <h1>商品新規登録画面</h1>
            <form action="#" method="post">
                @csrf

                <div class="form-group">
                    <label for="title">商品名</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="">
                </div>

                <div class="form-group">
                    <label for="makername">メーカー名</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="">
                </div>

                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="number" min="0" class="form-control" id="price" name="price" placeholder="">
                </div>

                <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="">
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder=""></textarea>
                </div>


                <div class="form-group">
                    <form action="/任意のurl" method="post" enctype='multipart/form-data'>
                    <input type="file" class="form-control" name="thumbnail" />
                 @csrf
                 </form>
                </div>

                <button type="submit" class="btn btn-default">送信</button>
                
            </form>
        </div>
        <div class='return'>
          <a href="{{route('product_list')}}">戻る</a>
        </div>
    </div>
       

@endsection
