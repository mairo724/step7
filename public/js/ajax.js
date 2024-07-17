'use strict'

//検索機能

$(".search_js").on('click', function () {

    let searchKeyword = $('#searchKeyword').val(); //検索ワードを取得
    let searchMaker = $('#searchMaker').val(); //検索メーカー名を取得
    let minPrice = $('#minPrice').val(); //最小金額を取得
    let maxPrice = $('#maxPrice').val(); //最大金額を取得
    let minStore = $('#minStore').val(); //最小在庫数を取得
    let maxStore = $('#maxStore').val(); //最大在庫数を取得
    // console.log(searchKeyword);
    // $('.table tbody').empty(); //もともとある要素を空にする
    // $('.search-null').remove(); //検索結果が0のときのテキストを消す
    // if (!searchKeyword) {
    //     return false;
    // } //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない
    // if (!searchMaker) {
    //     return false;
    // } 
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
        type: 'GET',
        url: 'product_list_search', //後述するweb.phpのURLと同じ形にする
        data: $('form').serialize(),
        // data: 
        // {
        //     'searchKeyword': searchKeyword, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        // },
        //dataType: 'json', //json形式で受け取るとダメだったがtextにしたら通信成功した。??texttypeの意味がわからない？？
        dataType: 'json', //json形式で受け取るとダメだったがtextにしたら通信成功した。??texttypeの意味がわからない？？
        beforeSend: function () {
            $('.loading').removeClass('display-none');
        } //通信中の処理をここで記載。今回はぐるぐるさせるためにcssでスタイルを消す。
    }).done(function (data) { //ajaxが成功したときの処理
        $('.loading').addClass('display-none'); //通信中のぐるぐるを消す

        let $tbody = $('#fav-table tbody');
        $tbody.empty();
        $.each(data, function (index, value) {
            let row = `
                <tr>
                <td>${value.id}</td>
                <td class="img_list img_pos"><img src="${value.img_path || '../public/img/no_image.png'}"></td>
                <td>${value.product_name}</td>
                    <td>${value.price}</td>
                    <td>${value.stock}</td>
                    <td>${value.company_name}</td>
                    <td class="btn_adj"><a href="/step7/public/product_details_information/${value.id}" class="btn btn-outline-primary">詳細</a></td>
                    <td class="btn_adj">
                    <!-- <form class="del_js"> -->
                    <!-- <form id="del_js" action="{{ route('product_delete', ['id'=>$product->id]) }}" method="POST"> -->
                        <!-- @csrf -->
                        <button class="del_js btn btn-outline-danger" id="${value.id}" value="削除">削除</button>
                        <!-- <button type="submit" class="btn btn-outline-danger" value="削除" onclick='return confirm("本当に削除しますか？")'>削除</button> -->
                    <!-- </form> -->
                        <!-- <button type="button" onclick="location.href='{{ route('product_delete', ['id'=>$product->id])  }}'" id="submit" class="btn btn-danger" method="POST">削除</button></th> -->
                        <!-- <button type="submit" class="btn btn-danger">削除</button> -->   
                </td>
                </tr>
            `;
            $tbody.append(row);
        });

        // 検索結果がなかったときの処理
        if (data.length === 0) {
            $tbody.append('<tr><td colspan="5" class="text-center">製品が見つかりません</td></tr>');
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.error('エラー:', jqXHR.status, textStatus, errorThrown.message);
        alert('失敗');
    });

        // let html = '';
 
        // console.log(searchKeyword);

        // $.each(data, function (index, value) { //dataの中身からvalueを取り出す

        //     //ここの記述はリファクタ可能
        //     let id = value.id;
        //     let name = value.name;
        //     let avatar = value.avatar;
        //     let itemsCount = value.items_count;

        //     // １ユーザー情報のビューテンプレートを作成
        //     html = `
        //                 <tr class="user-list">
        //                     <td class="col-xs-2"><img src="${avatar}" class="rounded-circle user-avatar"></td> //${}で変数展開
        //                     <td class="col-xs-3">${name}</td>
        //                     <td class="col-xs-2">${itemsCount}</td>
        //                     <td class="col-xs-5"><a class="btn btn-info" href="/user/${id}">詳細</a></td>
        //                 </tr>
        //                     `
        // })
        
        // $('.user-table tbody').append(html); //できあがったテンプレートをビューに追加
        // // 検索結果がなかったときの処理
        // if (data.length === 0) {
        //     $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
        // }

    // }).fail(function (jqXHR, textStatus, errorThrown) {
    //     //ajax通信がエラーのときの処理
        
    //     console.log('エラー！');
    //     alert('失敗');
    //     console.log("ajax通信に失敗しました");
    //     console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
    //     console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
    //     console.log("errorThrown    : " + errorThrown.message); // 例外情報
    //     //console.log("URL            : " + url);        
    // });
});




//削除機能

// $('body').on('click', '#del_js', function () {

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     var product_id = $(this).data("id");

//     confirm("削除してよろしいですか？");
//     // route('product_details_information', ['id'=>$product->id])
//     $.ajax({
//         type: "DELETE",
//         url: "{{ route('product_details_information' }}" + '/' + product_id,
//         success: function (data) {
//             table.draw();
//         },
//         error: function (data) {
//             console.log('Error:', data);
//         }
//     });
// });



  $(function() {
    $('body').on('click', '.del_js', function () {
        console.log($(this));
        var id = $(this)[0].id;
        // var id = $(this)[0][1].id;
        // var id = $(this).id;
    var deleteConfirm = confirm(id+'削除してよろしいですか？');
    if(deleteConfirm == true) {    
        
        $.ajaxSetup({
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),},
        });
        
        $.ajax({
        //POST通信
        type: "POST",
        //ここでデータの送信先URLを指定します。
        url: "destroy"+id,
        dataType: "text",
        data: {
            id: id
        },
        })
        
        // 成功
        .done(function (results){
            var clickEle = $(this);
            // alert('成功:' + {{ $form->id }});

            // 通信成功時の処理
                            alert('削除しました:');
            console.log("results : " + results);        
            // window.location.href = "/";     //削除後に画面を遷移

            // clickEle.parents('tr').remove();
            
            let deleteBtn = document.getElementById(id);
            console.log(deleteBtn); 
            deleteBtn.parentNode.parentNode.remove();

            // deleteBtn.addEventListener("click", function() {
            // let deleteRow = this.parentNode;
            // deleteRow.remove();
            // })

        })
        // 失敗
        .fail(function(jqXHR, textStatus, errorThrown){
            alert('失敗');
            console.log("ajax通信に失敗しました");
            console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
            console.log("errorThrown    : " + errorThrown.message); // 例外情報
            //console.log("URL            : " + url);        
        });
    }

      });
  });

// $('body').on('click', '.deleteProduct', function () {

//     var product_id = $(this).data("id");
//     confirm("Are You sure want to delete !");

//     $.ajax({
//         type: "DELETE",
//         url: "{{ route('products-ajax-crud.store') }}" + '/' + product_id,
//         success: function (data) {
//             table.draw();
//         },
//         error: function (data) {
//             console.log('Error:', data);
//         }
//     });
// });


//ソート機能
 $(document).ready(function() {
    $('#fav-table').tablesorter();
});