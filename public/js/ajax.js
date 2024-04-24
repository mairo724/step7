'use strict'

$('#seach_btn').on('click', function() {
    $('#target').toggle("slow");
    $('#target').css("background","red");
  });


//ソート機能
 $(document).ready(function() {
    $('#fav-table').tablesorter();
});

