$(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});

$(document).on("change", "#category_id", function() {  
    var id =  $("#category_id").val();
    $.ajax ({
        url: appurl+'admin/get-subcategory',
      type: 'POST',
      data: "id=" + id,
      success: function(res) {
        if(res){
              $("#subcategory_id").empty();
              $("#subcategory_id").append('<option value="">--Select Subcategory--</option>');
              $.each(res,function(key,value){
                  $("#subcategory_id").append('<option value="'+key+'">'+value+'</option>');
              });
          }else{
             $("#subcategory_id").empty();
           
          }

      }

    });
});
