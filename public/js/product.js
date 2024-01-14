'use strict'

// 設問7.
//   名前とニックネームの追加時、各行の右端に削除ボタンを出力しなさい。
//   ボタンをクリックするとボタンがある行を削除する処理を作成しなさい。

let i = 0 ;
const showInput = () => {
      const namaebox = document.getElementById("namae");
      const namaeValue = namaebox.value.trim();
      const nickbox = document.getElementById("nickname");
      const nickValue = nickbox.value.trim();

      if(namaeValue&& nickValue){
        if(window.confirm(namaeValue + 'さん' + nickValue + 'を登録します。よろしいですか？')){

                let tableObject = document.getElementById( "Table" );
                let tr = "<tr id=\""+i+"\">";
                    tr += "<td>" + namaeValue+ "</td>";
                    tr += "<td>" + nickValue + "</td>";
                    tr += "<td>" + "<button type=\"button\"  onclick=\"deleteBtn(" + i + ")\">" + "削除" + "</button>" + "</td>";
                    //  tr += "<td>" + "<button type=\"button\" id=\"dB\" class=\"button button--delete\" >" + "削除" + "</button>" + "</td>";
                    tr += "</tr>";
                   
                    
                tableObject.insertAdjacentHTML( "beforeend", tr );
                let row = tableObject.rows.length;

      i++;

      // const list = document.querySelector(".table");
      // const listItem = list.children;
      // console.log(listItem[i]);   



        //  if(i>=4){
        //                     const tuikaButton = document.getElementById('tuikaBtn');
        //                     tuikaButton.style.visibility='hidden';
        //                   }  

                        if(row>=3){
                            const tuikaButton = document.getElementById('tuikaBtn');
                            tuikaButton.style.visibility='hidden';
                          }  

                          // let row = tableObject.rows.length;
                          // if(row<4){
                          //   const tuikaButton = document.getElementById('tuikaBtn');
                          //   tuikaButton.style.visibility='hidden';
                          // }   
  

          // for( let i = 1; i < listItem.length; i++) {
          //       const itemDeleteButton = listItem[i].querySelector(deleteButton);
        
          //       console.log(listItem[i]);       
          //     }


//   let deleteBtn = document.getElementById('dB');
//   deleteBtn.addEventListener("click", function() {
  
//     let deleteRow = this.parentNode;
//     deleteRow.remove();
// })
                  
//     const listItem = tableObject.children;
//         const deleteButton = ".button--delete";
                   
//  for( let i = 0; i < listItem.length; i++) {

// const itemDeleteButton = listItem[i].querySelector(deleteButton);
// itemDeleteButton.addEventListener("click", () => {
//   listItem[i].remove();
// })
//           }                 
           }
           
        }else{
          alert("名前とニックネーム両方登録して下さい。");
          }
    }

  // function deleteBtn(target) {

//       var target_id = target.id;
//       console.log(target.id);
// a.pearentNode.remove();
//       let tableObject = document.getElementById( "target" );
//     const listItem = tableObject.children;
//     var tgt_id = document.getElementById(target_id);
//     listItem.removeChild(tgt_id);;


//   var parent = document.getElementById('Target');
//   var ipt_id = document.getElementById('inputform_' + target_id);
//   var tgt_id = document.getElementById(target_id);
//   parent.removeChild(ipt_id);
//   parent.removeChild(tgt_id);	



    function deleteBtn(target) {

      console.log(target);
      // const list = document.querySelector(".table");
      //               const listItem = list.children;
      //               const deleteButton = document.getElementById('dB');
                  // const itemDeleteButton =listItemElement.querySelector(deleteButton);
                //  let tbody = document.getElementById( "Table" );
                      let deleatRow= document.getElementById(target);
                      console.log(deleatRow);
                      deleatRow.remove();
                        let tableObject = document.getElementById( "Table" );
                      let row = tableObject.rows.length;
                      if(row<10){
                            const tuikaButton = document.getElementById('tuikaBtn');
                            tuikaButton.style.visibility='visible';
                          }  



    //   var target_id = target.id;
    //   console.log(target.id);
// a.pearentNode.remove();
    //   let tableObject = document.getElementById( "target" );
    // const listItem = tableObject.children;
    // var tgt_id = document.getElementById(target_id);
    // listItem.removeChild(tgt_id);;


  // var parent = document.getElementById('Target');
  // var ipt_id = document.getElementById('inputform_' + target_id);
  // var tgt_id = document.getElementById(target_id);
  // parent.removeChild(ipt_id);
  // parent.removeChild(tgt_id);	
 }



//     let tableObject = document.getElementById( "Table" );
//     function deleteBtn(){
//       const child = document.getElementById("0");
// const grandParent = child.closest("#sakujyo");
// randParent.remove();
// }

// let tableObject = document.getElementById( "Table" );
//     const listItem = tableObject.children;
//         const deleteButton = ".button--delete";
        
//  for( let i = 0; i < listItem.length; i++) {

//       const itemDeleteButton = listItem[i].querySelector(deleteButton);
//       itemDeleteButton.addEventListener("click", () => {
//         listItem[i].remove();
//       })
//     }

// let i = 1 ;
// {
//   let button_data = document.createElement('button');
//   button_data.id = i;
//   button_data.onclick = function(){deleteBtn(this);}
//   button_data.innerHTML = '削除';
//   let input_area = document.getElementById(input_data.id);
//   parent.appendChild(button_data);

//   i++ ;
// }

// function deleteBtn(target) {
//   var target_id = target.id;
//   var parent = document.getElementById('Target');
//   var ipt_id = document.getElementById('inputform_' + target_id);
//   var tgt_id = document.getElementById(target_id);
//   parent.removeChild(ipt_id);
//   parent.removeChild(tgt_id);	
// }